@extends('layouts.sidebar')
@section('headtitle')
	CRUD Clases
@stop
@section('content')

	<div class="page-header">
		<h1>Clase <small>CREAR</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'classes')) }}

		<div class="form-group">
			{{ Form::label('code', 'Código') }}
			{{ Form::text('code', Input::old('code'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('parent_id', 'ID Parent') }}
			{{ Form::select('parent_id', array('0' => 'Selecciona un Parent', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), Input::old('parent_id'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('tutoria_id', 'ID Tutoría') }}
			{{ Form::select('tutoria_id', array('0' => 'Selecciona una Tutoria', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), Input::old('tutoria_id'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Descripción') }}
			{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('start_at', 'Fecha Inicio') }}
			{{ Form::text('start_at', Input::old('start_at'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('end_at', 'Fecha Fin:') }}
			{{ Form::text('end_at', Input::old('end_at'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Crear la Clase!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop