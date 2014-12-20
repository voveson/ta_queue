@extends('layouts.main')

@section('content')

	<h1>{{ $q_name }}</h1>
	<h3>Login to Queue</h3>
	<div id="login-radios">
		<p>
			<span>Choose an option:</span>
		</p>
		<p>
			<label class="radio-inline"><input id="student-radio" type="radio" name="role">Student</label>
			<label class="radio-inline"><input id="ta-radio" type="radio" name="role">TA</label>
		</p>
	</div>
	<div id="login-container">
		<div id="student-form-container">
			<form action="" method="post">
				<input type="hidden" value="{{ $q_url . '/students' }}"/>
				<p>
					<input type="text" class="form-control" placeholder="Name" required/>
				</p>
				<p>
					<input type="text" class="form-control" placeholder="Location" required/>
				</p>
				<button type="submit" class="btn btn-primary btn-login btn-lg">
					Login&nbsp;{{ FA::icon('sign-in') }}
				</button>
			</form>
		</div>
		<div id="ta-form-container">
			<form action="" method="post">
				<p>
					<span>Login using the master password you were given by the instructor.</span>
				</p>
				<input type="hidden" value="{{ $q_url . '/tas' }}"/>
				<p>
					<input type="text" class="form-control" placeholder="Name" required/>
				</p>
				<p>
					<input type="password" class="form-control" placeholder="Password" required/>
				</p>
				<button type="submit" class="btn btn-primary btn-login btn-lg">
					Login&nbsp;{{ FA::icon('sign-in') }}
				</button>
			</form>
		</div>
	</div>

@stop