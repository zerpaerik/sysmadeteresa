@extends('layouts.app')
@section('content')
	<h3>Servicio PROGRAMADO: {{$data->title}}</h3>
    <p>Paciente: {{$data->nompac}} {{$data->apepac}} </p>
	<p>Especialista: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>Servicio: {{$data->srDetalle}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>	
@endsection