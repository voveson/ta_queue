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

	public function q_login()
	{
		$name = Input::get('q_name');
		$prof = Input::get('q_prof');
		$url = Input::get('q_url');

		return View::make('q-login')->with([
			'q_name'	=>	$name,
			'q_prof'	=>	$prof,
			'base_url'	=>	$url
		]);
	}

	public function student_queue()
	{
		$url = Input::get('url');		
		$base_url = Input::get('base_url');
		$name = Input::get('name');
		$location = Input::get('location');
		$q_name = Input::get('q_name');
		$q_prof = Input::get('q_prof');

		$student = new stdClass();
		$student->username = $name;
		$student->location = $location;
		$obj = new stdClass();
		$obj->student = $student;

		$data = json_encode($obj);
		
		$result = $this->login($data, $url);

		if(isset($result->errors))
			return View::make('q-login')->with([
				'q_name'		=>	$q_name,
				'q_prof'		=>	$q_prof,
				'base_url'		=>	$base_url,
				'login_name'	=>	$name,
				'location'		=>	$location,
				'api_errors'	=>	$result->errors,
				'student'		=>	true
			]);
		else
		{
			$auth_key = base64_encode($result->id . ':' . $result->token);
			$username = $result->username;
			$location = $result->location;

			return Redirect::route('show-sq', [
				's_id'		=>	$result->id,
				'username'	=>	$username,
				'location'	=>	$location,
				'auth_key'	=>	$auth_key,
				'q_name'	=>	$q_name
			]);
		}
	}

	public function show_student_q($s_id, $username, $location, $auth_key, $q_name)
	{
		$queue = $this->get_q($auth_key);

		return View::make('student-q')->with([
			's_id'		=>	$s_id,
			'username'	=>	$username,
			'location'	=>	$location,
			'auth_key'	=>	$auth_key,
			'q_name'	=>	$q_name,
			'queue'		=>	$queue
		]);/*
		echo $username;
		echo $location;
		echo $auth_key;
		echo $q_name;*/
	}

	public function enter_q($auth_key, $s_id)
	{
		$queue = $this->enter_exit($auth_key, 'enter_queue');		

		if(isset($queue->errors))
			return Response::json(['api_errors' => $queue->errors], 401);
		else
			return View::make('blocks.dynamic-students-panel')->with([
				'q'		=>	$queue,
				's_id'	=>	$s_id
			]);
	}

	public function exit_q($auth_key, $s_id)
	{
		$queue = $this->enter_exit($auth_key, 'exit_queue');		

		if(isset($queue->errors))
			return Response::json(['api_errors' => $queue->errors], 401);
		else
			return View::make('blocks.dynamic-students-panel')->with([
				'q'		=>	$queue,
				's_id'	=>	$s_id
			]);	
	}

	public function ta_queue()
	{
		$url = Input::get('url');
		$base_url = Input::get('base_url');
		$name = Input::get('name');
		$password = Input::get('password');
		$q_name = Input::get('q_name');
		$q_prof = Input::get('q_prof');

		$ta = new stdClass();
		$ta->username = $name;
		$ta->password = $password;
		$obj = new stdClass();
		$obj->ta = $ta;

		$data = json_encode($obj);
		
		$result = $this->login($data, $url);

		if(isset($result->errors))
			return View::make('q-login')->with([
				'q_name'		=>	$q_name,
				'q_prof'		=>	$q_prof,
				'base_url'		=>	$base_url,
				'login_name'	=>	$name,
				'api_errors'	=>	$result->errors,
				'ta'			=>	true
			]);
		else
			var_dump($result);
	}

	private function login($data, $url)
	{
		$curl = curl_init('http://nine.eng.utah.edu' . $url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(                                                                          
    		'Content-Type: application/json',                                                                                
    		'Content-Length: ' . strlen($data))                                                                       
		);

		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result);
	}

	private function get_q($auth_key)
	{
		$curl = curl_init('http://nine.eng.utah.edu/queue');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Authorization: BASIC ' . $auth_key
		));

		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result);	
	}

	private function enter_exit($auth_key, $url)
	{
		$curl = curl_init('http://nine.eng.utah.edu/queue/' . $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array(
			'Authorization: BASIC ' . $auth_key
		));

		$result = curl_exec($curl);
		curl_close($curl);

		return json_decode($result);		
	}

}
