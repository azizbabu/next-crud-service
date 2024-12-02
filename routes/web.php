<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// countries routes...
Route::group(['prefix' => '/countries'], function () {
    Route::get('/list', 'CountryController@index');
    Route::post('/store', 'CountryController@store');
    Route::put('/update/{id}', 'CountryController@update');
    Route::delete('/destroy/{id}', 'CountryController@destroy');
});

// posts routes...
Route::group(['prefix' => '/posts'], function () {
    Route::get('/list', 'PostController@index');
    Route::post('/store', 'PostController@store');
    Route::get('/show/{id}', 'PostController@show');
    Route::put('/update/{id}', 'PostController@update');
    Route::delete('/destroy/{id}', 'PostController@destroy');
});

// users routes...
Route::group(['prefix' => '/users'], function () {
    Route::get('/list', 'UserController@index');
    Route::post('/store', 'UserController@store');
    Route::get('/show/{id}', 'UserController@show');
    Route::put('/update/{id}', 'UserController@update');
    Route::delete('/destroy/{id}', 'UserController@destroy');
});

Route::get('/common-dropdown', function () {
    $list = [
        'countryList' => app('countryList'),
        'postList' => app('postList')
    ];

    return response([
        'success' => true,
        'data' => $list
    ]);
});
