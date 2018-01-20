@extends('layout.main')

@section('title')
	Ajouter une photo
@stop

@section('content')
	<h1 style="text-align: center;">Ajouter une photo</h1>
	<hr>
	{!! Form::open(['route' => 'addPhoto', 'files' => 'true']) !!}
		<div class="form-group">
			{!! Form::label('photo_date', 'Date de la photo (jj/mm/aaaa)') !!}
			{!! $errors->first('photo_date', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::date('photo_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('photo_description', 'Description') !!}
			{!! $errors->first('photo_description', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::textarea('photo_description', null, ['class' => 'form-control', 'rows' => '4', 'placeholder' => 'Tapez une description']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('photo_file', 'Choisir la photo (jpg, png, max. 5Mo)') !!}
			{!! $errors->first('photo_file', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::file('photo_file') !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop