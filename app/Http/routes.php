<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/auth/facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('/', 'HomeController@index');
    Route::get('/search', 'HomeController@search');
    Route::get('/api', 'HomeController@jsonData');
    Route::get('/about', 'HomeController@about');

    Route::group(['prefix' => 'user'], function () {
        Route::get('/create', 'UserController@create');
        Route::post('/create', 'UserController@store');
    });

    Route::group(['prefix' => 'page'], function () {
        Route::get('/', 'PageController@index');
    });

    Route::group(['prefix' => 'post'], function () {
        Route::get('/', 'PostController@index');
    });

    Route::get('/test/', function () {
        return view('test');
    });
});