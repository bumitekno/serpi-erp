<?php

use Illuminate\Support\Facades\Route;
use Modules\Sales\app\Http\Controllers\SalesController;

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
    Route::resource('sales', SalesController::class)->names('sales');
    Route::get('add-cart/{id}', [SalesController::class, 'addToCart'])->name('sales.addcart');
    Route::get('clear-cart', [SalesController::class, 'clearCart'])->name('sales.clearcart');
});