<div class="frame-lives">
	<div class="mid">
		<!--
		<div class="bot-tool padding-bottom-10px">
			<div class="nts">
				<div class="pp">
					<a href="{{ url('/user/'.$live->id) }}">
						<div class="image image-25px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$live->foto) }});"></div>
					</a>
					<a href="{{ url('/user/'.$live->id) }}">
						<div class="username">
							{{ $live->username }}
						</div>
					</a>
				</div>
			</div>
		</div>
		-->
		<div class="mid-tool">
			<a href="{{ url('/live/'.$live->idlives) }}">
				<div class="cover-theme">
					<div class="image image-full"
						style="background-image: url({{ asset('/live/thumbnails/'.$live->image) }});">
						<div class="icn fa fa-lg fa-play"></div>
					</div>
				</div>
			</a>
		</div>
		<div class="bot-tool">
			<div>
				<h1 class="ctn-main-font ctn-16px ctn-sek-color ctn-bold padding-bottom-5px">{{ $live->title }}</h1>
				<p class="ctn-main-font ctn-12px ctn-sek-color ctn-thin">{{ $live->description }}</p>
			</div>
			<div class="nts">
				<div class="notes ctn-main-font ctn-12px ctn-sek-color ctn-thin padding-bottom-10px">
					<span>{{ $live->created }}</span>
					<br>
					<span>{{ $live->views.' watchs' }}</span>
				</div>
			</div>
		</div>
		
	</div>
</div>
