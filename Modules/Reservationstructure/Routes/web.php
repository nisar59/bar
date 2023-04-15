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

Route::group(['prefix'=>'admin/reservation-structure','middleware' => ['permission:reservation-structure.add']],function(){
    Route::get('/', 'ReservationstructureController@index');
     Route::get('create', 'ReservationstructureController@create');
    Route::post('store', 'ReservationstructureController@store');

});
Route::group(['prefix'=>'admin/reservation-structure','middleware' => ['permission:reservation-structure.edit']],function(){
    Route::get('edit/{id}', 'ReservationstructureController@edit');
    Route::post('update/{id}', 'ReservationstructureController@update');
    Route::get('status/{id}', 'ReservationstructureController@status');


});
Route::group(['prefix'=>'admin/reservation-structure','middleware' => ['permission:reservation-structure.delete']],function(){
    Route::get('destroy/{id}', 'ReservationstructureController@destroy');
});