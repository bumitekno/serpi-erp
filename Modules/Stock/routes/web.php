<?php

use Illuminate\Support\Facades\Route;
use Modules\Stock\app\Http\Controllers\StockController;

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
    Route::resource('stock', StockController::class)->names('stock');
    Route::post('stock/search', [StockController::class, 'index'])->name('stock.search');
    Route::get('stock/in/purchase', [StockController::class, 'createstokP'])->name('stock.createstockp');
    Route::get('stock/opname/create', [StockController::class, 'createopname'])->name('stock.createopname');
    Route::post('stock/list/product', [StockController::class, 'ajaxproduct'])->name('stock.ajaxproduct');
    Route::post('stock/opname/store', [StockController::class, 'storeopname'])->name('stock.storeopname');
    Route::get('stock/download/opname', [StockController::class, 'download_stockopname'])->name('stock.download_stockopname');
});
