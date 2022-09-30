@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	var server = '{{ url("/") }}';

	function getImage() {
		var fd = new FormData();
		var image = $('#get-image')[0].files[0];
		
		fd.append('image', image);
		$.each($('#form-image').serializeArray(), function(a, b) {
	    	fd.append(b.name, b.value);
	    });
	    $.ajax({
	    	url: '{{ url("/story/image/upload") }}',
			data: fd,
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				$('#progressbar').show();
			}
	    })
	    .done(function(data) {
	    	var dt = '<img src="'+server+'/story/images/'+data+'" alt="image">';
	    	$('#progressbar').hide();
	    	$('#get-image').val('');
	    	putToText(dt);
	    })
	    .fail(function() {
	    	opAlert('open', 'We can not upload your Picture, please try again.');
	    	$('#progressbar').hide();
	    });
	}

	function publish() {
		var fd = new FormData();
		var content = $('#write-story').val();
		var tags = $('#tags-story').val();

		var ctn = $('#cover')[0].files.length;

		if (ctn >= 1) {

			for (let i = 0; i < ctn; i++) {
				fd.append('image[]', $('#cover')[0].files[i]);
			}
			fd.append('content', content);
			fd.append('tags', tags);
			$.each($('#form-publish').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

			$.ajax({
			  	url: '{{ url("/story/publish") }}',
				data: fd,
				processData: false,
				contentType: false,
				type: 'post',
				beforeSend: function() {
					open_progress('Uploading your Story...');
				}
			})
			.done(function(data) {
			   	if (data == 'failed') {
			   		opAlert('open', 'failed to publish story.');
			   	} else if (data == 'no-login') {
			   		opAlert('open', 'you must login berfore can publish story.');
			   	} else if (data == 'no-file') {
			   		opAlert('open', 'you must select files.');
			   	} else {
					window.location = '{{ url("/design/") }}'+'/'+data;
			   	}
			   	//console.log(data);
			})
			.fail(function(data) {
			  	opAlert('open', data.responseJSON.message);
			   	console.log(data.responseJSON);
			})
			.always(function () {
				close_progress();
			});

		} else {
			$('#add-pict')
			.find('.warn')
			.html('Please choose one design.')
			.show();
		}

		return false;
	}
	$(function () { 
		var imagesPreview = function (input, place) {
			if (input.files) {
				var reader = new FileReader();	
				reader.onload = function (event) {
					$('#add-pict')
					.find('.add-pict')
					.css('background-image', 'url('+event.target.result+')');
					$('#add-pict')
					.find('.icn')
					.hide();
					$('#add-pict')
					.find('.warn')
					.html('To change picture just click it again.')
					.show();
				}

				reader.readAsDataURL(input.files[0]);
			}
		};
		$('#cover').on('change', function () {
			imagesPreview(this, '#add-pict');
		});
	});
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
						Create Design
					</h2>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="width width-700px width-center">
	<div class="compose">
		<form id="form-publish" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="publish()">
			<div class="cmp-main">
				
				<div class="cmp-col-1">
					<div>
						<input 
							type="file" 
							name="cover" 
							class="hidden" 
							id="cover" 
							autofocus="autofocus" 
							accept="image/*" 
							max="10" 
							maxlength="10">
					</div>

					<div class="pl-add" id="add-pict">
						<div class="width width-200px width-center">
							<label for="cover">
								<div class="add-pict">
									<div class="lbl-add-pict">
										<div class="icn fa fa-lg fa-plus"></div>
									</div>
								</div>
							</label>
							<div class="warn ctn-main-font ctn-14px ctn-thin ctn-err-color"></div>
						</div>
					</div>

				</div>

				<div class="cmp-col-2">

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
								maxlength="250"></textarea>

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
								<input type="text" name="tags" id="tags-story" class="tg txt txt-main-color txt-box-shadow" placeholder="Tags1, Tags2, Tags N...">
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

@endsection
