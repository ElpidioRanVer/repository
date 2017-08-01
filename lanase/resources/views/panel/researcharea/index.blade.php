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
		<div class="col s12 m6 border-bottom">
			<h5>
			<b>Areas de investigación</b>
			<a href="{{ route('researcharea.create') }}" class="btn waves-effect waves-light green pull-right"><i class="material-icons">add</i></a>					
			</h5>
		</div>
	</div>
				
	<div class="row">
		<div class="col s12 m6 z-depth-1 white">				
			<table class="bordered responsive-table">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre (es)</th>
						<th>Opciones</th>
					</tr>
				</thead>
				<tbody id="table-users-body">
					@foreach( $areas as $area )
					<tr>
						<td>{{ $area->id }}</td>
						<td>{{ $area->title_es }}</td>												
						<td>
							<a href="#!" class="user-view" data-id="{{ $area->id }}"><i class="material-icons brown-text">receipt</i></a>
							<a href="#!" class="user-edit" data-id="{{ $area->id }}"><i class="material-icons teal-text">edit</i></a>
							<a href="#!" class="user-delete" data-id="{{ $area->id }}"><i class="material-icons red-text">delete</i></a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>	
		<div class="col s12 m6">
			<div class="card">
				Detalles
			</div>			
		</div>
	</div>

@endsection