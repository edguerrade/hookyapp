@extends('layouts.sidebar')
@section('headtitle')
	CRUD Grupos
@stop
@section('content')

	<div class="page-header">
		<a title="Editar Grupo" class="btn btn-xs btn-default pull-right" href="{{ URL::to('groups/' . $group->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
		<h1>{{ $group->name }} <small>CRUD</small></h1>
	</div>

	<!-- will be used to show any messages -->
	@if (Session::has('message'))
		<div class="alert alert-info alert-dismissable">
			<strong>{{ Session::get('message') }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
	@endif

	<div class="jumbotron text-center">
		<h2><strong>Nombre:</strong> {{ $group->name }}</h2>
		<p>
			@foreach ($group->getPermissions() as $permission => $value)
				<strong>{{ $permission }} :</strong> {{ $value }}<br>
			@endforeach
		</p>
	</div>

@stop