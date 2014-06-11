@extends('layouts.sidebar')
@section('headtitle')
	CRUD Usuarios
@stop
@section('requirejs')
users.index
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<h1>Usuarios <small>LISTAR</small>
  		</h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Foto</td>
				<td>Nombre</td>
				<td>Apellidos</td>
				<td>Email</td>
				<td>Nació</td>
				<td>Descripción</td>
				<!--<td>Grupos</td>
				<td>Permisos</td>-->
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($users as $key => $value)
			<tr>
				<td>{{ $value->id }}</td>
				<td>
				@if ( $value->avatar )
				<!--<img width="50" height="50" id="avatar" src="{{ asset($value->avatar) }}" alt="{{ $value->first_name . ' ' . $value->last_name }}" class="img-circle">-->
				<img width="50" height="50" id="avatar" class="lazy img-circle" data-original="{{ asset($value->avatar) }}" alt="{{ $value->first_name . ' ' . $value->last_name }}">
				@else
				<img width="50" height="50" id="avatar" src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $value->first_name . ' ' . $value->last_name }}" class="img-circle">
				@endif
				</td>
				<td>{{ $value->first_name }}</td>
				<td>{{ $value->last_name }}</td>
				<td>{{ $value->email }}</td>
				<td>{{ date("d/m/Y",strtotime($value->dob)) }}</td>
				<td>{{ $value->description }}</td>
				{{--<td>
				@foreach($value->getGroups() as $key => $group)
					{{ $group->name }}<br>
				@endforeach
				</td>
				<td>
				@foreach($value->getMergedPermissions() as $key => $permission)
					{{ $key . ':' . $permission}}<br>
				@endforeach
				</td>--}}

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the user (uses the destroy method DESTROY /users/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => 'users/' . $value->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						<!-- {{ Form::submit('Delete this User', array('class' => 'btn btn-warning')) }} -->
						{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class' => 'btn btn-xs btn-warning', 'type' => 'submit', 'title' => 'Eliminar Usuario')) }}
					{{ Form::close() }}

					<!-- show the user (uses the show method found at GET /users/{id} -->
					<a title="Mostrar Usuario" class="btn btn-xs btn-success" href="{{ URL::to('users/' . $value->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>

					<!-- edit this user (uses the edit method found at GET /users/{id}/edit -->
					<a title="Editar Usuario" class="btn btn-xs btn-info" href="{{ URL::to('users/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	
	{{ Form::open(array('url' => 'users/import-csv', 'files'=> true))  }}
		
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
				    {{ Form::label('csvmails', 'Importar usuarios') }}
				    {{ Form::file('csvmails', ['class' => 'filestyle']) }}
				    <p class="help-block">*.csv</p>
				</div>	
			</div>
		</div>

		{{ Form::submit('Importar!', array('class' => 'btn btn-sm btn-primary')) }}

	{{ Form::close() }}
@stop