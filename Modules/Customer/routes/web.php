<?php

use Illuminate\Support\Facades\Route;
use Modules\Customer\app\Http\Controllers\CustomerController;

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
    Route::resource('customer', CustomerController::class)->names('customer');
    Route::post('customer/filter/list', [CustomerController::class, 'index'])->name('customer.search');
    Route::get('customer/filter/list', [CustomerController::class, 'index'])->name('customer.search');
    Route::get('customer/cardview/{id}', [CustomerController::class, 'cardview'])->name('customer.cardview');
    Route::post('customer/cardview/cardstore', [CustomerController::class, 'cardstore'])->name('customer.cardstore');
    Route::get('customer/cardview/{id}/{status}', [CustomerController::class, 'updatecard'])->name('customer.updatecard');
    Route::get('customer/transcard/{customerid}', [CustomerController::class, 'ajax_trans_viewcard'])->name('customer.ajax_trans_viewcard');
    Route::post('customer/trans/topwithdraw', [CustomerController::class, 'storetranscard'])->name('customer.storetranscard');
    Route::get('customer/sales/{id}', [CustomerController::class, 'createpagesales'])->name('customer.createpagesales');
});
