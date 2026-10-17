<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

// Public
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me',      [AuthController::class, 'me']);

    Route::get('/vehicles',               [VehicleController::class, 'index']);
    Route::post('/vehicles',              [VehicleController::class, 'store']);
    Route::get('/vehicles/{vehicle}',     [VehicleController::class, 'show']);
    Route::put('/vehicles/{vehicle}',     [VehicleController::class, 'update']);
    Route::delete('/vehicles/{vehicle}',  [VehicleController::class, 'destroy']);
});