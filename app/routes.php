<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('Index');
});

Route::get('wyslijlosowawiadomosc', 'ChatController@sendRandomMessage');
Route::get('uzytkownicy', 'ChatController@showUsers');
Route::get('wiadomosciuzytkownika/{id}', 'ChatController@showUserChats');
Route::get('wiadomosciuzytkownika', 'ChatController@showUserChats');
Route::get('konwersacja/{id}', 'ChatController@showChanel');
Route::get('napiszwiadomosc', 'ChatController@showSend');
Route::post('napiszwiadomosc', 'ChatController@showPostMessage');