@extends('layouts.main')

@section('content')

<style>
	body {
		background-color: #363636;
		padding-top: 150px;
	}
	#landing-prompt {
		font-size: 16pt;
		color: #7FC9FF;
	}
</style>
	<a href="{{ URL::route('schools') }}">
		<img id="logo" src="{{ URL::asset('assets/images/logo.png') }}"></img>
	</a>
	<div id="landing-prompt">
		Tap the screen to continue
	</div>
@stop