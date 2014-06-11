@extends('layouts.sidebar')
@section('headtitle')
	CRUD Tutorías
@stop
@section('content')

	<div class="page-header">
  		<a title="Agregar Tutoría" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<a title="Crear Plantilla Excel" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/excel') }}"><span class="glyphicon glyphicon-list-alt"></span></a>
  		<a href="{{ URL::to('tutorials/create') }}" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">Modal Create AJAX</a>
  		<h1>Tutorías <small>LISTAR</small></h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info alert-dismissable">
			<strong>{{ Session::get('message') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
	@endif

	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<td>ID</td>
				<td>Código</td>
				<td>Descripción</td>
				<td>Tutor</td>
				<td>Classes</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($tutorials as $key => $value)
			<tr>
				<td>{{ $value->id }}</td>
				<td>{{ $value->code }}</td>
				<td>{{ $value->description }}</td>
				<td>{{-- $value->tutor_id . ' : '--}} {{ $value->tutor->first_name . ' ' . $value->tutor->last_name }}</td>
				<td>
					<!--<ul class="list-unstyled">
					@foreach ($value->classes as $classe)
						<li>{{ $classe->code }}</li>
					@endforeach
					</ul>-->
					@foreach ($value->classes as $classe)
						{{ $classe->code }},
					@endforeach
				</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the tutorial (uses the destroy method DESTROY /tutorials/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => 'tutorials/' . $value->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						<!-- {{ Form::submit('Delete this Tutorial', array('class' => 'btn btn-warning')) }} -->
						{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class' => 'btn btn-xs btn-warning', 'type' => 'submit', 'title' => 'Eliminar Tutoría')) }}
					{{ Form::close() }}

					<!-- show the tutorial (uses the show method found at GET /tutorials/{id} -->
					<a title="Mostrar Tutoría" class="btn btn-xs btn-success" href="{{ URL::to('tutorials/' . $value->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>

					<!-- edit this tutorial (uses the edit method found at GET /tutorials/{id}/edit -->
					<a title="Editar Tutoría" class="btn btn-xs btn-info" href="{{ URL::to('tutorials/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
					<a title="Editar Tutoría" class="btn btn-primary btn-xs" href="{{ URL::to('tutorials/' . $value->id . '/edit') }}" data-toggle="modal" data-target="#myModal">
	  Modal Edit
	</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop