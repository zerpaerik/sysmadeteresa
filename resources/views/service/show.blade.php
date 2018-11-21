@extends('layouts.app')
@section('content')
	<h1>Servicio medico: {{$data->title}}</h1>
	<p>Profesional: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>Especialidad: {{$data->nomEspecialidad}}</p>
	<p>Servicio: {{$data->srDetalle}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>	
@endsection