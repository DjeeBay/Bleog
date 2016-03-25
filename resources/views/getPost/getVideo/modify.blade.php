<div class="btn-group" style="margin-bottom: 20px;">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-edit"></span> Modifier <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    <li><a href="#" data-toggle="modal" data-target="#dateEdit"><span class="glyphicon glyphicon-calendar"></span> Modifier la date</a></li>
    <li><a href="#" data-toggle="modal" data-target="#descriptionEdit"><span class="glyphicon glyphicon-align-left"></span> Modifier le titre</a></li>
    <li><a href="#" data-toggle="modal" data-target="#linkEdit"><span class="glyphicon glyphicon-wrench"></span> Modifier la vidéo</a></li>
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
      {!! Form::open(array('route' => ['modifyVideo', $video->id], 'class' => 'form-inline')) !!}
      <div class="modal-body">
        <p><b>La date actuelle est : </b>{{ $video->date }}</p>
        <br />
        	<div class="form-group">
        		{!! Form::label('video_date', 'Modifier :') !!}
        		{!! Form::date('video_date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
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
        <h4 class="modal-title" id="modalDescriptionEdit">Modification du titre</h4>
      </div>
      {!! Form::open(['route' => ['modifyVideo', $video->id], 'class' => 'form-inline']) !!}
      <div class="modal-body">
      	<div class="form-group">
        	{!! Form::label('video_title', 'Titre : ') !!}
        	{!! Form::text('video_title', $video->title, ['class' => 'form-control', 'size' => '60'])  !!}
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
<div class="modal fade" id="linkEdit" tabindex="-1" role="dialog" aria-labelledby="modalLinkEdit">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLinkEdit">Modification du lien de la vidéo</h4>
      </div>
      {!! Form::open(['route' => ['modifyVideo', $video->id]]) !!}
      <div class="modal-body">
        <div class="form-group">
          {!! Form::label('video_link', 'Nouveau lien : ') !!}
          {!! Form::url('video_link', null, ['class' => 'form-control', 'placeholder' => 'Entrer un lien YouTube']) !!}
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
      {!! Form::open(['route' => ['modifyVideo', $video->id]]) !!}
      <div class="modal-footer">
        {!! Form::button('Annuler', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
        {!! Form::submit('Confirmer la suppression', ['name' => 'delThePost', 'class' => 'btn btn-danger']) !!}
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>
<!-- End modals -->