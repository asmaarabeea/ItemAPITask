<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("home", function(){
	return view('home');
});


Auth::routes();

Route::group(["middleware" => "auth"], function(){

	Route::get("items", "ItemController@showUserItems");


	Route::post("items", "ItemController@addUserItems");


	Route::put("items/{id}", "ItemController@markItem");

	
	Route::delete("items/{id}", "ItemController@deletItem");


});

