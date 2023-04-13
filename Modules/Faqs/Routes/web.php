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


Route::group(['prefix'=>'admin/faqs','middleware' => ['permission:faqs.view']],function(){
   Route::get('/', 'FaqsController@index');
});

Route::group(['prefix'=>'admin/faqs','middleware' => ['permission:faqs.add']],function(){
     Route::get('create', 'FaqsController@create');
    Route::post('store', 'FaqsController@store');

});
Route::group(['prefix'=>'admin/faqs','middleware' => ['permission:faqs.edit']],function(){
    Route::get('edit/{id}', 'FaqsController@edit');
    Route::post('update/{id}', 'FaqsController@update');
    Route::get('status/{id}', 'FaqsController@status');

});
Route::group(['prefix'=>'admin/faqs','middleware' => ['permission:faqs.delete']],function(){
    Route::get('destroy/{id}', 'FaqsController@destroy');
});
