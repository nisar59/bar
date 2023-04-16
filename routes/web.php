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

Route::get('user-login', 'Auth\LoginController@userloginform');
Route::get('user-register', 'Auth\RegisterController@userregisterform');
//Ferontend Controller Routes
/*Route::get('welcome', 'FrontendController@welcome');
Route::get('ourstory', 'FrontendController@ourstory');
Route::get('hours-location', 'FrontendController@hours_location');
Route::get('cafe-dante-menu', 'FrontendController@cafe_dante_menu');
Route::get('west-village-menu', 'FrontendController@west_village_menu');
Route::get('reservations', 'FrontendController@reservations');
Route::get('store', 'FrontendController@storee');
Route::get('gift-card', 'FrontendController@gift_card');

//Footer Routes
Route::get('bottled-cocktails', 'FrontendController@bottled_cocktails');
Route::get('collaborations', 'FrontendController@collaborations');
Route::get('news-and-events', 'FrontendController@news_and');
Route::get('press', 'FrontendController@press');
Route::get('contact', 'FrontendController@contact');
Route::get('celebrate', 'FrontendController@celebrate');
Route::get('work-with-us', 'FrontendController@work_with');
*/
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
Route::get('home', 'FrontendController@user')->middleware('auth');
Route::get('/{slug}', 'FrontendController@index');
