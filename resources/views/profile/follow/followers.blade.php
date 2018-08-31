@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<div class="sc-header bdr-bottom-mobile">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-1x">
				<div class="sc-col-2">
					<h2 class="ttl-head ttl-sekunder-color">{{ $ttl_followers }} Followers</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="frame-home">
	<div class="place-follow">
		<div>
			@foreach ($profile as $p)
				@include('main.follow')
			@endforeach
		</div>
	</div>
</div>
@endsection