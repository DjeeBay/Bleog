<div class="col-xs-6 col-md-3">
	<a href="{{ route('articlesPage', $post->article_id) }}" class="thumbnail" style="text-align: center; height: 210px;"><b><font color="#FF4E50">Article</font></b><hr style="margin: 0px 0px 4px 0px">
	<img src="css/reading.png" width="120px" alt="article">
	<p class="ellip" style="margin-top: 15px;">{{ $post->article_title }}</p>
	</a>
</div>