@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<!--
<div class="banner">
	<h1>It's a place for designers</h1>
</div>
-->
<div>
	<div>
		@if (count($topStory) == 0)
			@include('main.post-empty')	
		@else
			<div class="post">
				@foreach ($topStory as $story)
					@include('main.post')
				@endforeach
			</div>
			{{ $topStory->links() }}
		@endif
	</div>
</div>
@endsection