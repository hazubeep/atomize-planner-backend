<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskStepController;

Route::prefix('v1')->group(function () {

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks/atomize', [TaskController::class, 'atomize']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

        Route::patch('/micro-steps/{id}/toggle', [TaskStepController::class, 'toggle']);
    });
});
