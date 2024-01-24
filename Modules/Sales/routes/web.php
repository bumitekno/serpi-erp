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
    Route::get('delete-cart/{id}', [SalesController::class, 'deletecart'])->name('sales.deletecart');
    Route::get('clear-cart', [SalesController::class, 'clearCart'])->name('sales.clearcart');
    Route::get('filter/{filter}', [SalesController::class, 'create'])->name('sales.filter');
    Route::get('search/{keyword}', [SalesController::class, 'create'])->name('sales.search');
    Route::post('scanbarcode', [SalesController::class, 'scancart'])->name('sales.scancart');
    Route::post('customer/store', [SalesController::class, 'storecustomer'])->name('sales.storecustomer');
    Route::post('discount-cart', [SalesController::class, 'updateDiscount'])->name('sales.updateDiscount');
    Route::post('tax-cart', [SalesController::class, 'updatetax'])->name('sales.updatetax');
});
