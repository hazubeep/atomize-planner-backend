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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->text('title');
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'completed', 'archived'])
                ->default('active');
            $table->string('category')
                ->nullable()
                ->comment("Default: strategy, development, planning, design, research, marketing, other");
            $table->integer('progress_percentage')->default(0);
            $table->timestamps();
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {d
        Schema::dropIfExists('tasks');
    }
};
