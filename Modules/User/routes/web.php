<?php

use Illuminate\Support\Facades\Route;
use Modules\User\app\Http\Controllers\UserController;

/*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('user', UserController::class)->except(['index'])->names('user');
    Route::get('users', [UserController::class, 'index'])->name('user.index');
    Route::get('user/{user}/restore', [UserController::class, 'restore'])->name('user.restore');
    Route::delete('user/{user}/permanent', [UserController::class, 'permanent'])->name('user.destroy.permanent');
    Route::get('user', fn () => redirect()->route('user.index'))->name('user.index.redirect');
});
