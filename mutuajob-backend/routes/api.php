<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'apiLogin']);

Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);

    Route::post('/2fa/enable', [AuthController::class, 'enable2FA']);
    Route::post('/2fa/verify', [AuthController::class, 'verify2FA']);
});