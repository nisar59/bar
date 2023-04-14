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

Route::group(['prefix'=>'admin/bottomless-brunch','middleware' => ['permission:bottomless-brunch.view']],function(){
   Route::get('/', 'BrunchController@index');
});

Route::group(['prefix'=>'admin/bottomless-brunch','middleware' => ['permission:bottomless-brunch.add']],function(){
     Route::get('create', 'BrunchController@create');
    Route::post('store', 'BrunchController@store');

});
Route::group(['prefix'=>'admin/bottomless-brunch','middleware' => ['permission:bottomless-brunch.edit']],function(){
    Route::get('edit/{id}', 'BrunchController@edit');
    Route::post('update/{id}', 'BrunchController@update');
    Route::get('status/{id}', 'BrunchController@status');

});
Route::group(['prefix'=>'admin/bottomless-brunch','middleware' => ['permission:bottomless-brunch.delete']],function(){
    Route::get('destroy/{id}', 'BrunchController@destroy');
});
