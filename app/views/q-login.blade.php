@extends('layouts.main')

@section('content')

	<h1>{{ $q_name }}</h1>
	<h3>Login to Queue</h3>
	<div id="login-radios">
		<p>
			<span>Choose an option:</span>
		</p>
		<p>
			<label class="radio-inline">
				<input id="student-radio" type="radio" name="role" {{(isset($student)) ? 'checked' : ''}}>
				Student
			</label>
			<label class="radio-inline"><input id="ta-radio" type="radio" name="role">TA</label>
		</p>
	</div>	
	@if(isset($api_errors))
		<div id="errors-container" class="alert alert-danger">
			<b>The following errors occurred:</b><br>
			@foreach($api_errors as $err)
			&nbsp;&nbsp;&ndash;&nbsp;&nbsp;{{ $err }}<br>
			@endforeach
		</div>
	@endif
	<div id="login-container">
		<div id="student-form-container" {{(isset($student)) ? 'style="display:block"' : ''}}>
			<form action="{{ URL::route('student-queue') }}" method="post">
				<input type="hidden" name="url" value="{{ $base_url . '/students' }}"/>
				<input type="hidden" name="base_url" value="{{ $base_url }}"/>
				<input type="hidden" name="q_name" value="{{ $q_name }}"/>
				<input type="hidden" name="q_prof" value="{{ $q_prof }}"/>
				<p>
					<input type="text" name="name" class="form-control" placeholder="Name" required
						   {{(isset($login_name)) ? 'value="' . $login_name . '"' : ''}}/>
				</p>
				<p>
					<input type="text" name="location" class="form-control" placeholder="Location" required
						   {{(isset($location)) ? 'value="' . $location . '"' : ''}}/>
				</p>
				<button type="submit" class="btn btn-primary btn-login btn-lg">
					Login&nbsp;{{ FA::icon('sign-in') }}
				</button>
			</form>
		</div>
		<div id="ta-form-container" {{(isset($ta)) ? 'style="display:block"' : ''}}>
			<form action="{{ URL::route('ta-queue') }}" method="post">
				<p>
					<span>Login using the master password you were given by the instructor.</span>
				</p>
				<input type="hidden" name="url" value="{{ $base_url . '/tas' }}"/>
				<input type="hidden" name="base_url" value="{{ $base_url }}"/>
				<input type="hidden" name="q_name" value="{{ $q_name }}"/>
				<input type="hidden" name="q_prof" value="{{ $q_prof }}"/>
				<p>
					<input type="text" name="name" class="form-control" placeholder="Name" required
						   {{(isset($login_name)) ? 'value="' . $login_name . '"' : ''}}/>
				</p>
				<p>
					<input type="password" name="password" class="form-control" placeholder="Password" required/>
				</p>
				<button type="submit" class="btn btn-primary btn-login btn-lg">
					Login&nbsp;{{ FA::icon('sign-in') }}
				</button>
			</form>
		</div>
	</div>

@stop