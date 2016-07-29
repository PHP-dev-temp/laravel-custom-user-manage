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

Route::group(['prefix' => 'user'], function () {
    Route::get('login', [
        'uses' => 'UserController@loginUser',
        'as' => 'login'
    ]);

    Route::post('login', [
        'uses' => 'UserController@loginUserCheck',
        'as' => 'login.check'
    ]);

    Route::get('logout', [
        'uses' => 'UserController@logoutUser',
        'as' => 'logout'
    ]);

    Route::get('edit', [
        'uses' => 'UserController@editUser',
        'as' => 'user.edit',
        'middleware' => 'auth'
    ]);

    Route::post('edit', [
        'uses' => 'UserController@editUserStore',
        'as' => 'user.edit',
        'middleware' => 'auth'
    ]);
});


Route::group(['prefix' => 'register'], function () {
    Route::get('', [
        'uses' => 'UserController@registerUser',
        'as' => 'register'
    ]);

    Route::post('user', [
        'uses' => 'UserController@registerUserStore',
        'as' => 'register.user'
    ]);

    Route::get('activate/{email?}/{code?}', [
        'uses' => 'UserController@activateUser',
        'as' => 'user.activation'
    ]);
});


Route::group(['prefix' => 'password'], function () {
    Route::get('reset/{email}/{code}', [
        'uses' => 'UserController@resetPassword',
        'as' => 'reset.password'
    ]);

    Route::get('reset', [
        'uses' => 'UserController@resetPasswordForm',
        'as' => 'reset.password'
    ]);

    Route::post('reset', [
        'uses' => 'UserController@resetPasswordEmailing',
        'as' => 'reset.password'
    ]);

    Route::post('store', [
        'uses' => 'UserController@resetNewPasswordStore',
        'as' => 'new.password'
    ]);
});
