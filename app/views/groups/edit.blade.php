@extends('layouts.sidebar')
@section('headtitle')
	CRUD Grupos
@stop
@section('content')

	<div class="page-header">
  		<h1>Editar {{ $group->name }} <small>CRUD</small></h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	{{ Form::model($group, array('route' => array('groups.update', $group->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('name', 'Name') }}
			{{ Form::text('name', null, array('class' => 'form-control')) }}
		</div>

		<h3>Permisos</h3>
		
		<div class="row">
			@foreach ($permissions as $permission => $value)
				<div class="col-sm-2">
					<div class="form-group">
						{{ Form::label('permissions[' . $permission . ']', $permission) }}
						{{ Form::select('permissions[' . $permission . ']', array('0' => 'Deny', '1' => 'Allow'), $value, array('class' => 'form-control')) }}
					</div>
				</div>
			@endforeach
		</div>
		
		{{ Form::submit('Create the Group!', array('class' => 'btn btn-primary')) }}	

	{{ Form::close() }}

@stop