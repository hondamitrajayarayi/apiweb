<?php

use Illuminate\Http\Request;

Route::group(['prefix' => 'v1'], function(){

	Route::post('register', 'UserController@register');
	Route::post('login', 'UserController@login');
	Route::post('logout', 'UserController@logout')->middleware('jwt.verify'); //REMOVE TOKEN
	
	Route::get('book', 'TestController@book');
	Route::get('bookall', 'TestController@bookAuth')->middleware('jwt.verify');
	
	Route::get('user', 'UserController@getAuthenticatedUser')->middleware('jwt.verify');

	// Route::get('branch', 'PriceController@branch')->middleware('jwt.verify');
	Route::get('branch', 'PriceController@branch');

	//Route::get('marketplace', 'PriceController@marketplace')->middleware('jwt.verify');
	Route::get('marketplace', 'PriceController@marketplace');
	Route::get('price', 'PriceController@index')->middleware('jwt.verify');
	Route::get('/price/{branch}','PriceController@price_branch')->middleware('jwt.verify');

});