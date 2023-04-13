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


Route::group(['prefix'=>'admin/social-media','middleware' => ['permission:social-media.add']],function(){
    Route::get('/', 'SocialmediaController@index');
     Route::get('create', 'SocialmediaController@create');
    Route::post('store', 'SocialmediaController@store');

});
Route::group(['prefix'=>'admin/social-media','middleware' => ['permission:social-media.edit']],function(){
    Route::get('edit/{id}', 'SocialmediaController@edit');
    Route::post('update/{id}', 'SocialmediaController@update');
    Route::get('status/{id}', 'SocialmediaController@status');


});
Route::group(['prefix'=>'admin/social-media','middleware' => ['permission:social-media.delete']],function(){
    Route::get('destroy/{id}', 'SocialmediaController@destroy');
});