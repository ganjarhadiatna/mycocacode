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
			if (data.length > 0) {
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
			} else {
				if ($('#place-comment').html() != ' ') {
					$('#place-comment').html('<div class="ctn-main-font ctn-18px ctn-sek-color padding-bottom-20px">Comments Empty</div>');
				}
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
	function changeSize() {
		var stt = $('#frame-story').attr('class');
		if (stt == 'frame-story') {
			$('#frame-story').addClass('fs-size-big');
		} else {
			$('#frame-story').removeClass('fs-size-big');
		}
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

<div class="frame-story" id="frame-story">

	<div class="top">
		<div class="grid">
			<div class="col-1">
				<a href="{{ url('/user/'.$story->id) }}">
					<div 
					class="image image-40px image-circle" 
					style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
				</a>
			</div>
			<div class="col-2">
				<h1 class="username ctn-main-font ctn-sek-color ctn-16px" style="line-height: 1.2;">
					<a href="{{ url('/user/'.$story->id) }}">
						{{ $story->username }}
					</a>
				</h1>
				<p class="ctn-main-font ctn-sek-color ctn-12px ctn-thin" style="line-height: 1;">
					Published on {{ $story->created }}
				</p>
			</div>
			<div class="col-3">
				@if (is_int($story->is_love))
					<button 
						class="love-{{ $story->idstory }} btn btn-color-gg btn-circle"
						onclick="addLove('{{ $story->idstory }}', 'big')">
						<span class="fa fa-lg fa-heart"></span>
					</button>
				@else
					<button 
						class="love-{{ $story->idstory }} btn btn-grey-color btn-circle"
						onclick="addLove('{{ $story->idstory }}', 'big')">
						<span class="fa fa-lg fa-heart"></span>
					</button>
				@endif
				<div style="margin-right: 4px; display: inline-block;"></div>
				@if (is_int($story->is_save))
					<button 
						class="bookmark-{{ $story->idstory }} btn btn-main3-color"
						onclick="addBookmark('{{ $story->idstory }}', 'big')">
						Saves
					</button>
				@else
					<button 
						class="bookmark-{{ $story->idstory }} btn btn-grey-color"
						onclick="addBookmark('{{ $story->idstory }}', 'big')">
						Saves
					</button>
				@endif
			</div>
		</div>
	</div>

	<div class="mid">
		<div class="grids">
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
					@if ($story->description)
						<div 
							class="ctn-main-font ctn-sek-color ctn-mikro padding-bottom-15px"
							style="white-space: normal;">
							{{ $story->description }}
						</div>
					@endif
				</div>
			</div>
			<div class="col-2">
				@if (count($tags) > 0)
					<div class="info">
						<h2 class="ctn-main-font ctn-sek-color ctn-16px">
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

				<div class="info">
					<h2 class="ctn-main-font ctn-sek-color ctn-16px">
						Notes
					</h2>

					<div class="block">
						<div class="icn love">
							<span class="sh">
								<span class="non fa fa-lg fa-heart"></span>
							</span>
							<span>Like this?</span>
						</div>
						<div class="ctn">
							<span>{{ $story->ttl_love }} likes</span>
						</div>
					</div>

					<div class="block">
						<div class="icn save">
							<span class="sh">
								<span class="non fa fa-lg fa-bookmark"></span>
							</span>
							<span>Save this?</span>
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
				</div>

				<div class="info">
					<h2 class="ctn-main-font ctn-sek-color ctn-16px padding-top-15px">
						Options
					</h2>
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
					<div class="padding-bottom-15px"></div>
				</div>
				<div class="">
					<div class="top-comment" id="tr-comment">
						<h2 class="ctn-main-font ctn-sek-color ctn-16px">
							Comments
						</h2>
						@if (Auth::id())
						<div>
							<form method="post" action="javascript:void(0)" id="comment-publish">
								<div class="comment-head padding-top-15px">
									<div>
										<textarea class="txt edit-text et-height-50px comment-text txt-primary-color" id="comment-description" placeholder="Write comments.."></textarea>
									</div>
									<div class="padding-top-15px" style="text-align: right;">
										<input type="submit" name="post" class="btn btn-main-color" value="Send">
									</div>
								</div>
							</form>
						</div>
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
		</div>
	</div>
	
</div>

@endforeach

@if (count($newStory) == 0)
	@include('main.post-empty')	
@else
	<div class="post">
		@foreach ($newStory as $story)
			@include('main.post')
		@endforeach
	</div>
	<div class="padding-10px"></div>
@endif

@endsection
