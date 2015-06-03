<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::group(['prefix' => 'profile/{id}', 'middleware' => 'App\Http\Middleware\EditMiddleWare'], function()
{
  Route::get('/', 'ProfileController@show');
  Route::get('/edit', 'ProfileController@edit');
  Route::post('/update', 'ProfileController@update');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
