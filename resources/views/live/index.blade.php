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
	<div class="padding-20px">
		<h1>Share Videos With Other Designers</h1>
		<h3>Find your inspirations here.</h3>
		<div class="padding-20px">
			<a href="{{ url('/compose/live') }}">
				<button class="btn btn-main-color btn-radius">
					Create Videos
				</button>
			</a>
		</div>
	</div>
</div>

<div>
	<div class="nav-post">
		<ul>
			<a href="{{ url('/lives/fresh') }}" id="fresh">
				<li>
					Fresh
				</li>
			</a>
			<a href="{{ url('/lives/trending') }}" id="trending">
				<li>
					Trending
				</li>
			</a>
			<a href="{{ url('/lives/popular') }}" id="popular">
				<li>
					Popular
				</li>
			</a>
			@if (Auth::id())
				<a href="{{ url('/lives/timelines') }}" id="timelines">
					<li>
						Timelines
					</li>
				</a>
			@endif
		</ul>
	</div>
	<div>
		@if (count($topLive) == 0)
			@include('main.post-empty')	
		@else
			<div class="post">
				@foreach ($topLive as $live)
					@include('main.live')
				@endforeach
			</div>
			<div>
				{{ $topLive->links() }}
			</div>
		@endif
	</div>
</div>
@endsection