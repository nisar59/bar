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

Route::group(['prefix'=>'admin/caffe-menu','middleware' => ['permission:caffe-menu.view']],function(){
   Route::get('/', 'CaffeController@index');
});

Route::group(['prefix'=>'admin/caffe-menu','middleware' => ['permission:caffe-menu.add']],function(){
     Route::get('create', 'CaffeController@create');
    Route::post('store', 'CaffeController@store');

});
Route::group(['prefix'=>'admin/caffe-menu','middleware' => ['permission:caffe-menu.edit']],function(){
    Route::get('edit/{id}', 'CaffeController@edit');
    Route::post('update/{id}', 'CaffeController@update');
    Route::get('status/{id}', 'CaffeController@status');

});
Route::group(['prefix'=>'admin/caffe-menu','middleware' => ['permission:caffe-menu.delete']],function(){
    Route::get('destroy/{id}', 'CaffeController@destroy');
});
