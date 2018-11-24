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
						<select name="paciente" id="">
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
						<input type="input" name="m37m">	
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
						<input type="checkbox" name="ninguno_af"><br>
						<label for="">Alergias</label>
						<input type="checkbox" name="alergias_af"><br>
						<label for="">Anomalias Congenitas</label>
						<input type="checkbox" name="anomalias_af"><br>
						<label for="">Epilepsia</label>
						<input type="checkbox" name="epilepsia_af"><br>		
						<label for="">Diabetes</label>
						<input type="checkbox" name="diabetes_af"><br>
						<label for="">Enfermedades Congenitas</label>
						<input type="checkbox" name="enfermedades_af"><br>
						<label for="">Gemelares</label>
						<input type="checkbox" name="gemelares_af"><br>
						<label for="">Hipertension Arterial</label>
						<input type="checkbox" name="tension_af"><br>	
						<label for="">Neoplasia</label>
						<input type="checkbox" name="neoplasia_af"><br>
						<label for="">TBC Pulmonar</label>
						<input type="checkbox" name="pulmon_af"><br>
						<label for="">Otro</label>
						<input type="text" name="otro_af"><br>		

						<h2>Antecedentes Personales</h2>
						<label for="">Ninguno</label>
						<input type="checkbox" name="ninguno_ap"><br>
						<label for="">Aborto Habitual</label>
						<input type="checkbox" name="aborto_ap"><br>
						<label for="">Aborto Recurrente</label>
						<input type="checkbox" name="aborto2_ap"><br>
						<label for="">Alcoholismo</label>
						<input type="checkbox" name="alcohol_ap"><br>		
						<label for="">Alergia a Medicamentos</label>
						<input type="checkbox" name="alermedicamentos_ap"><br>
						<label for="">Asma Bronquial</label>
						<input type="checkbox" name="asmabron_ap"><br>
						<label for="">Bajo de peso al nacer</label>
						<input type="checkbox" name="pesonacimiento_ap"><br>
						<label for="">Cardiopatia</label>
						<input type="checkbox" name="cardiopatia_ap"><br>	
						<label for="">Cirugia Uterina</label>
						<input type="checkbox" name="cirugiauterina_ap"><br>
						<label for="">Diabetes</label>
						<input type="checkbox" name="diabetes_ap"><br>

						<label for="">Enfermedades Congenitas</label>
						<input type="checkbox" name="congenitas_ap"><br>
						<label for="">Enfermedades Infecciosas</label>
						<input type="checkbox" name="infeccion_ap"><br>
						<label for="">Epilepsia</label>
						<input type="checkbox" name="epilepsia_ap"><br>
						<label for="">Hemorragia Postparto</label>
						<input type="checkbox" name="hemorragiapost_ap"><br>		
						<label for="">Hipertension Arterial</label>
						<input type="checkbox" name="htarterial_ap"><br>
						<label for="">Hoja de coca</label>
						<input type="checkbox" name="coca_ap"><br>
						<label for="">Infertilidad</label>
						<input type="checkbox" name="infertilidad_ap"><br>
						<label for="">Neoplasias</label>
						<input type="checkbox" name="neoplasias_ap"><br>	
						<label for="">Otras Drogas</label>
						<input type="checkbox" name="drogas_ap"><br>
						<label for="">Parto Prolongado</label>
						<input type="checkbox" name="partoprolongado_ap"><br>		

						<label for="">Pre/Eclampsia</label>
						<input type="checkbox" name="eclampsia_ap"><br>
						<label for="">Prematuridad</label>
						<input type="checkbox" name="prematuro_ap"><br>
						<label for="">Retencion Placenta</label>
						<input type="checkbox" name="placenta_ap"><br>
						<label for="">Tabaco</label>
						<input type="checkbox" name="tabaco_ap"><br>		
						<label for="">TBC Pulmonar</label>
						<input type="checkbox" name="pulmonar_ap"><br>
						<label for="">VIH/SIDA</label>
						<input type="checkbox" name="sida_ap"><br>
						<label for="">Otro</label>
						<input type="checkbox" name="otro_ap"><br>

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
								<input type="radio" name="sangre-rh" value="rh+">Rh +
								<input type="radio" name="sangre-rh" value="rh-sd">Rh - Sen Desc	
								<input type="radio" name="sangre-rh" value="rh-ns">Rh - No sen
								<input type="radio" name="sangre-rh" value="rh-s">Rh - Sen
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
						<label for="">No se hizo </label>
						<input type="checkbox" name="hemoglobina_no">
						<label for="">Fecha</label>
						<input type="date" name="hemoglobina_fecha">		

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

						<h2>Patologia Materna (CIE 10)</h2>
						<label for="">1</label>
						<input type="text" name="patologia_1">
						<input type="date" name="patologia_1_date">
						<label for="">Otros(CIE 10)</label>
						<input type="text" name="patologia_1_otro">
						<br>		
						<label for="">2</label>
						<input type="text" name="patologia_2">
						<input type="date" name="patologia_2_date">
						<label for="">Otros(CIE 10)</label>
						<input type="text" name="patologia_2_otro">	
						<br>
						<label for="">3</label>
						<input type="text" name="patologia_3">
						<input type="date" name="patologia_3_date">
						<label for="">Otros(CIE 10)</label>
						<input type="text" name="patologia_3_otro">	

						<h2>Terminacion</h2>
						<label for="">Fecha</label>
						<input type="date" name="fecha_terminacion">
							<p>
								<input type="radio" name="terminacion" value="Espontanea">Espontanea
								<input type="radio" name="terminacion" value="Cesarea">Cesarea	
								<input type="radio" name="terminacion" value="Forceps">Forceps
								<input type="radio" name="terminacion" value="Vacumm">Vacumm
							</p>	

						<h2>Atencion</h2>
						<label for="">Nivel</label>	
						<p>
							<input type="radio" name="nivel" value="Primario">Primario
							<input type="radio" name="nivel" value="Secundario">Secundario	
							<input type="radio" name="nivel" value="Terciario">Terciario
							<input type="radio" name="nivel" value="Domiciliario">Domiciliario
							<input type="radio" name="nivel" value="Otros">Otro
						</p>	
							<label for="">Medico</label>
							<p>
								<input type="radio" name="medico_atencion" value="Parto">Parto
								<input type="radio" name="medico_atencion" value="Neonato">Neonato	
							</p>
							<label for="">Obstetriz</label>
							<p>
								<input type="radio" name="obstetriz_atencion" value="Parto">Parto
								<input type="radio" name="obstetriz_atencion" value="Neonato">Neonato	
							</p>		
							<label for="">Interno</label>
							<p>
								<input type="radio" name="interno_atencion" value="Parto">Parto
								<input type="radio" name="interno_atencion" value="Neonato">Neonato	
							</p>	
							<label for="">Estudiante</label>
							<p>
								<input type="radio" name="estudiante_atencion" value="Parto">Parto
								<input type="radio" name="estudiante_atencion" value="Neonato">Neonato	
							</p>	
							<label for="">Empirica</label>
							<p>
								<input type="radio" name="empirica_atencion" value="Parto">Parto
								<input type="radio" name="empirica_atencion" value="Neonato">Neonato	
							</p>	
							<label for="">Aux de Enfermeria</label>
							<p>
								<input type="radio" name="enfermeria_atencion" value="Parto">Parto
								<input type="radio" name="enfermeria_atencion" value="Neonato">Neonato	
							</p>	
							<label for="">Enfermera</label>
							<p>
								<input type="radio" name="enfermera_atencion" value="Parto">Parto
								<input type="radio" name="enfermera_atencion" value="Neonato">Neonato	
							</p>
							<label for="">Familiar</label>
							<p>
								<input type="radio" name="familiar_atencion" value="Parto">Parto
								<input type="radio" name="familiar_atencion" value="Neonato">Neonato	
							</p>	
							<label for="">Otro</label>
							<p>
								<input type="radio" name="otro_atencion" value="Parto">Parto
								<input type="radio" name="otro_atencion" value="Neonato">Neonato	
							</p>																																																								

							<h2>Recien Nacido</h2>
							<label for="">Sexo</label>
							<p>
								<input type="radio" name="sexo_nacido" value="Femenino">Femenino
								<input type="radio" name="sexo_nacido" value="Masculino">Masculino	
							</p>
							<label for="">Talla</label>
							<input type="text" name="talla_nacido"> <br>
							<label for="">Peso</label>
							<input type="text" name="peso_nacido"> <br>
							<label for="">P.Cef</label>
							<input type="text" name="cef_nacido"> <br>
							<label for="">Temperatura</label>
							<input type="text" name="temp_nacido"> <br>
							<br>
							<label for="">No. Hc RN</label>
							<input type="text" name="no_rn"> <br>
							<label for="">Nombre RN</label>
							<input type="text" name="nombre_rn"> <br>
							<label for="">Edad por semanas</label>
							<input type="text" name="edad_semanas"> <br>
							<br>
							<label for="">Peso por edad Gestacion</label>
							<p>
								<input type="radio" name="edad_gestacion" value="Adecuado">Adecuado
								<input type="radio" name="edad_gestacion" value="Pequeño">Pequeño	
								<input type="radio" name="edad_gestacion" value="Grande">Grande
							</p>	
							<label for="">APGAR</label>
							<br>
							1 <input type="text" name="apgar_1">
							<br>
							2 <input type="text" name="apgar_2">	
							<br>
							<label for="">Patologia del recion nacido</label>
							<br>
							1 <input type="text" name="patologia_recien_1">	<input type="date" name="patologia_recien_1_date"><br>
							2 <input type="text" name="patologia_recien_2">	<input type="date" name="patologia_recien_2_date"><br>						
							3 <input type="text" name="patologia_recien_3">	<input type="date" name="patologia_recien_3_date"><br>
							<label for="">Otros (CIE 10)</label>	
							<br>
							1 <input type="text" name="otros_cie1_10"><br>
							2 <input type="text" name="otros_cie2_10"><br>	
							<input type="submit" class="btn btn-primary" value="Guardar">														
					</div>
					</div>																																																										
					</div>
				</div>
				</form>
			</div>	
		</div>
	</div>
</div>	
@endsection