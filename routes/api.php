<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\ReportController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('clients', ClientController::class);
    Route::apiResource('projects', ProjectController::class);

    Route::post('/time-logs/start', [TimeLogController::class, 'start']);
    Route::put('/time-logs/{timeLog}/end', [TimeLogController::class, 'end']);
    Route::apiResource('time-logs', TimeLogController::class)->except(['store']);

    Route::get('/report', [ReportController::class, 'report']);
});
