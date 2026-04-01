<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'status' => 'active',
            'progress_percentage' => 0,
            'category' => 'OTHER',
        ];
    }
}
