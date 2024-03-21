<?php
use App\Addons\Accounting\Controllers\AccountAccountController;
use App\Addons\Accounting\Controllers\AccountCompanyController;
use Illuminate\Support\Facades\Route;

Route::prefix('account')->group(function () {
    Route::get('/', [AccountAccountController::class, 'index'])->name('account.index');
    Route::post('/', [AccountAccountController::class, 'index'])->name('account.search');
    Route::get('/create', [AccountAccountController::class, 'create'])->name('account.create');
    Route::post('/store', [AccountAccountController::class, 'store'])->name('account.store');
    Route::get('/edit/{id}', [AccountAccountController::class, 'edit'])->name('account.edit');
    Route::put('/update/{id}', [AccountAccountController::class, 'update'])->name('account.update');
    Route::get('/delete/{id}', [AccountAccountController::class, 'destroy'])->name('account.destroy');
});

Route::prefix('company')->group(function () {
    Route::get('/', [AccountCompanyController::class, 'index'])->name('account.company');
    Route::post('/', [AccountCompanyController::class, 'index'])->name('account.company.search');
    Route::get('/create', [AccountCompanyController::class, 'create'])->name('account.company.create');
});