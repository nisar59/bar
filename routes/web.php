<?php

use Illuminate\Support\Facades\Route;

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
Route::get('send-mail', 'FrontendController@send');
Route::get('user-login', 'Auth\LoginController@userloginform');
Route::get('user-register', 'Auth\RegisterController@userregisterform');

Auth::routes();


// Authentication Routes...
Route::get('admin', 'Auth\LoginController@showLoginForm')->name('admin');

Route::get('login', function()
{
	return redirect('user-login');
})->name('login');


Route::any('logout', 'Auth\LoginController@logout');

Route::get('admin/check-auth', 'HomeController@checkauth');
Route::get('admin/lock-screen', 'HomeController@lockscreen');

Route::get('admin/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('admin/artisan/{command}', 'HomeController@artisan')->name('home')->middleware('auth');


Route::get('/', 'FrontendController@index');
Route::post('contact-us/send', 'FrontendController@contactus');
Route::get('home', 'FrontendController@user')->middleware('auth');
Route::get('/{slug}', 'FrontendController@index');
