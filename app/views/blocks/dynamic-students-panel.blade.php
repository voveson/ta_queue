@foreach($q->students as $student)
	@if($student->in_queue)
		@include('blocks/q-student')
	@endif
@endforeach