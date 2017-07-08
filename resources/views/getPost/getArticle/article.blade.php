@extends('layout.main')

@section('addInHead')
	{!! Html::style('css/ekko-lightbox.min.css') !!}
@stop

@foreach($queryArticle as $article)

@section('title')
	Article du {{ $article->date }}
@stop

@section('errors')
	@if($errors->count())
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			@foreach($errors->all() as $error)
				<span class="glyphicon glyphicon-remove-circle"></span> {{ $error }}
			@endforeach
		</div>
	@endif
@stop

@section('content')
	<h2 style="text-align: center">Article du {{ $article->date }}</h2>
	<hr>
		
	@if(Auth::user()->admin)
		@include('getPost.getArticle.modify')
	@endif
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 style="text-align: center; font-weight: 800;">{{ $article->title }}</h3>
		</div>
		<div class="panel-body">
			{!! $article->body !!}
		</div>
	</div>
@stop

@section('addScript')
	<script src="{{ URL::asset('js/ekko-lightbox.min.js') }}"></script>
	<script type="text/javascript">
    $(document).delegate('*[data-toggle="lightbox"]', 'click', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox({
            onShow: function(elem) {
                var html = '<span id="dlPic"></span>';
                $(elem.currentTarget).find('.modal-header').append(html);

            },
            onNavigate: function(direction, itemIndex) {

            },
			onContentLoaded: function(e) {
                var img = $('.ekko-lightbox-container').find('img').attr('src');
                var html = '<a href="'+img+'" download><button type="button" class="btn btn-primary" style="">Télécharger l\'image</button></a>';
                $('#dlPic').html(html);
			}
		});
    }); 
    </script>
@stop

@endforeach