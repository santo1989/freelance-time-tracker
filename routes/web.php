<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TimeLogController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Authentication
Route::middleware('guest')->group(function () {
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Clients
    Route::resource('clients', ClientController::class)->except(['show']);

    // Projects
    Route::resource('projects', ProjectController::class)->except(['show']);

    // Time Logs
    Route::resource('time-logs', TimeLogController::class)->except(['show']);
});
