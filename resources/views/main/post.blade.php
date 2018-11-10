<div class="frame-post">
	<div class="mid">
		<div class="mid-tool">
			<a href="{{ url('/design/'.$story->idstory) }}">
				<div class="cover-theme">
					<div class="cover">
						<div class="desc ctn-main-font ctn-14px ctn-sek-color ctn-thin">
							{{ $story->description }}
						</div>
					</div>
					<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover1) }});"></div>
				</div>
			</a>
		</div>		
		<div class="bot-tool">
			<div class="nts">
				<div class="notes ctn-main-font ctn-12px ctn-sek-color ctn-thin padding-bottom-10px">
					<span>{{ ($story->views + $story->ttl_love + $story->ttl_comment + $story->ttl_save).' notes' }}</span>
				</div>
			</div>
			<div class="bok">
				<button 
					class="btn btn-sekunder-color btn-no-border btn-pad-5px love" 
					onclick="addLove('{{ $story->idstory }}')">
					@if (is_int($story->is_love))
						<span class="love-{{ $story->idstory }} scc fa fa-lg fa-heart"></span>
					@else
						<span class="love-{{ $story->idstory }} non fa fa-lg fa-heart"></span>
					@endif
				</button>
				<button class="btn btn-sekunder-color btn-no-border save"
					key="{{ $story->idstory }}" 
					onclick="addBookmark('{{ $story->idstory }}')">
					@if (is_int($story->is_save))
						<span class="bookmark-{{ $story->idstory }} scc fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
					@else
						<span class="bookmark-{{ $story->idstory }} non fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
					@endif
				</button>
			</div>
		</div>
	</div>
	<div class="padding-top-10px mobile-hide">
		<div class="nts">
			<div class="pp">
				<div class="pp-col-1">
					<a href="{{ url('/user/'.$story->id) }}">
						<div class="image image-25px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
					</a>
				</div>
				<div class="pp-col-2">
					<a href="{{ url('/user/'.$story->id) }}" class="pp-username">
						{{ $story->username }}
					</a>
				</div>
			</div>
		</div>
	</div>
</div>
