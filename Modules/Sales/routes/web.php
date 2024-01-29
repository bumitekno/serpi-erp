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
    Route::get('edit-cart/{id}', [SalesController::class, 'editcart'])->name('sales.editcart');
    Route::get('add-cart/{id}/{departement}', [SalesController::class, 'addToCart'])->name('sales.addcart');
    Route::get('delete-cart/{id}', [SalesController::class, 'deletecart'])->name('sales.deletecart');
    Route::get('clear-cart', [SalesController::class, 'clearCart'])->name('sales.clearcart');
    Route::get('filter/{filter}', [SalesController::class, 'create'])->name('sales.filter');
    Route::get('search/{keyword}', [SalesController::class, 'create'])->name('sales.search');
    Route::post('scanbarcode', [SalesController::class, 'scancart'])->name('sales.scancart');
    Route::post('customer/store', [SalesController::class, 'storecustomer'])->name('sales.storecustomer');
    Route::post('discount-cart', [SalesController::class, 'updateDiscount'])->name('sales.updateDiscount');
    Route::post('tax-cart', [SalesController::class, 'updatetax'])->name('sales.updatetax');
    Route::post('update-cart', [SalesController::class, 'updatecart'])->name('sales.updatecart');
    Route::get('change/customer/{customer}', [SalesController::class, 'changeCust'])->name('sales.changecust');
    Route::get('change/departement/{departement}', [SalesController::class, 'changeDepart'])->name('sales.changedepart');
    Route::get('struck/print/small/{id}', [SalesController::class, 'printsmall'])->name('sales.printsmall');
    Route::post('sales/saved/transaction', [SalesController::class, 'temptransaction'])->name('sales.temptransaction');
    Route::get('list/trans/saved', [SalesController::class, 'ajax_trans_saved'])->name('sales.list-saved');
    Route::get('call/saved/transaction/{id}', [SalesController::class, 'choose_transaction'])->name('sales.choose_transaction');
    Route::get('delete/saved/transaction/{id}', [SalesController::class, 'removeTrans'])->name('sales.removeTrans');
    Route::post('pay/credit/due', [SalesController::class, 'pay_credit'])->name('sales.pay_credit');
});
