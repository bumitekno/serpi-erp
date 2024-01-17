<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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
