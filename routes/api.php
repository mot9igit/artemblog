<?php

use App\Presentation\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(["web", "auth:sanctum"])->group(function (): void {
    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'findAll']);
        Route::post('/', [UserController::class, 'create']);
        Route::post('complete-reset-password', [UserController::class, 'completeResetPassword'])->withoutMiddleware(['auth:sanctum', 'web']);
        Route::post('reset-password', [UserController::class, 'resetPassword'])->withoutMiddleware(['auth:sanctum', 'web']);
        Route::get('me', [UserController::class, 'findMy']);
        Route::get('{id}/profile', [UserController::class, 'profile']);
        Route::get('{id}', [UserController::class, 'findById']);
        Route::put('{id}', [UserController::class, 'update']);
        Route::delete('{id}', [UserController::class, 'delete']);
    });
});
