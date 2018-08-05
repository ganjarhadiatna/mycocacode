@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')

<div class="banner">
	<h1>It's a place for Designers to sit down</h1>
	<div class="padding-20px">
		@include('main.search')
	</div>
</div>

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
			<div>
				{{ $topStory->links() }}
			</div>
		@endif
	</div>
</div>
@endsection