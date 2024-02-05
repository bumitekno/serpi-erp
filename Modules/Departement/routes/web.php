<?php

use Illuminate\Support\Facades\Route;
use Modules\Departement\app\Http\Controllers\DepartementController;

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
    Route::resource('departement', DepartementController::class)->names('departement');
    Route::post('departement/filter/list', [DepartementController::class, 'index'])->name('departement.search');
    Route::get('departement/filter/list', [DepartementController::class, 'index'])->name('departement.search');
});
