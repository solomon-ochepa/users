<?php

use Illuminate\Support\Facades\Route;
use Modules\OAuth\app\Http\Controllers\OAuthController;

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
    Route::resource('oauth', OAuthController::class)->except(['index'])->names('oauth');
    Route::get('oauths', [OAuthController::class, 'index'])->name('oauth.index');
    Route::get('oauth/{oauth}/restore', [OAuthController::class, 'restore'])->name('oauth.restore');
    Route::delete('oauth/{oauth}/permanent', [OAuthController::class, 'permanent'])->name('oauth.destroy.permanent');
    Route::get('oauth', fn () => redirect()->route('oauth.index'))->name('oauth.index.redirect');
});
