@extends('layouts.sidebar')
@section('headtitle')
	CRUD Clases
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Clase" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Mostrar Clase" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes/' . $classe->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a title="Listar Clases" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes') }}"><span class="glyphicon glyphicon-list"></span></a>
		<h1>{{ $classe->code }} <small>EDITAR</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($classe, array('route' => array('classes.update', $classe->id), 'method' => 'PUT')) }}

		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					{{ Form::label('code', 'Código') }}
					{{ Form::text('code', null, array('class' => 'form-control')) }}
				</div>

				<div class="col-sm-6">
				{{ Form::label('parent_id', 'ID Parent') }}
				{{ Form::select('parent_id', array('0' => 'Select a Parent', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Descripción') }}
			{{ Form::text('description', null, array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Editar la Clase!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop