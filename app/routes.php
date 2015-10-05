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


Route::get('/', function () {
        return View::make('site.home');
});

Route::get('contact_us', function () {
        return Redirect::back();
});

Route::get('privacy_policy', function () {
        return Redirect::back();
});

/*
    |--------------------------------------------------------------------------
    | Session Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle session things
    |
    */
Route::get('logout', 'SessionController@logout');
Route::get('login', 'SessionController@login');
Route::post('login', 'SessionController@handleLogin')->before('csrf');
Route::get('register', 'SessionController@register');
Route::post('register', 'SessionController@handleRegister')->before('csrf');
Route::get('activate/{key}', 'SessionController@activate');

/*
    |--------------------------------------------------------------------------
    | Profile Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle user profile
    |
    */
Route::controller('profile', 'ProfileController');

/*
    |--------------------------------------------------------------------------
    | Search Controller Routes
    |--------------------------------------------------------------------------
    |
    | Routes to handle questions and answers in the public area
    |
    */
