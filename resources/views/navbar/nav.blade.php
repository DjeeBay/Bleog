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
                    <li><a href=""><span class="glyphicon glyphicon-pencil"></span> Ajout articles</a></li>
                    <li><a href=""><span class="glyphicon glyphicon-envelope"></span> Envoi newsletters</a></li>
                  </ul>
              </li>
			@endif
              <li>
                <a href="">
                <span class="glyphicon glyphicon-tree-conifer"></span> <b><font color="blue">Origine du prénom</font></b></a>
              </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            	<li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-remove" style="vertical-align:text-top"></span> Déconnexion</a></li>
            </ul>
		</div><!--/.nav-collapse -->
	</div><!--/.container -->
</nav>