@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	function saveProfile() {
		
		var fd = new FormData();

		var email = $('#edit-email').val();
		var number = $('#edit-number').val();
		var gender = $('#edit-gender').val();

		fd.append('email', email);
		fd.append('phone_number', number);
		fd.append('gender', gender);

		$.each($('#form-edit-profile').serializeArray(), function(a, b) {
		   	fd.append(b.name, b.value);
		});

		$.ajax({
			url: '{{ url("/save/privateInformations") }}',
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
					<h3 class="ttl-head ttl-sekunder-color">Private Informations</h3>
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
								<span>Email</span>
							</div>
							<div class="pe-2">
								<input type="email" name="edit-email" class="txt txt-primary-color" id="edit-email" required="true" value="{{ $p->email }}" placeholder="Email">
							</div>
						</div>
						<div class="place-edit padding-bottom-20px">
							<div class="pe-1">
								<span>Phone Number</span>
							</div>
							<div class="pe-2">
								<input type="integer" name="edit-number" class="txt txt-primary-color" id="edit-number" required="true" value="{{ $p->phone_number }}" placeholder="+62 xxx xxxx xxxx">
							</div>
						</div>
						<div class="place-edit">
							<div class="pe-1">
								<span>Gender</span>
							</div>
							<div class="pe-2">
								<select name="edit-gender" id="edit-gender" class="txt txt-primary-color" style="width: 100px; padding: 0 0;">
									@if ($p->phone_number == 'male')
										<option value="male" selected="true">Male</option>
										<option value="female">Female</option>
									@else
										<option value="male">Male</option>
										<option value="female" selected="true">Female</option>
									@endif
								</select>
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

