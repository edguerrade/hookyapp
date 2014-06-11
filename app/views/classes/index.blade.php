@extends('layouts.sidebar')
@section('headtitle')
	CRUD Clases
@stop
@section('requirejs')
classes.index
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Clase" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<h1>Clases <small>LISTAR</small></h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info">{{ Session::get('message') }}</div>
	@endif

	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<td>Código</td>
				<td>Descripción</td>
				<td>Childrens</td>
				<td>Professores</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
		@foreach($classes as $key => $value)
			<tr>
				<td>
					<strong>
						{{-- $value->id . ' : ' --}}
						<a href="{{ URL::to('classes'.$value->url.'/list') }}">
						{{ $value->code }}
						</a>
					</strong>
				</td>
				<td>
					{{ $value->description }}
				</td>
				<td>
					@if($value->childrens->count() != 0)
					<div class="tree">
						<ul class="list-unstyled">
							<li>
								<span class="glyphicon 
								@if($value->childrens->count() == 0)
									glyphicon glyphicon-book
								@else
									glyphicon-plus-sign
								@endif
								">
									{{ $value->code }}
								</span>
								
								<ul>
								@foreach ($value->childrens as $childrens)
							    	@include('layouts.childrenclasse', array('item' => $childrens))
							    @endforeach
							    </ul>
						    </li>
						</ul>
					</div>
					@endif
				</td>
				<td>
					@foreach ($value->teachers as $teacher)
						{{ $teacher->first_name . ' ' . $teacher->last_name . '<br>' }}
					@endforeach
				</td>

				<!-- we will also add show, edit, and delete buttons -->
				<td>

					<!-- delete the classe (uses the destroy method DESTROY /classes/{id} -->
					<!-- we will add this later since its a little more complicated than the other two buttons -->
					{{ Form::open(array('url' => 'classes/' . $value->id, 'class' => 'pull-right')) }}
						{{ Form::hidden('_method', 'DELETE') }}
						<!-- {{ Form::submit('Delete this Classe', array('class' => 'btn btn-warning')) }} -->
						{{ Form::button('<span class="glyphicon glyphicon-trash"></span>', array('class' => 'btn btn-xs btn-warning', 'type' => 'submit', 'title' => 'Eliminar Clase')) }}
					{{ Form::close() }}

					<!-- show the classe (uses the show method found at GET /classes/{id} -->
					<a title="Mostrar Clase" data-toggle="tooltip" class="btn btn-xs btn-success" href="{{ URL::to('classes/' . $value->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>

					<!-- edit this classe (uses the edit method found at GET /classes/{id}/edit -->
					<a title="Editar Clase" class="btn btn-xs btn-info" href="{{ URL::to('classes/' . $value->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>

				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@stop