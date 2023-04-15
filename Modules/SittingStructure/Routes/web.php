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

Route::group(['prefix'=>'admin/sitting-structure','middleware' => ['permission:sitting-structure.add']],function(){
    Route::get('/', 'SittingStructureController@index');
    Route::post('store', 'SittingStructureController@store');
    Route::post('table/store', 'SittingStructureController@tablestore');

});
Route::group(['prefix'=>'admin/sitting-structure','middleware' => ['permission:sitting-structure.edit']],function(){
    Route::post('table/update/{id}', 'SittingStructureController@update');


});
Route::group(['prefix'=>'admin/sitting-structure','middleware' => ['permission:sitting-structure.delete']],function(){
    Route::get('table/destroy/{id}', 'SittingStructureController@destroy');
});