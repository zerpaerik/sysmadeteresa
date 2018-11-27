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
              <input type="text" name="terminacion_gestacion" value="{{$data->terminacion_gestacion}}">           
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
              @if($data->ninguno_af)
              <input type="text" name="ninguno_af" value="SI">Ninguno<br>         
              @else
              <input type="text" name="otro_ap" value="NO">Ninguno<br>
              @endif
              @if($data->alergias_af)
              <input type="text" name="alergias_af" value="SI">Alergias<br>
              @else
              <input type="text" name="otro_ap" value="NO">Alergias<br>
              @endif
              @if($data->anomalias_af)
              <input type="text" name="anomalias_af" value="SI">Anomalias Congenitas<br>
              @else
              <input type="text" name="otro_ap" value="NO">Anomalias Congenitas<br>
              @endif
              @if($data->epilepsia_af)
              <input type="text" name="epilepsia_af" value="SI">Epilepsia<br>         
              @else
              <input type="text" name="otro_ap" value="NO">Epilepsia<br>
              @endif
              @if($data->diabetes_af)
              <input type="text" name="diabetes_af" value="SI">Diabetes<br>         
              @else
              <input type="text" name="otro_ap" value="NO">Diabetes<br>
              @endif
              @if($data->gemelares_af)
              <input type="text" name="gemelares_af" value="SI">Gemelares<br>         
              @else
              <input type="text" name="otro_ap" value="NO">Gemelares<br>
              @endif
              @if($data->tension_af)
              <input type="text" name="tension_af" value="SI">Hipertension Arterial<br>
              @else
              <input type="text" name="otro_ap" value="NO">Hipertension Arterial<br>
              @endif
              @if($data->neoplasia_af)
              <input type="text" name="neoplasia_af" value="SI">Neoplasia<br>         
              @else
              <input type="text" name="otro_ap" value="NO">Neoplasia<br>
              @endif
              @if($data->pulmon_af)
              <input type="text" name="pulmon_af" value="SI">TBC Pulmonar<br>
              @else
              <input type="text" name="otro_ap" value="NO">TBC Pulmonar<br>
              @endif
              @if($data->otro_af)
              <input type="text" name="otro_af" value="SI">Otro<br> 
              @else
              <input type="text" name="otro_ap" value="NO">Otro<br>
              @endif

              <h3>Antecedentes Personales</h3>
              @if($data->ninguno_ap)
              <input type="text" name="ninguno_ap" value="SI">Ninguno <br>
              @else
              <input type="text" name="otro_ap" value="NO">Ninguno<br>
              @endif
              @if($data->aborto_ap)
              <input type="text" name="aborto_ap" value="SI">Aborto Habitual <br>
              @else
              <input type="text" name="otro_ap" value="NO">Aborto Habitual <br>
              @endif
              @if($data->aborto2_ap)
              <input type="text" name="aborto2_ap" value="SI">Aborto Recurrente<br>
              @else
              <input type="text" name="otro_ap" value="NO">Aborto Recurrente<br>
              @endif
              @if($data->alcohol_ap)
              <input type="text" name="alcohol_ap" value="SI">Alcoholismo<br>
              @else
              <input type="text" name="otro_ap" value="NO">Alcoholismo<br>
              @endif
              @if($data->alermedicamentos_ap)
              <input type="text" name="alermedicamentos_ap" value="SI">Alergia a Medicamentos<br>
              @else
              <input type="text" name="otro_ap" value="NO">Alergia a Medicamentos<br>
              @endif
              @if($data->asmabron_ap)
              <input type="text" name="asmabron_ap" value="SI">Asma Bronquial<br>
              @else
              <input type="text" name="otro_ap" value="NO">Asma Bronquial<br>
              @endif
              @if($data->pesonacimiento_ap)
              <input type="text" name="pesonacimiento_ap" value="SI">Bajo de peso al nacer<br>
              @else
              <input type="text" name="otro_ap" value="NO">Bajo de peso al nacer<br>
              @endif
              @if($data->cardiopatia_ap)
              <input type="text" name="cardiopatia_ap" value="SI">Cardiopatia<br>
              @else
              <input type="text" name="otro_ap" value="NO">Cardiopatia<br>
              @endif
              @if($data->cirugiauterina_ap)
              <input type="text" name="cirugiauterina_ap" value="SI">Cirugia Uterina<br>
              @else
              <input type="text" name="otro_ap" value="NO">Cirugia Uterina<br>
              @endif

              @if($data->congenitas_ap)
              <input type="text" name="congenitas_ap" value="SI">Enfermedades Congenitas<br>
              @else
              <input type="text" name="otro_ap" value="NO">Enfermedades Congenitas<br>
              @endif
              @if($data->infeccion_ap)
              <input type="text" name="infeccion_ap" value="SI">Enfermedades Infecciosas<br>
              @else
              <input type="text" name="otro_ap" value="NO">Enfermedades Infecciosas<br>
              @endif
              @if($data->epilepsia_ap)
              <input type="text" name="epilepsia_ap" value="SI">Epilepsia<br>
              @else
              <input type="text" name="otro_ap" value="NO">Epilepsia<br>
              @endif
              @if($data->hemorragiapost_ap)
              <input type="text" name="hemorragiapost_ap" value="SI">Hemorragia Postparto<br>
              @else
              <input type="text" name="otro_ap" value="NO">Hemorragia Postparto<br>
              @endif
              @if($data->htarterial_ap)
              <input type="text" name="htarterial_ap" value="SI">Hipertension Arterial<br>
              @else
              <input type="text" name="otro_ap" value="NO">Hipertension Arterial<br>
              @endif
              @if($data->coca_ap)
              <input type="text" name="coca_ap" value="SI">Hoja de coca<br>
              @else
              <input type="text" name="otro_ap" value="NO">Hoja de coca<br>
              @endif
              @if($data->infertilidad_ap)
              <input type="text" name="infertilidad_ap" value="SI">Infertilidad<br>
              @else
              <input type="text" name="otro_ap" value="NO">Infertilidad<br>
              @endif
              @if($data->neoplasias_ap)
              <input type="text" name="neoplasias_ap" value="SI">Neoplasias<br>
              @else
              <input type="text" name="otro_ap" value="NO">Neoplasias<br>
              @endif
              @if($data->drogas_ap)
              <input type="text" name="drogas_ap" value="SI">Drogas<br>
              @else
              <input type="text" name="otro_ap" value="NO">Drogas<br>
              @endif


              @if($data->partoprolongado_ap)
              <input type="text" name="partoprolongado_ap" value="SI">Parto Prolongado<br>
              @else
              <input type="text" name="otro_ap" value="NO">Parto Prolongado<br>
              @endif
              @if($data->eclampsia_ap)
              <input type="text" name="eclampsia_ap" value="SI">Pre/Eclampsia<br>
              @else
              <input type="text" name="otro_ap" value="NO">Pre/Eclampsia<br>
              @endif
              @if($data->prematuro_ap)
              <input type="text" name="prematuro_ap" value="SI">Prematuridad<br>
              @else
              <input type="text" name="otro_ap" value="NO">Prematuridad<br>
              @endif
              @if($data->placenta_ap)
              <input type="text" name="placenta_ap" value="SI">Retencion Placenta<br>
              @else
              <input type="text" name="otro_ap" value="NO">Retencion Placenta<br>
              @endif
              @if($data->tabaco_ap)
              <input type="text" name="tabaco_ap" value="SI">Tabaco<br>
              @else
              <input type="text" name="otro_ap" value="NO">Tabaco<br>
              @endif
              @if($data->pulmonar_ap)
              <input type="text" name="pulmonar_ap" value="SI">TBC Pulmonar<br>
              @else
              <input type="text" name="otro_ap" value="NO">TBC Pulmonar<br>
              @endif
              @if($data->sida_ap)
              <input type="text" name="sida_ap" value="SI">VIH/SIDA<br>
              @else
              <input type="text" name="otro_ap" value="NO">VIH/SIDA<br>
              @endif
              @if($data->otro_ap)
              <input type="text" name="otro_ap" value="SI">Otro<br>
              @else
              <input type="text" name="otro_ap" value="NO">Otro<br>
              @endif

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
                <input type="text" name="sangre" value="{{$data->sangre}}">
            </p>
            <label for="">RH</label>
              <p>
                <input type="text" name="sangre-rh" value="{{$data->sangre_rh}}">
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
                <input type="text" name="1era" value="{{ $data->s1era }}">
                <input type="date" name="serologia_1era" value="{{ $data->serologia_1era }}" style="line-height: 20px">
            </p>  
            <label for="">2</label>
              <p>
                <input type="text" name="2da" value="{{ $data->s2era }}">Negativo
                <input type="date" name="serologia_2da" value="{{ $data->serologia_2da }}" style="line-height: 20px">
            </p>

            <h3>Hemologbina</h3>
            <label for="">Hb (g %)</label>
            <input type="text" name="hemoglobina" value="{{ $data->hemoglobina }}">
            <label for="">No se hizo </label>
            <input type="text" name="hemoglobina_no" value="{{ $data->hemoglobina_no }}">
            <label for="">Fecha</label>
            <input type="date" name="hemoglobina_fecha" value="{{ $data->hemoglobina_fecha }}" style="line-height: 20px">    

            <h3>Examenes</h3>
            <label for="">Clinico</label>     
            <p>
                <input type="text" name="clinica" value="{{$data->clinica}}">
            </p>    
            <label for="">Mamas</label>     
            <p>
                <input type="text" name="mamas"  value="{{ $data->mamas }}">
            </p>  
            <label for="">Odontologia</label>     
            <p>
                <input type="text" name="odonto" value="{{ $data->odonto }}">
            </p>  
            <label for="">PAP</label>     
            <p>
                <input type="text" name="pap" value="{{ $data->pap}}">
            </p>
            <label for="">Orina</label>     
            <p>
                <input type="text" name="orina" value="{{ $data->orina}}">
            </p>
            <label for="">Glucosa</label>     
            <p>
                <input type="text" name="glucosa" value="{{ $data->glucosa}}">
            </p>  
            <label for="">HIV</label>     
            <p>
                <input type="text" name="hiv" value="{{$data->hiv}}">
            </p>  

            <label for="">BK en esputo</label>      
            <p>
                <input type="text" name="bk" value="{{$data->bk}}">  
            </p>
            <label for="">TORCH</label>     
            <p>
                <input type="text" name="torch" value="{{$data->torch}}">     
            </p>  

            <h3>Patologia Materna (CIE 10)</h3>
            <label for="">1</label>
            <input type="text" name="patologia_1" value="{{$data->patologia_1}}">
            <input type="date" name="patologia_1_date" value="{{$data->patologia_1_date}}" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_1_otro" value="{{$data->patologia_1_otro}}">
            <br>    
            <label for="">2</label>
            <input type="text" name="patologia_2" value="{{$data->patologia_2}}">
            <input type="date" name="patologia_2_date" value="{{$data->patologia_2_date}}" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_2_otro" value="{{$data->patologia_2_otro}}"> 
            <br>
            <label for="">3</label>
            <input type="text" name="patologia_3" value="{{$data->patologia_3}}">
            <input type="date" name="patologia_3_date" value="{{$data->patologia_3_date}}" style="line-height: 20px">
            <label for="">Otros(CIE 10)</label>
            <input type="text" name="patologia_3_otro" value="{{$data->patologia_3_otro}}"> 

            <h3>Terminacion</h3>
            <label for="">Fecha</label>
            <input type="date" name="fecha_terminacion" value="{{$data->fecha_terminacion}}"style="line-height: 20px">
            <input type="text" name="terminacion" value="{{$data->terminacion}}">

            <h3>Atencion</h3>
            <label for="">Nivel</label> 
            <p>
              <input type="text" name="nivel" value="{{$data->nivel}}">  
            </p>  
              <label for="">Medico</label>
              <p>
                <input type="text" name="medico_atencion" value="{{$data->medico_atencion}}">
              </p>
              <label for="">Obstetriz</label>
              <p>
                <input type="text" name="obstetriz_atencion" value="{{$data->obstetriz_atencion}}"> 
              </p>    
              <label for="">Interno</label>
              <p>
                <input type="text" name="interno_atencion" value="{{$data->interno_atencion}}"> 
              </p>  
              <label for="">Estudiante</label>
              <p>
                <input type="text" name="estudiante_atencion" value="{{$data->estudiante_atencion}}">  
              </p>  
              <label for="">Empirica</label>
              <p>
                <input type="text" name="empirica_atencion" value="{{$data->empirica_atencion}}">  
              </p>  
              <label for="">Aux de Enfermeria</label>
              <p>
                <input type="text" name="enfermeria_atencion" value="{{$data->enfermeria_atencion}}">  
              </p>  
              <label for="">Enfermera</label>
              <p>
                <input type="text" name="enfermera_atencion" value="{{$data->enfermera_atencion}}"> 
              </p>
              <label for="">Familiar</label>
              <p>
                <input type="text" name="familiar_atencion" value="{{$data->familiar_atencion}}">  
              </p>  
              <label for="">Otro</label>
              <p>
                <input type="text" name="otro_atencion" value="{{$data->otro_atencion}}">  
              </p>                                                                                                                

              <h3>Recien Nacido</h3>
              <label for="">Sexo</label>
              <input type="text" name="sexo_nacido" value="{{$data->sexo_nacido}}">

              <label class="col-sm-1 control-label">Talla</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="talla_nacido" value="{{$data->talla_nacido}}" placeholder="Talla" data-toggle="tooltip" data-placement="bottom" title="Talla">
            </div>

            <label class="col-sm-1 control-label">Peso</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="peso_nacido" value="{{$data->peso_nacido}}" placeholder="Peso" data-toggle="tooltip" data-placement="bottom" title="Peso">
            </div>
            <label class="col-sm-1 control-label">P.Cef</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="cef_nacido" value="{{$data->cef_nacido}}" placeholder="P.Cef" data-toggle="tooltip" data-placement="bottom" title="P.Cef">
            </div>
            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="temp_nacido" value="{{$data->temp_nacido}}" placeholder="Temperatura" data-toggle="tooltip" data-placement="bottom" title="Temperatura">
            </div>
              <br>
            <label class="col-sm-1 control-label">No.HcRN.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="no_rn" value="{{$data->no_rn}}" placeholder="No. Hc RN" data-toggle="tooltip" data-placement="bottom" title="No. Hc RN">
            </div>
            <label class="col-sm-1 control-label">NombreRN.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nombre_rn" value="{{$data->nombre_rn}}" placeholder="NombreRN" data-toggle="tooltip" data-placement="bottom" title="NombreRN">
            </div>
            <label class="col-sm-1 control-label">Edad.Sem</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="edad_semanas" value="{{$data->edad_semanas}}" placeholder="Edad por semanas" data-toggle="tooltip" data-placement="bottom" title="Edad por semanas">
            </div>
            
              <br>
              <label for="">Peso por edad Gestacion</label>
              <p>
                <input type="text" name="edad_gestacion" value="{{$data->edad_gestacion}}">
              </p>  
              <label for="">APGAR</label>
              <br>
              1 <input type="text" name="apgar_1" value="{{$data->apgar_1}}">
              <br>
              2 <input type="text" name="apgar_2" value="{{$data->apgar_2}}">  
              <br>
              <label for="">Patologia del recion nacido</label>
              <br>
              1 <input type="text" name="patologia_recien_1" value="{{$data->patologia_recien_1}}"> <input type="date" name="patologia_recien_1_date" value="{{ $data->patologia_recien_1_date }}" style="line-height: 20px"><br>
              2 <input type="text" name="patologia_recien_2" value="{{$data->patologia_recien_2}}"> <input type="date" name="patologia_recien_2_date" value="{{ $data->patologia_recien_2_date }}" style="line-height: 20px"><br>            
              3 <input type="text" name="patologia_recien_3" value="{{$data->patologia_recien_3}}"> <input type="date" name="patologia_recien_3_date" value="{{ $data->patologia_recien_3_date }}"  style="line-height: 20px"><br>
              <label for="">Otros (CIE 10)</label>  
              <br>
              1 <input type="text" name="otros_cie1_10" value="{{ $data->otros_cie1_10 }}"><br>
              2 <input type="text" name="otros_cie2_10" value="{{ $data->otros_cie2_10 }}"><br>                                                              
      
@endsection