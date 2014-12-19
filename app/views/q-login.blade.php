@extends('layouts.main')

@section('content')

	<h1>{{ $q_name }}</h1>
	<h3>Login to Queue</h3>
	<form action="" method="post">
		<input type="hidden" value="{{ $q_url }}"/>
		<p>
			<input type="text" class="form-control" placeholder="Name" required/>
		</p>
		<p>
			<input type="text" class="form-control" placeholder="Location" required/>
		</p>
		<p>
			<label class="radio-inline"><input type="radio" name="role">Student</label>
			<label class="radio-inline"><input type="radio" name="role">TA</label>
		</p>
		<button type="submit" class="btn btn-primary">
			Login&nbsp;{{ FA::icon('sign-in') }}
		</button>
	</form>

@stop