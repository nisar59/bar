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

Route::group(['prefix'=>'productshowcase','middleware' => ['permission:productshowcase.view']],function(){
   Route::get('/', 'ProductShowcaseController@index');
});

Route::group(['prefix'=>'productshowcase','middleware' => ['permission:productshowcase.add']],function(){
     Route::get('create', 'ProductShowcaseController@create');
    Route::post('store', 'ProductShowcaseController@store');

});
Route::group(['prefix'=>'productshowcase','middleware' => ['permission:productshowcase.edit']],function(){
    Route::get('edit/{id}', 'ProductShowcaseController@edit');
    Route::get('show/{id}', 'ProductShowcaseController@show');
    Route::post('update/{id}', 'ProductShowcaseController@update');
    Route::get('status/{id}', 'ProductShowcaseController@status');

});
Route::group(['prefix'=>'productshowcase','middleware' => ['permission:productshowcase.delete']],function(){
    Route::get('destroy/{id}', 'ProductShowcaseController@destroy');
});