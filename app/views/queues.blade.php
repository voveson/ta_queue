@extends('layouts.main')

@section('content')
	<script>
		$(function() {
			var height = $(window).height() * 0.75;
			$('#q-list').css('max-height', height);
		});
	</script>

	<h1>Select a Queue</h1>
	<div id="q-list">
		@for($i=0; $i<$q_count; $i++)
			@include('blocks/q-listing')
		@endfor
	</div>

@stop