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


Route::group(['prefix'=>'slider','middleware' => ['permission:slider.add']],function(){
    Route::get('/', 'SliderController@index');
     Route::get('create', 'SliderController@create');
    Route::post('store', 'SliderController@store');

});
Route::group(['prefix'=>'slider','middleware' => ['permission:slider.edit']],function(){
    Route::get('edit/{id}', 'SliderController@edit');
    Route::get('show/{id}', 'SliderController@show');
    Route::post('update/{id}', 'SliderController@update');
    Route::get('status/{id}', 'SliderController@status');

});
Route::group(['prefix'=>'slider','middleware' => ['permission:slider.delete']],function(){
    Route::get('destroy/{id}', 'SliderController@destroy');
});