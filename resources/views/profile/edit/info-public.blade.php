@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	function saveProfile() {
		
		var fd = new FormData();

		var name = $('#edit-name').val();
		var username = $('#edit-username').val();
		var about = $('#edit-about').val();
		var website = $('#edit-website').val();

		fd.append('name', name);
		fd.append('username', username);
		fd.append('about', about);
		fd.append('website', website);

		$.each($('#form-edit-profile').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
			url: '{{ url("/save/publicInformations") }}',
			data: fd,
			processData: false,
			contentType: false,
			type: 'post',
			beforeSend: function() {
				open_progress('Editing public informations...');
			}
		})
		.done(function(data) {
			if (data === 'success') {
				window.location = '{{ url("/me") }}';
			} else {
				opAlert('open', "failed to saving informations, please try again.");
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
		
		return false;
	}
</script>
<div class="sc-header">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-3x">
				<div class="sc-col-1"></div>
				<div class="sc-col-2">
					<h3 class="ttl-head ttl-sekunder-color">Public Informations</h3>
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

		<form id="form-edit-profile" method="post" action="javascript:void(0)" onsubmit="saveProfile()">

			<div class="fe-content">
				<div class="fe-mid">
					@foreach ($profile as $p)
						<div class="place-edit padding-bottom-20px">
							<div class="pe-1">
								<span>Name</span>
							</div>
							<div class="pe-2">
								<input 
								type="text" 
								name="edit-name" 
								class="txt txt-primary-color" 
								id="edit-name" 
								required="true" 
								value="{{ $p->name }}" 
								placeholder="Full Name">
							</div>
						</div>
						<div class="place-edit padding-bottom-20px">
							<div class="pe-1">
								<span>Username</span>
							</div>
							<div class="pe-2">
								<input 
								type="text" 
								name="edit-username" 
								class="txt txt-primary-color" 
								id="edit-username" 
								required="true" 
								value="{{ $p->username }}" 
								placeholder="Username">
							</div>
						</div>
						<div class="place-edit padding-bottom-20px">
							<div class="pe-1">
								<span>Website</span>
							</div>
							<div class="pe-2">
								<input 
								type="text" 
								name="edit-website" 
								class="txt txt-primary-color" 
								id="edit-website" 
								value="{{ $p->website }}" 
								placeholder="Link">
							</div>
						</div>
						<div class="place-edit">
							<div class="pe-1">
								<span>Bio</span>
							</div>
							<div class="pe-2">
								<textarea 
								class="txt edit-text txt-primary-color" 
								id="edit-about" 
								placeholder="About you">{{ $p->about }}</textarea>
							</div>
						</div>
							
					@endforeach
				</div>
				<div class="fe-bot">
					<input type="button" name="edit-save" class="btn btn-grey-color" value="Cancel" onclick="goBack()">
					<input type="submit" name="edit-save" class="btn btn-main-color" value="Save" style="margin-left: 10px; float: right;">
				</div>
			</div>
		</form>

	</div>
</div>
@endsection

