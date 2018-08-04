@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')

<div class="banner">
	<h1>It's a place for Designers to sit down</h1>
	<div class="padding-20px">
		<!--
		<a href="{{ url('/login') }}">
			<button class="btn-icn btn btn-sekunder-color btn-no-border">
				<span>LOGIN</span>
			</button>
		</a>
		<a href="{{ url('/register') }}" style="margin-left: 5px;">
			<button class="create btn btn-main-color">
				<span>REGISTER</span>
			</button>
		</a>
		-->
		<div class="main-search" id="main-search">
			<form id="place-search" action="javascript:void(0)" method="get">
				<input type="text" name="q" class="txt txt-main-color txt-no-shadow" id="txt-search" placeholder="Search designs.." required="true">
				<button type="submit" class="btn btn-main-color">
					<span class="fa fa-lg fa-search"></span>
				</button>
			</form>
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
			<div class="padding-bottom-15px">
				{{ $topStory->links() }}
			</div>
		@endif
	</div>
</div>
@endsection