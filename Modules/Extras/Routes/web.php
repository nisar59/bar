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

Route::group(['prefix'=>'admin/extras','middleware' => ['permission:extras.view']],function(){
   Route::get('/', 'ExtrasController@index');
});

Route::group(['prefix'=>'admin/extras','middleware' => ['permission:extras.add']],function(){
     Route::get('create', 'ExtrasController@create');
    Route::post('store', 'ExtrasController@store');

});
Route::group(['prefix'=>'admin/extras','middleware' => ['permission:extras.edit']],function(){
    Route::get('edit/{id}', 'ExtrasController@edit');
    Route::post('update/{id}', 'ExtrasController@update');
    Route::get('status/{id}', 'ExtrasController@status');
});
Route::group(['prefix'=>'admin/extras','middleware' => ['permission:extras.delete']],function(){
    Route::get('destroy/{id}', 'ExtrasController@destroy');
});
