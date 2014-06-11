@extends('layouts.sidebar')
@section('headtitle')
	CRUD Clases
@stop
@section('content')

	<div class="page-header">
		<a title="Agregar Clase" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Editar Clase" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes/' . $classe->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
		<a title="Listar Clases" class="btn btn-xs btn-default pull-right" href="{{ URL::to('classes') }}"><span class="glyphicon glyphicon-list"></span></a>
		<h1>{{ $classe->code }} <small>DETALLES</small></h1>
	</div>

	<div class="jumbotron text-center">
		<h2>{{ $classe->code }}</h2>
		<p>
			<strong>ID Parent:</strong> {{ $classe->parent_id }}<br>
			<strong>ID Tutoría:</strong> {{ $classe->tutoria_id }}<br>
			<strong>Descripción:</strong> {{ $classe->description }}<br>
			<strong>Fecha Inicio:</strong> {{ $classe->start_at }}<br>
			<strong>Fecha Fin:</strong> {{ $classe->end_at }}
		</p>
	</div>

@stop