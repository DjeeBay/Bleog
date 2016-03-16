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
			{!! $errors->first('newsletter_title', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::text('newsletter_title', null, ['class' => 'form-control', 'placeholder' => 'Veuillez entrer un titre']) !!}
		</div>
		<div class="form-group">
			{!! Form::label('newsletter_body', 'Message :') !!}
			{!! $errors->first('newsletter_body', '<small><font color="red"><b>:message</b></font></small>') !!}
			{!! Form::textarea('newsletter_body', null) !!}
		</div>
		{!! Form::submit('Envoyer', ['class' => 'btn btn-primary']) !!}
	{!! Form::close() !!}
<br>
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<table class="table table-hover table-striped">
			<tr class="warning">
				<td><b>Adresses des inscrits</b></td>
				<td>
					<a href="{{ route('subscribers') }}">
					<button type="submit" class="btn btn-xs btn-danger" name="mailsList">Gérer les inscrits</button>
					</a>
				</td>
			</tr>
			@foreach($subscribers as $subscriber)
				<tr class="active"><td colspan="2">{{ $subscriber->email_address }}</td></tr>
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