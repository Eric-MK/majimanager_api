<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TipController;


Route::apiResource('reports', ReportController::class);
Route::apiResource('contacts', ContactController::class);
Route::apiResource('tips', TipController::class);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
