<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/navbar-static-top.css') !!}
    {!! Html::style('css/style.css') !!}
    <script src="{{ URL::asset('js/ie-emulation-modes-warning.js') }}"></script>
    @yield('addInHead')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <title>Bleog - Liste des photos</title>
  </head>
  <body>
  	@if(session()->has('fail'))
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="glyphicon glyphicon-oremove-circle"></span> {!! session('fail') !!}
				</div>
			</div>
		</div>
	@endif
	@if(session()->has('success'))
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="glyphicon glyphicon-ok-circle"></span> {!! session('success') !!}
				</div>
			</div>
		</div>
	@endif
	<div class="row">
	<div class="panel panel-default col-md-6 col-md-offset-3">
	<div class="panel-body">
	{!! Form::open(['route' => 'postGalleryPic', 'files' => 'true']) !!}
		<div class="form-group">
			{!! Form::label('photo_file', 'Choisir la photo (jpg, png, max. 2Mo)') !!}
			{!! $errors->first('photo_file', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::file('photo_file') !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
	</div>
	</div>
	</div>
	<hr>
    <div class="row">
@foreach($pics as $pic)
	<div class="col-sm-6 col-md-2">
		<div class="thumbnail">
			{!! Form::open([route('getGallery')]) !!}
				<img src="{{ URL::asset('pics/articles_pics/mini/'.$pic->picsname) }}" alt="{{ $pic->picsname }}">
				<div class="caption">
					<small>Lien à copier :</small>
					<pre>/pics/articles_pics/mini/{{ $pic->picsname }}</pre>
					{!! Form::checkbox('selectedPics', $pic->id) !!} <small>Cochez et cliquez sur Supprimer</small>
					{!! Form::submit('Supprimer', ['class' => 'btn btn-danger btn-xs']) !!}
				</div>
			{!! Form::close() !!}
		</div>
	</div>
@endforeach
    </div>
	<script src="{{ URL::asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    </body>
</html>