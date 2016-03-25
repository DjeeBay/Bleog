<div class="btn-group" style="margin-bottom: 20px;">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-edit"></span> Modifier <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#" data-toggle="modal" data-target="#dateEdit"><span class="glyphicon glyphicon-calendar"></span> Modifier la date</a></li>
    <li><a href="#" data-toggle="modal" data-target="#descriptionEdit"><span class="glyphicon glyphicon-align-left"></span> Modifier la description</a></li>
    <li><a href="#" data-toggle="modal" data-target="#photoEdit"><span class="glyphicon glyphicon-picture"></span> Modifier la photo</a></li>
    <li role="separator" class="divider"></li>
    <li><a href="#" data-toggle="modal" data-target="#removeAll"><span class="glyphicon glyphicon-trash"></span> Supprimer la page</a></li>
  </ul>
</div>

<!-- Modals -->
<div class="modal fade" id="dateEdit" tabindex="-1" role="dialog" aria-labelledby="modalDateEdit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDateEdit">Modification de la date</h4>
      </div>
      {!! Form::open(array('route' => ['modifyPhoto', $photo->id], 'class' => 'form-inline')) !!}
      <div class="modal-body">
        <p><b>La date actuelle est : </b>{{ $photo->date }}</p>
        <br />
        	<div class="form-group">
        		{!! Form::label('photo_date', 'Modifier :') !!}
        		{!! Form::date('photo_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
        	</div>
      </div>
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="descriptionEdit" tabindex="-1" role="dialog" aria-labelledby="modalDescriptionEdit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDescriptionEdit">Modification de la description</h4>
      </div>
      {!! Form::open(['route' => ['modifyPhoto', $photo->id]]) !!}
      <div class="modal-body">
      	<div class="form-group">
        	{!! Form::label('description', 'Description :') !!}
        	{!! Form::textarea('description', $photo->title, ['class' => 'form-control', 'rows' => '4'])  !!}
      	</div>
      </div>
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
		@if (!empty($photo->title))
			{!! Form::button('Supprimer la description', ['class' => 'btn btn-danger', 'data-toggle' => 'modal', 'data-target' => '#supprDesc']) !!}
		@endif
        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="photoEdit" tabindex="-1" role="dialog" aria-labelledby="modalPhotoEdit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalPhotoEdit">Modification de la photo</h4>
      </div>
      {!! Form::open(['route' => ['modifyPhoto', $photo->id], 'files' => 'true']) !!}
      <div class="modal-body">
        <p>Photo actuelle :</p>
        <div>
        	<img class="img-responsive" alt="{{ $photo->picsname }}" src="{{ URL::asset('pics/mini') }}/{{ $photo->picsname }}">
        </div>
        <br /><br />
        	<div class="form-group">
        		{!! Form::label('photo_file', 'Choisir la photo :') !!}
        		{!! Form::file('photo_file') !!}
        	</div>
      </div>
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        {!! Form::submit('Sauvegarder', ['class' => 'btn btn-primary']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="removeAll" tabindex="-1" role="dialog" aria-labelledby="modalRemoveAll">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalRemoveAll">Supprimer la page</h4>
      </div>
      <div class="modal-body">
        <div class="alert alert-danger" role="alert"><b>Attention !</b> Êtes-vous sûr de vouloir supprimer définitivement cette page ?</div>
      </div>
      {!! Form::open(['route' => ['modifyPhoto', $photo->id]]) !!}
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        {!! Form::submit('Confirmer la suppression', ['name' => 'delThePost', 'class' => 'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<div class="modal fade" id="supprDesc" tabindex="-1" role="dialog" aria-labelledby="modalSupprDesc">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalSupprDesc">Suppression de la description</h4>
      </div>
      {!! Form::open(['route' => ['modifyPhoto', $photo->id]]) !!}
      <div class="modal-body">
        <div class="alert alert-danger" role="alert"><b>Attention !</b> Êtes-vous sûr de vouloir supprimer définitivement cette description ?</div>
      </div>
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        {!! Form::submit('Supprimer la description', ['name' => 'delDescr', 'class' => 'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- End modals -->