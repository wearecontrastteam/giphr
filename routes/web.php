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

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::get('login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('auth/{provider}/callback','Auth\LoginController@handleProviderCallback');

Route::middleware(['auth'])->group(function(){
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile', 'ProfileController@update')->name('profile.update');

    Route::middleware(['onboarded'])->group(function(){
        Route::get('/timeline', 'TimelineController@index')->name('timeline');
    });
});

Route::get('/privacy', 'LegalController@privacy')->name('privacy');
Route::get('/terms', 'LegalController@terms')->name('terms');

