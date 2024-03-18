<?php
use Illuminate\Support\Facades\Route;

Route::get('Account', 'AccountAccountController@index')->name('account.index');
Route::get('Account/Companny', 'AccountAccountController@company')->name('account.company');
