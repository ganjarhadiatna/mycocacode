@extends('layout.index')
@section('title',$title)
@section('path',$path)
@section('content')

@foreach ($getStory as $story)

<script type="text/javascript">
	var id = '{{ Auth::id() }}';
	var server = '{{ url("/") }}';

	function getComment(idstory, stt) {
		var offset = $('#offset-comment').val();
		var limit = $('#limit-comment').val();
		if (stt == 'new') {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/0/'+offset;
		} else {
			var url_comment = '{{ url("/get/comment/") }}'+'/'+idstory+'/'+offset+'/'+limit;
		}
		$.ajax({
			url: url_comment,
			dataType: 'json',
		})
		.done(function(data) {
			var dt = '';
			for (var i = 0; i < data.length; i++) {
				var server_foto = server+'/profile/thumbnails/'+data[i].foto;
				var server_user = server+'/user/'+data[i].id;
				if (data[i].id == id) {
					var op = '<span class="fa fa-lg fa-circle"></span>\
							<span class="del pointer" onclick="opQuestion('+"'open'"+','+"'Delete this comment ?'"+','+"'deleteComment("+data[i].idcomment+")'"+')" title="Delete comment.">Delete</span>';
				} else {
					var op = '';
				}
				dt += '\
					<div class="frame-comment comment-owner">\
						<div class="dt-1">\
							<a href="'+server_user+'" title="'+data[i].username+'">\
								<div class="image image-45px image-circle" style="background-image: url('+server_foto+')"></div>\
							</a>\
						</div>\
						<div class="dt-2">\
							<div class="desk comment-owner-radius">\
								<div class="comment-main">\
									<a href="'+server_user+'" title="'+data[i].username+'"><strong class="comment-name">'+data[i].username+'</strong></a>\
									<div>'+data[i].description+'</div>\
								</div>\
							</div>\
							<div class="tgl">\
								<span>'+data[i].created+'</span>\
								'+op+'\
							</div>\
						</div>\
					</div>\
				';
			}
			if (stt === 'new') {
				$('#place-comment').html(dt);
			} else {
				$('#place-comment').append(dt);

				var ttl = (parseInt($('#offset-comment').val()) + 5);
				$('#offset-comment').val(ttl);
			}
			if (data.length >= limit) {
				$('#frame-more-comment').show();
			} else {
				$('#frame-more-comment').hide();
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		});
		
	}
	function deleteComment(idcomment) {
		$.ajax({
			url: '{{ url("/delete/comment") }}',
			type: 'post',
			data: {'idcomment': idcomment},
		})
		.done(function(data) {
			if (data === 'success') {
				getComment('{{ $story->idstory }}', 'new');
			} else {
				opAlert('open', 'Deletting comment failed.');
			}
		})
		.fail(function(data) {
			console.log(data.responseJSON);
		}).
		always(function() {
			opQuestion('hide');
		});
	}
	function toComment() {
		var top = $('#tr-comment').offset().top;
		$('html, body').animate({scrollTop : (Math.round(top) - 70)}, 300);
		$('#comment-description').focus();
	}
	$(document).ready(function() {
		$('#offset-comment').val(0);
		$('#limit-comment').val(5);
		getComment('{{ $story->idstory }}', 'add');

		$('#comment-publish').submit(function(event) {
			var idstory = '{{ $story->idstory }}';
			var desc = $('#comment-description').val();
			if (desc === '') {
				$('#comment-description').focus();
			} else {
				$.ajax({
					url: '{{ url("/add/comment") }}',
					type: 'post',
					data: {
						'description': desc,
						'idstory': idstory
					},
				})
				.done(function(data) {
					if (data === 'failed') {
						opAlert('open', 'Sending comment failed.');
						$('#comment-description').focus();
					} else {
						$('#comment-description').val('');
						//refresh comment
						getComment('{{ $story->idstory }}', 'new');
					}
				})
				.fail(function(data) {
					console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		});

		$('#load-more-comment').on('click', function(event) {
			getComment('{{ $story->idstory }}', 'add');
		});

		$('.change-img').on('click', function(event) {
			var idimage = $(this).attr('key');
			$.ajax({
				url: server+'/image/'+idimage,
				type: 'get',
				beforeSend: function() {
					opLoadingCircle('open');
				}
			})
			.done(function(data) {
				if (data && data.length) {
					for (let i = 0; i < data.length; i++) {
						var img = '{{ asset("/story/covers/") }}'+'/'+data[i].image;
						$('#place-img').attr('src', img);
						$('#frame-img').css({'padding-bottom': ((data[i].height / data[i].width) * 100)+'%'});	
					}
				} else {
					opAlert('open', 'Failed to load image.');
				}
			})
			.fail(function(e) {
				opAlert('open', 'There is an error, please try again.');
			})
			.always(function () {
				opLoadingCircle('hide');
			});
		});

	});
</script>

<div class="frame-story">
	<div class="top">
		<div class="grid">
			<div class="col-1">
				<a href="{{ url('/user/'.$story->id) }}">
					<div 
					class="image image-50px image-circle" 
					style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
				</a>
			</div>
			<div class="col-2">
				<h1 class="username ctn-main-font ctn-sek-color ctn-mikro">
					<a href="{{ url('/user/'.$story->id) }}">
						{{ $story->username }}
					</a>
				</h1>
				<p class="ctn-main-font ctn-sek-color ctn-14px ctn-thin">
					Published on {{ $story->created }}
				</p>
			</div>
		</div>
	</div>
	<div class="mid">
		<div>
			@if ($story->description)
				<div class="ctn-main-font ctn-sek-color ctn-mikro padding-bottom-20px">
					{{ $story->description }}
				</div>
			@endif
		</div>
		<div class="grid">
			<div class="col-1">

				<div class="pict">
					@foreach ($images as $img)
						<div class="image" 
							style="
							background-image: url({{ asset('/story/covers/'.$img->image) }}); 
							padding-bottom: {{ (($img->height / $img->width) * 100) }}%;"
							id="frame-img">
						</div>
					@endforeach
				</div>

				<div>
					<div class="top-comment" id="tr-comment">
						@if (Auth::id())
						<form method="post" action="javascript:void(0)" id="comment-publish">
							<div class="comment-head padding-20px">
								<div>
									<input class="txt comment-text txt-primary-color" id="comment-description" placeholder="Type comment here.." />
								</div>
							</div>
						</form>
						@endif
						<div class="comment-content" id="place-comment"></div>
					</div>
					<div class="frame-more" id="frame-more-comment">
						<input type="hidden" name="offset" id="offset-comment" value="0">
						<input type="hidden" name="limit" id="limit-comment" value="0">
						<button class="btn btn-sekunder-color btn-radius" id="load-more-comment">
							<span class="Load More Comment">Load More</span>
						</button>
					</div>
				</div>

			</div>
			<div class="col-2">
				<div class="info">
					
					<div class="block">
						<div class="icn love pointer" key="{{ $story->idstory }}" onclick="addLove('{{ $story->idstory }}')">
							@if (is_int($story->is_love))
								<span class="sh">
									<span class="love-{{ $story->idstory }} scc fa fa-lg fa-heart"></span>
								</span>
							@else
								<span class="sh">
									<span class="love-{{ $story->idstory }} non fa fa-lg fa-heart"></span>
								</span>
							@endif
							<span>Like?</span>
						</div>
						<div class="ctn">
							<span>{{ $story->ttl_love }} likes</span>
						</div>
					</div>

					<div class="block">
						<div class="icn save pointer" key="{{ $story->idstory }}" onclick="addBookmark('{{ $story->idstory }}')">
							@if (is_int($story->is_save))
								<span class="sh">
									<span class="bookmark-{{ $story->idstory }} scc fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
								</span>
							@else
								<span class="sh">
									<span class="bookmark-{{ $story->idstory }} non fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
								</span>
							@endif
							<span>Save?</span>
						</div>
						<div class="ctn">
							<span>{{ $story->ttl_save }} saves</span>
						</div>
					</div>

					<div class="block">
						<div class="icn">
							<span class="sh fa fa-lg fa-eye"></span>
							<span>Views</span>
						</div>
						<div class="ctn">
							<span>{{ $story->views }} views</span>
						</div>
					</div>

					<div class="block">
						<div class="icn">
							<span class="sh fa fa-lg fa-comment"></span>
							<span>Talks</span>
						</div>
						<div class="ctn">
							<span>{{ $story->ttl_comment }} talks</span>
						</div>
					</div>

					<div class="block">
						<div class="icn">
							<span class="sh fa fa-lg fa-share-alt"></span>
							<span>Share</span>
						</div>
						<div class="ctn">
							<span class="sh fab fa-lg fa-facebook"></span>
							<span class="sh fab fa-lg fa-pinterest"></span>
							<span class="sh fab fa-lg fa-twitter"></span>
							<span class="sh fab fa-lg fa-google-plus"></span>
						</div>
					</div>

					@if (Auth::id() == $story->id)
					<div class="block">
						<div class="icn">
							<span class="sh fa fa-lg fa-cog"></span>
							<span>Option</span>
						</div>
						<div class="ctn">
							<span 
								class="sh fa fa-lg fa-pencil-alt"
								onclick="editPost('{{ $story->idstory }}','{{ $story->id }}')"
								></span>
							<span 
								class="sh fa fa-lg fa-trash-alt"
								onclick="opQuestionPost('{{ $story->idstory }}')"
								></span>
						</div>
					</div>
					@endif

				</div>

				@if (count($tags) > 0)
					<div class="padding-10px"></div>
					<div class="info">
						<h2 class="ctn-main-font ctn-sek-color ctn-18px">
							Tags
						</h2>
						<div class="padding-15px">
							@foreach($tags as $tag)
							
							<?php 
								$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
								$title = str_replace($replace, '', $tag->tag); 
							?>

							<a href="{{ url('/tags/'.$title) }}" class="frame-top-tag">
								<div>{{ $tag->tag }}</div>
							</a>
							@endforeach
						</div>
					</div>
				@endif

			</div>
		</div>
	</div>
	<div class="bot"></div>
</div>

@endforeach

@endsection
