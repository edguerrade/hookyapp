@extends('layouts.sidebar')
@section('headtitle')
	CRUD Grupos
@stop
@section('content')

	<div class="page-header">
		<h1>Crear un Grupos <small>CRUD</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	{{ Form::open(array('url' => 'groups')) }}

		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
		</div>

		<h3>Permisos</h3>
		
		<div class="row">
			@foreach (Sentry::findGroupById(6)->getPermissions() as $permission => $value)
				<div class="col-sm-2">
					<div class="form-group">
						{{ Form::label('permissions[' . $permission . ']', $permission) }}
						{{ Form::select('permissions[' . $permission . ']', array('0' => 'Deny', '1' => 'Allow'), Input::old('permissions[' . $permission . ']'), array('class' => 'form-control')) }}
					</div>
				</div>
			@endforeach
		</div>

		{{ Form::submit('Crear Grupo!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop