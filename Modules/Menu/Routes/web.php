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

Route::group(['prefix'=>'admin/menu','middleware' => ['permission:menu.view']],function(){
   Route::get('/', 'MenuController@index');
});

Route::group(['prefix'=>'admin/menu','middleware' => ['permission:menu.add']],function(){
     Route::get('create', 'MenuController@create');
    Route::post('store', 'MenuController@store');

});
Route::group(['prefix'=>'admin/menu','middleware' => ['permission:menu.edit']],function(){
    Route::get('edit/{id}', 'MenuController@edit');
    Route::post('update/{id}', 'MenuController@update');
    Route::get('status/{id}', 'MenuController@status');

});
Route::group(['prefix'=>'admin/menu','middleware' => ['permission:menu.delete']],function(){
    Route::get('destroy/{id}', 'MenuController@destroy');
});