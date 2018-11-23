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
						<input type="input" name="gesta"> 
						<br>	
						
						<label for="">Aborto</label>
						<input type="input" name="aborto">	
						<br>

						<label for="">Vaginales</label>
						<input type="input" name="vaginales">	
						<br>

						<label for="">Nacidos Vivos</label>
						<input type="input" name="vivos">	
						<br>

						<label for="">Nacidos Muertos</label>
						<input type="input" name="muertos">	
						<br>	

						<label for="">Viven</label>
						<input type="input" name="viven">	
						<br>	

						<label for="">Mueren 1era Semana</label>
						<input type="input" name="semana1">	
						<br>	

						<label for="">Despues 1era Semana</label>
						<input type="input" name="semana2">	
						<br>

						<label for="">Cesareas</label>
						<input type="input" name="cesaria">	
						<br>

						<label for="">Partos</label>
						<input type="input" name="parto">	
						<br>	

						<label for="">0 ó +3</label>
						<input type="input" name="num">	
						<br>

						<label for="">2500gr</label>
						<input type="input" name="gr">	
						<br>

						<label for="">Gemelar</label>
						<input type="input" name="gemelar">	
						<br>

						<label for="">37 Semanas</label>
						<input type="input" name="37m">	
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

						<h2>Antecedentes Personales</h2>
						<label for="">Ninguno</label>
						<input type="checkbox" name="ninguno">
						<label for="">Aborto Habitual</label>
						<input type="checkbox" name="aborto_ap">
						<label for="">Aborto Recurrente</label>
						<input type="checkbox" name="aborto2_ap">
						<label for="">Alcoholismo</label>
						<input type="checkbox" name="alcohol_ap">		
						<label for="">Alergia a Medicamentos</label>
						<input type="checkbox" name="alermedicamentos_ap">
						<label for="">Asma Bronquial</label>
						<input type="checkbox" name="asmabron_ap">
						<label for="">Bajo de peso al nacer</label>
						<input type="checkbox" name="pesonacimiento_ap">
						<label for="">Cardiopatia</label>
						<input type="checkbox" name="cardiopatia_ap">	
						<label for="">Cirugia Uterina</label>
						<input type="checkbox" name="cirugiauterina_ap">
						<label for="">Diabetes</label>
						<input type="checkbox" name="diabetes_ap">

						<label for="">Enfermedades Congenitas</label>
						<input type="checkbox" name="congenitas_ap">
						<label for="">Enfermedades Infecciosas</label>
						<input type="checkbox" name="infeccion_ap">
						<label for="">Epilepsia</label>
						<input type="checkbox" name="epilepsia_ap">
						<label for="">Hemorragia Postparto</label>
						<input type="checkbox" name="hemorragiapost_ap">		
						<label for="">Hipertension Arterial</label>
						<input type="checkbox" name="htarterial_ap">
						<label for="">Hoja de coca</label>
						<input type="checkbox" name="coca_ap">
						<label for="">Infertilidad</label>
						<input type="checkbox" name="infertilidad_ap">
						<label for="">Neoplasias</label>
						<input type="checkbox" name="neoplasias_ap">	
						<label for="">Otras Drogas</label>
						<input type="checkbox" name="drogas_ap">
						<label for="">Parto Prolongado</label>
						<input type="checkbox" name="partoprolongado_ap">		

						<label for="">Pre/Eclampsia</label>
						<input type="checkbox" name="eclampsia_ap">
						<label for="">Prematuridad</label>
						<input type="checkbox" name="prematuro_ap">
						<label for="">Retencion Placenta</label>
						<input type="checkbox" name="placenta_ap">
						<label for="">Tabaco</label>
						<input type="checkbox" name="tabaco_ap">		
						<label for="">TBC Pulmonar</label>
						<input type="checkbox" name="pulmonar_ap">
						<label for="">VIH/SIDA</label>
						<input type="checkbox" name="sida_ap">
						<label for="">Otro</label>
						<input type="checkbox" name="otro_ap">

						<h2>Peso y Talla</h2>
						<label for="">Peso Pregestacional</label>
						<input type="text" name="peso_pregestacional">
						<label for="">Talla (Cm)</label>
						<input type="text" name="talla_pregestacional">

						<h2>Antitetanica</h2>
						<label for="">Numero de dosis previa</label>
						<input type="text" name="dosis_previa">
						<label for="">Primera Dosis</label>
						<input type="text" name="primera_dosis">
						<label for="">Segunda Dosis</label>
						<input type="text" name="segunda_dosis">

						<h2>Tipo de sangre</h2>		
						<label for="">Grupo</label>
							<p>
								<input type="radio" name="sangre" value="A">A
								<input type="radio" name="sangre" value="B">B	
								<input type="radio" name="sangre" value="AB">AB
								<input type="radio" name="sangre" value="O">O
						</p>
						<label for="">RH</label>
							<p>
								<input type="radio" name="sangre" value="rh+">Rh +
								<input type="radio" name="sangre" value="rh-sd">Rh - Sen Desc	
								<input type="radio" name="sangre" value="rh-ns">Rh - No sen
								<input type="radio" name="sangre" value="rh-s">Rh - Sen
						</p>	
						<label for="">Psicoproxilasis Estimulacion</label>	
						<label for="">Numero de sesiones</label>		
						<input type="text" name="sesion_sangre">

						<h2>F.U.M</h2>
						<label for="">Fecha Ultima Menstruacion</label>
						<input type="date" name="ultima_menstruacion">
						<label for="">Fecha Probable de Parto</label>
						<input type="date" name="parto_probable">
						<label for="">Eco: EG</label>
						<input type="date" name="eco_eg">		

						<h2>Serologia</h2>
						<label for="">1</label>
							<p>
								<input type="radio" name="1era" value="negativo">Negativo
								<input type="radio" name="1era" value="positivo">Positivo	
								<input type="radio" name="1era" value="no">No se hizo
								<input type="date" name="serologia_1era">
						</p>	
						<label for="">2</label>
							<p>
								<input type="radio" name="2da" value="negativo">Negativo
								<input type="radio" name="2da" value="positivo">Positivo	
								<input type="radio" name="2da" value="no">No se hizo
								<input type="date" name="serologia_2da">
						</p>

						<h2>Hemologbina</h2>
						<label for="">Hb (g %)</label>
						<input type="text" name="hemoglobina">
						No se hizo <input type="checkbox" name="hemoglobina_no">
						<br>Fecha<input type="date" name="hemoglobina_fecha">		

						<h2>Examenes</h2>
						<label for="">Clinico</label>			
						<p>
								<input type="radio" name="clinica" value="clinico_no">Sin Examen 
								<input type="radio" name="clinica" value="clinico_normal">Normal	
								<input type="radio" name="clinica" value="clinico_patologico">Patologico							
						</p>		
						<label for="">Mamas</label>			
						<p>
								<input type="radio" name="mamas" value="mamas_no">Sin Examen 
								<input type="radio" name="mamas" value="mamas_normal">Normal	
								<input type="radio" name="mamas" value="mamas_anormal">Anormal							
						</p>	
						<label for="">Odontologia</label>			
						<p>
								<input type="radio" name="odonto" value="odonto_no">Sin Examen 
								<input type="radio" name="odonto" value="odonto_normal">Normal	
								<input type="radio" name="odonto" value="odonto_anormal">Anormal							
						</p>	
						<label for="">PAP</label>			
						<p>
								<input type="radio" name="pap" value="pap_no">Sin Examen 
								<input type="radio" name="pap" value="pap_normal">Normal	
								<input type="radio" name="pap" value="pap_anormal">Anormal							
						</p>
						<label for="">Orina</label>			
						<p>
								<input type="radio" name="orina" value="orina_no">Sin Examen 
								<input type="radio" name="orina" value="orina_normal">Normal	
								<input type="radio" name="orina" value="orina_anormal">Anormal							
						</p>
						<label for="">Glucosa</label>			
						<p>
								<input type="radio" name="glucosa" value="glucosa_no">Sin Examen 
								<input type="radio" name="glucosa" value="glucosa_normal">Normal	
								<input type="radio" name="glucosa" value="glucosa_anormal">Anormal							
						</p>	
						<label for="">HIV</label>			
						<p>
								<input type="radio" name="hiv" value="hiv_no">Sin Examen 
								<input type="radio" name="hiv" value="hiv_negativo_1er">Negativo 1er	
								<input type="radio" name="hiv" value="hiv_negativo_2do">Negativo 2do
								<input type="radio" name="hiv" value="hiv_positivo_1er">Positivo 1er	
								<input type="radio" name="hiv" value="hiv_positivo_2do">Positivo 2do							
						</p>																																																										
						<label for="">BK en esputo</label>			
						<p>
								<input type="radio" name="bk" value="bk_no">Sin Examen 
								<input type="radio" name="bk" value="bk_negativo">Negativo 	
								<input type="radio" name="bk" value="bk_no_aplica">No Aplica
								<input type="radio" name="bk" value="bk_positivo">Positivo	
						</p>
						<label for="">TORCH</label>			
						<p>
								<input type="radio" name="torch" value="torch_no">Sin Examen 
								<input type="radio" name="torch" value="torch_normal">Normal	
								<input type="radio" name="torch" value="torch_anormal">Anormal		
								<input type="radio" name="torch" value="torch_anormal">Anormal							
						</p>

																								
					</div>
				</form>
			</div>	
		</div>
	</div>
</div>	
@endsection