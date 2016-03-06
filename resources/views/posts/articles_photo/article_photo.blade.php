<div class="col-xs-6 col-md-3">
	<a href="{{ route('photosPage', $post->photo_id) }}" class="thumbnail" style="text-align: center; height: 210px;">
	<b><font color="#29d683">Photo</font></b>
	<hr style="margin: 0px 0px 4px 0px">
	<img src="pics/mini/{{ $post->photo_name }}" alt="{{ $post->photo_name }}">
	</a>
</div>