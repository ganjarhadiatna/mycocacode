<?php use App\TagModel; ?>

<div class="ctr">
	<div class="place-ctr">
		@foreach (TagModel::allTags() as $ctr)
			<?php 
				$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
				$title = str_replace($replace, '', $ctr->tag); 
			?>
			<div class="tag">
				<a href="{{ url('/tags/'.$title) }}">
					{{ $ctr->tag }}
				</a>
			</div>
		@endforeach
	</div>
</div>