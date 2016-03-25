<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('favicon.ico') }}">
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/signin.css') !!}
    <script src="{{ URL::asset('js/ie-emulation-modes-warning.js') }}"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <title>Bleog - Authentification</title>
  </head>
  <body>
	<div class="container">
		<div class="jumbotron">
			@if(session()->has('fail'))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="glyphicon glyphicon-oremove-circle"></span> {!! session('fail') !!}
				</div>
			@endif
			{!! Form::open(['route' => 'login', 'class' => 'form-signin']) !!}
				<h2 class="form-signin-heading">Connectez-vous</h2>
				{!! Form::label('inputPseudo', 'Pseudo', ['class' => 'sr-only']) !!}
				{!! Form::text('inputPseudo', null, ['class' => 'form-control', 'placeholder' => 'Pseudo', 'required', 'autofocus']) !!}
				{!! Form::label('inputPassword', 'Mot de passe', ['class' => 'sr-only']) !!}
				{!! Form::password('inputPassword', ['class' => 'form-control', 'placeholder' => 'Mot de passe', 'required' => true]) !!}
					<div class="checkbox">
					{!! Form::checkbox('rememberMe', 'rememberMe', false) !!} Se souvenir de moi
					</div>
				{!! Form::submit('Connexion', ['class' => 'btn btn-lg btn-primary btn-block']) !!}
			{!! Form::close() !!}
		</div>
     </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ URL::asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
  </body>
</html>