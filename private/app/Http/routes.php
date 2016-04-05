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

Route::get ('/', 'WelcomeController@index');

Route::get ('home', ['as' => 'home', 'tag' => 'home', 'uses' => 'HomeController@index']);

Route::controllers ([
  'auth'     => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

Route::group (['tag' => 'users'], function () {
  Route::controller ('admin', 'AdminController', [
    'getUsers' => 'users',
    'getUser'  => 'user',
  ]);
});

// URL-controlled localization support:

//Route::group (Language::getRouteGroup (), function () {
//});

//Route::get('locale', ['as' => 'locale', 'uses' => 'HomeController@locale']);


