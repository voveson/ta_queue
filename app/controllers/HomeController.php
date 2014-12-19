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

			$queues = array();

			foreach($data->instructors as $prof)
			{
				foreach($prof->queues as $queue)
				{
					$q = array();
					$q['class_number'] = $queue->class_number;
					$q['professor'] = $prof->name;
					$q['prof_name'] = $prof->username;
					$queues[] = $q;
				}
			}

			$school['queues'] = $queues;

			$schools[] = $school;
		}

		// Return the list of schools
		return View::make('schools')->withSchools($schools);
	}

	public function queues()
	{
		$class_numbers = Input::get('class_numbers');
		$professors = Input::get('professors');
		$urls = Input::get('urls');

		$q_count = 0;
		foreach($class_numbers as $num)
			$q_count++;

		return View::make('queues')->with([
			'q_count'		=>	$q_count,
			'class_numbers'	=>	$class_numbers,
			'professors'	=>	$professors,
			'urls'			=>	$urls
		]);
	}

}
