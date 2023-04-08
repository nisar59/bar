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

/*Route::prefix('weaklyevents')->group(function() {
    Route::get('/', 'WeaklyEventsController@index');
    Route::get('create', 'WeaklyEventsController@create');
    Route::post('store', 'WeaklyEventsController@store');
    Route::get('edit/{id}', 'WeaklyEventsController@edit');
    Route::post('update/{id}', 'WeaklyEventsController@update');
    Route::get('destroy/{id}', 'WeaklyEventsController@destroy');
});*/
Route::group(['prefix'=>'weaklyevents','middleware' => ['permission:weaklyevents.view']],function(){
   Route::get('/', 'WeaklyEventsController@index');
});

Route::group(['prefix'=>'weaklyevents','middleware' => ['permission:weaklyevents.add']],function(){
     Route::get('create', 'WeaklyEventsController@create');
    Route::post('store', 'WeaklyEventsController@store');

});
Route::group(['prefix'=>'weaklyevents','middleware' => ['permission:weaklyevents.edit']],function(){
    Route::get('edit/{id}', 'WeaklyEventsController@edit');
    Route::post('update/{id}', 'WeaklyEventsController@update');
});
Route::group(['prefix'=>'weaklyevents','middleware' => ['permission:weaklyevents.delete']],function(){
    Route::get('destroy/{id}', 'WeaklyEventsController@destroy');
});