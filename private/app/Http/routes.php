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

Route::controllers([
  'auth' => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
  'admin' => 'AdminController'
]);


// Localization support:

//Route::group (Language::getRouteGroup (), function () {
//});

//Route::get('locale', ['as' => 'locale', 'uses' => 'HomeController@locale']);


