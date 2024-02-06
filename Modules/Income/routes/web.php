<?php

use Illuminate\Support\Facades\Route;
use Modules\Income\app\Http\Controllers\IncomeController;

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
    Route::resource('income', IncomeController::class)->names('income');
    Route::get('income/search/filter', [IncomeController::class, 'index'])->name('income.search');
    Route::post('income/search/filter', [IncomeController::class, 'index'])->name('income.search');
    Route::get('income/trans/create/{id}', [IncomeController::class, 'createtrans'])->name('income.create_trans');
    Route::get('income/trans/edit/{id}', [IncomeController::class, 'edittrans'])->name('income.edittrans');
    Route::post('income/trans/store', [IncomeController::class, 'storetrans'])->name('income.storetrans');
    Route::put('income/trans/update/{id}', [IncomeController::class, 'updatetrans'])->name('income.update_trans');
    Route::get('income/trans/delete/{id}', [IncomeController::class, 'destroytrans'])->name('income.destroytrans');
});
