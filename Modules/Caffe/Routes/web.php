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

Route::prefix('caffe')->group(function() {
    Route::get('/', 'CaffeController@index');
    Route::get('create', 'CaffeController@create');
    Route::post('store', 'CaffeController@store');
    Route::get('edit/{id}', 'CaffeController@edit');
    Route::post('update/{id}', 'CaffeController@update');
    Route::get('destroy/{id}', 'CaffeController@destroy');
});
