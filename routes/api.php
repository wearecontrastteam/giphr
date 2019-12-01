<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth')->namespace('Api')->group(function (){
    Route::get('/users/@{user}/giphs', 'UserController@giphs')->name('users.giphs');

    Route::prefix('giphs')->name('giphs.')->group(function() {
        Route::get('/', 'GiphController@index')->name('index');
        Route::post('/', 'GiphController@create')->name('create');
        Route::get('/{giph}', 'GiphController@show')->name('show');
        Route::delete('/{giph}', 'GiphController@delete')->name('delete');
        Route::post('/{giph}/likes', 'GiphController@like')->name('like');
    });
});

