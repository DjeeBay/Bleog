<!DOCTYPE html>
<html>
<head>
	<title>Bleog - Désinscription à la newsletter</title>
</head>
<body>
	<div id="confirm">
		<p>En cliquant sur "Confirmer" vous ne recevrez plus la newsletter à l'adresse <b>{{ $unsuscriber->email_address }}</b></p>
		{!! Form::open(['route' => ['unsusNewsletter', $unsuscriber->uniqid], 'id' => 'unsus']) !!}
			{!! Form::submit('Confirmer') !!}
		{!! Form::close() !!}
	</div>
	<script src="{{ URL::asset('js/unsuscribe.js') }}"></script>
</body>
</html>