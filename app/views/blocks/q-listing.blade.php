<div class="q-listing">
	<div class="q-name">
		<b>Class:</b>&nbsp;&nbsp;{{ $class_numbers[$i] }}<br>
		<b>Prof.:</b>&nbsp;&nbsp;{{ $professors[$i] }}
	</div>
	<div class="q-actions">
		<form action="{{ URL::route('q-login') }}" method="POST">
			<input type="hidden" name="q_name" value="{{ $class_numbers[$i] }}"/>
			<input type="hidden" name="q_prof" value="{{ $professors[$i] }}"/>
			<input type="hidden" name="q_url" value="{{ $urls[$i] }}"/>
			<button class="btn btn-default btn-sm">
				<b>GO</b>&nbsp;{{ FA::icon('chevron-right') }}
			</button>
		</form>
	</div>
</div>
@if($i != ($q_count - 1))
<hr>
@endif