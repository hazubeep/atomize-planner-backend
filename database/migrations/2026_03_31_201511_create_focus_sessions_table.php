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
        Schema::create('focus_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('task_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('task_step_id')
                  ->constrained('task_steps')
                  ->cascadeOnDelete();
            $table->unsignedSmallInteger('duration_minutes')
                  ->default(25)
                  ->comment('Timer duration set by user; default = 1 Pomodoro (25 min)');
            $table->text('session_notes')->nullable();
            $table->enum('status', ['active', 'completed', 'cancelled'])
                  ->default('active');
            $table->timestamp('started_at')->useCurrent();
            $table->timestamp('ended_at')
                  ->nullable()
                  ->comment('NULL while the session is still active');
            $table->unsignedSmallInteger('actual_duration_minutes')
                  ->nullable()
                  ->comment('Calculated on complete/cancel: TIMESTAMPDIFF(MINUTE, started_at, ended_at)');
            $table->timestamps();

            $table->index(['user_id', 'status']);
            $table->index('task_step_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('focus_sessions');
    }
};
