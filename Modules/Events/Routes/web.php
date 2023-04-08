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

Route::group(['prefix'=>'events','middleware' => ['permission:events.view']],function(){
   Route::get('/', 'EventsController@index');
});

Route::group(['prefix'=>'events','middleware' => ['permission:events.add']],function(){
     Route::get('create', 'EventsController@create');
    Route::post('store', 'EventsController@store');

});
Route::group(['prefix'=>'events','middleware' => ['permission:events.edit']],function(){
    Route::get('edit/{id}', 'EventsController@edit');
    Route::post('update/{id}', 'EventsController@update');
});
Route::group(['prefix'=>'events','middleware' => ['permission:events.delete']],function(){
    Route::get('destroy/{id}', 'EventsController@destroy');
});

