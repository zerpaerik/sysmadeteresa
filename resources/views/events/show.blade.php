@extends('layouts.app')
@section('content')
	<h1>Cita medica {{$data->title}}</h1>
	<p>Paciente: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>Doctor: {{$data->nombrePro}} {{$data->apellidoPro}}</p>
	<p>Fecha de cita: {{$data->date}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>
	@if($historial)
	<h2>Historia Base de {{$data->nombres}} {{$data->apellidos}}</h2>
		<p>Alergias: {{$historial->alergias}}</p>
		<p>Antecedentes patologicos: {{$historial->antecedentes_patologicos}}</p>
		<p>Antecedentes Personales: {{$historial->antecedentes_personales}}</p>
		<p>Antecedentes Familaires: {{$historial->antecedentes_familiar}}</p>
	@else
	<h4>Este usuario no cuenta con un historial base, por favor agregue uno</h4>
		<form action="historial/create" method="post">
			{{ csrf_field() }}
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
			<h3>Antecedentes Medicos</h3>
			<label for="">Antecedentes familiares</label>
			<input type="text" name="a_familiares">
			<label for="">Antecedentes personales</label>
			<input type="text" name="a_personales">
			<label for="">Antecedentes patologicos</label>
			<input type="text" name="a_patologicos">
			<label for="">Alergias</label>
			<input type="text" name="alergias">
			<input type="submit" value="Registrar" class="btm btn-success">
		</form>
	@endif
	<br>
	<h2>Resultados anteriores de {{$data->nombres}} {{$data->apellidos}}</h2>
	@foreach($consultas as $consulta)
		<h4>Consulta del {{$consulta->created_at}}</h4>
		<p>P/A {{ $consulta->pa }}</p>
		<p>Pulso {{ $consulta->pulso }}</p>
		<p>Temperatura {{ $consulta->temperatura }}</p>
		<p>peso {{ $consulta->peso }}</p>
		<p>G: {{ $consulta->g }}</p>
		<p>P: {{ $consulta->p }}</p>
		<p>Menarquia {{ $consulta->menarquia }}</p>
		<p>1 R.S {{ $consulta->rs }}</p>
		<p>FUR {{ $consulta->fur }}</p>
		<p>R/C {{ $consulta->rc }}</p>
		<p>MAC {{ $consulta->MAC }}</p>
		<p>Fecha ultimo PAP {{ $consulta->fecha_ultimo_pap }}</p>
		<p>Motivo de Consulta {{ $consulta->motivo_consulta }}</p>
		<p>Tipo de Enfermedad {{ $consulta->tipo_enfermedad }}</p>
		<p>Evolucion Enfermedad {{ $consulta->evolucion_enfermedad }}</p>
		<p>Funciones Biologicas {{ $consulta->funciones_biologicas }}</p>
		<p>Examen Fisico Regional {{ $consulta->examen_fisico_regional }}</p>
		<p>Presuncion Diagnostica {{ $consulta->presuncion_diagnostica }}</p>
		<p>Diagnostico Final {{ $consulta->diagnostico_final }}</p>
		<p>Examen Auxiliar {{ $consulta->examen_auxiliar }}</p>
		<p>Plan de Tratamiento {{ $consulta->plan_tratamiento }}</p>
		<p>Observaciones {{ $consulta->obervaciones }}</p>
		<p>------------------------------------</p>
	@endforeach
	<h3>Historial de consultas</h3>
	<form action="observacion/create" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
		<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
		<label for="">P/A</label>
		<input type="text" name="pa">
		<label for="">Pulso</label>
		<input type="text" name="pulso">
		<label for="">Temperatura</label>
		<input type="text" name="temperatura">
		<label for="">Peso</label>
		<input type="text" name="peso">
		<label for="">G:</label>
		<input type="text" name="g">
		<label for="">P:</label>
		<input type="text" name="p">
		<label for="">Menarquia</label>
		<input type="text" name="menarquia">
		<label for="">1 R.S</label>
		<input type="text" name="rs">
		<label for="">FUR</label>
		<input type="text" name="fur">
		<label for="">R/C</label>
		<input type="text" name="rc">
		<label for="">MAC</label>
		<input type="text" name="mac">
		<label for="">Fecha Ultimo PAP</label>
		<input type="date" name="pap">
		<label for="">Motivo de Consulta</label>
		<input type="text" name="motivo_consulta">		
		<label for="">Tipo de enfermedad</label>
		<input type="text" name="tipo_enfermedad">
		<label for="">Evolucion de la enfermedad</label>
		<input type="text" name="evolucion_enfermedad">
		<label for="">Funciones Biologicas</label>
		<input type="text" name="funciones_biologicas">
		<label for="">Examen fisico regional</label>
		<input type="text" name="examen_fisico">
		<label for="">Presuncion Diagnostica</label>
		<input type="text" name="presuncion_diagnostica">
		<label for="">CIE-X</label>
		<input type="text" name="ciex1">
		<label for="">Diagnostico Final</label>
		<input type="text" name="diagnostico_final">
		<label for="">CIE-X</label>
		<input type="text" name="ciex2">
		<label for="">Examen Auxiliar</label>
		<input type="text" name="examen_auxiiar">
		<label for="">Plan de Tratamiento</label>
		<input type="text" name="plan_tratamiento">
		<label for="">Observaciones</label>
		<textarea name="observaciones" id="" cols="30" rows="10">
		</textarea>
		<input type="submit" value="Registrar" class="btm btn-success">
	</form>
	

@endsection