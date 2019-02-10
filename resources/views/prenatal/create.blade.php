@extends('layouts.app')
@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Control Prenatal</strong></span>
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

	@if($prenatal)
	<h2>Control Prenatal Base de {{$paciente->nombres}} {{$paciente->apellidos}}</h2>
	<div class="row">
		    <strong><p>I. Antecedentes Obstètricos</p></strong>
			<p class="col-sm-2"><strong>Gestas:</strong> {{ $prenatal->gesta }}</p>
			<p class="col-sm-2"><strong>Aborto:</strong> {{ $prenatal->aborto }}</p>
		    <p class="col-sm-2"><strong>Vaginales:</strong> {{ $prenatal->vaginales }}</p>
		    <p class="col-sm-2"><strong>Nac.Vivos:</strong> {{ $prenatal->vivos }}</p>
		    <p class="col-sm-2"><strong>Nac.Muertoss:</strong> {{ $prenatal->muertos }}</p>
		    <p class="col-sm-2"><strong>Viven:</strong> {{ $prenatal->viven }}</p>
		    <p class="col-sm-2"><strong>Mueren.1Sem:</strong> {{ $prenatal->semana1 }}</p>
		    <p class="col-sm-2"><strong>Despues.1Sem:</strong> {{ $prenatal->semana2 }}</p>
		    <p class="col-sm-2"><strong>Cesarea:</strong> {{ $prenatal->cesaria }}</p>

		     <p class="col-sm-2"><strong>Partos:</strong> {{ $prenatal->parto }}</p>
		    <p class="col-sm-2"><strong>0 ó +3:</strong> {{ $prenatal->num }}</p>
		    <p class="col-sm-2"><strong>250gr:</strong> {{ $prenatal->gr }}</p>
		    <p class="col-sm-2"><strong>Gemelar:</strong> {{ $prenatal->gemelar }}</p>
		    <p class="col-sm-2"><strong>37 Sem.:</strong> {{ $prenatal->m37m }}</p>
		    <br>
	</div>
	<div class="row">
		<div class="col-md-6">
		    <strong><p>II. Antecedentes Familiares</p></strong>
		    {{ $prenatal->af }}
		 </div>
		   <div class="col-md-6">
		    <strong><p>II. Antecedentes Personales</p></strong>
		    		    {{ $prenatal->ap }}
		    </div>
    </div>

    <div class="row">
   <strong><p>III. Fin de Gestaciòn Anterior</p></strong>
   <div class="col-md-3">
   	<strong>Terminaciòn:</strong> {{ $prenatal->terminacion_gestacion }}
   	
   </div>

    <div class="col-md-3">

    <strong>Fecha:</strong> {{ $prenatal->fecha_terminacion }}

   	
   </div>

    <div class="col-md-3">

    <strong>Tipò de Aborto:</strong> {{ $prenatal->aborto_gestacion }}
   	
   </div>

    <div class="col-md-3">

    <strong>RN Mayor Peso:</strong>{{ $prenatal->peso_gestacion }}
   	
   </div>

    </div>

    <div class="row">
    <strong><p>IV. Peso y Talla</p></strong>
    	<div class="col-md-4">
    		<strong>Peso:</strong>{{ $prenatal->peso_pregestacional }}
    	</div>

    	<div class="col-md-4">
    		    		<strong>Talla:</strong>{{ $prenatal->peso_pregestacional }}

    	</div>
    	<div class="col-md-4">
    		   <strong>Conclusiòn:</strong>{{ $prenatal->talla_conclusion }}
    	</div>
    	
    </div>

<div class="row">
	<div class="col-md-6">
<strong><p>V. Tipo de Sangre</p></strong>	

	<div class="col-md-3">
		<strong>Grupo</strong>: {{ $prenatal->sangre }}
		
	</div>

	<div class="col-md-3">
		<strong>RH</strong>: {{ $prenatal->sangrerh }}
		
	</div>
	</div>

<div class="col-md-6">
			<strong><p>VI. F.U.M</p></strong>	

	<div class="col-md-3">
		<strong>FUM</strong>: {{ $prenatal->ultima_menstruacion }}
		
	</div>


	<div class="col-md-3">

	<strong>FPP</strong>: {{ $prenatal->parto_probable }}
		
	</div>

	<div class="col-md-3">

	<strong>ECO EG</strong>: {{ $prenatal->eco_eg }}
		
	</div>

	</div>
</div>

<div class="row">
	<strong><p>Examenes</p></strong>	

	<div class="col-md-2">

		<strong>Orina</strong>: {{ $prenatal->orina }}
		
	</div>

		<div class="col-md-2">
					<strong>Urea</strong>: {{ $prenatal->urea }}

		
	</div>

		<div class="col-md-2">

					<strong>Creatinina</strong>: {{ $prenatal->creatinina }}

		
	</div>

		<div class="col-md-2">

					<strong>BK</strong>: {{ $prenatal->bic }}

		
	</div>

		<div class="col-md-2">

					<strong>Torch</strong>: {{ $prenatal->torch }}

		
	</div>
	
</div>
<br>
   
   @foreach($control as $c)

   	<h2>Control Mensual de {{$paciente->nombres}} {{$paciente->apellidos}}</h2>
   	<h2>Fecha {{$c->created_at}}</h2>

   	 <div class="row">

            <label class="col-sm-1 control-label">Gestaciòn</label>
            <div class="col-sm-3">
              {{$c->gesta_semanas}}
            </div>

            <label class="col-sm-1 control-label">PesoMadre.</label>
            <div class="col-sm-3">
             
              {{$c->peso_madre}}
            </div>

            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-3">
              {{$c->temp}}
            </div>

            </div>
            <div class="row">

            <label class="col-sm-1 control-label">Tensiòn.</label>
            <div class="col-sm-3">
              {{$c->tension}}
            </div>

             <label class="col-sm-1 control-label">Alt.Ute.</label>
            <div class="col-sm-3">
            {{$c->altura_uterina}}
            </div>

            <label class="col-sm-1 control-label">Presentaciòn.</label>
            <div class="col-sm-3">
               {{$c->presentacion}}
            </div>

            </div>

                        <div class="row">


            <label class="col-sm-1 control-label">F.C.F.</label>
            <div class="col-sm-3">
              {{$c->fcf}}
            </div>

             <label class="col-sm-1 control-label">Movimiento.</label>
            <div class="col-sm-3">
               {{$c->movimiento_fetal}}
            </div>

             <label class="col-sm-1 control-label">Edema.</label>
            <div class="col-sm-3">
               {{$c->edema}}
            </div>
        </div>

                    <div class="row">


             <label class="col-sm-1 control-label">Pulso.</label>
            <div class="col-sm-3">
               {{$c->pulso_materno}}
            </div>


             <label class="col-sm-1 control-label">Consejeria</label>
            <div class="col-sm-3">
              {{$c->consejeria}}
            </div>


             <label class="col-sm-1 control-label">Sulfato.</label>
            <div class="col-sm-3">
              {{$c->sulfato}}
            </div>

        </div>

                    <div class="row">



             <label class="col-sm-1 control-label">Perfil.</label>
            <div class="col-sm-3">
              {{$c->perfil_biofisico}}
            </div>


             <label class="col-sm-1 control-label">Visita.</label>
            <div class="col-sm-3">
               {{$c->visita_domicilio}}
            </div>

             <label class="col-sm-1 control-label">Establ.</label>
            <div class="col-sm-3">
            
               {{$c->establecimiento_atencion}}
            </div>

        </div>

             <label class="col-sm-1 control-label">Responsable.</label>
            <div class="col-sm-3">

                             {{$c->responsable_control}}

            </div> 

            <label class="col-sm-1 control-label">Examenes.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 


            <label class="col-sm-1 control-label">.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 



          
                    <div class="row">



             <label class="col-sm-1 control-label">Serologia</label>
            <div class="col-sm-2">
            <strong>Resultado:</strong>:{{$c->sero}}
             <strong>Fecha:</strong>:{{$c->serod}}


            </div>


             <label class="col-sm-1 control-label">Glucosa</label>
            <div class="col-sm-2">
                 <strong>Resultado:</strong>:{{$c->glu}}
             <strong>Fecha:</strong>:{{$c->glud}}

            </div>

             <label class="col-sm-1 control-label">VIH</label>
            <div class="col-sm-2">
                  <strong>Resultado:</strong>:{{$c->vih}}
             <strong>Fecha:</strong>:{{$c->vihd}}

            </div>

               <label class="col-sm-1 control-label">Hemoglobina</label>
            <div class="col-sm-2">
                  <strong>Resultado:</strong>:{{$c->hemo}}
             <strong>Fecha:</strong>:{{$c->hemod}}

            </div>

        </div>
    </div>
</div>


   @endforeach


	@else
	<h4>Este usuario no cuenta con un historial base, por favor agregue uno</h4>
			<div class="box-content">	
				<form class="form-horizontal" role="form" method="post" action="prenatal/create">
					{{ csrf_field() }}

		             <input type="hidden" name="paciente" value="{{$paciente->id}}">
						<h3>I. Antecedentes Obstetricos</h3>

						<label class="col-sm-1 control-label">Gestas</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="gesta" placeholder="gesta" data-toggle="tooltip" data-placement="bottom" title="gesta">
						</div>

						<label class="col-sm-1 control-label">Aborto</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="aborto" placeholder="Noabortombres" data-toggle="tooltip" data-placement="bottom" title="aborto">
						</div>

						<label class="col-sm-1 control-label">Vaginales</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="vaginales" placeholder="vaginales" data-toggle="tooltip" data-placement="bottom" title="vaginales">
						</div>

						<label class="col-sm-1 control-label">Nac.Vivos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="vivos" placeholder="vivos" data-toggle="tooltip" data-placement="bottom" title="vivos">
						</div>

							<label class="col-sm-1 control-label">Nac.Muertoss</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="muertos" placeholder="muertos" data-toggle="tooltip" data-placement="bottom" title="muertos">
						</div>

							<label class="col-sm-1 control-label">Viven</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="viven" placeholder="viven" data-toggle="tooltip" data-placement="bottom" title="viven">
						</div>

							<label class="col-sm-1 control-label">Mueren.1Sem</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="semana1" placeholder="semana1" data-toggle="tooltip" data-placement="bottom" title="semana1">
						</div>

							<label class="col-sm-1 control-label">Despues.1Sem</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="semana2" placeholder="semana2" data-toggle="tooltip" data-placement="bottom" title="semana2">
						</div>

							<label class="col-sm-1 control-label">Cesarea</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cesaria" placeholder="cesarea" data-toggle="tooltip" data-placement="bottom" title="cesaria">
						</div>

						<label class="col-sm-1 control-label">Partos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="parto" placeholder="parto" data-toggle="tooltip" data-placement="bottom" title="parto">
						</div>

							<label class="col-sm-1 control-label">0 ó +3</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="num" placeholder="" data-toggle="tooltip" data-placement="bottom" title="">
						</div>

						<label class="col-sm-1 control-label">250gr</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="gr" placeholder="250gr" data-toggle="tooltip" data-placement="bottom" title="250gr">
						</div>

						<label class="col-sm-1 control-label">Gemelar</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="gemelar" placeholder="gemelar" data-toggle="tooltip" data-placement="bottom" title="gemelar">
						</div>
                        <label class="col-sm-3 control-label">37 Sem.</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="m37m" placeholder="m37m" data-toggle="tooltip" data-placement="bottom" title="m37m">
						</div>

					<br>

					<div class="row">

						<div class="col-md-6">


						   <h3>II. Antecedentes Familiares</h3>
					    <p>
							
                         <div class="col-sm-12">
							<select id="my-select" multiple="true" name="af[]" style="width: 350px;">
							<option value="Ninguno">Ninguno</option>
							<option value="Alergias">Alergias</option>
							<option value="Anomalias Congenitas">Anomalias Congenitas</option>
							<option value="Epilepsia">Epilepsia</option>
							<option value="Diabetes">Diabetes</option>
							<option value="Gemelares">Gemelares</option>
							<option value="Hipertension Arterial">Hipertension Arterial</option>
							<option value="Neoplasia">Neoplasia</option>
							<option value="TBC Pulmonar">TBC Pulmonar</option>
							<option value="Otro">Otro</option>
						    </select>
						</div>
						</p>

						          </div>

										<div class="col-md-6">


						   <h3>III. Antecedentes Personales</h3>
					    <p>
							
                         <div class="col-sm-12">
							<select id="my-select2" multiple="true" name="ap[]" style="width: 350px;">
							<option value="Ninguno">Ninguno</option>
							<option value="Alergias">Alergias</option>
							<option value="Anomalias Congenitas">Anomalias Congenitas</option>
							<option value="Epilepsia">Epilepsia</option>
							<option value="Diabetes">Diabetes</option>
							<option value="Gemelares">Gemelares</option>
							<option value="Hipertension Arterial">Hipertension Arterial</option>
							<option value="Neoplasia">Neoplasia</option>
							<option value="TBC Pulmonar">TBC Pulmonar</option>
							<option value="Otro">Otro</option>
						    </select>
						</div>
						</p>

						          </div>


          </div>

          <br>

          <div class="row">


						<h3>IV. Fin Gestacion Anterior</h3>
						          	<div class="col-md-3">

						<p>
							<select id="el12" name="terminacion_gestacion" style="width: 200px;">
							<option value="Parto">Parto</option>
							<option value="Aborto">Aborto</option>
							<option value="Ectopico">Ectopico</option>
							<option value="Molar">Molar</option>
							<option value="Otro">Otro</option>
							<option value="Noaplica">Noaplica</option>
						    </select>							
						</p>	

			</div>

			          	<div class="col-md-3">


						<label for="">Fecha</label>
						<input type="date" name="fecha_terminacion" style="line-height: 20px">
						<br>
					</div>

			          	<div class="col-md-3">

						<label for="">Si fue aborto que tipo de aborto</label>
						
							<select id="el12" name="aborto_gestacion" style="width: 200px;">
							<option value="Incompleto">Incompleto</option>
							<option value="Completo">Completo</option>
							<option value="Frustro">Frustro</option>
							<option value="Septico">Septico</option>
							<option value="Otro">Otro</option>
							<option value="Noaplica">Noaplica</option>
						    </select>
						
					</div>

				<div class="col-md-3">

						<label for="">RN de mayor peso</label>
						<input type="text" name="peso_gestacion">Gr
						<br>
					</div>

		</div>
                      
						<div class="row">
						<h3>V. Peso y Talla</h3>
						<div class="col-md-4">
						<label for="">Peso Gr.</label>
						<input type="text" name="peso_pregestacional">
					    </div>
					    <div class="col-md-4">
						<label for="">Talla (Cm)</label>
						<input type="text" name="talla_pregestacional">
						</div>

						<div class="col-md-4">
						<label for="">Conclusiòn</label>
						<select id="el12" name="conclusion" style="width: 200px;">
							<option value="0">Seleccione</option>
							<option value="Normal(18-24)">Normal(18-24)</option>
							<option value="Sobrepeso(25-29)">Sobrepeso(25-29)</option>
							<option value="ObesidadI(30-34)">ObesidadI(30-34)</option>
							<option value="ObesidadII(35-39)">ObesidadII(35-39)</option>

						</select>
						</div>

						</div>
						<br>

						<div class="row">
					<div class="col-md-4">		


						<h3>VI. Tipo de Sangre</h3>	
						<div class="col-md-2">	
						<label for="">Grupo</label>
							<p>

					    <select id="el12" name="sangre">
							<option value="A">A</option>
							<option value="B">B</option>
						     <option value="AB">AB</option>
							<option value="O">O</option>
						</select>
						</p>
					     </div>
					     <div class="col-md-2">
						<label for="">RH</label>
							<p>
							
							<select id="el12" name="sangrerh">
							<option value="Rh+">Rh+</option>
							<option value="Rh-Sen Desc">Rh-Sen Desc</option>
						     <option value="Rh-Nosen">Rh-Nosen</option>
							<option value="Rh-Sen">Rh-Sen</option>
						</select>
						</p>
					     </div>
					 </div>
					 <div class="col-md-8">

					     <h3>VI. F.U.M</h3>	

					     <div class="col-md-2">
                        <label for="">FUM</label>
						<input type="date" name="ultima_menstruacion" style="line-height: 20px">
					     </div>


					     <div class="col-md-2">
                        <label for="">FPP</label>
						<input type="date" name="parto_probable" style="line-height: 20px">
					     </div>

					      <div class="col-md-2">
                        <label for="">Eco: EG</label>
						<input type="date" name="eco_eg" style="line-height: 20px">	
					     </div>



					  </div>


					</div>

					<div class="row">

					<div class="col-md-2">

					<h3>Orina</h3>	
					<p>
							
							<select id="el12" name="orina">
							<option value="Normal">Normal</option>
							<option value="Anormal">Anormal</option>
						     <option value="No">No se hizO</option>
						</select>

						<input type="date" name="orinad" style="line-height: 20px">	
						</p>

					</div>	

					<div class="col-md-2">

					<h3>Urea</h3>	
					<p>
							
						<input type="text" name="urea" style="line-height: 20px">	

						<input type="date" name="uread" style="line-height: 20px">	
						</p>

					</div>	

					<div class="col-md-2">

					<h3>Creati.</h3>	
					<p>
							
						<input type="text" placeholder="creatinina" name="creatinina" style="line-height: 20px">	

						<input type="date" name="creatininad" style="line-height: 20px">	
						</p>

					</div>

					<div class="col-md-2">

					<h3>BK</h3>	
					<p>
							
							<select id="el12" name="bic">
							<option value="SinExamen">Sin Examen</option>
							<option value="Neg">Negativo</option>
						     <option value="Pos">Positivo</option>
						     <option value="N/A">N/A</option>
						</select>

						<input type="date" name="bicd" style="line-height: 20px">	
						</p>

					</div>	

					<div class="col-md-2">

					<h3>TORCH</h3>	
					<p>
							
							<select id="el12" name="torch">
							<option value="Normal">Normal</option>
							<option value="Anormal">Anormal</option>
						     <option value="No">No se hizO</option>
						</select>

						<input type="date" name="torchd" style="line-height: 20px">	
						</p>

					</div>		


						
					</div>



						
							<input type="button" onclick="form.submit()" class="btn btn-primary" value="Guardar">														
					</div>
					</div>																																																										
					</div>
				</div>
				</form>
			</div>	
		</div>
		@endif
	</div>
	   <div class="box-content"> 
        <form class="form-horizontal" role="form" method="post" action="control/create">
          {{ csrf_field() }}
          <div class="form-group">          
              <input type="hidden" name="evento" value="{{$evento->id}}">
            <h3>Control Prenatal Mensual de {{$paciente->nombres}} {{$paciente->apellidos}}</h3>
            <br>
            
             <input type="hidden" name="paciente" value="{{$paciente->id}}">
            <label for="">Fecha Control</label>
            <input type="date" name="fecha_cont" style="line-height: 20px"> 
            <br>  
            <div class="row">

            <label class="col-sm-1 control-label">Gestaciòn</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gesta_semanas" placeholder="Semanas de gestacion" data-toggle="tooltip" data-placement="bottom" title="gesta_semanas">
            </div>

            <label class="col-sm-1 control-label">PesoMadre.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="peso_madre" placeholder="Peso de Madre" data-toggle="tooltip" data-placement="bottom" title="m37m">
            </div>

            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="temp" placeholder="Temperatura" data-toggle="tooltip" data-placement="bottom" title="Temperatura">
            </div>

            </div>
            <div class="row">

            <label class="col-sm-1 control-label">Tensiòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="tension" placeholder="tension arterial" data-toggle="tooltip" data-placement="bottom" title="tension">
            </div>

             <label class="col-sm-1 control-label">Alt.Ute.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="altura_uterina" placeholder="Altura Uterina" data-toggle="tooltip" data-placement="bottom" title="altura uterina">
            </div>

            <label class="col-sm-1 control-label">Presentaciòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="presentacion" placeholder="presentacion" data-toggle="tooltip" data-placement="bottom" title="presentacion">
            </div>

            </div>

                        <div class="row">


            <label class="col-sm-1 control-label">F.C.F.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="fcf" placeholder="FCF" data-toggle="tooltip" data-placement="bottom" title="fcf">
            </div>

             <label class="col-sm-1 control-label">Movimiento.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="movimiento_fetal" placeholder="Movimiento Fetal" data-toggle="tooltip" data-placement="bottom" title="movimiento_fetal">
            </div>

             <label class="col-sm-1 control-label">Edema.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="edema" placeholder="Edema" data-toggle="tooltip" data-placement="bottom" title="edema">
            </div>
        </div>

                    <div class="row">


             <label class="col-sm-1 control-label">Pulso.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="pulso_materno" placeholder="Pulso Materno" data-toggle="tooltip" data-placement="bottom" title="pulso_materno">
            </div>


             <label class="col-sm-1 control-label">Consejeria</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="consejeria" placeholder="Consejeria PF" data-toggle="tooltip" data-placement="bottom" title="consejeria">
            </div>


             <label class="col-sm-1 control-label">Sulfato.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="sulfato" placeholder="Sulfato Ferroso" data-toggle="tooltip" data-placement="bottom" title="sulfato">
            </div>

        </div>

                    <div class="row">



             <label class="col-sm-1 control-label">Perfil.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="perfil_biofisico" placeholder="Perfil Biosfisico" data-toggle="tooltip" data-placement="bottom" title="perfil_biofisico">
            </div>


             <label class="col-sm-1 control-label">Visita.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="visita_domicilio" placeholder="Visita a domicilio" data-toggle="tooltip" data-placement="bottom" title="visita_domicilio">
            </div>

             <label class="col-sm-1 control-label">Establ.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="establecimiento_atencion" placeholder="Establecimiento de atencion" data-toggle="tooltip" data-placement="bottom" title="establecimiento_atencion">
            </div>

        </div>

             <label class="col-sm-1 control-label">Responsable.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="responsable_control" placeholder="Responsable de Control" data-toggle="tooltip" data-placement="bottom" title="responsable_control">
            </div> 

            <label class="col-sm-1 control-label">Examenes.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 


            <label class="col-sm-1 control-label">.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="EXAMENES" placeholder="EXAMENES" data-toggle="tooltip" data-placement="bottom" title="responsable_control" readonly="true">
            </div> 



          
                    <div class="row">



             <label class="col-sm-1 control-label">Serologia</label>
            <div class="col-sm-3">
             <select id="el12" name="sero">
							<option value="Negativo">Negativo</option>
							<option value="Positivo">Positivo</option>
						     <option value="No">No se hizO</option>
			</select>
				<input type="date" name="serod" style="line-height: 20px">	

            </div>


             <label class="col-sm-1 control-label">Glucosa</label>
            <div class="col-sm-3">
               <select id="el12" name="gluco">
							<option value="Normal">Normal</option>
							<option value="Anormal">Anormal</option>
						     <option value="No">No se hizo</option>
			</select>
							<input type="date" name="glucod" style="line-height: 20px">	

            </div>

             <label class="col-sm-1 control-label">VIH</label>
            <div class="col-sm-3">
               <select id="el12" name="vih">
							<option value="Positivo">Positivo</option>
							<option value="Negativo">Negativo</option>
						     <option value="No">No se hizO</option>
			</select>
							<input type="date" name="vihd" style="line-height: 20px">	

            </div>

        </div>

           <div class="row">



             <label class="col-sm-1 control-label">Hemoglobina</label>
            <div class="col-sm-3">
             	<input type="text" name="hemo" style="line-height: 20px">gr/dl	
				<input type="date" name="hemod" style="line-height: 20px">	

            </div>


          </div>

        </div>


            <br>
            <div class="col-sm-3">
            <input type="button" onclick="form.submit()" class="btn btn-primary" value="Guardar">  
            </div>                         
          </div>
          </div> 
      </form>
  </div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('plugins/multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>



<script type="text/javascript">

// Run Select2 on element
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
  $("#el4").select2();
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	LoadTimePickerScript(DemoTimePicker);
	WinMove();
});

function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
	$('#input_time').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
	$('#input_time2').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
}

</script>
<script type="text/javascript">

$('#my-select').multiSelect()
$('#my-select2').multiSelect()



</script>



   
@endsection	
@endsection