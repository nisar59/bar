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

Route::group(['prefix'=>'product-showcase','middleware' => ['permission:product-showcase.view']],function(){
   Route::get('/', 'ProductShowcaseController@index');
});

Route::group(['prefix'=>'product-showcase','middleware' => ['permission:product-showcase.add']],function(){
     Route::get('create', 'ProductShowcaseController@create');
    Route::post('store', 'ProductShowcaseController@store');

});
Route::group(['prefix'=>'product-showcase','middleware' => ['permission:product-showcase.edit']],function(){
    Route::get('edit/{id}', 'ProductShowcaseController@edit');
    Route::get('show/{id}', 'ProductShowcaseController@show');
    Route::post('update/{id}', 'ProductShowcaseController@update');
    Route::get('status/{id}', 'ProductShowcaseController@status');

});
Route::group(['prefix'=>'product-showcase','middleware' => ['permission:product-showcase.delete']],function(){
    Route::get('destroy/{id}', 'ProductShowcaseController@destroy');
    Route::get('image/destroy/{id}', 'ProductShowcaseController@destroyimage');
});