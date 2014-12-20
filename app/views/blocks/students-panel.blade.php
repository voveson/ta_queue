@foreach($queue->students as $student)
	@if($student->in_queue)
		@if($student->id == $s_id)
			<script>
				$(function(){
					$('#enter-q').hide();
					$('#exit-q').show();
				});
			</script>
		@endif
		@include('blocks/q-student')
	@elseif($student->id == $s_id)
		<script>
			$(function(){
				$('#enter-q').show();
				$('#exit-q').hide();
			});
		</script>
	@endif
@endforeach