@include('blocks/page_start')
@include('blocks/header')
@include('blocks/ta-modal')

<div class="content-wrapper">
	<div id="page_content" class="container">
		@yield('content')
	</div>
</div>
{{-- @include('blocks/footer') --}}
@include('blocks/page_end')