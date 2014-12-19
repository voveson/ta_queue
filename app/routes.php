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

Route::get('/', array(
	'as'	=>	'root',
	'uses'	=>	'HomeController@index'
));

Route::get('/schools', array(
	'as'	=>	'schools',
	'uses'	=>	'HomeController@schools'
));

Route::post('/q-list', array(
	'as'	=>	'q_list',
	'uses'	=>	'HomeController@queues'
));
