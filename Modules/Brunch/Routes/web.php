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

Route::prefix('brunch')->group(function() {
    Route::get('/', 'BrunchController@index');
    Route::get('create', 'BrunchController@create');
    Route::post('store', 'BrunchController@store');
    Route::get('edit/{id}', 'BrunchController@edit');
    Route::get('destroy/{id}', 'BrunchController@destroy');
    Route::post('update/{id}', 'BrunchController@update');
});
