@extends('layouts.sidebar')
@section('headtitle')
	CRUD Tutorías
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Tutoría" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Mostrar Tutoría" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/' . $tutorial->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a title="Listar Tutorías" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials') }}"><span class="glyphicon glyphicon-list"></span></a>
  		<h1>{{ $tutorial->code }} <small>EDITAR</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	{{ Form::model($tutorial, array('route' => array('tutorials.update', $tutorial->id), 'method' => 'PUT')) }}

		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					{{ Form::label('code', 'Código') }}
					{{ Form::text('code', null, array('class' => 'form-control')) }}
				</div>

				<div class="col-sm-6">
					{{ Form::label('tutor_id', 'ID Tutor') }}
					{{ Form::select('tutor_id', array('0' => 'Select a Tutor', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Descripción') }}
			{{ Form::text('description', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Guardar cambios', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop