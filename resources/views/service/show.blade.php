@extends('layouts.app')
@section('content')
@if($data->tipo==1)
	<h3>Servicio PROGRAMADO: {{$data->title}}</h3>
    <p>Paciente: {{$data->apepac}} {{$data->nompac}} </p>
	<p>Especialista: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>Servicio: {{$data->srDetalle}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
		<p>Tiempo: {{$data->tiempo}}</p>
@elseif($data->tipo==2)
<h3>CONSULTA PROGRAMADA: {{$data->title}}</h3>
    <p>Paciente: {{$data->apepac}} {{$data->nompac}} </p>
	<p>Especialista: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>CONSULTA:</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
			<p>Tiempo: {{$data->tiempo}}</p>
@else
<h3>CONTROL PROGRAMADO: {{$data->title}}</h3>
    <p>Paciente: {{$data->apepac}} {{$data->nompac}} </p>
	<p>Especialista: {{$data->nombrePro}} {{$data->apellidoPro}} </p>
	<p>CONTROL PRENATAL:</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
			<p>Tiempo: {{$data->tiempo}}</p>
@endif
	<br>	
@endsection