@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')
<script type="text/javascript">
	function savePassword(argument) {
		var fd = new FormData();
		var old_password = $('#old-password').val();
		var new_password = $('#new-password').val();
		var renew_password = $('#renew-password').val();

		if (new_password == renew_password) {
			fd.append('old_password', old_password);
			fd.append('new_password', new_password);
			fd.append('renew_password', renew_password);
			$.each($('#form-edit-profile').serializeArray(), function(a, b) {
			   	fd.append(b.name, b.value);
			});

			$.ajax({
				url: '{{ url("/save/password") }}',
				data: fd,
				processData: false,
				contentType: false,
				type: 'post',
				beforeSend: function() {
					open_progress('Changing your Password...');
				}
			})
			.done(function(data) {
				if (data == "done") {
					opAlert('open', "Your password has been changed.");
				} else if (data == "not_seem") {
					opAlert('open', "New password and Re-new password not seem.");
				} else if (data == "false") {
					opAlert('open', "Old password is wrong.");
					$('#old-password').select();
				} else {
					opAlert('open', "Please check your network or your password cridential.");
				}
			})
			.fail(function(data) {
				console.log(data.responseJSON);
				opAlert('open', "There is an error please try again.");
			})
			.always(function() {
				close_progress();
			});
		} else {
			opAlert('open', "Re-type Password must be seem with new Password.");
		}
	}
</script>
<div class="sc-header">
	<div class="sc-place pos-fix">
		<div class="col-full">
			<div class="sc-grid sc-grid-3x">
				<div class="sc-col-1"></div>
				<div class="sc-col-2">
					<h3 class="ttl-head ttl-sekunder-color">Change Password</h3>
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
		<form id="form-edit-profile" method="post" action="javascript:void(0)" onsubmit="savePassword()">
			<div class="fe-content">
				<div class="fe-mid">
					<div class="place-edit padding-bottom-20px">
						<div class="pe-1">
							<span>Old Password</span>
						</div>
						<div class="pe-2">
							<input type="password" name="old-password" class="txt txt-primary-color" id="old-password" required="true" placeholder="Old Password">
						</div>
					</div>
					<div class="padding-bottom-20px"></div>
					<div class="place-edit padding-bottom-20px">
						<div class="pe-1">
							<span>New Password</span>
						</div>
						<div class="pe-2">
							<input type="password" name="new-password" class="txt txt-primary-color" id="new-password" required="true" placeholder="New Password">
						</div>
					</div>
					<div class="place-edit">
						<div class="pe-1">
							<span>Confirm Password</span>
						</div>
						<div class="pe-2">
							<input type="password" name="renew-password" class="txt txt-primary-color" id="renew-password" required="true" placeholder="Confirm Password">
						</div>
					</div>
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