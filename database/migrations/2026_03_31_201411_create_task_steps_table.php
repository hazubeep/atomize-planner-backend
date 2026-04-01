<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained()->cascadeOnDelete();
            $table->text('title');
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'current', 'in_progress', 'completed'])
                ->default('pending');
            $table->boolean('is_completed')->default(false);
            $table->boolean('is_current_focus')
                ->default(false)
                ->comment('Only one step per task may be true at a time');
            $table->unsignedSmallInteger('estimated_duration')
                ->nullable()
                ->comment('Estimated completion time in minutes; set by AI or user');
            $table->unsignedSmallInteger('order')
                ->default(0)
                ->comment('Display order within the task');
            $table->timestamps();

            $table->index(['task_id', 'order']);
            $table->index(['task_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task_steps');
    }
};
