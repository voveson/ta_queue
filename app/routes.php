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

Route::post('/q-login', array(
	'as'	=>	'q-login',
	'uses'	=>	'HomeController@q_login'
));

Route::post('/student-queue', array(
	'as'	=>	'student-queue',
	'uses'	=>	'HomeController@student_queue'
));

Route::post('/ta-queue', array(
	'as'	=>	'ta-queue',
	'uses'	=>	'HomeController@ta_queue'
));

Route::get('/show-sq/{s_id}/{username}/{location}/{auth_key}/{q_name}', array(
	'as'	=>	'show-sq',
	'uses'	=>	'HomeController@show_student_q'
));

Route::get('/show-tq', array(
	'as'	=>	'show-tq',
	'uses'	=>	'HomeController@show_ta_q'
));