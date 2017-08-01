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
			<b>Proyectos</b>
			<a href="{{ route('projects.create') }}" class="btn waves-effect waves-light green pull-right"><i class="material-icons">add</i></a>
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
							<th>Responsable</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody id="table-users-body">
						@foreach( $projects as $project )
						<tr>
							<td>{{ $project->id }}</td>
							<td>{{ $project->title_es }}</td>
							{{-- <td>{{ $project->research_area->title_es }}</td>					 --}}					
							<td>{{ $project->responsable->name }}</td>						
							<td>
								<a href="#!" class="user-view" data-id="{{ $project->id }}"><i class="material-icons brown-text">receipt</i></a>
								<a href="#!" class="user-edit" data-id="{{ $project->id }}"><i class="material-icons teal-text">edit</i></a>
								<a href="#!" class="user-delete" data-id="{{ $project->id }}"><i class="material-icons red-text">delete</i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="fixed-action-btn">
		<a href="{{ route('projects.create') }}" class="btn-floating btn-large waves-effect waves-light blue pull-right"><i class="material-icons">add</i></a>
		</div>

@endsection