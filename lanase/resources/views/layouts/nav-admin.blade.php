<!-- Perfil -->
<ul id="perfil" class="dropdown-content">
	<li><a href="#!">Perfil</a></li>
	<li class="divider"></li>
	<li>{!! Html::link('logout', 'Salir', ['onclick' => 'event.preventDefault();document.getElementById("logout-form").submit();']) !!}</li>
	
	{{-- <li><a href="{{ url('/logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a></li> --}}

	{!! Form::open(['url' => '/logout', 'method' => 'POST', 'id' => 'logout-form', 'style' => 'display: none']) !!}
	{!! Form::close() !!}
	{{-- <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form> --}}
</ul>
<!-- Usuarios -->
<ul id="users-options" class="dropdown-content">
	<li><a href="{{ route('users.index') }}">Ver/Editar</a></li>
	<li><a href="{{ route('users.create') }}">Agregar</a></li>
	<li class="divider"></li>
	<li><a href="">Roles</a></li>
</ul>
<!-- Investigación -->
<ul id="investigation" class="dropdown-content">
	<li><a href="{{ route('researcharea.index') }}">Areas de investigacion</a></li>
	<li><a href="{{ route('projects.index') }}">Proyectos</a></li>
</ul>
<!-- Proyectos -->
<ul id="projects-options" class="dropdown-content">
	<li><a href="{{ route('projects.index') }}">Proyectos</a></li>
	<li><a href="{{ route('projects.create') }}">Agregar Proyecto</a></li>
</ul>
<nav class="white">
	<div class="nav-wrapper container">
		<a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="{{ url('/panel/dashboard') }}">Dashboard</a></li>
			<li><a class="dropdown-button" href="#!" data-activates="users-options">Usuarios<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a class="dropdown-button" href="#!" data-activates="investigation">Investigación<i class="material-icons right">arrow_drop_down</i></a></li>
			<li><a class="dropdown-button" href="#!" data-activates="perfil">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>
		</ul>
		<ul class="side-nav" id="mobile-nav">
			<li><a href="{{ url('/panel/dashboard') }}">Dashboard</a></li>
			<li class="no-padding">
				<ul class="collapsible collapsible-accordion">
					<li>
					<a class="collapsible-header">Investigación<i class="material-icons">arrow_drop_down</i></a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#!">First</a></li>
								<li><a href="#!">Second</a></li>
								<li><a href="#!">Third</a></li>
								<li><a href="#!">Fourth</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>

<ul class="side-nav fixed">
	<div id="panel-logo">
		<a href="{{ url('/') }}" class="no-padding"><img src="{{ asset('images/logo-texto.png') }}" class="responsive-img"></a>
	</div>
	<p>GENERAL</p>
	<li class="active1"><a href="#!"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Dashboard</a></li>
	<li><a href="#!">Second Sidebar Link</a></li>
	<li class="no-padding">
		<ul class="collapsible collapsible-accordion">
			<li>
			<a class="collapsible-header">Dropdown<i class="material-icons right white-text">arrow_drop_down</i></a>
				<div class="collapsible-body">
					<ul>
						<li><a href="#!">First</a></li>
						<li><a href="#!">Second</a></li>
						<li><a href="#!">Third</a></li>
						<li><a href="#!">Fourth</a></li>
					</ul>
				</div>
			</li>
		</ul>
	</li>
</ul>