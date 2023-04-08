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

Route::group(['prefix'=>'caffe','middleware' => ['permission:caffe.view']],function(){
   Route::get('/', 'CaffeController@index');
});

Route::group(['prefix'=>'caffe','middleware' => ['permission:caffe.add']],function(){
     Route::get('create', 'CaffeController@create');
    Route::post('store', 'CaffeController@store');

});
Route::group(['prefix'=>'caffe','middleware' => ['permission:caffe.edit']],function(){
    Route::get('edit/{id}', 'CaffeController@edit');
    Route::post('update/{id}', 'CaffeController@update');
});
Route::group(['prefix'=>'caffe','middleware' => ['permission:caffe.delete']],function(){
    Route::get('destroy/{id}', 'CaffeController@destroy');
});
