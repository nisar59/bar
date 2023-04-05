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

Route::get('login', function () {
    return redirect('login');
});

//Ferontend Controller Routes
Route::get('/', 'FrontendController@index');
Route::get('welcome', 'FrontendController@welcome');
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


Auth::routes();
Route::any('logout', 'Auth\LoginController@logout');

Route::get('check-auth', 'HomeController@checkauth');
Route::get('lock-screen', 'HomeController@lockscreen');

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/artisan/{command}', 'HomeController@artisan')->name('home')->middleware('auth');
