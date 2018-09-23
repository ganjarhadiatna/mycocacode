<?php use App\TagModel; ?>

<div class="ctr">
	<div class="place-ctr">
		@foreach (TagModel::allTags() as $ctr)
			<?php 
				$replace = array('[',']','@',',','.','#','+','-','*','<','>','-','(',')',';','&','%','$','!','`','~','=','{','}','/',':','?','"',"'",'^');
				$title = str_replace($replace, '', $ctr->tag); 
			?>
			<div class="tag">
				<div class="col-1">
					<span class="far fa-1x fa-circle"></span>
				</div>
				<div class="col-2">
					<a href="{{ url('/tags/'.$title) }}">
						{{ $ctr->tag }}
					</a>
				</div>
			</div>
		@endforeach
	</div>
</div>