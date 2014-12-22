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
<script>
$(function() {
	$('body').click(function() {
		window.location.href = "{{ URL::route('schools') }}";
	});
});
</script>
	<img id="logo" src="{{ URL::asset('assets/images/logo.png') }}"></img>
	<div id="landing-prompt">
		Tap the screen to continue
	</div>
@stop