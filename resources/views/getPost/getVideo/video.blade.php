@extends('layout.main')

@foreach($queryVideo as $video)

@section('title')
	Vidéo du {{ $video->date }}
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
	<h2 style="text-align: center">Vidéo du {{ $video->date }}</h2>
	<hr>
		
	@if(Auth::user()->admin)
		@include('getPost.getVideo.modify')
	@endif
	
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 style="text-align: center; font-weight: 800;">{{ $video->title }}</h3>
		</div>
		<div class="panel-body">
			<div class="embed-responsive embed-responsive-16by9">
				<iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/{{ $video->link }}" allowfullscreen></iframe>
			</div>
		</div>
	</div>
@stop

@endforeach