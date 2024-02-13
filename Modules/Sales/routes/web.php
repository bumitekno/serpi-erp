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
    Route::get('sales/edit-cart/{id}', [SalesController::class, 'editcart'])->name('sales.editcart');
    Route::get('sales/add-cart/{id}/{departement}', [SalesController::class, 'addToCart'])->name('sales.addcart');
    Route::get('sales/delete-cart/{id}', [SalesController::class, 'deletecart'])->name('sales.deletecart');
    Route::get('sales/clear-cart/session', [SalesController::class, 'clearCart'])->name('sales.clearcart');
    Route::get('sales/filter/{filter}', [SalesController::class, 'create'])->name('sales.filter');
    Route::get('sales/search/{keyword}', [SalesController::class, 'create'])->name('sales.search');
    Route::post('sales/scanbarcode/session', [SalesController::class, 'scancart'])->name('sales.scancart');
    Route::post('sales/customer/store', [SalesController::class, 'storecustomer'])->name('sales.storecustomer');
    Route::post('sales/discount-cart', [SalesController::class, 'updateDiscount'])->name('sales.updateDiscount');
    Route::post('sales/tax-cart', [SalesController::class, 'updatetax'])->name('sales.updatetax');
    Route::post('sales/update-cart', [SalesController::class, 'updatecart'])->name('sales.updatecart');
    Route::get('sales/change/customer/{customer}', [SalesController::class, 'changeCust'])->name('sales.changecust');
    Route::get('sales/change/departement/{departement}', [SalesController::class, 'changeDepart'])->name('sales.changedepart');
    Route::get('sales/struck/print/small/{id}/{route}', [SalesController::class, 'printsmall'])->name('sales.printsmall');
    Route::post('sales/saved/transaction', [SalesController::class, 'temptransaction'])->name('sales.temptransaction');
    Route::get('sales/list/trans/saved', [SalesController::class, 'ajax_trans_saved'])->name('sales.list-saved');
    Route::get('sales/call/saved/transaction/{id}', [SalesController::class, 'choose_transaction'])->name('sales.choose_transaction');
    Route::get('sales/delete/saved/transaction/{id}', [SalesController::class, 'removeTrans'])->name('sales.removeTrans');
    Route::post('sales/pay/credit/due', [SalesController::class, 'pay_credit'])->name('sales.pay_credit');
    Route::post('sales/history/filter', [SalesController::class, 'index'])->name('sales.filter-history');
    Route::get('sales/history/filter', [SalesController::class, 'index'])->name('sales.filter-history');
    Route::get('sales/edit/cancel', [SalesController::class, 'canceledit'])->name('sales.canceledit');
    Route::get('sales/download/transaction', [SalesController::class, 'download_transaction'])->name('sales.download_transaction');
    Route::post('sales/open/balance', [SalesController::class, 'storeopenbal'])->name('sales.storeopenbal');
    Route::get('sales/report/daily/{departement}', [SalesController::class, 'reportdaily'])->name('sales.reportdaily');
});
