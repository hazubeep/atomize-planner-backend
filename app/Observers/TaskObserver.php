<?php

namespace App\Observers;

use App\Models\CompletedTaskSnapshot;
use App\Models\Task;

use function Symfony\Component\Clock\now;

class TaskObserver
{
    public function updated(Task $task)
    {
        if ($task->isDirty('status') && $task->status === 'completed') {
            $completedStepsCount = $task->taskSteps()->where('status', 'completed')
                ->count();

            CompletedTaskSnapshot::create([
                'user_id' => $task->user_id,
                'task_id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'category' => strtolower($task->category ?? 'other'),
                'steps_count' => $completedStepsCount,
                'completed_at' => now(),
            ]);
        }
    }
}
