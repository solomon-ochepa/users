<?php

use Illuminate\Support\Facades\Route;
use Modules\Place\app\Http\Controllers\PlaceController;

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
    Route::resource('place', PlaceController::class)->except(['index'])->names('place');
    Route::get('places', [PlaceController::class, 'index'])->name('place.index');
    Route::get('place/{place}/restore', [PlaceController::class, 'restore'])->name('place.restore');
    Route::delete('place/{place}/permanent', [PlaceController::class, 'permanent'])->name('place.destroy.permanent');
    Route::get('place', fn () => redirect()->route('place.index'))->name('place.index.redirect');
});
