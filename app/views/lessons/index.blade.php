@extends('layouts.sidebar')
@section('headtitle')
	CRUD Lecciones
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Lección" class="btn btn-xs btn-default pull-right" href="{{ URL::to('lessons/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<h1>Lecciones <small>LISTAR</small></h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Tutoria ID</td>
				<td>Clase ID</td>
				<td>Timetable ID</td>
				<td>Inicio</td>
				<td>Fin</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($lessons as $key => $value)
			<tr>
				<td>
					{{-- $value->tutorial_id . ' : ' --}}
					{{ $value->tutorial->code }}
				</td>
				<td>
					{{-- $value->classe_id  . ' : ' --}}
					{{ $value->classe->code }}
				</td>
				<td>
					{{-- $value->timetable_id . ' : ' --}}
					@if ($value->timetable->weekday === 1)
					    Lunes
					@elseif ($value->timetable->weekday === 2)
					    Martes
					@elseif ($value->timetable->weekday === 3)
					    Miércoles
					@elseif ($value->timetable->weekday === 4)
					    Jueves
					@elseif ($value->timetable->weekday === 5)
					    Viernes
					@elseif ($value->timetable->weekday === 6)
					    Sábado
					@else
					    Domingo
					@endif
					@foreach($value->time as $seasson)
						<span class="badge pull-right">{{  $seasson[0] .' - '. $seasson[1] }}</span>
					@endforeach
				</td>
				<td>{{ date("d/m/Y",strtotime($value->start_at)) }}</td>
				<td>{{ date("d/m/Y",strtotime($value->end_at)) }}</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the lesson (uses the destroy method DESTROY /lessons/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => 'lessons/' . $value->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						<!-- {{ Form::submit('Delete this Classe', array('class' => 'btn btn-warning')) }} -->
						{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class' => 'btn btn-xs btn-warning', 'type' => 'submit', 'title' => 'Eliminar Lección')) }}
					{{ Form::close() }}

					<!-- show the lesson (uses the show method found at GET /lessons/{id} -->
					<a title="Mostrar Lección" data-toggle="tooltip" class="btn btn-xs btn-success" href="{{ URL::to('lessons/' . $value->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>

					<!-- edit this lesson (uses the edit method found at GET /lessons/{id}/edit -->
					<a title="Editar Lección" class="btn btn-xs btn-info" href="{{ URL::to('lessons/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop