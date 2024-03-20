<?php
use App\Addons\Accounting\Controllers\AccountAccountController;
use App\Addons\Accounting\Controllers\AccountCompanyController;
use Illuminate\Support\Facades\Route;

Route::get('Account', [AccountAccountController::class, 'index'])->name('account.index');

Route::prefix('company')->group(function () {
    Route::get('/', [AccountCompanyController::class, 'index'])->name('account.company');
    Route::get('/create', [AccountCompanyController::class, 'create'])->name('account.company.create');
});