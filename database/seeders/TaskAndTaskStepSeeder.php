<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\TaskStep;

class TaskAndTaskStepSeeder extends Seeder
{
    public function run()
    {
        // Create 3 tasks for user_id 1
        $tasks = Task::factory()->count(3)->create(['user_id' => 1]);

        // For each task, create 5 steps
        foreach ($tasks as $task) {
            TaskStep::factory()->count(5)->create([
                'task_id' => $task->id,
            ]);
        }
    }
}
