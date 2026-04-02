<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskStep;

class TaskStepController extends Controller
{

    public function toggle($id)
    {

        $step = TaskStep::findOrFail($id);

        $step->is_completed = !$step->is_completed;
        $step->save();

        $task = Task::with("taskSteps")->find($step->task_id);

        $total = $task->taskSteps->count();
        $done = $task->taskSteps->where("is_completed", true)->count();

        $task->progress_percentage = intval(($done / $total) * 100);
        $task->save();

        return [
            "message" => "Status updated",
            "task_steps" => $step
        ];
    }
}
