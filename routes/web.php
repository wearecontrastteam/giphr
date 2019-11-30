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

Route::get('/', function () {
    return view('welcome');
});

//Auth::routes();

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@updateProfile')->name('updateProfile');


// Socialite (social login)

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');

Route::get('/privacy', 'LegalController@privacy')->name('privacy');
Route::get('/terms', 'LegalController@terms')->name('terms');

