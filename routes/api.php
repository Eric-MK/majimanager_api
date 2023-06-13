<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TipController;
use App\Http\Controllers\AuthController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

    // Common User routes
    Route::get('reports', [ReportController::class, 'index']);
    Route::get('reports/{id}', [ReportController::class, 'show']);
    Route::post('reports', [ReportController::class, 'store']); // allow users to create reports

    Route::get('contacts', [ContactController::class, 'index']);
    Route::get('contacts/{contact}', [ContactController::class, 'show']);

    Route::get('tips', [TipController::class, 'index']);
    Route::get('tips/{id}', [TipController::class, 'show']);

        // Admin routes
        Route::apiResource('reports', ReportController::class)->except(['store']); // except store because it's defined above
        Route::apiResource('contacts', ContactController::class);
        Route::apiResource('tips', TipController::class);


