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

Route::pattern('id', '[0-9]+');

Route::get('/', function() {

    return Redirect::to('api/pemilu');
});

Route::group(array('prefix' => 'api'), function() {

	// Pemilu
	Route::group(array('prefix' => 'pemilu'), function() {

    	Route::get('/', array('uses' => 'PemiluController@getAll'));
    	Route::get('/{id?}', array('uses' => 'PemiluController@getOne'));
	});

	// Formulir
	Route::group(array('prefix' => 'formulir'), function() {

    	Route::get('/', array('uses' => 'FormulirController@getAll'));
    	Route::get('/{id?}', array('uses' => 'FormulirController@getOne'));
	});

	// Provinsi
	Route::group(array('prefix' => 'province'), function() {

	    Route::get('/', array('uses' => 'ProvinceController@getAll'));
    	Route::get('/{id?}', array('uses' => 'ProvinceController@getOne'));
	});

	// Voices
	Route::group(array('prefix' => 'voice'), function() {

	    Route::get('/', array('uses' => 'VoiceController@getAll'));
	});

});

App::missing(function($exception) {

    return XApi::response(array('error'=>400, 'results'=>null), 400);
});