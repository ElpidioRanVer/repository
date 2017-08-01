<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lanase |  @yield('title','Inicio') </title>

	{!! Html::style('http://fonts.googleapis.com/icon?family=Material+Icons') !!}
	{!! Html::style('css/materialize.min.css') !!}
	{!! Html::style('css/font-awesome.css') !!}
	{!! Html::style('css/main.css') !!}	
</head>
<body>
	
	<header>
		@yield('nav')
	</header>

	<main class="container">
		@include('flash::message')
		@yield('content')
	</main>

	{!! Html::script('js/jquery-3.1.1.min.js') !!}
	{!! Html::script('js/materialize.min.js') !!}
	{!! Html::script('js/scripts.js') !!}
	<script type="text/javascript">
		
	  @if($errors)
	    @foreach($errors->all() as $error)
	      Materialize.toast('{{ $error }}', 4000, 'red white-text');
	    @endforeach
	  @endif

	</script>
	<script type="text/javascript">
		@yield('scripts')		
	</script>
</body>
</html>