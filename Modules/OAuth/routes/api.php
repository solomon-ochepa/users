<?php

use Illuminate\Support\Facades\Route;
use Modules\OAuth\app\Http\Controllers\APi\OAuthController;

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
    Route::post('/register', [OAuthController::class, 'register'])->name('register');
    Route::post('/login', [OAuthController::class, 'login'])->name('login');
});
