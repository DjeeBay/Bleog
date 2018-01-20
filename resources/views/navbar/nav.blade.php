<?php
$navCtrl = new \App\Http\Controllers\NavController();
$years = $navCtrl::getYears();
?>
<nav class="navbar navbar-default navbar-static-top">
	<div class="container">
		<div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('index') }}">Bleog</a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li><a href="{{ route('index') }}"><span class="glyphicon glyphicon-home"></span> Accueil</a></li>
			@if(Auth::user()->admin == 1)
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                 <span class="glyphicon glyphicon-menu-hamburger"></span> Ajouts Admin <span class="caret"></span>
                </a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ route('addPhoto') }}"><span class="glyphicon glyphicon-camera"></span> Ajout photos</a></li>
                    <li><a href="{{ route('addVideo') }}"><span class="glyphicon glyphicon-film"></span> Ajout vidéos</a></li>
                    <li><a href="{{ route('addArticle') }}"><span class="glyphicon glyphicon-pencil"></span> Ajout articles</a></li>
                    <li><a href="{{ route('newsletter') }}"><span class="glyphicon glyphicon-envelope"></span> Envoi newsletters</a></li>
                    <li><a href="{{ route('memories') }}"><span class="glyphicon glyphicon-cloud"></span> Carnet mémoires</a></li>
                  </ul>
              </li>
			@endif
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <span class="glyphicon glyphicon-calendar"></span> Années <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <?php
                    foreach ($years as $year)
                    {?>
                        <li><a href="{{URL::to('/an/'.$year->year)}}">{{$year->year}}</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </li>
              <li>
                <a href="{{ url('article/25') }}">
                <span class="glyphicon glyphicon-tree-conifer"></span> <span class="nav-blue-link"> <b>Origine du prénom</b></span></a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(Auth::user()->admin == 1)
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-cog"></span> Gestion <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('uploadPhotos') }}"><span class="glyphicon glyphicon-upload"></span> Upload de photos</a></li>
                            <li><a href="{{ url('add/article/gallery') }}" onclick="open('/add/article/gallery', 'Popup', 'scrollbars=1,resizable=1,height=800,width=1280'); return false;"><span class="glyphicon glyphicon-picture"></span> Galerie photos</a></li>
                        </ul>
                    </li>
                @endif
            	<li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-remove" style="vertical-align:text-top"></span> Déconnexion</a></li>
            </ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container -->
</nav>