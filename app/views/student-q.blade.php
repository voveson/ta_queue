@extends('layouts.main')

@section('content')
{{--
<script src="{{ URL::asset('assets/js/sq.js') }}"></script>
--}}
<script>
var polling;
var empty_q = true;
$(function(){
	polling = setInterval(function(){poll()}, 10000);

	if(empty_q)
	{
		$('#q-students').html('<div class="q-message">No students in the queue</div>');
	}
});	
</script>
{{ '<style>body, html{ background-color: ' . $color .'; }</style>' }}

<div id="hidden-data" 
	 data-username="{{ $username }}" 
	 data-location="{{ $location }}" 
	 data-key="{{ $auth_key }}"
	 data-poll="">
</div>
<h1>{{ $q_name }}</h1>

<div id="q-status">
	@include('blocks/q-status')
</div>

<div id="q-students">
	@include('blocks/students-panel')
</div>

<div id="fixed-panel">	
	@include('blocks/s-fixed-panel')
</div>

@stop