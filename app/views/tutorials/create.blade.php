@extends('layouts.sidebar')
@section('headtitle')
	CRUD Tutorías
@stop
@section('content')

	<div class="page-header">
		<a title="Listar Tutorías" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials') }}"><span class="glyphicon glyphicon-list"></span></a>
		<h1>Tutoría <small>CREAR</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	{{ Form::open(array('url' => 'tutorials')) }}

		<div class="form-group">
			{{ Form::label('code', 'Código') }}
			{{ Form::text('code', Input::old('code'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Descripción') }}
			{{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('tutor_id', 'ID Tutor') }}
			{{ Form::select('tutor_id', array('0' => 'Select a Tutor', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), Input::old('tutor_id'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Crear Tutoría!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop