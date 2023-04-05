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

Route::prefix('faqs')->group(function() {
    Route::get('/', 'FaqsController@index');
    Route::get('create', 'FaqsController@create');
    Route::post('store', 'FaqsController@store');
    Route::get('edit/{id}', 'FaqsController@edit');
    Route::post('update/{id}', 'FaqsController@update');
    Route::get('destroy/{id}', 'FaqsController@destroy');
});
