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

Route::prefix('menu')->group(function() {
    Route::get('/', 'MenuController@index');
    Route::get('create', 'MenuController@create');
    Route::post('store', 'MenuController@store');
    Route::get('edit/{id}', 'MenuController@edit');
    Route::post('update/{id}', 'MenuController@update');
    Route::get('destroy/{id}', 'MenuController@destroy');
});
