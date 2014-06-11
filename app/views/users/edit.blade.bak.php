@extends('layouts.sidebar')
@section('headtitle')
	CRUD Usuarios
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
  		<h1>Editar {{ $user->first_name . ' ' . $user->last_name }} <small>CRUD</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	{{ HTML::ul($errors->all()) }}

	{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}

		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					{{ Form::label('first_name', 'Nombre') }}
					{{ Form::text('first_name', null, array('class' => 'form-control')) }}
				</div>

				<div class="col-sm-6">
					{{ Form::label('last_name', 'Apellidos') }}
					{{ Form::text('last_name', null, array('class' => 'form-control')) }}
				</div>
			</div>
		</div>

		<div class="form-group">	
			<div class="row">
				<div class="col-sm-6">
					{{ Form::label('email', 'Email') }}
					{{ Form::email('email', null, array('class' => 'form-control')) }}
				</div>

				<div class="col-sm-6">
					{{ Form::label('tel', 'Teléfono') }}
					{{ Form::input('tel', 'tel', null, ['class' => 'form-control', 'placeholder' => 'Teléfono de contacto']) }}
				</div>
			</div>
		</div>
		
		<div class="form-group">
			<div class="row">
				<div class="col-sm-6">
					{{ Form::label('dob', 'Fecha de nacimiento') }}
					{{ Form::input('date', 'dob', null, ['class' => 'form-control', 'placeholder' => 'Fecha']) }}
				</div>

				<div class="col-sm-6">
					<label for="exampleInputFile">Imagen</label>
				    <input type="file" id="exampleInputFile">
				    <p class="help-block">*.png, *.jpg</p>
				</div>	
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Description') }}
			{{ Form::text('description', null, array('class' => 'form-control')) }}
		</div>

		<h3>Grupos</h3>

		<div class="form-group">
			<div class="row">
				@foreach($groups as $group => $value)
				<div class="col-sm-2">
					<div class="class="checkbox-inline"">
						<label>
							{{ Form::checkbox('groups[' . $group . ']', 1, $value) }}
							{{ $group }}
						</label>
					</div>
				</div>
				@endforeach
			</div>
		</div>

		<h3>Permisos</h3>
		
		<div class="row">
			@foreach ($permissions as $permission => $value)
				<div class="col-sm-2">
					<div class="form-group">
						{{ Form::label('permissions[' . $permission . ']', $permission) }}
						{{ Form::select('permissions[' . $permission . ']', array('-1' => 'Deny', '0'=> 'Inherit', '1' => 'Allow'), $value, array('class' => 'form-control')) }}
					</div>
				</div>
			@endforeach
		</div>

		{{ Form::submit('Edit User!', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

@stop