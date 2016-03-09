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

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <title>Bleog - @yield('title')</title>
  </head>
  <body>
  	@include('navbar.nav')
	<div class="container">
		@yield('top-content')
		<div class="jumbotron">
			@if(session()->has('fail'))
				<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="glyphicon glyphicon-oremove-circle"></span> {!! session('fail') !!}
				</div>
			@endif
			@yield('errors') <!-- Allow each view to display the $error message -->
			@if(session()->has('success'))
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<span class="glyphicon glyphicon-ok-circle"></span> {!! session('success') !!}
				</div>
			@endif
			@yield('content')
		</div>
     </div>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="{{ URL::asset('js/ie10-viewport-bug-workaround.js') }}"></script>
    <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/newsletter.js') }}"></script>
  </body>
</html>