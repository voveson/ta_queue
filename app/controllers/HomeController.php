<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		return View::make('home');
	}

	public function schools()
	{
		$curl = curl_init('http://nine.eng.utah.edu/schools');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$result = curl_exec($curl);
		curl_close($curl);

		$schools = array();

		foreach(json_decode($result) as $data)
		{
			$school = array();
			$school['name'] = $data->name;
			$school['abbreviation'] = $data->abbreviation;
			$schools[] = $school;
		}

		return View::make('schools')->withSchools($schools);
	}

	public function queues()
	{
		return View::make('queues');
	}

}
