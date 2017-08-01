@extends('main')
@section('title','Dashboard')
@section('nav')
@include('admin.nav')
@endsection
@section('content')

<div class="row mt-30">
	<div class="col s12 border-bottom">
		<h5><b>Bienvenido </b></h5>
	</div>
</div>
<div class="row">
	<div class="col s6 z-depth-2 nopadding">
		<div class="panel-heading teal">
			<h6><a href="users.php" class="white-text">Usuarios</a></h6>
		</div>
		<div class="panel-body">
			<ul class="collection noborder">
				<li class="collection-item">Total <span class="badge teal br-15 white-text"></span></li>
				<li class="collection-item">Activo <span class="badge blue br-15 white-text"></span></li>
				<li class="collection-item">Inactivo <span class="badge orange br-15 white-text"></span></li>
			</ul>
		</div>

	</div>
</div>

@endsection
@section('scripts')
  @if($errors)
    @foreach($errors->all() as $error)
      Materialize.toast('{{ $error }}', 4000);
    @endforeach
  @endif
@endsection