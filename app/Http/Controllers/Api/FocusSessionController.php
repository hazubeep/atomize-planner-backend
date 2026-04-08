<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StartFocusSessionRequest;
use App\Http\Requests\UpdateFocusSettingsRequest;
use App\Models\FocusSession;
use App\Models\TaskStep;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FocusSessionController extends Controller
{
    public function store(StartFocusSessionRequest $request)
    {
        $user = $request->user();

        $hasActive = FocusSession::where('user_id', $user->id)
            ->where('status', 'active')
            ->exists();

        if ($hasActive) {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'SESSION_ALREADY_ACTIVE',
                    'message' => 'You already have an active focus session. Please complete or cancel it first.'
                ],
            ], 409);
        }

        $step = TaskStep::whereHas('task', fn($q) => $q->where('user_id', $user->id))
            ->where('task_id', $request->task_id)
            ->findOrFail($request->step_id);

        $durationMinutes = $request->input('duration_minutes', 25);
        $startedAt = Carbon::now();

        $session = FocusSession::create([
            'user_id' => $user->id,
            'task_id' => $request->task_id,
            'task_step_id' => $step->id,
            'duration_minutes' => $durationMinutes,
            'session_notes' => $request->session_notes,
            'status' => 'active',
            'started_at' => $startedAt,
            'ended_at' => null
        ]);

        return response()->json([
            'success' => true,
            'data' => $this->formatSession($session, $step)
        ]);
    }

    public function active(Request $request)
    {
        $session = FocusSession::with('taskStep')
            ->where('user_id', $request->user()->id)
            ->where('status', 'active')
            ->latest('started_at')
            ->first();

        if (!$session) {
            return response()->noContent();
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatSession($session, $session->taskStep)
        ]);
    }

    public function complete(Request $request, FocusSession $session)
    {
        $this->authorizeSession($session, $request->user()->id);

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'SESSION_ALREADY_ENDED',
                    'message' => 'This session has already been completed or cancelled.'
                ]
            ], 409);
        }

        $endedAt = Carbon::now();
        $actualDuration = (int) Carbon::parse($session->started_at)->diffInMinutes($endedAt);

        $session->update([
            'status' => 'completed',
            'ended_at' => $endedAt,
            'actual_duration_minutes' => $actualDuration
        ]);

        $step = $session->taskStep;
        $step->update([
            'status' => 'completed',
            'is_completed' => true,
            'is_current_focus' => false,
        ]);

        $task = $step->task;
        $totalSteps = $task->taskSteps()->count();
        $completedSteps = $task->taskSteps()->where('is_completed', true)->count();
        $progressPct = $totalSteps > 0 ? (int) round($completedSteps / $totalSteps * 100) : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'session_id' => $session->id,
                'step_id' => $step->id,
                'step_status' => 'completed',
                'task_progress_percentage' => $progressPct,
                'completed_at' => $endedAt->toISOString(),
                'actual_duration_minutes' => $actualDuration
            ]
        ]);
    }

    public function cancel(Request $request, FocusSession $session)
    {
        $this->authorizeSession($session, $request->user()->id);

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'SESSION_ALREADY_ENDED',
                    'message' => 'This session has already been completed or cancelled.'
                ]
            ], 409);
        }

        $endedAt = Carbon::now();
        $actualDuration = (int) Carbon::parse($session->started_at)->diffInMinutes($endedAt);

        $session->update([
            'status' => 'cancelled',        
            'ended_at' => $endedAt,
            'actual_duration_minutes' => $actualDuration
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Focus session cancelled. Your step progress has been saved.'
        ]);
    }

    public function updateSettings(UpdateFocusSettingsRequest $request, FocusSession $session)
    {
        $this->authorizeSession($session, $request->user()->id);

        if ($session->status !== 'active') {
            return response()->json([
                'success' => false,
                'error' => [
                    'code' => 'SESSION_NOT_ACTIVE',
                    'message' => 'Settings can only be updated on an active session.'
                ]
            ], 409);
        }

        $session->update($request->validated());

        return response()->json([
            'success' => true,
            'data' => $this->formatSession($session->fresh(), $session->taskStep)
        ]);
    }

    private function authorizeSession(FocusSession $session, int $userId): void
    {
        if ($session->user_id !== $userId) {
            abort(403, 'This session does not belong to you.');
        }
    }

    private function formatSession(FocusSession $session, TaskStep $step): array
    {
        $endsAt = Carbon::parse($session->started_at)
            ->addMinutes($session->duration_times);

        return [
            'session_id' => $session->id,
            'task_id' => $session->task_id,
            'step_id' => $session->task_step_id,
            'objective' => $step->title,
            'duration_minutes' => $session->duration_minutes,
            'session_notes' => $session->session_notes,
            'status' => $session->status,
            'deep_focus_active' => $session->status === 'active',
            'started_at' => Carbon::parse($session->started_at)->toISOString(),
            'ends_at' => $endsAt->toISOString(),
        ];
    }
}
