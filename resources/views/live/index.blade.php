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

<div 
	class="banner banner-image"
	style="
		background-image: url('{{ asset('/img/sites/intro-1600.jpg') }}');
	" >
	<div class="padding-20px">
		<h1>Share Videos With Other Designers</h1>
		<h3>Find your inspirations here.</h3>
		<div class="padding-20px">
			<button class="btn btn-main-color btn-radius">
				Create Videos
			</button>
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
		<h2>Content</h2>
	</div>
</div>
@endsection