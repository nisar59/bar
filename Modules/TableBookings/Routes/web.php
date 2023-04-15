<?php

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

Route::prefix('table-bookings')->group(function() {
    Route::get('/', 'TableBookingsController@index');
    Route::get('/create', 'TableBookingsController@create');
    Route::get('/store/{id}', 'TableBookingsController@store');
    Route::get('/checkout/{id}', 'TableBookingsController@checkout');

});

Route::prefix('admin/table-bookings')->group(function() {
    Route::get('/', 'TableBookingsController@index');
    Route::get('/create', 'TableBookingsController@create');

});