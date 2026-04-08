<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskStepController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\FocusSessionController;

Route::prefix('v1')->group(function () {

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/auth/logout', [AuthController::class, 'logout']);

        Route::get('/tasks', [TaskController::class, 'index']);
        Route::post('/tasks/atomize', [TaskController::class, 'atomize']);
        Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);
        Route::post('/tasks/{taskId}/steps', [TaskStepController::class, 'store']);
        Route::patch('/tasks/{taskId}/steps/{stepId}/toggle', [TaskStepController::class, 'toggle']);
        Route::patch('/tasks/{task}/steps/{step}', [TaskStepController::class, 'update']);
        Route::delete('/tasks/{task}/steps/{step}', [TaskStepController::class, 'delete']);

        Route::post('/tasks', [TaskController::class, 'store']);
        Route::get('/tasks/{id}', [TaskController::class, 'show']);
        Route::patch('/tasks/{id}', [TaskController::class, 'update']);
        Route::post('/tasks/{taskId}/steps/{stepId}/mark-working', [TaskStepController::class, 'markWorking']);

        Route::get('/profile', [ProfileController::class, 'show']);
        Route::patch('/profile', [ProfileController::class, 'update']);
        Route::delete('/profile', [ProfileController::class, 'destroy']);

        Route::post('/profile/avatar', [ProfileController::class, 'uploadAvatar']);
        Route::delete('/profile/avatar', [ProfileController::class, 'removeAvatar']);

        Route::post('/profile/change-password', [PasswordController::class, 'update']);

        Route::prefix('/focus')->group(function () {
            Route::post('/sessions', [FocusSessionController::class, 'store']);
            Route::get('/sessions/active', [FocusSessionController::class, 'active']);
            Route::post('/sessions/{session}/complete', [FocusSessionController::class, 'complete']);
            Route::post('/sessions/{session}/cancel', [FocusSessionController::class, 'cancel']);
            Route::patch('/sessions/{session}/settings', [FocusSessionController::class, 'updateSettings']);
        });
    });
});
