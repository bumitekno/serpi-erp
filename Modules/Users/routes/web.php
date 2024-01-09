<?php

use Illuminate\Support\Facades\Route;
use Modules\Users\app\Http\Controllers\UsersController;

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
    Route::resource('users', UsersController::class)->names('users')->middleware('auth');
    Route::post('users/remove/multiple', [UsersController::class, 'destroy_multiple'])->name('users.remove.mt')->middleware('auth');
});
