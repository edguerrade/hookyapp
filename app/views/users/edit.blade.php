@extends('layouts.sidebar')
@section('headtitle')
	CRUD Usuarios
@stop
@section('requirejs')
users.edit
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Mostrar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/' . $user->id) }}"><span class="glyphicon glyphicon-eye-open"></span></a>
		<a title="Listar Usuarios" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users') }}"><span class="glyphicon glyphicon-list"></span></a>
  		<h1>
  			@if ( $user->avatar )
  			<img width="100" height="100" id="avatar" src="{{ asset($user->avatar) }}" alt="{{ $user->first_name . ' ' . $user->last_name }}" class="img-circle">
			@else
			<img width="100" height="100" id="avatar" src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $user->first_name . ' ' . $user->last_name }}" class="img-circle">
			@endif
  			{{ $user->last_name . ', ' . $user->first_name }}  <small>EDITAR</small>
  		</h1>
	</div>

	<!-- if there are creation errors, they will show here -->
	@if ($errors->all())
		@foreach ($errors->all() as $key => $value)
			<div class="alert alert-danger alert-dismissable">
				<strong>{{ e($value) }}</strong>
			</div>	
		@endforeach
	@endif

	<ul class="nav nav-tabs">
		<li class="active"><a href="#profile" data-toggle="tab">Perfil</a></li>
		<li><a href="#profileimg" data-toggle="tab">Imagen</a></li>
		<li><a href="#groups" data-toggle="tab">Grupos</a></li>
		<li><a href="#permissions" data-toggle="tab">Permisos</a></li>
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div class="tab-pane active" id="profile">
			{{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'files'=> true)) }}
				<h3>Perfil</h3>

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

				<div class="form-group required">	
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
						    {{ Form::label('image', 'Imagen') }}
						    {{ Form::file('image', ['class' => 'filestyle']) }}
						    <p class="help-block">*.png, *.jpg</p>
						</div>	
					</div>
				</div>

				<div class="form-group">
					{{ Form::label('description', 'Description') }}
					{{ Form::text('description', null, array('class' => 'form-control')) }}
				</div>
			
				{{ Form::submit('Editar Perfil!', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}
		</div>

		<div class="tab-pane" id="profileimg">
			{{ Form::open(array('url' => array('users/image', $user->id), 'method' => 'PUT')) }}
			    <h3>Imagen</h3>
			    <div class="form-group">
			        <div class="row">
			            <div class="col-md-6">
			                <div class="img-container"><img src="{{ asset($user->avatar) }}"></div>
			            </div>
			        </div>
			    </div>

			    <input class="form-control" id="get-data-input" name="get-data-input" type="hidden" placeholder="The data object will be showed here">
			    <input id="get-img-info-input" type="hidden" class="form-control" placeholder="The image information will be showed here">
			      
			    {{ Form::submit('Editar Avatar!', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}
		</div>

		<div class="tab-pane" id="groups">
			{{ Form::open(array('url' => array('users/groups', $user->id), 'method' => 'PUT')) }}
				<h3>Grupos</h3>

				<div class="form-group">
					<div class="row">
						@foreach($groups as $group => $value)
						<div class="col-sm-2">
							<div class="checkbox-inline">
								<label>
									{{ Form::checkbox('groups[' . $group . ']', 1, $value, array('class' => 'input-blue')) }}
									{{ $group }}
								</label>
							</div>
						</div>
						@endforeach
					</div>
				</div>
				{{ Form::submit('Editar Grupos!', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}
		</div>

		<div class="tab-pane" id="permissions">
			{{ Form::open(array('url' => array('users/permissions', $user->id), 'method' => 'PUT')) }}
				<h3>Permisos</h3>
			
				<!--<div class="row">
					@foreach ($permissions as $permission => $value)
						<div class="col-sm-2">
							<div class="form-group">
								{{ Form::label('permissions[' . $permission . ']', $permission) }}
								{{ Form::select('permissions[' . $permission . ']', array('-1' => 'Deny', '0'=> 'Inherit', '1' => 'Allow'), $value, array('class' => 'form-control')) }}
							</div>
						</div>
					@endforeach
				</div>-->

				<div class="row">
					<div class="col-sm-12">
						<table class="table table-striped table-bordered">
							<thead>
								<tr>
									<td>Nombre</td>
									<td class="text-center">Deny</td>
									<td class="text-center">Inherit</td>
									<td class="text-center">Allow</td>
								</tr>
							</thead>
							<tbody>
							@foreach ($permissions as $permission => $value)
								<tr>
									<td>{{ $permission }}</td>
									<td class="text-center">{{ Form::radio('permissions[' . $permission . ']', '-1', ($value==-1)?true:false, array('class' => 'input-red')) }}</td>
									<td class="text-center">{{ Form::radio('permissions[' . $permission . ']', '0', ($value==0)?true:false, array('class' => 'input-grey')) }}</td>
									<td class="text-center">{{ Form::radio('permissions[' . $permission . ']', '1', ($value==1)?true:false, array('class' => 'input-green')) }}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
				{{ Form::submit('Editar Permisos!', array('class' => 'btn btn-primary')) }}

			{{ Form::close() }}
		</div>
	</div>

@stop