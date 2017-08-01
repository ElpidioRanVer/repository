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
		<div class="col s12 border-bottom">
			<h5><b>Agregar nuevo usuario</b></h5>
		</div>
	</div>
	<div class="row">
		
		{!! Form::open(['route' => 'users.store', 'method' => 'POST', 'class' => 'col s12 white z-depth-1', 'style' => 'padding: 30px']) !!}
			<div class="row">
				<div class="input-field col s12 m6">
					{!! Form::label('name', 'Nombre') !!}
					{!! Form::text('name', null, ['class'=>'validate', 'required']) !!}					
				</div>
				<div class="input-field col s12 m6">
					{!! Form::label('email', 'Email') !!}
					{!! Form::email('email', null, ['class'=>'validate', 'required']) !!}					
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m2">
					{!! Form::select('role', ['1' => 'Admin', '2' => 'User'], null, ['class' => 'select-dropdown', 'required', 'id' => 'role', 'placeholder' => 'Seleccione un rol']) !!}
				</div>
				<div class="input-field col s12 m5">
					{!! Form::label('password', 'Password') !!}
					{!! Form::password('password', ['class'=>'validate', 'required']) !!}
				</div>
				<div class="input-field col s12 m5">
					{!! Form::label('password_confirmation', 'Verifique Password') !!}
					{!! Form::password('password_confirmation', ['class'=>'validate', 'required']) !!}
				</div>
			</div>
			<div class="input-field">
		      {!! Form::submit('Guardar',['class'=>'btn btn-block btn-block-large waves-effect waves-light']) !!}
		    </div>
		{!! Form::close() !!}

	</div>


@endsection