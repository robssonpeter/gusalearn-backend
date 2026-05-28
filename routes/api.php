<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BadgeController;
use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\ProgressController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {

    // ── Auth (rate-limited) ──────────────────────────────────────────────────
    Route::middleware('throttle:10,1')->group(function () {
        Route::post('auth/register', [AuthController::class, 'register']);
        Route::post('auth/login',    [AuthController::class, 'login']);
    });

    // ── Protected ────────────────────────────────────────────────────────────
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('auth/logout', [AuthController::class, 'logout']);

        Route::get('user', [UserController::class, 'show']);

        Route::get('lessons',      [LessonController::class, 'index']);
        Route::get('lessons/{lesson}', [LessonController::class, 'show']);

        Route::post('lessons/{lesson}/complete', [ProgressController::class, 'complete']);
        Route::post('progress/sync',             [ProgressController::class, 'sync']);

        Route::get('badges', [BadgeController::class, 'index']);
    });
});
