@extends('layouts.main')

@section('content')
{{--
<script src="{{ URL::asset('assets/js/sq.js') }}"></script>
--}}
<div id="hidden-data" 
	 data-username="{{ $username }}" 
	 data-location="{{ $location }}" 
	 data-key="{{ $auth_key }}">
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