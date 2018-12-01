@extends('layouts.app')
@section('content')
	<h3>Servicio medico: {{$data->title}}</h3>
    <p>Paciente: {{$data->nompac}} {{$data->apepac}} </p>
	<p>Profesional: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>Especialidad: {{$data->nomEspecialidad}}</p>
	<p>Servicio: {{$data->srDetalle}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>	
@endsection