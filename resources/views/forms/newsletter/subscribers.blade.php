@extends('layout.main')

@section('title')
	Gestion des inscrits
@stop

@section('content')
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<table class="table table-hover table-striped">
				<tr class="warning">
					<td><b>Liste des inscrits</b></td>
					<td><b>Gestion</b></td>
				</tr>
				@foreach($subscribers as $sub)
					<tr class="active">
						<td>{{ $sub->email_address }}</td>
						<td>Suppr</td>
					</tr>
				@endforeach
			</table>
		</div>
	</div>
@stop