@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
@if (count($notif) != 0)
<script type="text/javascript">
	$(document).ready(function() {
		$(window).scroll(function(event) {
			var top = $(window).scrollTop();
			var hg = Math.floor($('#home-main-object').height() - $('#home-side-object').height());
			var top1 = Math.floor($('#home-side-object').height() - ($(window).height() - 100));
			if (top >= top1) {
				$('#home-side-object').attr('class', 'side-fixed');
			}
			if (top >= (hg + top1)) {
				$('#home-side-object').attr('class', 'side-absolute');
			}
			if (top < top1) {
				$('#home-side-object').attr('class', '');
			}
		});
	});
</script>
@endif
<div class="sc-header bdr-bottom-mobile">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-1x">
				<div class="sc-col-2">
					<h2 class="ttl-head ttl-sekunder-color">
						Notifications
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>
<div>
	<div class="place-notif">

		@foreach ($notif as $dt)
			@if ($dt->type == 'comment' || $dt->type == 'like')
				<div class="frame-notif grid grid-3x">
					<div class="grid-1">
						<a href="{{ url('/user/'.$dt->id) }}">
							<div 
								class="image image-40px image-radius"
								style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
						</a>
					</div>
					<div class="grid-2">
						<div class="notif-mid">
							<div class="ntf-mid">
								<div class="desc">
									<a href="{{ url('/user/'.$dt->id) }}">
										<strong>
											{{ $dt->username }}
										</strong>
									</a>
									{{ 'commented "'.$dt->description.'" on your story' }}
								</div>
								<div class="desc date">
									{{ $dt->created }}
								</div>
							</div>
						</div>
					</div>
					<div class="grid-3 txt-right">
						<a href="{{ url('/story/'.$dt->idstory) }}">
							<div 
								class="image image-40px image-radius"
								style="background-image: url({{ asset('/story/thumbnails/'.$dt->image) }});"></div>
						</a>
					</div>
				</div>
			@elseif ($dt->type == 'follow')
				<div class="frame-notif grid grid-2x">
					<div class="grid-1">
						<a href="{{ url('/user/'.$dt->id) }}">
							<div 
								class="image image-40px image-radius"
								style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
						</a>
					</div>
					<div class="grid-2">
						<div class="notif-mid">
							<div class="ntf-mid">
								<div class="desc">
									<a href="{{ url('/user/'.$dt->id) }}">
										<strong>
											{{ $dt->username }}
										</strong>
									</a>
									started following you
								</div>
								<div class="desc date">
									{{ $dt->created }}
								</div>
							</div>
						</div>
					</div>
				</div>
			@else
				<div class="frame-notif grid grid-3x">
					<div class="grid-1">
						<a href="{{ url('/user/'.$dt->id) }}">
							<div 
								class="image image-40px image-radius"
								style="background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});"></div>
						</a>
					</div>
					<div class="grid-2">
						<div class="notif-mid">
							<div class="ntf-mid">
								<div class="desc">
									<a href="{{ url('/user/'.$dt->id) }}">
										<strong>
											{{ $dt->username }}
										</strong>
									</a>
									@if ($dt->type == 'love')
										like your story
									@else
										save your story
									@endif
								</div>
								<div class="desc date">
									{{ $dt->created }}
								</div>
							</div>
						</div>
					</div>
					<div class="grid-3 txt-right">
						<a href="{{ url('/story/'.$dt->idstory) }}">
							<div 
								class="image image-40px image-radius"
								style="background-image: url({{ asset('/story/thumbnails/'.$dt->image) }});"></div>
						</a>
					</div>
				</div>
			@endif
		@endforeach

		<div>
			{{ $notif->links() }}
		</div>

	</div>
</div>
@endsection