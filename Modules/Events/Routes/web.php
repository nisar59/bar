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

Route::prefix('events')->group(function() {
    Route::get('/', 'EventsController@index');
    Route::get('create', 'EventsController@create');
    Route::post('store', 'EventsController@store');
    Route::get('edit/{id}', 'EventsController@edit');
    Route::post('update/{id}', 'EventsController@update');
    Route::get('destroy/{id}', 'EventsController@destroy');
});
