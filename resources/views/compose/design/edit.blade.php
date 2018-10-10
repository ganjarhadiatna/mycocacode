@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	var server = '{{ url("/") }}';
	function publish() {
		var fd = new FormData();
		var idstory = $('#id-story').val();
		var content = $('#write-story').val();
		var tags = $('#tags-story').val();

		fd.append('idstory', idstory);
		fd.append('content', content);
		fd.append('tags', tags);
		$.each($('#form-publish').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
		  	url: '{{ url("/story/save/editting") }}',
			data: fd,
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				open_progress('Updating your Story...');
			}
		})
		.done(function(data) {
		   	if (data === 'failed') {
		   		opAlert('open', 'failed to saving design, your design still the same with previous content. To fix problem try with edit description.');
		   		close_progress();
		   	} else {
				$('#title-story').val('');
				$('#write-story').val('');
				opCreateStory('close');
				close_progress();
				window.location = '{{ url("/story/") }}'+'/'+data;
		   	}
		   	//console.log(data);
		})
		.fail(function() {
		  	opAlert('open', "there is an error, please try again.");
		   	close_progress();
		});

		return false;
	}
	$(document).ready(function() {
		$('#progressbar').progressbar({
			value: false,
		});
		$('#write-story').keyup(function(event) {
			var length = $(this).val().length;
			$('#desc-lg').html(length);
			
		});
		$('#btnToolStory').on('click', function(e) {
			e.preventDefault();
			var stt = $('#btnToolStory #tool-icn').attr('key');
			if (stt == 'hidden') {
				var x = ($(this).offset().top - 155);
				var y = ($(this).offset().left - 145);
				$('#toolStory')
				.css({
					'top': x+'px',
					'right': '40px'
				})
				.show();
				$('#btnToolStory #tool-icn').attr('key','open');
				$('#btnToolStory #tool-icn').attr('class', 'icn fa fa-lg fa-times');
				$('#btnToolStory').addClass('active');
			} else {
				$('#toolStory').hide();
				$('#btnToolStory #tool-icn').attr('key','hidden');
				$('#btnToolStory #tool-icn').attr('class', 'icn fa fa-lg fa-plus');
				$('#btnToolStory').removeClass('active');
			}
		});
	});
</script>

<div class="sc-header bdr-bottom-mobile">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-1x">
				<div class="sc-col-2">
					<h2 class="ttl-head ttl-sekunder-color">
						Edit Design
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

@foreach ($getStory as $story)
<div class="width width-700px width-center">
	<div class="compose">
		<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
			<div class="cmp-main">
				
				<div class="cmp-col-1">
					<div class="pl-add" id="add-pict">
						<div class="width width-200px width-center">
							<div class="warn ctn-main-font ctn-14px ctn-thin ctn-err-color"></div>
							<div class="add-pict" style="background-image: url({{ asset('/story/thumbnails/'.$story->cover) }});"></div>
						</div>
					</div>
				</div>

				<div class="cmp-col-2">
					
					<div class="top"></div>

					<div class="mid">
						
						<div class="block-field">

							<div class="pan">
								<div class="left">
									<p class="ttl">Description</p>
								</div>
								<div class="right">
									<div class="count">
										<span id="desc-lg">0</span>/250
									</div>
								</div>
							</div>

							<textarea 
								name="write-story" 
								id="write-story" 
								class="txt edit-text txt-main-color txt-box-shadow ctn ctn-main ctn-sans-serif"
								placeholder="Write something..." 
								maxlength="250"><?php echo $story->description; ?></textarea>

						</div>

						<div class="padding-5px"></div>

						<div class="block-field place-tags">
							
							<div class="pan">
								<div class="left">
									<p class="ttl">Tags</p>
								</div>
								<div class="right"></div>
							</div>

							<div class="block-field">
								<input type="text" name="tags" id="tags-story" class="tg txt txt-main-color txt-box-shadow" placeholder="Tags1, Tags2, Tags N..." value="{{ $tags }}">
							</div>

						</div>

					</div>

					<div class="bot">
						<input 
							type="button" 
							name="edit-save" 
							class="btn btn-primary-color" 
							value="Cancel" 
							onclick="goBack()" 
							style="margin-right: 10px;">
						<input 
							type="submit" 
							name="save" 
							class="btn btn-main-color" 
							value="Post" 
							id="btn-publish">
					</div>

				</div>
			</div>
		</form>
	</div>
</div>
@endforeach

@endsection