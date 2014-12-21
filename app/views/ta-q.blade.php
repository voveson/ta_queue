@extends('layouts.main')

@section('content')
{{--
<script src="{{ URL::asset('assets/js/sq.js') }}"></script>
--}}
<script>
var polling;
$(function(){
	polling = setInterval(function(){poll()}, 10000);
});	
</script>

{{ '<style>body, html{ background-color: ' . $color .'; }</style>' }}
<div id="hidden-data" 
	 data-username="{{ $username }}"
	 data-key="{{ $auth_key }}"
	 data-poll="">
</div>
<h1>{{ $q_name }}</h1>

<div id="q-status">
	@include('blocks/ta-q-status')
</div>

<div id="q-students">
	@include('blocks/ta-students-panel')
</div>

<div id="fixed-panel">	
	@include('blocks/ta-fixed-panel')
</div>

@stop