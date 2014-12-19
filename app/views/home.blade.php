@extends('layouts.main')

@section('content')

	<a href="{{ URL::route('schools') }}">
		<img id="logo" src="{{ URL::asset('assets/images/logo.png') }}"></img>
	</a>
@stop