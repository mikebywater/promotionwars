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

Auth::routes();

Route::middleware(['auth'])->group(function() {

    Route::get('/', 'GameController@index');
    Route::get('/games/load', 'GameController@load');
    Route::resource('/games', 'GameController');
    Route::post('/games/exit', 'GameController@exit');

    Route::middleware(['game.loaded'])->group(function() {

        Route::get('/roster', 'WrestlerController@roster')->name('roster');

        Route::resource('/wrestlers', 'WrestlerController');

        Route::resource('/promotions', 'PromotionController');

        Route::get('/home', 'HomeController@index')->name('home');

        Route::get('/search', 'SearchController@index');
    });
});
