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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', [
   'uses' => 'UserController@registerUser',
    'as' => 'register'
]);

Route::post('/register/user', [
    'uses' => 'UserController@registerUserStore',
    'as' => 'register.user'
]);
