<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\ReportDailyPosController;
use App\Http\Controllers\ShipmentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/auth/checkpost', [AuthController::class, 'Authen'])->name('loginprocess');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('home')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('dashboard');
    Route::get('module/{module}', [HomeController::class, 'checkroute'])->middleware('auth')->name('checkroute');
});

Route::prefix('report')->group(function () {
    Route::prefix('dailypost')->group(function () {
        Route::get('index', [ReportDailyPosController::class, 'index'])->name('report.dailypost');
        Route::get('export/dailypos', [ReportDailyPosController::class, 'downloadreportD'])->name('report.downloadreportD');
    });
    Route::prefix('shipments')->group(function () {
        Route::get('index', [ShipmentController::class, 'index'])->name('report.shipment');
        Route::post('store', [ShipmentController::class, 'store'])->name('report.storeshipment');
    });
})->middleware('auth');

Route::prefix('profil')->group(function () {
    Route::get('index', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('storeupdate', [ProfilController::class, 'storeupdate'])->name('profil.storeupdate');
})->middleware('auth');
