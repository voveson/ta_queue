@extends('layouts.main')

@section('content')

	<h1>Choose your school:</h1>
	<div class="school-list">
		@foreach($schools as $school)
			<p>
				<form id="form-{{ $school['abbreviation'] }}" method="POST" action="{{ URL::route('q_list') }}">
					@foreach($school['queues'] as $q)
						<input type="hidden" name="class_numbers[]" value="{{ $q['class_number'] }}"/>
						<input type="hidden" name="professors[]" value="{{ $q['professor'] }}"/>
						<input type="hidden" name="urls[]" 
							   value="{{ '/schools/' . $school['abbreviation'] . '/' . $q['prof_name'] . 
							   '/' . $q['class_number'] }}"/>
					@endforeach
				</form>
				<a href="#" class="btn btn-lg school_picker" data-form="#form-{{ $school['abbreviation'] }}">
					{{ $school['name'] }}&nbsp;{{ FA::icon('chevron-right') }}
				</a>
			</p>{{--
			<table>
				<tr>
					<th>Professor</th>
					<th colspan="2">Course</th>
				</tr>
			@foreach($school['queues'] as $q)
				<tr>
					<td>{{ $q['professor'] }}</td>
					<td>{{ $q['class_number'] }}</td>
					<td><button class="btn btn-sm">{{ FA::icon('plus') }}</button></td>
				</tr>
			@endforeach
			</table>--}}
		@endforeach
	</div>
@stop