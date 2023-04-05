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

Route::prefix('pages')->group(function() {
    Route::get('/', 'PagesController@index');
    Route::get('create', 'PagesController@create');
    Route::post('store', 'PagesController@store');
    Route::get('edit/{id}', 'PagesController@edit');
    Route::post('update/{id}', 'PagesController@update');
    Route::get('destroy/{id}', 'PagesController@destroy');
    Route::get('block/{id}', 'PagesController@block');

});
