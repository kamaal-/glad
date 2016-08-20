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
});


Route::post('auth/facebook', 'AuthController@facebook');
Route::post('auth/login', 'AuthController@login');
Route::post('auth/signup', 'AuthController@signup');
Route::get('auth/unlink/{provider}', ['middleware' => 'auth', 'uses' => 'AuthController@unlink']);



Route::get('/collage/list', ['as' => 'collages', 'uses' => 'CollageController@all']);
Route::get('/collage/{id}', ['as' => 'collage_view', 'uses' => 'CollageController@show']);
Route::get('/collage', ['as' => 'collage_new', 'uses' => 'CollageController@create']);


//api
Route::get('api/me', ['middleware' => 'auth', 'uses' => 'UserController@getUser']);
Route::put('api/me', ['middleware' => 'auth', 'uses' => 'UserController@updateUser']);

// api collage
Route::post('api/collage', ['middleware' => 'auth', 'uses' => 'UserController@saveCollage']);
Route::get('api/collage', ['middleware' => 'auth', 'uses' => 'CollageController@create']);
Route::put('api/collage', ['middleware' => 'auth', 'uses' => 'CollageController@update']);
Route::get('api/collage/list', ['middleware' => 'auth', 'uses' => 'CollageController@all']);

//Image
Route::post('api/image/upload', ['middleware' => 'auth', 'uses' => 'ImageController@postUpload']);
Route::post('api/image/delete', ['middleware' => 'auth', 'uses' => 'ImageController@deleteUpload']);
Route::get('api/image', ['middleware' => 'auth', 'uses' => 'ImageController@getOne']);
