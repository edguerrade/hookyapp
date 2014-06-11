@extends('layouts.sidebar')
@section('headtitle')
	CRUD Usuarios
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Editar Usuario" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users/' . $user->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
		<a title="Listar Usuarios" class="btn btn-xs btn-default pull-right" href="{{ URL::to('users') }}"><span class="glyphicon glyphicon-list"></span></a>
  		<h1>
  			@if ( $user->avatar )
			<img width="100" height="100" id="avatar" src="{{ asset($user->avatar) }}" alt="{{ $user->first_name . ' ' . $user->last_name }}" class="img-circle">
			@else
			<img width="100" height="100" id="avatar" src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $user->first_name . ' ' . $user->last_name }}" class="img-circle">
			@endif
  			{{ $user->last_name . ', ' . $user->first_name }} <small>DETALLES</small>
  		</h1>
	</div>

	<div class="row">
		<div class="col-sm-6"><strong>Nombre:</strong> {{ $user->first_name }}</div>
		<div class="col-sm-6"><strong>Apellidos:</strong> {{ $user->last_name }}</div>
	</div>
	<div class="row">
		<div class="col-sm-6"><strong>Email:</strong> {{ $user->email }}</div>
		<div class="col-sm-6"><strong>Teléfono:</strong> {{-- $user->tel --}}</div>
	</div>
	<div class="row">
		<div class="col-sm-6"><strong>Fecha de nacimiento:</strong> {{ date("d/m/Y",strtotime($user->dob)) }}</div>
	</div>
	<div class="row">
		<div class="col-sm-12"><strong>Descripción:</strong> {{ $user->description }}</div>
	</div>

@stop