<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lanase |  @yield('title','Inicio') </title>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/materialize.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}">

	<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
	<script src="{{ asset('js/materialize.min.js') }}"></script>
	<script src="{{ asset('js/scripts.js') }}"></script>
</head>
<body>
	
	<header>
		@yield('nav')
	</header>

	<main class="container">
		@include('flash::message')
		@yield('content')
	</main>

	

	  @if($errors)
	    @foreach($errors->all() as $error)
	      Materialize.toast('{{ $error }}', 4000);
	    @endforeach
	  @endif
</body>
</html>