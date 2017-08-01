@extends('panel.main')
@section('title','Dashboard')

@section('nav')
@if(Auth::user()->isAdmin())
	@include('layouts.nav-admin')
@else
	@include('layouts.nav-user')
@endif
@endsection

@section('content')

<div class="row mt-30">
	<div class="col s12 m3">
		<div class="card center-align">
			<div class="col s8 offset-s2">
				<img src="{{asset('images/user.jpg')}}" class="circle responsive-img">
			</div>
			<div class="clearfix"></div>
			<div class="divider"></div>
			<p class="mt-15 mb-0 black-text"><b>{{ Auth::user()->name }}</b></p>
			<p><i>{{ Auth::user()->email }}</i></p>
		</div>
	</div>
	@if(Auth::user()->isAdmin())
	<div class="col s12 m2">
		<div class="card">
			<h1 class="teal-text">{{ $users['activos'] }}</h1>
			<span>USUARIOS</span>
			<div class="divider strong teal"></div>
		</div>
	</div>
	<div class="card col s12 m2 pb-15">
		<h4 class="teal-text"><b>{{ $users['activos'] }}</b> 
		{{-- <small>Usuarios activos</small> --}}
		</h4>
		<p>USUARIOS ACTIVOS</p>
		<div class="divider strong teal"></div>
	</div>
	<div class="card col s12 m2 pb-15">
		<h4 class="teal-text"><b>{{ $users['activos'] }}</b> 
		{{-- <small>Usuarios activos</small> --}}
		</h4>
		<p>USUARIOS ACTIVOS</p>
		<div class="divider strong teal"></div>
	</div>
	@endif
</div>
<div class="row">
	@if(Auth::user()->isAdmin())
	
	@else
	<div class="col s6 z-depth-2 nopadding">
		<div class="panel-heading teal">
			<h6><a href="users.php" class="white-text">Generales</a></h6>
		</div>
		<div class="panel-body">
			{{-- <ul class="collection noborder">
				<li class="collection-item">Total <span class="badge teal br-15 white-text">{{ $users['total'] }}</span></li>
				<li class="collection-item">Activo <span class="badge blue br-15 white-text">{{ $users['activos'] }}</span></li>
				<li class="collection-item">Inactivo <span class="badge orange br-15 white-text">{{ $users['inactivos'] }}</span></li>
			</ul> --}}
		</div>

	</div>
	@endif
</div>


@endsection























