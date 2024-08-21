<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', function () {
    return ['status' => 'ok'];
});

Route::prefix('auth')->group(function () {
    Route::post('signup', [UserController::class, 'signup']);
    Route::post('login', [UserController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('', [UserController::class, 'getProfile']);
        Route::put('', [UserController::class, 'updateProfile']);
    });
});
