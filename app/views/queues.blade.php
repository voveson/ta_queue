@extends('layouts.main')

@section('content')

	<h1>Add a Queue</h1>
	<div class="q-list">
		@for($i=0; $i<$q_count; $i++)
			@include('blocks/q-listing')
		@endfor
	</div>

@stop