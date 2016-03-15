@extends('layout.main')

@section('addInHead')
	<script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
@stop

@section('title')
	Envoi de newsletter
@stop

@section('content')
	<h1 style="text-align: center">Envoyer une newsletter</h1>
	<hr>
	{!! Form::open(['route' => 'postNewsletter']) !!}
		<div class="form-group">
			{!! Form::label('newsletter_title', 'Titre de la newsletter (objet du mail) :') !!}
			{!! Form::text('newsletter_title', null, ['class' => 'form-control', 'placeholder' => 'Veuillez entrer un titre']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('newsletter_body', 'Message :') !!}
			{!! Form::textarea('newsletter_body', null) !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
<br>
<form action="view/newsletter/mailsList.php" method="post" target="_blank">
	<button type="submit" class="btn btn-success" name="mailsList">Gérer les inscrits</button>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<table class="table table-hover">
			<tr class="warning"><td><b>Adresse email</b></td></tr>
			@foreach($subscribers as $subscriber)
				<tr class="active"><td>{{ $subscriber->email_address }}</td></tr>
			@endforeach
			</table>
		</div>
	</div>
@stop

@section('addScript')
	<!-- Adding CKEditor -->
	<script>
		CKEDITOR.replace('newsletter_body', {
			filebrowserBrowseUrl: '{{ route('getGallery') }}'
		});
	</script>
@stop