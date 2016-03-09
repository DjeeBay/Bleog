@extends('layout.main')

@section('title')
	Ajouter un article
@stop

@section('content')
	<h1 style="text-align: center;">Ajouter un article</h1>
	<hr>
	{!! Form::open(['route' => 'addArticle']) !!}
		<div class="form-group">
			{!! Form::label('article_date', 'Date de l\'article (jj/mm/aaaa)') !!}
			{!! $errors->first('article_date', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::date('article_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('article_title', 'Titre de l\'article :') !!}
			{!! $errors->first('article_title', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::text('article_title', null, ['class' => 'form-control', 'placeholder' => 'Veuillez entrer un titre']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('article_body', 'Article :') !!}
			{!! $errors->first('article_body', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::textarea('article_body', null, ['class' => 'form-controle']) !!}
			{!! csrf_field() !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
@stop