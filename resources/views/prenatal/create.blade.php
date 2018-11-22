@extends('layouts.app')
@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Informe Prenatal</strong></span>
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content">	
				<form class="form-horizontal" role="form" method="post" action="prenatal/create">
					{{ csrf_field() }}
					<div class="form-group">					
						<h2>Datos personales</h2>
						<label for="">Seleccione un paciente</label>
						<select name="" id="">
						@foreach($pacientes as $paciente)
							<option value="{{$paciente->id}}">{{$paciente->nombres}} {{$paciente->apellidos}}</option>
						@endforeach
						</select>
						<h2>Antecedentes Obstetricos</h2>

						<label for="">Gestas</label>
						<input type="radio" name="gesta" value="1">Si
						<input type="radio" name="gesta" value="0">No 
						<br>	
						
						<label for="">Aborto</label>
						<input type="radio" name="aborto" value="1">Si
						<input type="radio" name="aborto" value="0">No	
						<br>

						<label for="">Vaginales</label>
						<input type="radio" name="vaginales" value="1">Si
						<input type="radio" name="vaginales" value="0">No	
						<br>

						<label for="">Nacidos Vivos</label>
						<input type="radio" name="vivos" value="1">Si
						<input type="radio" name="vivos" value="0">No	
						<br>

						<label for="">Nacidos Muertos</label>
						<input type="radio" name="muertos" value="1">Si
						<input type="radio" name="muertos" value="0">No	
						<br>	

						<label for="">Viven</label>
						<input type="radio" name="viven" value="1">Si
						<input type="radio" name="viven" value="0">No	
						<br>	

						<label for="">Mueren 1era Semana</label>
						<input type="radio" name="semana1" value="1">Si
						<input type="radio" name="semana1" value="0">No	
						<br>	

						<label for="">Despues 1era Semana</label>
						<input type="radio" name="semana2" value="1">Si
						<input type="radio" name="semana2" value="0">No	
						<br>

						<label for="">Cesareas</label>
						<input type="radio" name="cesaria" value="1">Si
						<input type="radio" name="cesaria" value="0">No	
						<br>

						<label for="">Partos</label>
						<input type="radio" name="parto" value="1">Si
						<input type="radio" name="parto" value="0">No	
						<br>	

						<label for="">0 ó +3</label>
						<input type="radio" name="num" value="1">Si
						<input type="radio" name="num" value="0">No	
						<br>

						<label for="">2500gr</label>
						<input type="radio" name="gr" value="1">Si
						<input type="radio" name="gr" value="0">No	
						<br>

						<label for="">Gemelar</label>
						<input type="radio" name="gemelar" value="1">Si
						<input type="radio" name="gemelar" value="0">No	
						<br>

						<label for="">37 Semanas</label>
						<input type="radio" name="37m" value="1">Si
						<input type="radio" name="37m" value="0">No	
						<br>

						<h2>Fin Gestacion Anterior</h2>
						<label for="">Terminacion</label>
						<p>
							<input type="radio" name="terminacion_gestacion" value="Parto">Parto
							<input type="radio" name="terminacion_gestacion" value="Aborto">Aborto	
							<input type="radio" name="terminacion_gestacion" value="Ectopipo">Ectopipo
							<input type="radio" name="terminacion_gestacion" value="Molar">Molar
							<input type="radio" name="terminacion_gestacion" value="Otro">Otro
							<input type="radio" name="terminacion_gestacion" value="No Aplica">No Aplica							
						</p>								
						<label for="">Fecha</label>
						<input type="date" name="fecha_terminacion">
						<br>
						<label for="">Si fue aborto que tipo de aborto</label>
						<p>
							<input type="radio" name="aborto_gestacion" value="Incompleto">Incompleto
							<input type="radio" name="aborto_gestacion" value="Completo">Completo	
							<input type="radio" name="aborto_gestacion" value="Frustro">Frustro
							<input type="radio" name="aborto_gestacion" value="Septico">Septico
							<input type="radio" name="aborto_gestacion" value="Otro">Otro
							<input type="radio" name="aborto_gestacion" value="No Aplica">No Aplica	
						</p>
						<label for="">RN de mayor peso</label>
						<input type="text" name="peso_gestacion">Gr
						<h2>Antecedentes Familiares</h2>
						<label for="">Ninguno</label>
						<input type="checkbox" name="ninguno">
						<label for="">Alergias</label>
						<input type="checkbox" name="alergias_af">
						<label for="">Anomalias Congenitas</label>
						<input type="checkbox" name="anomalias_af">
						<label for="">Epilepsia</label>
						<input type="checkbox" name="epilepsia_af">		
						<label for="">Diabetes</label>
						<input type="checkbox" name="diabetes_af">
						<label for="">Enfermedades Congenitas</label>
						<input type="checkbox" name="enfermedades_af">
						<label for="">Gemelares</label>
						<input type="checkbox" name="gemelares_af">
						<label for="">Hipertension Arterial</label>
						<input type="checkbox" name="tension_af">	
						<label for="">Neoplasia</label>
						<input type="checkbox" name="neoplasia_af">
						<label for="">TBC Pulmonar</label>
						<input type="checkbox" name="pulmon_af">
						<label for="">Otro</label>
						<input type="text" name="otro_af">																	
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>	
@endsection