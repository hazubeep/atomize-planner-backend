<?php

namespace App\Observers;

use App\Models\TaskStep;
use App\Models\Task;

class TaskStepObserver
{
    public function updated(TaskStep $taskStep)
    {
        if ($taskStep->wasChanged('is_completed') && $taskStep->is_completed) {
            $task = $taskStep->task;
            if ($task) {
                $allCompleted = $task->taskSteps()->where('is_completed', false)->count() === 0;
                if ($allCompleted && $task->status !== 'completed') {
                    $task->status = 'completed';
                    $task->save();
                }
            }
        }
    }
}
