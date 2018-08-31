@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')

<script type="text/javascript">
	$(document).ready(function() {
		var path = '{{ $path }}';
		$('#'+path).addClass('active');
	});
</script>

<div class="banner">
	<h1>It's A Place For Designers To Sit Down</h1>
	<div class="padding-20px">
		@include('main.search')
	</div>
</div>

<div>
	<div class="nav-post">
		<ul>
			<a href="{{ url('/fresh') }}" id="fresh">
				<li>
					Fresh
				</li>
			</a>
			<a href="{{ url('/trending') }}" id="trending">
				<li>
					Trending
				</li>
			</a>
			<a href="{{ url('/popular') }}" id="popular">
				<li>
					Popular
				</li>
			</a>
			@if (Auth::id())
				<a href="{{ url('/timelines') }}" id="timelines">
					<li>
						Timelines
					</li>
				</a>
			@endif
		</ul>
	</div>
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