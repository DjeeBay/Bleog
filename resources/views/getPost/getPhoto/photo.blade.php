@extends('layout.main')

@foreach($queryPhoto as $photo)

@section('title')
	Photo du {{ $photo->date }}
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
	<h2 style="text-align: center">Photo du {{ $photo->date }}</h2>
	<hr>
		
	@if(Auth::user()->admin)
		@include('getPost.getPhoto.modify')
	@endif
		
	@if($photo->title)
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Description</h3>
			</div>
			<div class="panel-body">
				{{ $photo->title }}
			</div>
		</div>
	@endif
	<a href="{{ URL::asset('pics') }}/{{ $photo->picsname }}"><img class="img-responsive" style="margin: auto;" src="{{ URL::asset('pics') }}/{{ $photo->picsname }}"></a>
@stop

@endforeach