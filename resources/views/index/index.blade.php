@extends('layout.main')

@section('title')
	Accueil
@stop

@section('top-content')
	<img class="img-responsive" src="css/eog.jpg" style="margin-top: -19px;margin-bottom: -50px">
@stop

@section('content')
	<h1 style="text-align: center">Blog d'Eogan</h1>
  	<hr>
	<div class="alert alert-danger alert-dismissible" role="alert" style="margin-bottom: 0px" id="emldiv">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<!-- <form class="form-horizontal" method="post" action="" id="sub"> -->
		{!! Form::open(['route' => 'index', 'id' => 'sub', 'class' => 'form-horizontal']) !!}
			<div class="form-group" style="margin-bottom: 0px;">
				<label class="control-label col-sm-4" for="inputGroupSuccess2">Recevoir un mail à chaque nouveauté</label>
				<div class="col-sm-4">
					<div class="input-group">
						<span class="input-group-addon">@</span>
						<input type="email" class="form-control" id="mail" name="name" aria-describedby="inputGroupSuccess2Status">
					</div>
				</div>
				<button type="submit" class="btn btn-default" id="submit" name="send">Confirmer</button>
			</div>
		{!! Form::close() !!}
	</div>
	@if($moreToDisplay)
		<nav style="text-align:center;">
			<ul class="pagination">
				<li>
					@if($hasPrevious)
						<a href="{{ route('index') }}?page={{ $currentPage + 1 }}" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span> Remonter dans le temps
						</a>
					@endif
					@if($hasNext)
						<a href="{{ route('index') }}?page={{ $currentPage - 1 }}" aria-label="Next">
							Avancer dans le temps <span aria-hidden="true">&raquo;</span>
						</a>
					@endif
				</li>
			</ul>
		</nav>
	@else
		<br>
	@endif
	@include('index.listing')
	@if($moreToDisplay)
		<nav style="text-align:center;">
			<ul class="pagination">
				<li>
					@if($hasPrevious)
						<a href="{{ route('index') }}?page={{ $currentPage + 1 }}" aria-label="Previous">
							<span aria-hidden="true">&laquo;</span> Remonter dans le temps
						</a>
					@endif
					@if($hasNext)
						<a href="{{ route('index') }}?page={{ $currentPage - 1 }}" aria-label="Next">
							Avancer dans le temps <span aria-hidden="true">&raquo;</span>
						</a>
					@endif
				</li>
			</ul>
		</nav>
	@endif
@stop
@section('addScript')
	<script src="{{ URL::asset('js/newsletter.js') }}"></script>
@stop