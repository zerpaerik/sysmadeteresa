@extends('layouts.app')
@section('content')
	<h2>Ficha Prenatal de {{ $paciente->nombres }} {{ $paciente->apellidos }} </h2>

  <h3>Antecedentes Obstetricos</h3>

            <label class="col-sm-1 control-label">Gestas</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gesta" value="{{ $data->gesta }}" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
            </div>

            <label class="col-sm-1 control-label">Aborto</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="aborto" value="{{ $data->aborto }}" placeholder="Noabortombres" data-toggle="tooltip" data-placement="bottom" title="aborto">
            </div>

            <label class="col-sm-1 control-label">Vaginales</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="vaginales" value="{{ $data->vaginales }}" placeholder="vaginales" data-toggle="tooltip" data-placement="bottom" title="vaginales">
            </div>

            <label class="col-sm-1 control-label">Nac.Vivos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="vivos" value="{{ $data->vivos }}" placeholder="vivos" data-toggle="tooltip" data-placement="bottom" title="vivos">
            </div>

              <label class="col-sm-1 control-label">Nac.Muertoss</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="muertos" value="{{ $data->muertos }}" placeholder="muertos" data-toggle="tooltip" data-placement="bottom" title="muertos">
            </div>

              <label class="col-sm-1 control-label">Viven</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="viven" value="{{ $data->viven }}" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
            </div>

              <label class="col-sm-1 control-label">Mueren.1Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="semana1" value="{{ $data->semana1 }}" placeholder="semana1" data-toggle="tooltip" data-placement="bottom" title="semana1">
            </div>

              <label class="col-sm-1 control-label">Despues.1Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="semana2" value="{{ $data->semana2 }}"  placeholder="semana2" data-toggle="tooltip" data-placement="bottom" title="semana2">
            </div>

              <label class="col-sm-1 control-label">Cesarea</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="cesaria" value="{{ $data->cesaria }}" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
            </div>

            <label class="col-sm-1 control-label">Partos</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="parto" value="{{ $data->parto }}" placeholder="parto" data-toggle="tooltip" data-placement="bottom" title="parto">
            </div>

              <label class="col-sm-1 control-label">0 ó +3</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="num" value="{{ $data->num }}" placeholder="" data-toggle="tooltip" data-placement="bottom" title="">
            </div>

            <label class="col-sm-1 control-label">250gr</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gr" value="{{ $data->gr }}"  placeholder="250gr" data-toggle="tooltip" data-placement="bottom" title="250gr">
            </div>

            <label class="col-sm-1 control-label">Gemelar</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gemelar" value="{{ $data->gemelar }}"  placeholder="gemelar" data-toggle="tooltip" data-placement="bottom" title="gemelar">
            </div>
                        <label class="col-sm-3 control-label">37 Sem.</label>
            <div class="col-sm-5">
              <input type="text" class="form-control" name="m37m" value="{{ $data->m37m }}" placeholder="m37m" data-toggle="tooltip" data-placement="bottom" title="m37m">
            </div>

            <br><br>
            <h3>Fin Gestacion Anterior</h3>
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
            <input type="date" name="fecha_terminacion" value="{{ $data->fecha_terminacion }}"  style="line-height: 20px">
            <br>
            <label for="">Si fue aborto que tipo de aborto</label>
            <p>

              <label for="">RN de mayor peso</label>
            <input type="text" name="peso_gestacion" value="{{ $data->peso_gestacion }}" >Gr
            <br>

          <h3>Antecedentes Familiares</h3>
              <p>
              <input type="checkbox" name="ninguno_af" value="{{ $data->ninguno_af }}" >Ninguno
              <input type="checkbox" name="alergias_af" value="{{ $data->alergias_af }}">Alergias  
              <input type="checkbox" name="anomalias_af" value="{{ $data->anomalias_af }}">Anomalias Congenitas
              <input type="checkbox" name="epilepsia_af" value="{{ $data->epilepsia_af }}">Epilepsia
              <input type="checkbox" name="diabetes_af" value="{{ $data->diabetes_af }}">Diabetes
              <input type="checkbox" name="gemelares_af" value="{{ $data->gemelares_af }}">Gemelares
              <input type="checkbox" name="tension_af" value="{{ $data->tension_af }}">Hipertension Arterial
              <input type="checkbox" name="neoplasia_af" value="{{ $data->neoplasia_af }}">Neoplasia
              <input type="checkbox" name="pulmon_af" value="{{ $data->pulmon_af }}">TBC Pulmonar
              <input type="checkbox" name="otro_af" value="{{ $data->otro_af }}">Otro
            </p>
            <br>

              <h3>Antecedentes Personales</h3>
              <p>
              <input type="checkbox" name="ninguno_ap" value="{{ $data->ninguno_ap }}">Ninguno
              <input type="checkbox" name="aborto_ap" value="{{ $data->aborto_ap }}">Aborto Habitual 
              <input type="checkbox" name="aborto2_ap" value="{{ $data->aborto2_ap }}">Aborto Recurrente
              <input type="checkbox" name="alcohol_ap" value="{{ $data->alcohol_ap }}">Alcoholismo
              <input type="checkbox" name="alermedicamentos_ap" value="{{ $data->alermedicamentos_ap }}">Alergia a Medicamentos
              <input type="checkbox" name="asmabron_ap" value="{{ $data->asmabron_ap }}">Asma Bronquial
              <input type="checkbox" name="pesonacimiento_ap" value="{{ $data->pesonacimiento_ap }}">Bajo de peso al nacer
              <input type="checkbox" name="cardiopatia_ap" value="{{ $data->cardiopatia_ap }}">Cardiopatia
              <input type="checkbox" name="cirugiauterina_ap" value="{{ $data->cirugiauterina_ap }}">Cirugia Uterina
            </p>

            <p>
              <input type="checkbox" name="congenitas_ap" value="{{ $data->congenitas_ap }}">Enfermedades Congenitas
              <input type="checkbox" name="infeccion_ap" value="{{ $data->infeccion_ap }}">Enfermedades Infecciosas
              <input type="checkbox" name="epilepsia_ap" value="{{ $data->epilepsia_ap }}">Epilepsia
              <input type="checkbox" name="hemorragiapost_ap" value="{{ $data->hemorragiapost_ap }}">Hemorragia Postparto
              <input type="checkbox" name="htarterial_ap" value="{{ $data->htarterial_ap }}">Hipertension Arterial
              <input type="checkbox" name="coca_ap" value="{{ $data->coca_ap }}">Hoja de coca
              <input type="checkbox" name="infertilidad_ap" value="{{ $data->infertilidad_ap }}">Infertilidad
              <input type="checkbox" name="neoplasias_ap" value="{{ $data->neoplasias_ap }}">Neoplasias
              <input type="checkbox" name="drogas_ap" value="{{ $data->drogas_ap }}">Drogas
 
            </p>

            <p>
              <input type="checkbox" name="partoprolongado_ap" value="{{ $data->partoprolongado_ap }}">Parto Prolongado
              <input type="checkbox" name="eclampsia_ap" value="{{ $data->eclampsia_ap }}">Pre/Eclampsia
              <input type="checkbox" name="prematuro_ap" value="{{ $data->prematuro_ap }}">Prematuridad
              <input type="checkbox" name="placenta_ap" value="{{ $data->placenta_ap }}">Retencion Placenta
              <input type="checkbox" name="tabaco_ap" value="{{ $data->tabaco_ap }}">Tabaco
              <input type="checkbox" name="pulmonar_ap" value="{{ $data->pulmonar_ap }}">TBC Pulmonar
              <input type="checkbox" name="sida_ap" value="{{ $data->sida_ap }}">VIH/SIDA
              <input type="checkbox" name="otro_ap" value="{{ $data->otro_ap }}">Otro
            
            </p>
            <br>
            <h3>Peso y Talla</h3>
            <label for="">Peso Pregestacional</label>
            <input type="text" name="peso_pregestacional" value="{{ $data->peso_pregestacional }}">
            <label for="">Talla (Cm)</label>
            <input type="text" name="talla_pregestacional" value="{{ $data->talla_pregestacional }}">

            <h3>Antitetanica</h3>
            <label for="">Numero de dosis previa</label>
            <input type="text" name="dosis_previa" value="{{ $data->dosis_previa }}">
            <label for="">Primera Dosis</label>
            <input type="text" name="primera_dosis" value="{{ $data->primera_dosis }}">
            <label for="">Segunda Dosis</label>
            <input type="text" name="segunda_dosis" value="{{ $data->segunda_dosis }}">

            <h3>Tipo de sangre</h3>   
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
            <input type="text" name="sesion_sangre" value="{{ $data->sesion_sangre }}">

            <h3>F.U.M</h3>
            <label for="">Fecha Ultima Menstruacion</label>
            <input type="date" name="ultima_menstruacion" value="{{ $data->ultima_menstruacion }}" style="line-height: 20px">
            <label for="">Fecha Probable de Parto</label>
            <input type="date" name="parto_probable" value="{{ $data->parto_probable }}" style="line-height: 20px">
            <label for="">Eco: EG</label>
            <input type="date" name="eco_eg" value="{{ $data->eco_eg }}" style="line-height: 20px">   

            <h3>Serologia</h3>
            <label for="">1</label>
              <p>
                <input type="radio" name="1era" value="negativo">Negativo
                <input type="radio" name="1era" value="positivo">Positivo 
                <input type="radio" name="1era" value="no">No se hizo
                <input type="date" name="serologia_1era" value="{{ $data->serologia_1era }}" style="line-height: 20px">
            </p>  
            <label for="">2</label>
              <p>
                <input type="radio" name="2da" value="negativo">Negativo
                <input type="radio" name="2da" value="positivo">Positivo  
                <input type="radio" name="2da" value="no">No se hizo
                <input type="date" name="serologia_2da" value="{{ $data->serologia_2da }}" style="line-height: 20px">
            </p>

            <h3>Hemologbina</h3>
            <label for="">Hb (g %)</label>
            <input type="text" name="hemoglobina" value="{{ $data->hemoglobina }}">
            <label for="">No se hizo </label>
            <input type="checkbox" name="hemoglobina_no" value="{{ $data->hemoglobina_no }}">
            <label for="">Fecha</label>
            <input type="date" name="hemoglobina_fecha" value="{{ $data->hemoglobina_fecha }}" style="line-height: 20px">    

            <h3>Examenes</h3>
            <label for="">Clinico</label>     
            <p>
                <input type="radio" name="clinica" value="clinico_no">Sin Examen 
                <input type="radio" name="clinica" value="clinico_normal">Normal  
                <input type="radio" name="clinica" value="clinico_patologico">Patologico              
            </p>    
            <label for="">Mamas</label>     
            <p>
                <input type="radio" name="mamas"  value="{{ $data->mamas_no }}">Sin Examen 
                <input type="radio" name="mamas" value="{{ $data->mamas_normal }}>Normal  
                <input type="radio" name="mamas" value="{{ $data->mamas_anormal }}>Anormal              
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

            <h3>Patologia Materna (CIE 10)</h3>
            <label for="">1</label>
            <input type="text" name="patologia_1">
            <input type="date" name="patologia_1_date" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_1_otro">
            <br>    
            <label for="">2</label>
            <input type="text" name="patologia_2">
            <input type="date" name="patologia_2_date" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_2_otro"> 
            <br>
            <label for="">3</label>
            <input type="text" name="patologia_3">
            <input type="date" name="patologia_3_date" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_3_otro"> 

            <h3>Terminacion</h3>
            <label for="">Fecha</label>
            <input type="date" name="fecha_terminacion" style="line-height: 20px">
              <p>
                <input type="radio" name="terminacion" value="Espontanea">Espontanea
                <input type="radio" name="terminacion" value="Cesarea">Cesarea  
                <input type="radio" name="terminacion" value="Forceps">Forceps
                <input type="radio" name="terminacion" value="Vacumm">Vacumm
              </p>  

            <h3>Atencion</h3>
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

              <h3>Recien Nacido</h3>
              <label for="">Sexo</label>
              <p>
                <input type="radio" name="sexo_nacido" value="Femenino">Femenino
                <input type="radio" name="sexo_nacido" value="Masculino">Masculino  
              </p>

              <label class="col-sm-1 control-label">Talla</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="talla_nacido" placeholder="Talla" data-toggle="tooltip" data-placement="bottom" title="Talla">
            </div>

            <label class="col-sm-1 control-label">Peso</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="peso_nacido" placeholder="Peso" data-toggle="tooltip" data-placement="bottom" title="Peso">
            </div>
            <label class="col-sm-1 control-label">P.Cef</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="cef_nacido" placeholder="P.Cef" data-toggle="tooltip" data-placement="bottom" title="P.Cef">
            </div>
            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="temp_nacido" placeholder="Temperatura" data-toggle="tooltip" data-placement="bottom" title="Temperatura">
            </div>
              <br>
            <label class="col-sm-1 control-label">No.HcRN.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="no_rn" placeholder="No. Hc RN" data-toggle="tooltip" data-placement="bottom" title="No. Hc RN">
            </div>
            <label class="col-sm-1 control-label">NombreRN.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre_rn" placeholder="NombreRN" data-toggle="tooltip" data-placement="bottom" title="NombreRN">
            </div>
            <label class="col-sm-1 control-label">Edad.Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="edad_semanas" placeholder="Edad por semanas" data-toggle="tooltip" data-placement="bottom" title="Edad por semanas">
            </div>
            
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
              1 <input type="text" name="patologia_recien_1"> <input type="date" name="patologia_recien_1_date" value="{{ $data->patologia_recien_1_date }}" style="line-height: 20px"><br>
              2 <input type="text" name="patologia_recien_2"> <input type="date" name="patologia_recien_2_date" value="{{ $data->patologia_recien_2_date }}" style="line-height: 20px"><br>            
              3 <input type="text" name="patologia_recien_3"> <input type="date" name="patologia_recien_3_date" value="{{ $data->patologia_recien_3_date }}"  style="line-height: 20px"><br>
              <label for="">Otros (CIE 10)</label>  
              <br>
              1 <input type="text" name="otros_cie1_10" value="{{ $data->otros_cie1_10 }}"><br>
              2 <input type="text" name="otros_cie2_10" value="{{ $data->otros_cie2_10 }}"><br>                                                              
      
@endsection