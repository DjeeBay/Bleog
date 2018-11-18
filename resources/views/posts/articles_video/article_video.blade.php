<div class="col-xs-6 col-md-3">
	<a href="{{ route('videosPage', $post->video_id) }}" class="thumbnail" style="text-align: center; height: 210px;"><b><font color="#2175D9">Vidéo</font></b><hr style="margin: 0px 0px 4px 0px">
	<img src="https://img.youtube.com/vi/{{ $post->video_link }}/0.jpg" width="220" alt="vidéo">
	<p class="ellip">{{ $post->video_title }}</p>
	</a>
</div>