<div id="q-tas">
	<b>TAs on Duty:</b>
	<ul>
		@foreach($queue->tas as $ta)
			<li>{{ $ta->username}}{{ $ta->student ? ': helping ' . $ta->student->username : '' }}</li>
		@endforeach
	</ul>
</div>

<div id="q-state">
	<b>Queue State: </b>
	@if(!$queue->active)
		<span id="inactive">INACTIVE</span>
	@elseif ($queue->frozen)
		<span id="frozen">FROZEN</span>
	@else
		<span id="active">ACTIVE</span>
	@endif
</div>

<div id="enter-exit">
	<button id="enter-q" class="btn btn-md" {{ (!$queue->active || $queue->frozen) ? "disabled" : "" }}>
		Enter Queue
	</button>
	<button id="exit-q" class="btn btn-md">
		Exit Queue
	</button>
	<button id="sign-out-q" class="btn btn-md">
		Sign Out
	</button>
</div>