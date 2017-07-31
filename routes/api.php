<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('login','API\AuthController@authenticate');
Route::get('user','API\AuthController@getAuthenticatedUser');

Route::post('photo','API\PhotoController@store');
Route::get('photo','API\PhotoController@index');
Route::get('photo/file/{id}','API\PhotoController@file');
Route::get('photo/like/{id}','API\PhotoController@like');
