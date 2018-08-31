@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	function loadFoto() {
		var OFReader = new FileReader();
		OFReader.readAsDataURL(document.getElementById("change-picture").files[0]);
		OFReader.onload = function (oFREvent) {
			$('#place-picture').css('background-image', 'url("'+oFREvent.target.result+'")');
		}
	}
	function saveProfile() {
		var fd = new FormData();

		var foto = $('#change-picture')[0].files[0];
		var ctn = $('#change-picture')[0].files.length;

		if (ctn >= 1) {

			fd.append('foto', foto);

			$.each($('#form-edit-profile').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

			$.ajax({
				url: '{{ url("/save/profilePicture") }}',
				data: fd,
				processData: false,
				contentType: false,
				type: 'post',
				beforeSend: function() {
					open_progress('Uploading profile picture...');
				}
			})
			.done(function(data) {
				if (data === 'success') {
					window.location = '{{ url("/me") }}';
				}
				else if (data === 'no-file') {
					opAlert('open', "Please choose one picture");
				}
				else if (data === 'failed') {
					opAlert('open', "failed to updating profile picture");
				} else {
					opAlert('open', "failed to updating, please try again");
				}
				close_progress();
			})
			.fail(function(data) {
				opAlert('open', "there is an error, please try again.");
				close_progress();
			})
			.always(function() {
				close_progress();
			});

		} else {
			opAlert('open', "Please choose picture");
		}
		
		return false;
	}
</script>
<div class="sc-header">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-3x">
				<div class="sc-col-1"></div>
				<div class="sc-col-2">
					<h3 class="ttl-head ttl-sekunder-color">Profile Picture</h3>
				</div>
				<div class="sc-col-3"></div>
			</div>
		</div>
	</div>
</div>
<div class="frame-edit">
	<div class="fe-col-1">
		@include('profile.edit.setting')
	</div>
	<div class="fe-col-2">
		<form id="form-edit-profile" method="post" action="javascript:void(0)" enctype="multipart/form-data" onsubmit="saveProfile()">
			<div class="fe-content">
				<div class="fe-mid">
					@foreach ($profile as $p)
						<div class="change" id="change">
							
							<div class="foto padding-15px">
								<div class="image image-150px image-circle" id="place-picture" style="background-image: url({{ asset('/profile/photos/'.$p->foto) }});"></div>
							</div>

							<div class="file">
								<input type="file" name="change-picture" id="change-picture" onchange="loadFoto()">
								<label for="change-picture">
									<div class="btn btn-div btn-sekunder-color" id="btn-save-foto">
										<span class="fas fa-lg fa-camera"></span>
										<span>Choose File</span>
									</div>
								</label>
							</div>

						</div>
					@endforeach
				</div>
				<div class="fe-bot">
					<input type="button" name="edit-save" class="btn btn-grey-color" value="Cancel" onclick="goBack()">
					<input type="submit" name="edit-save" class="btn btn-main-color" value="Save" style="margin-left: 10px; float: right;">
				</div>
			</div>
		</div>
	</form>
</div>
@endsection

