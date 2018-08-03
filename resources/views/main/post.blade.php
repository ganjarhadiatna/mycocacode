<div class="frame-post">
	<div class="mid">
		<div class="mid-tool">
			<a href="{{ url('/story/'.$story->idstory) }}">
				<div class="cover-theme">
					<div class="cover"></div>
					<div class="image image-all"
						style="background-image: url({{ asset('/story/thumbnails/'.$story->cover1) }});"></div>
				</div>
			</a>
		</div>
		<div class="bot-tool">
			<div class="nts">
				<a href="{{ url('/user/'.$story->id) }}">
					<div class="image image-25px image-circle" style="background-image: url({{ asset('/profile/thumbnails/'.$story->foto) }});"></div>
				</a>
			</div>
			<div class="bok">
				<button class="btn btn-sekunder-color btn-no-border btn-pad-5px love">
					<span class="fa fa-lg fa-eye"></span>
					<span>{{ $story->views }}</span>
				</button>
				<a href="{{ url('/story/'.$story->idstory) }}">
					<button class="btn btn-sekunder-color btn-no-border btn-pad-5px">
						<span class="fa fa-lg fa-comment"></span>
						<span>{{ $story->ttl_comment }}</span>
					</button>
				</a>
				<button 
					class="btn btn-sekunder-color btn-no-border btn-pad-5px love" 
					onclick="addLove('{{ $story->idstory }}')">
					@if (is_int($story->is_love))
						<span class="love-{{ $story->idstory }} scc fa fa-lg fa-heart"></span>
					@else
						<span class="love-{{ $story->idstory }} non fa fa-lg fa-heart"></span>
					@endif
					<span>{{ $story->ttl_love }}</span>
				</button>
				<button class="btn btn-sekunder-color btn-no-border save"
					key="{{ $story->idstory }}" 
					onclick="addBookmark('{{ $story->idstory }}')">
					@if (is_int($story->is_save))
						<span class="bookmark-{{ $story->idstory }} scc fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
					@else
						<span class="bookmark-{{ $story->idstory }} non fa fa-lg fa-bookmark" id="bookmark-{{ $story->idstory }}"></span>
					@endif
					<span>{{ $story->ttl_save }}</span>
				</button>
			</div>
		</div>
	</div>
	<!--
	@if ($story->description)
		<div class="desc">
			{{ $story->description }}
		</div>
	@endif
	-->
</div>