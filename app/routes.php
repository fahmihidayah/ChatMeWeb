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
	return View::make('hello');
});

Route::post('/api/get_user', "HomeController@getUser");

Route::post('api/register', "HomeController@registerUser");

Route::post('/api/login', 'HomeController@login');

// Route::get('/api/check_auth', 'HomeController@checkAuth');

Route::get('/api/logout', 'HomeController@logout');

Route::post('/api/send_message', "HomeController@sendMessage");

Route::post('/api/get_messages', "HomeController@getMessage");