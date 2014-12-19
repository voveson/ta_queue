@extends('layouts.main')

@section('content')

	<h1>Choose your school:</h1>
	<div class="school-list">
		@foreach($schools as $school)
		<p>
			<button class="btn btn-lg">
				{{ $school['name'] }}&nbsp;{{ FA::icon('chevron-right') }}
			</button>
		</p>
		@endforeach
	</div>
@stop