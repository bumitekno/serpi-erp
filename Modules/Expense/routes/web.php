<?php

use Illuminate\Support\Facades\Route;
use Modules\Expense\app\Http\Controllers\ExpenseController;

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
    Route::resource('expense', ExpenseController::class)->names('expense');
    Route::get('expense/search/filter', [ExpenseController::class, 'index'])->name('expense.search');
    Route::post('expense/search/filter', [ExpenseController::class, 'index'])->name('expense.search');
    Route::get('expense/trans/create/{id}', [ExpenseController::class, 'createtrans'])->name('expense.create_trans');
    Route::get('expense/trans/edit/{id}', [ExpenseController::class, 'edittrans'])->name('expense.edittrans');
    Route::post('expense/trans/store', [ExpenseController::class, 'storetrans'])->name('expense.storetrans');
    Route::put('expense/trans/update/{id}', [ExpenseController::class, 'updatetrans'])->name('expense.update_trans');
    Route::get('expense/trans/delete/{id}', [ExpenseController::class, 'destroytrans'])->name('expense.destroytrans');
});
