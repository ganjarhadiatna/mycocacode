@extends('layout.index')
@section('title',$title)
@section('path', $path)
@section('content')

<div class="col-700px padding-top-20px">
	<form action="javascript:void" method="get" id="place-search">
		<div class="place-search padding-top-10px">
			<input 
				type="text" 
				name="q" 
				class="txt-search" 
				id="txt-search" 
				placeholder="Search CocaCode..." 
				required="true" 
				value="{{ $ctr }}">
			<button type="submit" class="btn-search">
				<span class="fa fa-lg fa-search"></span>
			</button>
		</div>
	</form>

	@if (!empty($ctr))

		@if (count($topTags) != 0)
			<div class="padding-top-20px">
				@foreach ($topTags as $tag)
					<?php 
						$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
						$title = str_replace($replace, '', $tag->tag); 
					?>
					<a href="{{ url('/tags/'.$title) }}">
						<div class="frame-top-tag">
							{{ $tag->tag }}
						</div>
					</a>
				@endforeach 
			</div>
		@endif

	@else

		@if (count($trendingTags) != 0)
			<div class="padding-top-20px">
				@foreach ($trendingTags as $tag)
					<?php 
						$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
						$title = str_replace($replace, '', $tag->tag); 
					?>
					<a href="{{ url('/tags/'.$title) }}">
						<div class="frame-top-tag">
							{{ $tag->tag }}
						</div>
					</a>
				@endforeach 
			</div>
		@endif

	@endif
</div>



	@if (count($topStory) == 0)
		@include('main.post-empty')	
	@else
		<div class="post">
			@foreach ($topStory as $story)
				@include('main.post')
			@endforeach
		</div>
		{{ $topStory->links() }}
	@endif



@endsection