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
    Route::post('/create/', 'TableBookingsController@store');
    Route::get('/checkout/{id}', 'TableBookingsController@checkout');
    Route::get('/checkout/success/{id}', 'TableBookingsController@postsuccess');
    Route::get('/success/{id}', 'TableBookingsController@success');
    Route::get('user-show/{id}', 'TableBookingsController@usershow');

});

Route::prefix('admin/table-bookings')->group(function() {
    Route::get('/', 'TableBookingsController@index');
    Route::get('destroy/{id}', 'TableBookingsController@destroy');
    Route::get('status/{id}', 'TableBookingsController@status');
    Route::get('show/{id}', 'TableBookingsController@show');


});