<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStep;
use Illuminate\Http\Request;

class TaskStepController extends Controller
{
    public function toggle($taskId, $stepId)
    {
        $step = TaskStep::where('id', $stepId)
            ->whereHas('task', function ($q) use ($taskId) {
                $q->where('id', $taskId)
                    ->where('user_id', auth()->id());
            })
            ->first();

        if (!$step) {
            return response()->json([
                'success' => false,
                'message' => 'Step not found.'
            ], 404);
        }

        $step->is_completed = !$step->is_completed;
        $step->status = $step->is_completed ? 'completed' : 'pending';
        $step->save();

        return response()->json([
            'success' => true,
            'data' => $step
        ]);
    }

    public function store($taskId, Request $request)
    {
        $task = Task::where('id', $taskId)
            ->where('user_id', $request->user()->id)
            ->first();

        if (!$task) {
            return response()->json([
                "success" => false,
                "message" => "Task not found."
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $step = TaskStep::create([
            'task_id' => $task->id,
            'title' => $validated['title'],
            'is_completed' => false
        ]);

        return response()->json([
            "success" => true,
            "data" => $step
        ], 201);
    }

    public function markWorking($taskId, $stepId)
    {
        $step = TaskStep::where('id', $stepId)
            ->whereHas('task', function ($q) use ($taskId) {
                $q->where('id', $taskId)
                    ->where('user_id', auth()->id());
            })
            ->first();

        if (!$step) {
            return response()->json([
                'success' => false,
                'message' => 'Step not found.'
            ], 404);
        }

        TaskStep::where('task_id', $taskId)
            ->update(['is_current_focus' => false]);

        $step->is_current_focus = true;
        $step->status = 'current';
        $step->save();

        return response()->json([
            'success' => true,
            'data' => $step
        ]);
    }

    public function update(Request $request, Task $task, TaskStep $step)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403, 'This task does not belong to you.');
        }

        if ($step->task_id !== $task->id) {
            abort(404, 'Step not found in this task.');
        }

        $validated = $request->validate([
            'title'              => 'sometimes',
            'description'        => 'nullable',
            'status'             => 'sometimes|in:pending,current,in_progress,completed',
            'estimated_duration' => 'sometimes|numeric'
        ]);

        $step->update($validated);

        return response()->json([
            "success" => true,
            "data" => $step->fresh()
        ]);
    }

    public function delete(Request $request, Task $task, TaskStep $step)
    {
        if ($task->user_id !== $request->user()->id) {
            abort(403, 'This task does not belong to you.');
        }

        if ($step->task_id !== $task->id) {
            abort(404, 'Step not found in this task.');
        }

        $step->delete();

        return response()->json([
            "success" => true,
            "message" => "step deleted successfully."
        ]);
    }
}
