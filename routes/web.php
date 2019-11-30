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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile', 'HomeController@updateProfile')->name('updateProfile');

// TODO REMOVE
Route::post('/post', 'HomeController@post')->name('post');
// TODO REMOVE
Route::post('/like/{giph}', 'HomeController@like')->name('like');

// Socialite (social login)

Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
//Route::get('login/{provider}/callback','Auth\LoginController@handleProviderCallback');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');