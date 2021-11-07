<?php

use Illuminate\Support\Facades\Route;

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


Route::prefix('/')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('', 'DashboardController@index')->name('dashboard');
        Route::get('transaction/{id}/set-status', 'TransactionController@status')->name('transaction.status');
        Route::resource('product', 'ProductController');
        Route::resource('product-galleries', 'ProductGalleryController');

        Route::resource('transaction', 'TransactionController');
    });

Auth::routes();
