@if(Auth::user()->admin == 1)
@endif

@foreach($months as $key => $postTab)
<?php 
$timestamp = strtotime($key.'15');
$date = strftime('%B %Y', $timestamp);
?>
<div class="panel panel-primary-green">
	<div class="panel-heading-green">
		<h3 class="panel-title">
			<span class="glyphicon glyphicon-circle-arrow-right"></span><b> {{ $date }} </b>
		</h3>
	</div>
	<div class="panel-body">
		@foreach($postTab as $post)
			@if($post->type == 'article')
				@include('posts.articles.article')
			@endif
	
			@if($post->type == 'photo')
				@include('posts.articles_photo.article_photo')
			@endif
	
			@if($post->type == 'video')
				@include('posts.articles_video.article_video')
			@endif
		@endforeach
	</div>
</div>
@endforeach