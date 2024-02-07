<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductPos\app\Http\Controllers\ProductPosController;

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
    Route::resource('productpos', ProductPosController::class)->names('productpos');
    Route::post('productpos/search/filter', [ProductPosController::class, 'index'])->name('productpos.search');
    Route::get('productpos/search/filter', [ProductPosController::class, 'index'])->name('productpos.search');
    Route::prefix('productpos')->group(function () {
        Route::post('import/data', [ProductPosController::class, 'import'])->name('tools-productpos.import');
        Route::get('export/data', [ProductPosController::class, 'export'])->name('tools-productpos.export');
        Route::get('download/template', [ProductPosController::class, 'download'])->name('tools-productpos.download');
        Route::get('importview/import', [ProductPosController::class, 'importview'])->name('tools-productpos.importview');
    });
    Route::post('productpos/printbarcode/label', [ProductPosController::class, 'printbarcode'])->name('productpos.printbarcode');
});
