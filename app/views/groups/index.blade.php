@extends('layouts.sidebar')
@section('headtitle')
	CRUD Grupos
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Grupo" class="btn btn-xs btn-default pull-right" href="{{ URL::to('groups/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<h1>Grupos <small>CRUD</small>
  		</h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>ID</td>
				<td>Grupos</td>
				<td>Permisos</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($groups as $key => $group)
			<tr>
				<td>{{ $group->id }}</td>
				<td>{{ $group->name }}</td>
				<td>
				@foreach($group->getPermissions() as $key => $permission)
					{{ $key }}<br>
				@endforeach
				</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the user (uses the destroy method DESTROY /groups/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => 'groups/' . $group->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						<!-- {{ Form::submit('Delete this User', array('class' => 'btn btn-warning')) }} -->
						{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class' => 'btn btn-xs btn-warning', 'type' => 'submit', 'title' => 'Eliminar Usuario')) }}
					{{ Form::close() }}

					<!-- show the user (uses the show method found at GET /groups/{id} -->
					<a title="Mostrar Usuario" class="btn btn-xs btn-success" href="{{ URL::to('groups/' . $group->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>

					<!-- edit this user (uses the edit method found at GET /groups/{id}/edit -->
					<a title="Editar Usuario" class="btn btn-xs btn-info" href="{{ URL::to('groups/' . $group->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop