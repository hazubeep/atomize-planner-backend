<?php

namespace Database\Factories;

use App\Models\TaskStep;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TaskStep>
 */
class TaskStepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'task_id' => 1, // Override in seeder for real relation
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->optional()->paragraph(),
            'status' => 'pending',
            'is_completed' => false,
            'is_current_focus' => false,
            'estimated_duration' => $this->faker->numberBetween(5, 60),
            'order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
