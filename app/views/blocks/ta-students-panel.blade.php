@foreach($queue->students as $student)
	@if($student->in_queue)
		@include('blocks/ta-q-student')
	@endif
@endforeach