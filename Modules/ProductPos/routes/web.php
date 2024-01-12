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

    Route::prefix('tools-productpos')->group(function () {
        Route::post('import', [ProductPosController::class, 'import'])->name('tools-productpos.import');
        Route::get('export', [ProductPosController::class, 'export'])->name('tools-productpos.export');
        Route::get('download', [ProductPosController::class, 'download'])->name('tools-productpos.download');
        Route::get('importview', [ProductPosController::class, 'importview'])->name('tools-productpos.importview');
    });
});
