<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Http\Controllers\Api\UserController;

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
    Route::middleware(['auth:api'])->group(function () {
        Route::post('/user', [UserController::class, 'user'])->name('user');
    });
});
