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

Route::group(['prefix'=>'admin/tables-reservation','middleware' => ['permission:tables-reservation.view']],function(){
   Route::get('/', 'TablesReservationController@index');
});

Route::group(['prefix'=>'admin/tables-reservation','middleware' => ['permission:tables-reservation.add']],function(){
     Route::get('create', 'TablesReservationController@create');
    Route::post('store', 'TablesReservationController@store');

});
Route::group(['prefix'=>'admin/tables-reservation','middleware' => ['permission:tables-reservation.edit']],function(){
    Route::get('edit/{id}', 'TablesReservationController@edit');
    Route::get('show/{id}', 'TablesReservationController@show');
    Route::post('update/{id}', 'TablesReservationController@update');
    Route::get('status/{id}', 'TablesReservationController@status');

});
Route::group(['prefix'=>'admin/tables-reservation','middleware' => ['permission:tables-reservation.delete']],function(){
    Route::get('destroy/{id}', 'TablesReservationController@destroy');
});