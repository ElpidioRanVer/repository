@extends('panel.main')
@section('title','Dashboard')

@section('nav')
	@include('layouts.nav-admin')
@endsection

@section('content')

	<div class="row mt-30">
		<div class="col s12 border-bottom">
			<h5><b>Usuarios</b></h5>
		</div>
	</div>
	<div class="row">
			<div class="col s12">
				<div class="col m2 s4 plr-1">
					<button class="btn-block teal waves-effect waves-light btn" id="btn-admin-users-all">Todos</button>
				</div>
				<div class="col m2 s4 plr-1">
					<button class="btn-block phantom waves-effect waves-light btn" id="btn-admin-users-admin">Admin</button>
				</div>
				<div class="col m2 s4 plr-1">
					<button class="btn-block phantom waves-effect waves-light btn" id="btn-admin-users-users">User</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 z-depth-1 white">
				<table class="bordered responsive-table">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Email</th>
							<th>Status</th>
							<th>Role</th>
							<th>Opciones</th>
						</tr>
					</thead>
					<tbody id="table-users-body">
						@foreach( $users as $user )
						<tr>
							<td>{{ $user->name }}</td>
							<td>{{ $user->email }}</td>
							<td>
								@if( $user->status == 1)
								<span class='badge1 green white-text'>Activo</span>
								@else
								<span class='badge1 grey white-text'>Inactivo</span>
								@endif
							</td>
							<td>
								@if( $user->role == 1 )
								<span class='badge1 teal white-text'>Admin</span>
								@else
								<span class='badge1 blue white-text'>User</span>
								@endif
							</td>
							<td>
								<a href="#!" class="user-view" data-id="{{ $user->id }}"><i class="material-icons brown-text">receipt</i></a>
								<a href="#!" class="user-edit" data-id="{{ $user->id }}"><i class="material-icons teal-text">edit</i></a>
								<a href="#!" class="user-delete" data-id="{{ $user->id }}"><i class="material-icons red-text">delete</i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

		<div class="fixed-action-btn">
		<a href="{{ route('users.create') }}" class="btn-floating btn-large waves-effect waves-light blue pull-right"><i class="material-icons">add</i></a>
		</div>

		{!! Form::open(['route' => 'users.getUsers', 'method' => 'POST', 'id' => 'form' ]) !!}
		{!! Form::hidden('type', 'all', ['id' => 'type']) !!}
		{!! Form::close() !!}

@endsection
@section('scripts')
	$("button[id^='btn-admin-users-']").click(function(){

		var btn;
		if($(this).attr('id') == "btn-admin-users-all"){
			btn = "all";
		}else if($(this).attr('id') == "btn-admin-users-admin"){
			btn = "admin";
		}else{
			btn = "user";
		}

		$('#type').val(btn);
		var form = $('#form').serialize();

		$.ajax({

			url: 'users/getUsers',
			type: 'POST',
			data: form,
			success:function(response){
				$("#table-users-body").html(response);
				{{-- alert(response); --}}
			},
			error:function(response){
				alert(response);
			}

		});
	});
@endsection