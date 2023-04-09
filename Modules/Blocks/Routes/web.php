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

Route::group(['prefix'=>'pages','middleware' => ['permission:pages.edit']],function(){
    Route::get('blocks/{id}', 'BlocksController@index');
    Route::post('blocks/create/{id}/{key}', 'BlocksController@create');
    Route::post('blocks/store/{id}/{key}', 'BlocksController@store');
    Route::get('blocks/edit/{id}/', 'BlocksController@edit');
    Route::post('blocks/update/{id}/', 'BlocksController@update');
    Route::get('blocks/destroy/{id}/', 'BlocksController@destroy');

});