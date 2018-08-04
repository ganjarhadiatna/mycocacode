<?php use App\ProfileModel; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Pictlr - @yield('title')</title>
	<meta charset=utf-8>
    <meta name=description content="">
    <meta name=viewport content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- ICON -->
    <link href="{{ asset('/img/C.png') }}" rel='SHORTCUT ICON'/>

	<!-- SASS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('css/css/fontawesome-all.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('sass/main.css') }}">

	<!-- JS -->
	<script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/follow.js') }}"></script>
	<script type="text/javascript">
		var iduser = '{{ Auth::id() }}';

		function setScroll(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll');
			} else {
				$('html').removeClass('set-scroll');
			}
		}
		function setScrollMobile(stt) {
			if (stt === 'hide') {
				$('html').addClass('set-scroll-mobile');
			} else {
				$('html').removeClass('set-scroll-mobile');
			}
		}
		function opSearch(stt) {
			if (stt === 'open') {
				$('#search').show();
				$('#txt-search').select();
				setScroll('hide');
			} else {
				$('#search').hide();
				setScroll('show');
			}
		}
		function opCreateStory(stt) {
			if (stt === 'open') {
				$('#create').show();
				setScroll('hide');
			} else {
				$('#create').hide();
				setScroll('show');
			}
		}
		function opToggle(stt) {
			var tr = $('#'+stt).attr('class');
			if (tr === 'toggle fa fa-lg fa-toggle-off') {
				$('#'+stt).attr('class', 'toggle tgl-active fa fa-lg fa-toggle-on');
			} else {
				$('#'+stt).attr('class', 'toggle fa fa-lg fa-toggle-off');
			}
		}
		function pictZoom(idstory) {
			var img = $('#pict-'+idstory).attr('src');
			var str = img.replace('/thumbnails/','/covers/');
			var dt = '<img src="'+str+'" alt="pict">';
			$('#zoom-pict').show();
			$('#zoom-pict .zp-main').html(dt);
			setScroll('hide');
		}
		function toLink(path) {
			window.location = path;
		}
		function cekNotif() {
			$.get('{{ url("/notif/cek") }}', function(data) {
				//console.log('notif: '+data);
				if (data != 0) {
					$('#main-notif-sign').show();
				} else {
					$('#main-notif-sign').hide();
				}
			});
		}

		function opLoadingCircle(stt) {
			if (stt == 'open') {
				$('#frame-loading-circle').show();
			} else {
				$('#frame-loading-circle').hide();
			}
		}
		
		function goBack() {
			window.history.back();
		}

		function toLeft() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (sc >= 0) {
				$('#ctnTag').animate({scrollLeft: (sc - wd)}, 500);
			}
		}
		function toRight() {
			var wd = $('#ctnTag').width();
			var sc = $('#ctnTag').scrollLeft();
			if (true) {
				$('#ctnTag').animate({scrollLeft: (sc + wd)}, 500);
			}
		}

		function addLove(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can love this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/love") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'love') {
						$('.love-'+idstory).attr('class', 'love-'+idstory+' scc fa fa-lg fa-heart');
					} else if (data === 'unlove') {
						$('.love-'+idstory).attr('class', 'love-'+idstory+' non fa fa-lg fa-heart');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to love story.');
						$('.love-'+idstory).attr('class', 'love-'+idstory+' non fa fa-lg fa-heart');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to unlove story.');
						$('.love-'+idstory).attr('class', 'love-'+idstory+' scc fa fa-lg fa-heart');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
				})
				.fail(function() {
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}

		function addBookmark(idstory) {
			if (iduser === '') {
				opAlert('open', 'Please login berfore you can save this story.');
			} else {
				$.ajax({
					url: '{{ url("/add/bookmark") }}',
					type: 'post',
					data: {'idstory': idstory},
				})
				.done(function(data) {
					if (data === 'bookmark') {
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' scc fa fa-lg fa-bookmark');
					} else if (data === 'unbookmark') {
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' non fa fa-lg fa-bookmark');
					} else if (data === 'failedadd') {
						opAlert('open', 'Failed to save story to bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' non fa fa-lg fa-bookmark');
					} else if (data === 'failedremove') {
						opAlert('open', 'Failed to remove story from bookmark.');
						$('.bookmark-'+idstory).attr('class', 'bookmark-'+idstory+' scc fa fa-lg fa-bookmark');
					} else {
						opAlert('open', 'There is an error, please try again.');
					}
					//console.log(data);
				})
				.fail(function(data) {
					//console.log(data.responseJSON);
					opAlert('open', 'There is an error, please try again.');
				});
			}
		}

		window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).ready(function() {
			var pth = "@yield('path')";

			if (iduser) {
				setInterval('cekNotif()', 3000);
			}

			/*$(window).scroll(function(event) {
				var hg = $('#header').height();
				var top = $(this).scrollTop();
				if (top > hg) {
					$('#main-search').addClass('hide');
				} else {
					$('#main-search').removeClass('hide');
				}
			});*/

			$('#txt-search').focusin(function () {
				$('#main-search .main-search').addClass('select');
			}).focusout(function () {
				$('#main-search .main-search').removeClass('select');
			});

			$('#close-zoom, #zoom-pict').on('click',function () {
				$('#zoom-pict').hide();
				setScroll('show');
			});
			
			$('#header .place .menu .pos .btn-circle').each(function(index, el) {
				$(this).removeClass('active');
				$('#'+pth).addClass('active');
			});

			$('#place-search').submit(function(event) {
				var ctr = $('#txt-search').val();
				window.location = "{{ url('/search/') }}"+'/'+ctr;
			});
			
		});
	</script>
</head>
<body>
	<div id="header">
		<div class="hc-place">
			<div class="hc-menu">
				<div class="col-1">
					<div class="logo">
						<a href="{{ url('/') }}">
							<img src="{{ asset('/img/1.png') }}" alt="Pictlr">
						</a>
					</div>
				</div>
				<div class="col-2">
					<ul class="hc-list">
					    <a href="{{ url('/fresh') }}">
					    	<li>
					    		Fresh
					    	</li>
					    </a>
					    <a href="{{ url('/trending') }}">
					    	<li>
					    		Trending
					    	</li>
					    </a>
					    <a href="{{ url('/popular') }}">
					    	<li>
					    		Popular
					    	</li>
					    </a>
					    <a href="">
					    	<li>
					    		All <span class="fa fa-lg fa-angle-down"></span>
					    	</li>
					    </a>
					</ul>
				</div>
				<div class="col-3">
					@if (!Auth::id())
						<a href="{{ url('/login') }}">
							<button class="btn-icn btn btn-sekunder-color btn-no-border">
								<span>LOGIN</span>
							</button>
						</a>
						<a href="{{ url('/register') }}" style="margin-left: 5px;">
							<button class="create btn btn-main-color">
								<span>REGISTER</span>
							</button>
						</a>
					@else
						<a href="{{ url('/me/notifications') }}">
							<button class="btn-icn btn btn-circle btn-main2-color" id="notif" key="hide" style="margin-right: 5px;">
								<div class="notif-icn absolute fas fa-lg fa-circle" id="main-notif-sign"></div>
								<span class="fas fa-lg fa-bell"></span>
							</button>
						</a>
						@foreach (ProfileModel::UserSmallData(Auth::id()) as $dt)
							<a href="{{ url('/user/'.$dt->id) }}">
								<button class="btn-pp btn btn-circle btn-main2-color btn-radius" id="profile">
									<div 
										class="image image-30px image-circle"
										style="
											background-image: url({{ asset('/profile/thumbnails/'.$dt->foto) }});
											margin: auto;"
										id="profile"></div>
								</button>
							</a>
						@endforeach
						<a href="{{ url('/compose') }}">
							<button class="create btn btn-radius btn-main-color" id="op-add" key="hide" style="margin-left: 20px;">
								<span class="fas fa-lg fa-plus"></span>
								<span class="ttl">Create Design</span>
							</button>
						</a>
					@endif
				</div>
			</div>
		</div>
	</div>
	
	<div id="body">
		<!--
		<div class="zoom-pict" id="zoom-pict">
			<button class="close btn btn-circle btn-main2-color" id="close-zoom">
				<span class="fas fa-lg fa-times"></span>
			</button>
			<div class="zp-main"></div>
		</div>
		-->
		<div class="frame-loading-circle" id="frame-loading-circle">
			<div class="icn btn btn-circle btn-normal-color">
				<div class="tr fas fa-lg fa-spin fa-circle-notch"></div>
			</div>
		</div>
		@yield("content")

		@include('main.loading-bar')
		@include('main.post-menu')
		@include('main.question-menu')
		@include('main.alert-menu')

	</div>
	<div id="footer">
		<div class="ft-place">
			<div class="ft-col ft-col-1">
				<!--
				<div class="logo">
					<a href="{{ url('/') }}">
						<img src="{{ asset('/img/1.png') }}" alt="Pictlr">
					</a>
				</div>
				-->
				<h1>CocaCode</h1>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
				<p>Duis aute irure dolor in reprehenderit in voluptate velit esse
				cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
				proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
				quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
				consequat.</p>
			</div>
			
			<div class="ft-col ft-col-2">
				<h1>Options</h1>
				<ul class="ft-menu">
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>Home Feeds</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>About Us</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>Help</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>FAQ</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>Terms & Privacy</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>Policy</span>
				    </li>
				    <li>
				    	<span class="icn icn-small fa fa-lg fa-circle"></span>
				    	<span>Groups</span>
				    </li>
				</ul>
			</div>

			<div class="ft-col ft-col-3">
				<h1>Find US</h1>
				<ul class="ft-menu">
				    <li>
				    	<span class="icn fab fa-lg fa-instagram"></span>
				    	<span>Instagram</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-twitter"></span>
				    	<span>Twitter</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-facebook"></span>
				    	<span>Facebook</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-youtube"></span>
				    	<span>Youtube</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-pinterest"></span>
				    	<span>Pinterest</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-medium"></span>
				    	<span>Medium</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-behance"></span>
				    	<span>Behance</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-dribbble"></span>
				    	<span>Dribbble</span>
				    </li>
				</ul>
			</div>
			
			<div class="ft-col ft-col-4">
				<h1>Contact US</h1>
				<ul class="ft-menu">
				    <li>
				    	<span class="icn fab fa-lg fa-whatsapp"></span>
				    	<span>(+62) 888 8888 88</span>
				    </li>
				    <li>
				    	<span class="icn fab fa-lg fa-whatsapp"></span>
				    	<span>(+62) 888 6666 88</span>
				    </li>
				    <li>
				    	<span class="icn fa fa-lg fa-envelope"></span>
				    	<span>support@cocacode.com</span>
				    </li>
				    <li>
				    	<span class="icn fa fa-lg fa-envelope"></span>
				    	<span>help@cocacode.com</span>
				    </li>
				</ul>
			</div>

		</div>
	</div>
</body>
</html>
