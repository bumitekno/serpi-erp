<?php

use Illuminate\Support\Facades\Route;
use Modules\Purchase\app\Http\Controllers\PurchaseController;

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
    Route::resource('purchase', PurchaseController::class)->names('purchase');
    Route::post('purchase/pay/credit/due', [PurchaseController::class, 'pay_credit'])->name('purchase.pay_credit');
    Route::post('purchase/add/supplier', [PurchaseController::class, 'storesupplier'])->name('purchase.storesupplier');
    Route::post('purchase/history/filter', [PurchaseController::class, 'index'])->name('purchase.filter-history');
    Route::get('purchase/history/filter', [PurchaseController::class, 'index'])->name('purchase.filter-history');
    Route::get('purchase/transfer/stock/{id}', [PurchaseController::class, 'storetransfer'])->name('purchase.storetransfer');
    Route::get('puchase/export/trans', [PurchaseController::class, 'download_transaction'])->name('purchase.download_transaction');
});
