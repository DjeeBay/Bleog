@extends('layout.main')

@section('addInHead')
	<script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
@stop

@foreach($queryArticle as $article)

@section('title')
	Modification de l'article du {{ $article->date }}
@stop

@section('errors')
	@if($errors->has())
		<div class="alert alert-danger alert-dismissible" role="alert">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			@foreach($errors->all() as $error)
				<span class="glyphicon glyphicon-remove-circle"></span> {{ $error }}
			@endforeach
		</div>
	@endif
@stop

@section('content')
	<h2 style="text-align: center; color: red;"><b>Mode édition</b></h2>
	<h2 style="text-align: center">Article du {{ $article->date }}</h2>
	<hr>
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 style="text-align: center; font-weight: 800;">{{ $article->title }}</h3>
		</div>
		{!! Form::open(['route' => ['editArticle', $article->id]]) !!}
			{!! Form::textarea('article_body', $article->body) !!}
	</div>
			<a href="{{ route('articlesPage', $article->id) }}" class="btn btn-default">
				Annuler
			</a>
			{!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
		{!! Form::close() !!}
		<!-- Adding CKEditor -->
		<script>
			CKEDITOR.replace('article_body', {
				filebrowserBrowseUrl: '/articles_pics/sel_pics.php',
	    		filebrowserUploadUrl: '/articles_pics/upload.php'
			});
		</script>
@stop

@endforeach