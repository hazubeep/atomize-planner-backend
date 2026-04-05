<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskStepController;
use App\Http\Controllers\Api\PasswordController;

Route::prefix('v1')->group(function () {

    Route::post('/auth/register', [AuthController::class, 'register']);
    Route::post('/auth/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

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
    });
});
