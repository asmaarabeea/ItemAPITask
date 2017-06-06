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

Route::group(["prefix" => "v1"], function () {
   // return $request->user();

	Route::post('/signup', 'Api\UserController@signup');

	Route::post('/signin', 'Api\UserController@signin');

	Route::get('items', 'Api\ItemController@showUserItems');

	Route::post('items', 'Api\ItemController@addUserItems');

	Route::delete('items/{id}', 'Api\ItemController@deletItem')->where('id', '\d+');

	Route::put('items/{id}', 'Api\ItemController@markItem')->where('id', '\d+');

});