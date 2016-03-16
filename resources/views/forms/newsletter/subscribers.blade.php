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
						<td>
							<a href="#" data-toggle="modal" data-target="#delSub{{ $sub->id }}">
							<button type="button" class="btn btn-xs btn-danger">Supprimer</button>
							</a>
						</td>
					</tr>
					<!-- Modal -->
					<div class="modal fade" id="delSub{{ $sub->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								{!! Form::open(['route' => 'subscribers']) !!}
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
								</div>
								<div class="modal-body">
									<div class="alert alert-danger" role="alert">
										<span class="glyphicon glyphicon-oremove-circle"></span> Veuillez confirmer la suppression définitive de l'adresse <b>{{ $sub->email_address }}</b>.
									</div>
								</div>
								<div class="modal-footer">
									{!! Form::hidden('subAddress', $sub->email_address) !!}
									{!! Form::hidden('subId', $sub->id) !!}
									{!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        							{!! Form::submit('Confirmer', ['class' => 'btn btn-primary']) !!}
								</div>
								{!! Form::close() !!}
							</div>
						</div>
					</div>
				@endforeach
			</table>
		</div>
	</div>
@stop