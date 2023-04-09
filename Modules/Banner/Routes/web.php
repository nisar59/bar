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

Route::group(['prefix'=>'admin/banner','middleware' => ['permission:banner.view']],function(){
   Route::get('/', 'BannerController@index');
});

Route::group(['prefix'=>'admin/banner','middleware' => ['permission:banner.add']],function(){
     Route::get('create', 'BannerController@create');
    Route::post('store', 'BannerController@store');

});
Route::group(['prefix'=>'admin/banner','middleware' => ['permission:banner.edit']],function(){
    Route::get('edit/{id}', 'BannerController@edit');
    Route::get('show/{id}', 'BannerController@show');
    Route::post('update/{id}', 'BannerController@update');
    Route::get('status/{id}', 'BannerController@status');

});
Route::group(['prefix'=>'admin/banner','middleware' => ['permission:banner.delete']],function(){
    Route::get('destroy/{id}', 'BannerController@destroy');
});