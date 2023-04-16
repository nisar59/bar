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


Route::group(['prefix'=>'admin/sittings','middleware' => ['permission:sittings.add']],function(){
    Route::get('/', 'SittingsController@index');
    Route::get('create', 'SittingsController@create');
    Route::post('store', 'SittingsController@store');

});
Route::group(['prefix'=>'admin/sittings','middleware' => ['permission:sittings.edit']],function(){
    Route::get('edit/{id}', 'SittingsController@edit');
    Route::post('update/{id}', 'SittingsController@update');
    Route::get('status/{id}', 'SittingsController@status');


});
Route::group(['prefix'=>'admin/sittings','middleware' => ['permission:sittings.delete']],function(){
    Route::get('table/destroy/{id}', 'SittingsController@destroy');
});