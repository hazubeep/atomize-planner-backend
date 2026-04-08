<?php

namespace App\Http\Controllers;

use App\Models\CompletedTaskSnapshot;
use App\Models\Task;
use App\Models\TaskStep;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function getWeeklySummary(Request $request)
    {
        $userId = $request->user()->id;
        $weekOffset = (int) $request->query('week_offset', 0);

        $startOfWeek = now()->subWeeks($weekOffset)->startOfWeek();
        $endOfWeek = now()->subWeeks($weekOffset)->endOfWeek();

        $weekLabel = $startOfWeek->format('M j') . ' – ' . $endOfWeek->format('M j, Y');

        $completedSteps = TaskStep::whereHas('task', function ($q) use ($userId) {
            $q->where('user_id', $userId);
        })
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
            ->get();

        $totalStepsCompleted = $completedSteps->count();

        $daysOfWeek = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $dailyBreakdown = collect($daysOfWeek)->map(function ($day) use ($completedSteps) {
            $count = $completedSteps->filter(function ($step) use ($day) {
                return $step->updated_at->format('D') === $day;
            })->count();
            return [
                'day' => $day,
                'count' => $count
            ];
        })->values()->toArray();

        $tasksCompleted = CompletedTaskSnapshot::where('user_id', $userId)
            ->whereBetween('completed_at', [$startOfWeek, $endOfWeek])
            ->count();

        $totalTasks = Task::where('user_id', $userId)->count();
        $completedTasks = Task::where('user_id', $userId)->where('status', 'completed')->count();
        $completionPercentage = $totalTasks > 0 ? (int) round(($completedTasks / $totalTasks) * 100) : 0;

        return response()->json([
            'success' => true,
            'data' => [
                'week_label' => $weekLabel,
                'total_steps_completed' => $totalStepsCompleted,
                'daily_breakdown' => $dailyBreakdown,
                'achievements' => [
                    'tasks_completed' => $tasksCompleted,
                    'completion_percentage' => $completionPercentage
                ]
            ]
        ]);
    }

    public function getCompletedTasks(Request $request)
    {
        $userId = $request->user()->id;
        $page = (int) $request->query('page', 1);
        $limit = (int) $request->query('limit', 10);
        $category = $request->query('category');

        $query = CompletedTaskSnapshot::where('user_id', $userId);

        if (!empty($category)) {
            $query->where('category', $category);
        }

        $snapshots = $query->orderBy('completed_at', 'desc')->paginate($limit, ['*'], 'page', $page);

        $items = collect($snapshots->items())->map(function ($snapshot) {
            return [
                'id' => $snapshot->id,
                'task_id' => $snapshot->task_id,
                'title' => $snapshot->title,
                'description' => $snapshot->description,
                'category' => $snapshot->category,
                'steps_count' => $snapshot->steps_count,
                'completed_at' => $snapshot->completed_at ? $snapshot->completed_at->toIso8601String() : null,
            ];
        })->values();

        return response()->json([
            'success' => true,
            'data' => [
                'items' => $items,
                'pagination' => [
                    'current_page' => $snapshots->currentPage(),
                    'total_pages' => $snapshots->lastPage(),
                    'total_items' => $snapshots->total(),
                    'has_next_page' => $snapshots->hasMorePages(),
                ]
            ]
        ]);
    }
}
