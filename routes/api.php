<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

    // Common User routes
    Route::get('reports', [ReportController::class, 'index']);
    Route::get('reports/{report}', [ReportController::class, 'show']);
    Route::post('reports', [ReportController::class, 'store']); // allow users to create reports

    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{contact}', [ContactController::class, 'show']);

    Route::get('tips', [TipController::class, 'index']);
    Route::get('tips/{tip}', [TipController::class, 'show']);

        // Admin routes
        Route::apiResource('reports', ReportController::class)->except(['store']); // except store because it's defined above
        Route::apiResource('contacts', ContactController::class);
        Route::apiResource('tips', TipController::class);

        Route::apiResource('users', UserController::class);
        Route::put('users/{id}/password', [UserController::class, 'updatePassword']);
        Route::delete('users/{id}', [UserController::class, 'destroy']);

        Route::get('users/{user}/reports', [ReportController::class, 'userReports']);
        Route::get('reports/users', [ReportController::class, 'index']);
        Route::get('allusers', [UserController::class, 'index']);



