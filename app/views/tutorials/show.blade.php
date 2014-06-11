@extends('layouts.sidebar')
@section('headtitle')
	CRUD Tutorías
@stop
@section('content')
	
	<div class="page-header">
		<a title="Agregar Tutoría" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/create') }}"><span class="glyphicon glyphicon-plus"></span></a>
		<a title="Editar Tutoría" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials/' . $tutorial->id . '/edit') }}"><span class="glyphicon glyphicon-pencil"></span></a>
		<a title="Listar Tutorías" class="btn btn-xs btn-default pull-right" href="{{ URL::to('tutorials') }}"><span class="glyphicon glyphicon-list"></span></a>
		<h1>{{ $tutorial->code }} <small>DETALLES</small></h1>
	</div>

	<div class="jumbotron text-center">
		<h2>{{ $tutorial->code }}</h2>
		<p>
			<strong>Descripción:</strong> {{ $tutorial->description }}<br>
			<strong>ID Tutor:</strong> {{ $tutorial->tutor_id }}
		</p>
	</div>

@stop