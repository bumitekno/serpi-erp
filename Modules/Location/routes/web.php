<?php

use Illuminate\Support\Facades\Route;
use Modules\Location\app\Http\Controllers\LocationController;

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

Route::group([], function () {
    Route::resource('location', LocationController::class)->names('location');
    Route::post('location/store', [LocationController::class, 'store'])->name('location.store');
    Route::post('location', [LocationController::class, 'index'])->name('location.search');
});
