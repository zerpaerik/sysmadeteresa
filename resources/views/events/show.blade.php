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
		<div></div>
		<form action="historial/create" method="post">
			<div class="form-group">
				{{ csrf_field() }}
				<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
				<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
				<h3>Antecedentes Medicos</h3>

				<label for="" class="col-sm-12">Antecedentes familiares</label>
				<div class="col-sm-12">
					<input type="text" name="a_familiares">
				</div>

				<label for="" class="col-sm-12">Antecedentes personales</label>
				<div class="col-sm-12">			
					<input type="text" name="a_personales">
				</div>

				<label for="" class="col-sm-12">Antecedentes patologicos</label>
				<div class="col-sm-12">			
					<input type="text" name="a_patologicos">
				</div>

				<label for="" class="col-sm-12">Alergias</label>
				<div class="col-sm-12">
					<input type="text" name="alergias">
				</div>
				<br>
				<div class="col-sm-12">
					<input type="submit" value="Registrar" class="btn btn-success">
				</div>
			</div>
		</form>
	@endif
	<br>
	<h2>Resultados anteriores de {{$data->nombres}} {{$data->apellidos}}</h2>
	@foreach($consultas as $consulta)
	<div class="rows">
		<div class="col-sm-6">
			<div class="rows">
				<h3 class="col-sm-12"><strong>Consulta del {{$consulta->created_at}}</strong></h3>
				<p class="col-sm-6"><strong>P/A:</strong> {{ $consulta->pa }}</p>
				<p class="col-sm-6"><strong>Pulso:</strong> {{ $consulta->pulso }}</p>
				<p class="col-sm-6"><strong>Temperatura:</strong> {{ $consulta->temperatura }}</p>
				<p class="col-sm-6"><strong>peso:</strong> {{ $consulta->peso }}</p>
				<p class="col-sm-6"><strong>G:</strong> {{ $consulta->g }}</p>
				<p class="col-sm-6"><strong>P:</strong> {{ $consulta->p }}</p>
				<p class="col-sm-6"><strong>Menarquia:</strong> {{ $consulta->menarquia }}</p>
				<p class="col-sm-6"><strong>1° R.S:</strong> {{ $consulta->rs }}</p>
				<p class="col-sm-6"><strong>FUR:</strong> {{ $consulta->fur }}</p>
				<p class="col-sm-6"><strong>R/C:</strong> {{ $consulta->rc }}</p>
				<p class="col-sm-6"><strong>MAC:</strong> {{ $consulta->MAC }}</p>
				<p class="col-sm-6"><strong>Fecha ultimo PAP:</strong>{{ $consulta->fecha_ultimo_pap }}</p>
				<p class="col-sm-6"><strong>Motivo de Consulta:</strong> {{ $consulta->motivo_consulta }}</p>
				<p class="col-sm-6"><strong>Tipo de Enfermedad:</strong> {{ $consulta->tipo_enfermedad }}</p>
				<p class="col-sm-6"><strong>Evolucion Enfermedad:</strong>{{ $consulta->evolucion_enfermedad }}</p>
				<p class="col-sm-6"><strong>Funciones Biologicas </strong>{{ $consulta->funciones_biologicas }}</p>
				<p class="col-sm-6"><strong>Examen Fisico Regional: </strong>{{ $consulta->examen_fisico_regional }}</p>
				<p class="col-sm-6"><strong>>Presuncion Diagnostica:</strong> {{ $consulta->presuncion_diagnostica }}</p>
				<p class="col-sm-6"><strong>Diagnostico Final: </strong>{{ $consulta->diagnostico_final }}</p>
				<p class="col-sm-6"><strong>CIEX:</strong> {{ $consulta->CIEX }}</p>
				<p class="col-sm-6"><strong>CIEX: </strong>{{ $consulta->CIEX2 }}</p>
				<p class="col-sm-6"><strong>Examen Auxiliar: </strong>{{ $consulta->examen_auxiliar }}</p>
				<p class="col-sm-6"><strong>Plan de Tratamiento: </strong>{{ $consulta->plan_tratamiento }}</p>
				<p  class="col-sm-12"><strong>Observaciones: </strong> {{ $consulta->obervaciones }}</p>
				<br>
			</div>
		</div>
	
	@endforeach
	<div class="col-sm-12">
	<h3>Registrar nueva Historia</h3>
	<form action="observacion/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">

			<label for="" class="col-sm-2 ">P/A</label>
			<div class="col-sm-4">
				<input type="text" name="pa" class="form-control" required>
			</div>

			<label for="" class="col-sm-2 ">Pulso</label>
			<div class="col-sm-4">
				<input  required class="form-control" type="text" name="pulso">
			</div>

			<label for=""class="col-sm-2 ">Temperatura</label>
			<div class="col-sm-4">
				<input  required class="form-control" type="text" name="temperatura">
			</div>

			<label for="" class="col-sm-2 ">Peso</label>
			<div class="col-sm-4">			
				<input  required class="form-control" type="text" name="peso">
			</div>

			<label for="" class="col-sm-2 ">G:</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="g">
			</div>

			<label for="" class="col-sm-2 ">P:</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="p">
			</div>

			<label for="" class="col-sm-2 ">Menarquia</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="menarquia">
			</div>

			<label for="" class="col-sm-2 ">1 R.S</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="rs">
			</div>

			<label for="" class="col-sm-2 ">FUR</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="fur">
			</div>

			<label for="" class="col-sm-2 ">R/C</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="rc">
			</div>

			<label for="" class="col-sm-2 ">MAC</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="mac">
			</div>

			<label for="" class="col-sm-2 ">Motivo de Consulta</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="motivo_consulta">		
			</div>

			<label for="" class="col-sm-2 ">Ultimo PAP</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="date" name="pap">
			</div>

			<label for="" class="col-sm-2 ">Tipo de enfermedad</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="tipo_enfermedad">
			</div>

			<label for="" class="col-sm-2 ">Evolucion de la enfermedad</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="evolucion_enfermedad">
			</div>	

			<label for="" class="col-sm-2 ">Funciones Biologicas</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="funciones_biologicas">
			</div>
			<br>
			<label class="col-sm-12" for="">Examen fisico regional</label>
			<div class="col-sm-12">	
				<input  required class="form-control" type="text" name="examen_fisico">
			</div>

			<label for="" class="col-sm-12 ">Presuncion Diagnostica</label>
			<div class="col-sm-12">	
				<input  required class="form-control" type="text" name="presuncion_diagnostica">
			</div>

			<label for="" class="col-sm-2 ">CIE-X</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="ciex1">
			</div>

			<label for="" class="col-sm-2 ">Diagnostico Final</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="diagnostico_final">
			</div>

			<label for="" class="col-sm-2 ">CIE-X</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="ciex2">
			</div>

			<label for="" class="col-sm-2 ">Examen Auxiliar</label>
			<div class="col-sm-4">	
				<input  required class="form-control" type="text" name="examen_auxiiar">
			</div>

			<label for="" class="col-sm-2 ">Plan de Tratamiento</label>
			<div class="col-sm-10">	
				<input  required class="form-control" type="text" name="plan_tratamiento">
			</div>

			<label for="" class="col-sm-2 ">Observaciones</label>
			<div class="col-sm-10">	
				<textarea name="observaciones" cols="10" rows="10" class="form-control" required></textarea>
			</div>	
			<div class="col-sm-12">
				<input type="submit" value="Registrar" class="btn btn-success" class="form-control">
			</div>
		</div>
		</div>
	</form>
	</div>
</div>
@endsection