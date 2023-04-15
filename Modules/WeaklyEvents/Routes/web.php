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

Route::group(['prefix'=>'admin/weekly-events','middleware' => ['permission:weekly-events.view']],function(){
   Route::get('/', 'WeaklyEventsController@index');
});

Route::group(['prefix'=>'admin/weekly-events','middleware' => ['permission:weekly-events.add']],function(){
     Route::get('create', 'WeaklyEventsController@create');
    Route::post('store', 'WeaklyEventsController@store');

});
Route::group(['prefix'=>'admin/weekly-events','middleware' => ['permission:weekly-events.edit']],function(){
    Route::get('edit/{id}', 'WeaklyEventsController@edit');
    Route::post('update/{id}', 'WeaklyEventsController@update');
    Route::get('status/{id}', 'WeaklyEventsController@status');

});
Route::group(['prefix'=>'admin/weekly-events','middleware' => ['permission:weekly-events.delete']],function(){
    Route::get('destroy/{id}', 'WeaklyEventsController@destroy');
});