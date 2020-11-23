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

Route::middleware(['auth'])->group(function() {
    Route::get('/wrestlers/upload', 'ImportController@uploadWrestlers');

    Route::post('/wrestlers/import', 'ImportController@importWrestlers');

    Route::get('/promotions/upload', 'ImportController@uploadPromotions');

    Route::post('/promotions/import', 'ImportController@importPromotions');

    Route::resource('/wrestlers', 'WrestlerController');

    Route::resource('/promotions', 'PromotionController');

    Route::get('/home', 'HomeController@index');

    Route::resource('/games', 'GameController');

    Route::get('/search', 'SearchController@index');
});
