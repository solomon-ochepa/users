<?php

use App\Http\Controllers\Auth\TokenController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::prefix('v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::post('/user', [AuthController::class, 'user'])->name('user');
        Route::post('tokens', [TokenController::class, 'index'])->name('token.index');
    });

    Route::apiResource('token', TokenController::class)->except(['index'])->names('token');
    Route::get('token', fn () => ['Not found.'])->name('token.index.redirect');
});
