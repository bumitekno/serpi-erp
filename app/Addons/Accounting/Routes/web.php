<?php
use App\Addons\Accounting\Controllers\AccountAccountController;
use App\Addons\Accounting\Controllers\AccountCompanyController;
use App\Addons\Accounting\Controllers\AccountJurnalController;
use Illuminate\Support\Facades\Route;


/** group route account  */
Route::prefix('account')->group(function () {
    Route::get('/', [AccountAccountController::class, 'index'])->name('account.index');
    Route::post('/', [AccountAccountController::class, 'index'])->name('account.search');
    Route::get('/create', [AccountAccountController::class, 'create'])->name('account.create');
    Route::post('/store', [AccountAccountController::class, 'store'])->name('account.store');
    Route::get('/edit/{id}', [AccountAccountController::class, 'edit'])->name('account.edit');
    Route::put('/update/{id}', [AccountAccountController::class, 'update'])->name('account.update');
    Route::get('/delete/{id}', [AccountAccountController::class, 'destroy'])->name('account.destroy');
});

/** group route company  */
Route::prefix('company')->group(function () {
    Route::get('/', [AccountCompanyController::class, 'index'])->name('account.company');
    Route::post('/', [AccountCompanyController::class, 'index'])->name('account.company.search');
    Route::get('/create', [AccountCompanyController::class, 'create'])->name('account.company.create');
    Route::post('/post', [AccountCompanyController::class, 'store'])->name('account.company.store');
    Route::get('/edit/{id}', [AccountCompanyController::class, 'edit'])->name('account.company.edit');
    Route::put('/update/{id}', [AccountCompanyController::class, 'update'])->name('account.company.update');
});

/** group route journal */
Route::prefix('journal')->group(function () {
    Route::get('/', [AccountJurnalController::class, 'index'])->name('account.journal');
    Route::get('/edit/{id}', [AccountJurnalController::class, 'edit'])->name('account.journal.edit');
    Route::get('/filter', [AccountJurnalController::class, 'search'])->name('account.journal.filter');
    Route::get('/create', [AccountJurnalController::class, 'create'])->name('account.journal.create');
    Route::post('/post', [AccountJurnalController::class, 'store'])->name('account.journal.store');
});