@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	$(document).ready(function() {
		$('#post-nav ul li').each(function(index, el) {
			$(this).removeClass('active');
			$('#{{ $nav }}').addClass('active');
		});
	});
</script>
@foreach ($profile as $p)

<div class="frame-profile">
	<div class="fp-top" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});">
		<div class="fp-cover">
			<div class="fp-info">
				<div 
				class="fp-image image image-120px image-circle" 
				id="place-picture" 
				style="background-image: url({{ asset('/profile/thumbnails/'.$p->foto) }});"></div>
				
				<div class="padding-bottom-5px"></div>

				<div id="edit-name">
					<h1 class="ctn-main-font ctn-standar">{{ $p->name }}</h1>
				</div>
				
				<div>
					<p id="edit-about">
						<strong>
							{{ $p->username }}
						</strong>
						<span class="fa fa-1x fa-circle" style="position: relative; font-size: 8px; top: -2.5px;"></span>
						{{ $p->about }}
					</p>
				</div>

				<div class="other padding-5px">
					<a class="ctn-main-font ctn-white-color ctn-thin" href="{{ $p->website }}" target="_blank">
						{{ $p->website }}
					</a>
				</div>
				<div class="padding-top-5px">
					<ul class="fp-menu">
					    <li>
							<a href="{{ url('/user/'.$p->id.'/following') }}" class="white">
								<div class="val">{{ $p->ttl_following }}</div>
								<div class="ttl">Following</div>
							</a>
						</li>
						<li>
							<a href="{{ url('/user/'.$p->id.'/followers') }}" class="white">
								<div class="val">{{ $p->ttl_followers }}</div>
								<div class="ttl">Followers</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="fp-mid">
		<div class="fp-place">
			<div class="fp-col-1">
				<div>
					<ul class="fp-menu">
						<li>
							<a href="{{ url('/user/'.$p->id.'/story') }}">
								<div class="val">{{ $p->ttl_story }}</div>
								<div class="ttl">Designs</div>
							</a>
						</li>
						<li>
							<a href="{{ url('/user/'.$p->id.'/save') }}">
								<div class="val">{{ $p->ttl_save }}</div>
								<div class="ttl">Saves</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<div class="fp-col-2">
				@if (Auth::id() == $p->id)
					<a href="{{ url('/me/setting') }}">
						<button class="btn btn-grey-color">
							<span class="fa fa-lg fa-cog"></span>
							<span class="">Setting</span>
						</button>
					</a>
				@else
					@if (!is_int($statusFolow))
						<input 
							type="button" 
							name="edit" 
							class="btn btn-grey-color" 
							id="add-follow-{{ $p->id }}" 
							value="Follow" 
							onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
					@else
						<input 
							type="button" 
							name="edit" 
							class="btn btn-main3-color" 
							id="add-follow-{{ $p->id }}" 
							value="Unfollow" 
							onclick="opFollow('{{ $p->id }}', '{{ url("/") }}', '{{ Auth::id() }}')">
					@endif
				@endif
			</div>
		</div>
	</div>
</div>

@endforeach

<div>
	@if (count($userStory) == 0)
		@include('main.post-empty')	
	@else
		<div class="post">
			@foreach ($userStory as $story)
				@include('main.post')
			@endforeach
		</div>
		<div>
			{{ $userStory->links() }}
		</div>
	@endif
</div>

@endsection