@extends('layouts.sidebar')
@section('headtitle')
	CRUD Usuarios
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Listar Usuarios" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users') }}"><span class="glyphicon glyphicon-list"></span></a>
  		<h1>Editar {{ $tutorial->code }} <small>CRUD</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::open(array('url' => 'tutorials')) }}

		<div class="form-group">
			{{ Form::label('code', 'Code') }}
			{{ Form::text('code', Input::old('code'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('tutor_id', 'ID Tutor') }}
			{{ Form::select('tutor_id', array('0' => 'Select a Tutor', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), Input::old('tutor_id'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Create the Tutorial!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop