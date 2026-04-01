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
        Schema::create('completed_task_snapshots', function (Blueprint $table) {
           $table->id();
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('task_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('title')
                  ->comment('Snapshot of task title at time of completion');
            $table->text('description')->nullable();
            $table->string('category', 50)
                  ->default('OTHER');
            $table->unsignedSmallInteger('steps_count')
                  ->comment('Total completed steps at time of snapshot');
            $table->timestamp('completed_at');

            $table->index(['user_id', 'completed_at']);
            $table->index(['user_id', 'category']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('completed_task_snapshots');
    }
};
