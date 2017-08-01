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
			<h5><b>Agregar nuevo proyecto</b></h5>
		</div>
	</div>
	<div class="row">
		
		{!! Form::open(['route' => 'projects.store', 'method' => 'POST', 'class' => 'col s12 white z-depth-1', 'style' => 'padding: 30px', 'files' => true]) !!}
			<div class="row">
				<div class="input-field col s12 m4">
					{!! Form::label('title_es', 'Nombre (es)') !!}
					{!! Form::text('title_es', null, ['class'=>'validate', 'required']) !!}					
				</div>
				<div class="input-field col s12 m4">
					{!! Form::label('title', 'Nombre (en)') !!}
					{!! Form::text('title', null, ['class'=>'validate', 'required']) !!}					
				</div>
				<div class="col s12 m4">
					<div class="input-fields">
						<p>Display</p>
						{!! Form::radio('display', 1, false, ['id' => 'display1', 'class' => 'with-gap']) !!}
						{!! Form::label('display1', 'Si') !!}
						{!! Form::radio('display', 0, false, ['id' => 'display2', 'class' => 'with-gap']) !!}
						{!! Form::label('display2', 'No') !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m6">
					{!! Form::label('abstract_es','Abstracto (es)') !!}
	                {!! Form::textarea('abstract_es', null, ['class'=>'materialize-textarea','required']) !!}		
				</div>
				<div class="input-field col s12 m6">
					{!! Form::label('abstract','Abstracto (en)') !!}
	                {!! Form::textarea('abstract', null, ['class'=>'materialize-textarea','required']) !!}		
				</div>
			</div>
			<div class="row">
				<div class="input-field file-field">
					<div class="btn">
						<span>
							Imagen        
						</span>
						{!! Form::file('image') !!}
					</div>
					<div class="file-path-wrapper">
						{!! Form::text('image',null,['class'=>'file-path validate','placeholder'=>'Selecciona una imagen']) !!}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="input-field col s12 m4">
					
					{!! Form::select('research_area_id', $researchareas, null, ['class' => 'select-dropdown', 'required', 'id' => 'research_area_id', 'placeholder' => 'Seleccione una area']) !!}
				</div>
				<div class="input-field col s12 m4">
					
					{!! Form::select('responsible', $users, null, ['class' => 'select-dropdown', 'required', 'id' => 'responsible', 'placeholder' => 'Seleccione un responsable']) !!}
				</div>
			</div>
			<div class="input-field">
		      {!! Form::submit('Guardar',['class'=>'btn btn-block btn-block-large waves-effect waves-light']) !!}
		    </div>
		{!! Form::close() !!}

	</div>


@endsection