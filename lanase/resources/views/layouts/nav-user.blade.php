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

<nav class="cyan">
	<div class="nav-wrapper container">
		<a href="{{ url('/panel/dashboard') }}" class="brand-logo">Inicio</a>
		<a href="#" data-activates="mobile-nav" class="button-collapse"><i class="material-icons">menu</i></a>
		<ul id="nav-mobile" class="right hide-on-med-and-down">
			<li><a href="{{ url('/panel/dashboard') }}">Dashboard</a></li>
			<li><a href="{{ route('researcharea.index') }}">Investigación</a></li>
			<!-- Dropdown Trigger -->
			<li><a class="dropdown-button" href="#!" data-activates="perfil">{{ Auth::user()->name }}<i class="material-icons right">arrow_drop_down</i></a></li>

		</ul>
		<ul class="side-nav" id="mobile-nav">
			<li><a href="!#">Module 1</a></li>
			<li><a href="!#">Module 2</a></li>
			<li><a href="!#">Module 3</a></li>
		</ul>
	</div>
</nav>