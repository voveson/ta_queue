@foreach($queue->students as $student)
	@if($student->in_queue)
		@include('blocks/ta-q-student')
		<script>
			empty_q = false;
		</script>
	@endif
@endforeach