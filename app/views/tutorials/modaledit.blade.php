@extends('layouts.modal')
@section('modaltitle')
	Editar {{ $tutorial->code }} <small>CRUD</small>
@stop
@section('modalcontent')

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
			{{ Form::label('code', 'Código') }}
			{{ Form::text('code', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Descripción') }}
			{{ Form::text('description', null, array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('tutor_id', 'ID Tutor') }}
			{{ Form::select('tutor_id', array('0' => 'Select a Tutor', '1' => '1 Amparo', '2' => '2 Amparo', '3' => '3 Amparo'), null, array('class' => 'form-control')) }}
		</div>
		<p class="help-block">*Required.</p>

@stop
@section('modalbuttons')

		{{ Form::submit('Guardar cambios', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop