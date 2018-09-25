@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')

<div 
	class="banner banner-image"
	style="
		background-image: url('{{ asset('/img/sites/intro-1600.jpg') }}');
	" >
	<div class="padding-20px">
		<div>
			<h1>
				Want Make Your Projects or Personal Applications?
			</h1>
			<h3>Now it's so easy.</h3>
			<div class="padding-10px">
				<form method="post" action="#">
					<input 
						type="text" 
						name="email" 
						class="txt txt-main-color" 
						placeholder="Your email or phone number" 
						style="
							width: 250px;
							margin: 0 5px;
						"
						required="required">
					<select 
						class="txt txt-main-color"
						style="
							width: 150px; 
							margin: 10px 5px;
							color: #555;
							cursor: pointer;
						"
						required="required">
						<option value="choose">Choose Apps</option>
						<option value="web">Website</option>
						<option value="android">Android</option>
						<option value="ios">iOS</option>
						<option value="uiux">UIUX Designs</option>
					</select>
					<button 
						type="submit" 
						class="btn btn-main-color"
						style="
							margin: 0 5px;
						">
						Let's make it
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="padding-50px">
	<div class="title center">
		<p class="tt-second">
			Offers
		</p>
		<h2 class="tt-first">
			What we offers for you?
		</h2>
		<div class="tt-border"></div>
	</div>
	<div class="post">
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-globe"></div>
			</div>
			<div class="fo-mid">
				<h2>Website</h2>
			</div>
			<div class="fo-bot">
				Create website or web applications 
				for your projects or personal
			</div>
			<div class="fo-bot">
				<button class="btn btn-sekunder-color btn-radius">
					Let's make it
				</button>
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fab fa-lg fa-android"></div>
			</div>
			<div class="fo-mid">
				<h2>Android</h2>
			</div>
			<div class="fo-bot">
				Create mobile android applications
				for your projects or personal
			</div>
			<div class="fo-bot">
				<button class="btn btn-sekunder-color btn-radius">
					Let's make it
				</button>
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fab fa-lg fa-apple"></div>
			</div>
			<div class="fo-mid">
				<h2>iOS</h2>
			</div>
			<div class="fo-bot">
				Create mobile iOS applications
				for your projects or personal
			</div>
			<div class="fo-bot">
				<button class="btn btn-sekunder-color btn-radius">
					Let's make it
				</button>
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-edit"></div>
			</div>
			<div class="fo-mid">
				<h2>UIUX</h2>
			</div>
			<div class="fo-bot">
				Designing your applications 
				interface now so easy
			</div>
			<div class="fo-bot">
				<button class="btn btn-sekunder-color btn-radius">
					Let's make it
				</button>
			</div>
		</div>
	</div>
</div>

<div 
	class="banner">
	<div class="padding-20px">
		<div>
			<h1>
				Our Experiences
			</h1>
			<h3>We have been build much applications.</h3>
			<div class="padding-10px">
				<button 
					type="submit" 
					class="btn btn-main-color"
					style="
						margin: 0 5px;
					">
					Check Here
				</button>
			</div>
		</div>
	</div>
</div>

<div class="padding-50px">
	<div class="title center">
		<p class="tt-second">
			Benefits
		</p>
		<h2 class="tt-first">
			What would you get now?
		</h2>
		<div class="tt-border"></div>
	</div>
	<div class="post">
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-percent"></div>
			</div>
			<div class="fo-mid">
				<h2>Discount</h2>
			</div>
			<div class="fo-bot">
				Save your money with
				10% discount of each
				applications
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fas fa-lg fa-users"></div>
			</div>
			<div class="fo-mid">
				<h2>Teams</h2>
			</div>
			<div class="fo-bot">
				Work with profesional
				and trusted coca-code teams
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-comments"></div>
			</div>
			<div class="fo-mid">
				<h2>Discussion</h2>
			</div>
			<div class="fo-bot">
				Free discussion about
				applications to make 
				it more better
			</div>
		</div>
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-cogs"></div>
			</div>
			<div class="fo-mid">
				<h2>Maintenance</h2>
			</div>
			<div class="fo-bot">
				Get your free 3-months
				maintenance applications
			</div>
		</div>
	</div>
</div>

<div class="padding-bottom-50px">
	<div class="title center">
		<p class="tt-second">
			Contacts
		</p>
		<h2 class="tt-first">
			You can discused anytime
		</h2>
		<p class="tt-second padding-bottom-10px">
			We live 24 hours
		</p>
		<div class="tt-border"></div>
	</div>
	<div class="post post-5">
		@for ($i=1; $i<=5; $i++)
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fab fa-lg fa-whatsapp"></div>
			</div>
			<div class="fo-mid">
				<h2>Whatsapp</h2>
			</div>
			<div class="fo-bot">
				+62 896 0000 0000
			</div>
		</div>
		@endfor
	</div>
</div>

<div class="padding-bottom-50px">
	<div class="title center">
		<p class="tt-second">
			Testimonial
		</p>
		<h2 class="tt-first">
			What costumers say about us
		</h2>
		<div class="tt-border"></div>
	</div>
	<div class="post post-3">
		@for ($i=1; $i<=3; $i++)
		<div class="frame-offers">
			<div class="fo-top">
				<div class="fa fa-lg fa-quote-left"></div>
			</div>
			<div class="fo-bot">
				Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
				tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.
			</div>
			<div class="fo-bot">
				<div class="image image-50px image-circle image-center"></div>
				<div class="padding-top-10px">
					<strong>Lorem</strong>
				</div>
				<div>
					Students, Designers
				</div>
			</div>
		</div>
		@endfor
	</div>
</div>

<div 
	class="banner">
	<div class="padding-20px">
		<div>
			<h1>
				Now, Let's Make It!
			</h1>
			<h3>Just send us your email or phone number.</h3>
			<div class="padding-10px">
				<form method="post" action="#">
					<input 
						type="text" 
						name="email" 
						class="txt txt-main-color" 
						placeholder="Your email or phone number" 
						style="
							width: 250px;
							margin: 0 5px;
						"
						required="required">
					<select 
						class="txt txt-main-color"
						style="
							width: 150px; 
							margin: 10px 5px;
							color: #555;
							cursor: pointer;
						"
						required="required">
						<option value="choose">Choose Apps</option>
						<option value="web">Website</option>
						<option value="android">Android</option>
						<option value="ios">iOS</option>
						<option value="uiux">UIUX Designs</option>
					</select>
					<button 
						type="submit" 
						class="btn btn-main-color"
						style="
							margin: 0 5px;
						">
						Let's make it
					</button>
				</form>
			</div>
		</div>
	</div>
</div>

<div class="padding-bottom-50px"></div>

@endsection
