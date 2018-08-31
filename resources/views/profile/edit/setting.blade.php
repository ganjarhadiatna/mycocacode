<script type="text/javascript">
	function logout() {
		var a = confirm('Logout from account?');
		if (a == true) {
			window.location = "{{ route('logout') }}";
			event.preventDefault();
			document.getElementById('logout-form').submit();
		}
	}

	$(document).ready(function() {
		var path = '{{ $path }}';
		$('#'+path).addClass('active');
	});
</script>
<div>
	<div class="fe-block padding-bottom-20px">
		<strong>Account</strong>
		<ul>
			<a href="{{ url('/me/setting') }}">
				<li id="profile-picture">Change Profile Picture</li>
			</a>
			<a href="{{ url('/me/setting/info/public') }}">
				<li id="public-informations">Change Public Informations</li>
			</a>
			<a href="{{ url('/me/setting/info/private') }}">
				<li id="private-informations">Change Private Informations</li>
			</a>
			<a href="{{ url('/me/setting/password') }}">
				<li id="change-password">Change Password</li>
			</a>
		</ul>
	</div>
	<div class="fe-block padding-bottom-20px">
		<strong>More</strong>
		<ul>
			<!--<li>Delete your account</li>-->
			<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
				{{ csrf_field() }}
			</form>
			<a href="{{ route('logout') }}" 
				onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
				<li>Logout</li>
			</a>
		</ul>
	</div>
</div>