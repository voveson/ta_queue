<div id="q-tas">
	<b>TAs on Duty:</b>
	<ul>
		@foreach($queue->tas as $ta)
			@if($ta->id == $t_id)
				<li>You{{ $ta->student ? ': helping ' . $ta->student->username : '' }}</li>
			@else
				<li>{{ $ta->username}}{{ $ta->student ? ': helping ' . $ta->student->username : '' }}</li>
			@endif
		@endforeach
	</ul>
</div>

<div id="q-state">
	<b>Queue State: </b>
	<select id="q-state-select" class='form-control' 
			data-url="{{ URL::route('q-state-change', $auth_key) }}"
			data-frozen="{{ ($queue->frozen) ? 'true' : 'false' }}"
			data-active="{{ ($queue->active) ? 'true' : 'false' }}">
		<option value="1">ACTIVE</option>
		<option value="2" {{ (!$queue->active) ? 'selected' : '' }}>INACTIVE</option>
		<option value="3" {{ ($queue->frozen && $queue->active) ? 'selected' : '' }}>FROZEN</option>
	</select>
</div>

<div id="enter-exit">
	<button id="ta-sign-out-q" class="btn btn-lg" 
			data-url="{{ URL::route('sign-out', array($auth_key, $t_id)) }}"
			data-after="{{ URL::route('schools') }}">
		Sign Out {{ FA::icon('sign-out') }}
	</button>
</div>