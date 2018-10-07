@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="padding-bottom-15px"></div>
<div class="sc-header">
	<div class="sc-place">
		<div class="sc-block">
			<div class="sc-col-1">
				<h1 class="ttl-head ctn-main-font ctn-big">{{ $title }}</h1>
				<p class="ctn-main-font ctn-mikro ctn-thin">{{ $total.' designs' }}</p>
			</div>
		</div>
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