@extends('layout.main')

@section('title')
	Ajouter une vidéo
@stop

@section('content')
	<h1 style="text-align: center;">Ajouter une vidéo</h1>
	<hr>
	{!! Form::open(['route' => 'addVideo']) !!}
		<div class="form-group">
			{!! Form::label('video_date', 'Date de la vidéo (jj/mm/aaaa)') !!}
			{!! $errors->first('video_date', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::date('video_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('video_title', 'Titre de la vidéo') !!}
			{!! $errors->first('video_title', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::text('video_title', null, ['class' => 'form-control', 'placeholder' => 'Veuillez entrer un titre']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('video_link', 'Lien de la vidéo') !!}
			{!! $errors->first('video_link', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::text('video_link', null, ['class' => 'form-control', 'placeholder' => 'Entrer un lien Youtube']) !!}
			{!! csrf_field() !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop