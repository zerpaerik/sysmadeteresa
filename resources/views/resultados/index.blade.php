@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Resultados/Redactar Servicios</span>

				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>

			{!! Form::open(['method' => 'get', 'route' => ['resultados.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
					{!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha2'))
					<p class="help-block">
						{{ $errors->first('fecha2') }}
					</p>
					@endif
				</div>
                        <div class="col-md-3">
                              {!! Form::label('name', '*', ['class' => 'control-label']) !!}
                            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Buscar por Detalle']) !!}
                            <p class="help-block"></p>
                            @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                          </p>
                          @endif
                    </div>
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Servicio</th>
							<th width="40%">Informe</th>
							<th>Acciones:</th>
							


						</tr>
					</thead>
					<tbody>
					@foreach($data as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->created_at}}</td>
						<td>{{$p->apellidos}},{{$p->nombres}}</td>
						<td>{{$p->lastname}},{{$p->name}}</td>
						<td>{{$p->servicio}}</td>
						
					
						  
							@if($p->informe)
						<td>

					    <a href="resultados-desoc-{{$p->id}}" class="btn btn-success">Reversar</a>
	
						<a href="/modelo-informe-{{$p->id}}-{{$p->informe}}" class="btn btn-primary" target="_blank">Descargar Modelo</a>
							
						<td><a class="btn btn-primary" href="/resultados-guardar-{{$p->id}}">Adjuntar Informe</a></td>

							@else
								<td>
					<form action="{{$model . '-asoc-' .$p->id}}" method="get">
					     <select id="el2" name="informe">
						<option value="">Seleccione</option>
                                    @if(Session::get('sedeName') == 'VIDA FELIZ')

                                    <option value="ABDOMEN COLECISTITIS CRONICA FASE AGUDA-V.docx">ABDOMEN COLECISTITIS CRONICA FASE AGUDA-V</option>
                                    <option value="ABDOMEN COLECISTITIS CRONICA-V.docx">ABDOMEN COLECISTITIS CRONICA-V</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, CCC-V.docx">ABDOMEN ESTEATOSIS LEVE, CCC-V</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, SVB-V.docx">ABDOMEN ESTEATOSIS LEVE, SVB-V</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE-V.docx">ABDOMEN ESTEATOSIS LEVE-V</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA, SVB-V.docx">ABDOMEN ESTEATOSIS MODERADA, SVB-V</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA,PANCREAS INUSUAL-V.docx">ABDOMEN ESTEATOSIS MODERADA,PANCREAS INUSUAL-V</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA-V.docx">ABDOMEN ESTEATOSIS MODERADA-V</option>
                                    <option value="ABDOMEN NRML-V.docx">ABDOMEN NRML-V</option>
                                    <option value="ABDOMEN POLIPO VB-V.docx">ABDOMEN POLIPO VB-V</option>
                                    <option value="ABDOMEN POLIPOSIS VB-V.docx">ABDOMEN POLIPOSIS VB-V</option>
                                    <option value="ABDOMEN STATUS POST COLECISTECTOMIA-V.docx">ABDOMEN STATUS POST COLECISTECTOMIA-V</option>
                                     <option value="COLPOSCOPIA POSITIVO.docx">COLPOSCOPIA POSITIVO-V</option>
                                      <option value="COLPO NEGATIVO.docx">COLPOSCOPIANEGATIVO-V</option>
                                    <option value="GIN EPI-V.docx">GIN EPI-V</option>
                                    <option value="GIN NRML-V.docx">GIN NRML-V</option>
                                    <option value="GIN POLIFOL, EPI-V.docx">GIN POLIFOL, EPI-V</option>
                                    <option value="GIN POLIFOL-V.docx">GIN POLIFOL-V</option>
                                    <option value="GIN TV AMNRR-V.docx">GIN TV AMNRR-V</option>s
                                    <option value="GIN TV CONSIDERAR AB EN CURSO-V.docx">GIN TV CONSIDERAR AB EN CURSO-V</option>
                                    <option value="GIN TV DIU NRML-V.docx">GIN TV DIU NRML-V</option>
                                    <option value="GIN TV DIU SITUACION BAJA-V.docx">GIN TV DIU SITUACION BAJA-V</option>
                                    <option value="GIN TV INVOLUTIVO-V.docx">GIN TV INVOLUTIVO-V</option>
                                    <option value="GIN TV DIU SITUACION BAJA-V.docx">GIN TV DIU SITUACION BAJA-V</option>
                                    <option value="GIN TV MIOMATOSIS-V.docx">GIN TV MIOMATOSIS-V</option>
                                    <option value="GIN TV NRML-V.docx">GIN TV NRML-V</option>

                                    <option value="GIN TV OV MORFOLOGIA POLIQUISTICA-V.docx">GIN TV OV MORFOLOGIA POLIQUISTICA-V</option>
                                    <option value="GIN TV POLIFOL, EPI-V.docx">GIN TV POLIFOL, EPI-V</option>
                                    <option value="GIN TV POLIFOL-V.docx">GIN TV POLIFOL-V</option>
                                    <option value="GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION-V.docx">GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION-V</option>
                                    <option value="GIN TV SEGUIMIENTO OVULATORIO NRML-V.docx">GIN TV SEGUIMIENTO OVULATORIO NRML-V</option>
                                    <option value="GIN TV SITUACION INDETERMIDA BETA +-V.docx">GIN TV SITUACION INDETERMIDA BETA +-V</option>
                                    <option value="MAMAS FIBROADENOMA MAMA DER-V.docx">MAMAS FIBROADENOMA MAMA DER-V</option>
                                    <option value="MAMAS FIBROADENOMA MAMA IZQ-V.docx">MAMAS FIBROADENOMA MAMA IZQ-V</option>
                                    <option value="MAMAS QT SIMPLE MAMA DER-V.docx">MAMAS QT SIMPLE MAMA DER-V</option>
                                    <option value="MAMAS QT SIMPLE MAMA IZQ-V.docx">MAMAS QT SIMPLE MAMA IZQ-V</option>
                                    <option value="MAMAS-V.docx">MAMAS-V</option>
                                    <option value="OBST 4D II TRIMESTRE-V.docx">OBST 4D TRIMESTRE-V</option>
                                    <option value="OBST 4D III TRIMESTRE CC-V.docx">OBST 4D III TRIMESTRE CC-V</option>
                                    <option value="OBST 4D III TRIMESTRE-V.docx">OBST 4D III TRIMESTRE-V</option>
                                   
                                    <option value="OBST DOPPLER TAMIZAJE II TRIMESTRE-V.docx">OBST DOPPLER TAMIZAJE II TRIMESTRE-V</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE BICO, BIAMN-V.docx">OBST GEMELAR II, III TRIMESTRE BICO, BIAMN-V-V</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE MONOCO, BIAMN-V.docx">OBST GEMELAR II, III TRIMESTRE MONOCO, BIAMN-V-V</option>
                                    <option value="OBST I EMBRION 6 - 8 SEMANAS-V.docx">OBST I EMBRION 6 - 8 SEMANAS-V-V</option>
                                    <option value="OBST I EMBRION 9 SEMANAS-V.docx">OBST I EMBRION 9 SEMANAS-V-V</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE BICO, BIAMN-V.docx">OBST GEMELAR II, III TRIMESTRE BICO, BIAMN-V</option>
                                    <option value="OBST I EMBRION 6 - 8 SEMANAS-V.docx">OBST I EMBRION 6 - 8 SEMANAS-V</option>
                                    <option value="OBST I EMBRION 9 SEMANAS-V.docx">OBST I EMBRION 9 SEMANAS-V</option>
                                    <option value="OBST I FETO 10 - 11SS-V.docx">OBST I FETO 10 - 11SS-V</option>
                                    <option value="OBST I FETO 12 - 14SS-V.docx">OBST I FETO 12 - 14SS-V</option>
                                   
                                    <option value="OBST I TV DOPPLER TAMIZAJE-V.docx">OBST I TV DOPPLER TAMIZAJE-V</option>
                                    <option value="OBST I TV FETO 10 - 11SS DOBLE BIAMN BICOR-V.docx">OBST I TV FETO 10 - 11SS DOBLE BIAMN BICOR-V</option>
                                    <option value="OBST I TV FETO 10 - 11SS DOBLE BIAMN MONOCOR-V.docx">OBST I TV FETO 10 - 11SS DOBLE BIAMN MONOCOR-V</option>

                                    <option value="OBST I TV FETO 10 - 11SS-V.docx">OBST I TV FETO 10 - 11SS-V</option>
                                    <option value="OBST I TV FETO 12 - 14SS-V.docx">OBST I TV FETO 12 - 14SS-V</option>
                                    <option value="OBST I TV NO EVOLUTIVO LCN-V.docx">OBST I TV NO EVOLUTIVO LCN-V</option>
                                    <option value="OBST I TV NO EVOLUTIVO SG-V.docx">OBST I TV NO EVOLUTIVO SG-V</option>
                                    <option value="OBST I TV NO EVOLUTIVO vs VIABILIDAD SG-V.docx">OBST I TV NO EVOLUTIVO vs VIABILIDAD SG-V</option>
                                    <option value="OBST I TV UTERO BICORNE-V.docx">OBST I TV UTERO BICORNE-V</option>
                                    <option value="OBST I TV, GEST TEMPR, EPI-V.docx">OBST I TV, GEST TEMPR, EPI-V</option>
                                    <option value="OBST II-V.docx">OBST II-V</option>
                                    <option value="OBST III DISCORDANTE DC CIR TIPO II, CC-V.docx">OBST III DISCORDANTE DC CIR TIPO II, CC-V</option>
                                    <option value="OBST III DISCORDANTE DC CIR TIPO II-V.docx">OBST III DISCORDANTE DC CIR TIPO II-V</option>
                                    <option value="OBST III DOPPLER NIVEL II CC-V.docx">OBST III DOPPLER NIVEL II CC-V-V</option>
                                    <option value="OBST III DOPPLER NIVEL II-V.docx">OBST III DOPPLER NIVEL II-V-V</option>

                                    <option value="OBST III DOPPLER NIVEL II-3p-V.docx">OBST III DOPPLER NIVEL II-3p-V</option>
                                    <option value="OBST III PB SOSPECHA DE CC-V.docx">OBST III PB SOSPECHA DE CC-V-V</option>
                                    <option value="OBST III TRIMESTRE SOSPECHA DE CC-V.docx">OBST III TRIMESTRE SOSPECHA DE CC-V-V</option>

                                    <option value="OBST III PB-V.docx">OBST III PB-V</option>
                                    <option value="OBST III TRIMESTRE CIRCULAR DE CORDON-V.docx">OBST III TRIMESTRE CIRCULAR DE CORDON-V</option>
                                    <option value="OBST III-V.docx">OBST III-V</option>
                                    <option value="OBST MORFOLOGICA II TRIMESTRE-V.docx">OBST MORFOLOGICA II TRIMESTRE-2p-V</option>
                                    <option value="PB CADERAS NRML-V.docx">PB CADERAS NRML-V</option>
                                    <option value="PB INGLE NRML, HERNIA POSITIVO-V.docx">PB INGLE NRML, HERNIA POSITIVO-V</option>
                                    <option value="PB TESTICULAR NRML-V.docx">PB TESTICULAR NRML-V</option>
                                    <option value="PB TIROIDES NRML-V.docx">PB TIROIDES NRML-V</option>
                                    <option value="PROSTATA HPB G II ADENOMA-V.docx">PROSTATA HPB G II ADENOMA-V-V</option>
                                    <option value="PROSTATA HPB G I-V.docx">PROSTATA HPB G I-V-V</option>

                                    <option value="PROSTATA NRML-V.docx">PROSTATA NRML-V</option>
                                    <option value="PROSTATA QT LINEA MEDIA-V.docx">PROSTATA QT LINEA MEDIA-V</option>
                                    <option value="PROSTATA REMANENTE-V.docx">PROSTATA REMANENTE-V</option>
                                    <option value="PROSTATA SEC DE PROSTATITIS-V.docx">PROSTATA SEC DE PROSTATITIS-V</option>
                                    <option value="RENAL DOBLE SISTEMA-V.docx">RENAL DOBLE SISTEMA-V</option>
                                    <option value="RENAL HIDROURETERONEFROSIS-V.docx">RENAL HIDROURETERONEFROSIS-V</option>
                                    <option value="RENAL LITIASIS BILATERAL-V.docx">RENAL LITIASIS BILATERAL-V</option>
                                    <option value="RENAL LITIASIS UNILATERAL-V.docx">RENAL LITIASIS UNILATERAL-V</option>
                                    <option value="RENAL NRML-V.docx">RENAL NRML-V</option>
                                    <option value="RENAL QT SIMPLE-V.docx">RENAL QT SIMPLEL-V</option>
                                    <option value="RENAL Y VIAS URINARIAS-V.docx">RENAL Y VIAS URINARIAS-V</option>
 <option value="RX. ABDOMEN SIMPLE.docx">RX. ABDOMEN SIMPLE</option>

                                    <option value="RX. ANTEBRAZO NRML.docx">RX. ANTEBRAZO NRML</option>
                                    <option value="RX. ANTEBRAZO FX.docx">RX. ANTEBRAZO FX</option>
                                    <option value="RX. BRAZO NRML.docx">RX. BRAZO NRML</option>
                                    <option value="RX. CADERA NRML.docx">RX. CADERA NRML</option>
                                    <option value="RX. CALCANEO ESPOLON.docx">RX. CALCANEO ESPOLON</option>
                                    <option value="RX. CALCANEOS.docx">RX. CALCANEOS</option>
                                    <option value="RX. CAVUM HIPERTROFIA.docx">RX. CAVUM HIPERTROFIA</option>
                                    <option value="RX. CAVUM.docx">RX. CAVUM</option>
                                    <option value="RX. CLAVICULA NRML.docx">RX. CLAVICULA NRML</option>
                                    <option value="RX. CLAVICULA FX.docx">RX. CLAVICULA FX</option>
                                    <option value="RX. CODO.docx">RX. CODO</option>
                                    <option value="RX. COLUMNA CERV NRML.docx">RX. COLUMNA CERV NRML</option>
                                    <option value="RX. COLUMNA CERVICAL ESPOND.docx">RX. COLUMNA CERVICAL ESPOND</option>
                                    <option value="RX. COLUMNA DORSAL ESPOND, ESC.docx">RX. COLUMNA DORSAL ESPOND, ESC</option>
                                    <option value="RX. COLUMNA DORSAL NRML.docx">RX. COLUMNA DORSAL NRML</option>
                                    <option value="RX. COLUMNA DORSOLUMBAR ESPONDILOSIS, ESCOLIOSIS.docx">RX. COLUMNA DORSOLUMBAR ESPONDILOSIS, ESCOLIOSIS</option>
                                    <option value="RX. COLUMNA LUMB SACRA NRML.docx">RX. COLUMNA LUMB SACRA NRML</option>
                                    <option value="RX. COLUMNA LUMB SACRA PINZ L5 S1.docx">RX. COLUMNA LUMB SACRA PINZ L5 S1</option>
                                    <option value="RX. COLUMNA LUMBO SACRA ESPOND.docx">RX. COLUMNA LUMBO SACRA ESPOND</option>
                                    <option value="RX. COLUMNA SACRO COXIS NRML.docx">RX. COLUMNA SACRO COXIS NRML</option>
                                    <option value="RX. CRANEO.docx">RX. CRANEO</option>
                                    <option value="RX. FEMUR NRML.docx">RX. FEMUR NRML</option>
                                    <option value="RX. HOMBRO.docx">RX. HOMBRO</option>
                                    <option value="RX. HOMBRO TENDINITIS INICIAL.docx">RX. HOMBRO TENDINITIS INICIAL</option>
                                    <option value="RX. HPN.docx">RX. HPN</option>
                                    <option value="RX. HPN FX.docx">RX. HPN FX</option>
                                    <option value="RX. MANO EDAD OSEA NRML.docx">RX. MANO EDAD OSEA NRML</option>
                                    <option value="RX. MANO.docx">RX. MANO</option>
                                    <option value="RX. MUÑECA NRML.docx">RX. MUÑECA NRML</option>
                                    <option value="RX. PARRILLA COSTAL NRML.docx">RX. PARRILLA COSTAL NRML</option>
                                    <option value="RX. PARRILLA COSTAL FX.docx">RX. PARRILLA COSTAL FX</option>
                                    <option value="RX. PELVIS AP DISPLASIA NEGAT.docx">RX. PELVIS AP DISPLASIA NEGAT</option>
                                    <option value="RX. PELVIS AP NRML.docx">RX. PELVIS AP NRML</option>
                                    <option value="RX. PIE.docx">RX. PIE</option>
                                    <option value="RX. PIERNA NRML.docx">RX. PIERNA NRML</option>
                                    <option value="RX. RODILLA.docx">RX. RODILLA</option>
                                    <option value="RX. RODILLA GONARTROSIS.docx">RX. RODILLA</option>

                                    <option value="RX. SPN PROCESO ALERGICO.docx">RX. SPN PROCESO ALERGICO</option>
                                    <option value="RX. SPN RINOSINUSITIS.docx">RX. SPN RINOSINUSITIS</option>
                                    <option value="RX. SPN SINUSOPATIA.docx">RX. SPN SINUSOPATIA</option>
                                    <option value="RX. SPN.docx">RRX. SPN</option>
                                    <option value="RX. TOBILLO.docx">RX. TOBILLO</option>
                                    <option value="RX. TORAX ATELECTASIA.docx">RX. TORAX ATELECTASIA</option>
                                    <option value="RX. TORAX DERRAME PLEURAL.docx">RX. TORAX DERRAME PLEURAL</option>
                                    <option value="RX. TORAX FIBROSIS PULMONAR.docx">RX. TORAX FIBROSIS PULMONAR</option>
                                    <option value="RX. TORAX INFLAMT BRONQ.docx">RX. TORAX INFLAMT BRONQ</option>
                                    <option value="RX. TORAX NEUMOPATIA NIÑO.docx">RX. TORAX NEUMOPATIA NIÑO</option>
                                    <option value="RX. TORAX NRML NIÑO.docx">RX. TORAX NRML NIÑO</option>
                                    <option value="RX. TORAX NRML.docx">RX. TORAX NRML</option>
                                    <option value="RX. TORAX PEP.docx">RX. TORAX PEP</option>
                                    <option value="RX. TORAX SECUELAS DE PEP.docx">RX. TORAX SECUELAS DE PEP</option>

                                    @else

                                     <option value="ABDOMEN COLECISTITIS CRONICA FASE AGUDA.docx">ABDOMEN COLECISTITIS CRONICA FASE AGUDA</option>
                                    <option value="ABDOMEN COLECISTITIS CRONICA.docx">ABDOMEN COLECISTITIS CRONICA</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, CCC.docx">ABDOMEN ESTEATOSIS LEVE, CCC</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, SVB.docx">ABDOMEN ESTEATOSIS LEVE, SVB</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE.docx">ABDOMEN ESTEATOSIS LEVE</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA, SVB.docx">ABDOMEN ESTEATOSIS MODERADA, SVB</option>
                                    
                                    <option value="ABDOMEN ESTEATOSIS MODERADA.docx">ABDOMEN ESTEATOSIS MODERADA</option>
                                    <option value="ABDOMEN NRML.docx">ABDOMEN NRML</option>
                                    <option value="ABDOMEN POLIPO VB.docx">ABDOMEN POLIPO VB</option>
                                    <option value="ABDOMEN POLIPOSIS VB.docx">ABDOMEN POLIPOSIS VB</option>
                                    <option value="ABDOMEN STATUS POST COLECISTECTOMIA.docx">ABDOMEN STATUS POST COLECISTECTOMIA</option>
                                     <option value="COLPOSCOPIA POSITIVO.docx">COLPOSCOPIAPOSITIVO</option>
                                      <option value="COLPO NEGATIVO.docx">COLPOSCOPIANEGATIVO</option>
                                    <option value="GIN EPI.docx">GIN EPI</option>
                                    <option value="GIN NRML.docx">GIN NRML</option>
                                    <option value="GIN POLIFOL, EPI.docx">GIN POLIFOL, EPI</option>
                                    <option value="GIN POLIFOL.docx">GIN POLIFOL</option>
                                  
                                    <option value="GIN TV DIU NRML.docx">GIN TV DIU NRML</option>
                                    <option value="GIN TV DIU SITUACION BAJA.docx">GIN TV DIU SITUACION BAJA</option>
                                    <option value="GIN TV INVOLUTIVO.docx">GIN TV INVOLUTIVO</option>
                                    <option value="GIN TV DIU SITUACION BAJA.docx">GIN TV DIU SITUACION BAJA</option>
                                    <option value="GIN TV MIOMATOSIS.docx">GIN TV MIOMATOSIS</option>
                                    <option value="GIN TV NRML.docx">GIN TV NRML</option>
                                    <option value="GIN TV OV MORFOLOGIA POLIQUISTICA.docx">GIN TV OV MORFOLOGIA POLIQUISTICA</option>
                                  
                                    <option value="GIN TV POLIFOL.docx">GIN TV POLIFOL</option>
                                    <option value="GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION.docx">GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION</option>
                                    <option value="GIN TV SEGUIMIENTO OVULATORIO NRML.docx">GIN TV SEGUIMIENTO OVULATORIO NRML</option>
                                    <option value="GIN TV SITUACION INDETERMIDA BETA +.docx">GIN TV SITUACION INDETERMIDA BETA +</option>
                                  
                                     <option value="GIN TV OV MORFOLOGIA POLIQUISTICA.docx">GIN TV OV MORFOLOGIA POLIQUISTICA</option>
                                   
                                    <option value="MAMAS NRML.docx">MAMAS NRML</option>
                                    <option value="MAMAS QT SIMPLE.docx">MAMAS QT SIMPLE</option>
                                    <option value="MAMAS FIBROADENOMA MAMA DER . IZQ.docx">MAMAS FIBROADENOMA MAMA DER . IZQ</option>
                                    <option value="MAMAS MASTOPATIA FQ BILATERAL.docx">MAMAS MASTOPATIA FQ BILATERAL</option>

                                    <option value="OBST 4D II TRIMESTRE.docx">OBST 4D TRIMESTRE</option>
                                     <option value="OBST 5D II TRIMESTRE.docx">OBST 5D II TRIMESTRE</option>
                                      <option value="OBST 5D III TRIMESTRE.docx">OBST 5D III TRIMESTRE</option>
                                   
                                    <option value="OBST 4D III TRIMESTRE.docx">OBST 4D III TRIMESTRE</option>
                                   

                                    <option value="OBST GEMELAR II, III TRIMESTRE BICO, BIAMN.docx">OBST GEMELAR II, III TRIMESTRE BICO, BIAMN</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE MONOCO, BIAMN.docx">OBST GEMELAR II, III TRIMESTRE MONOCO, BIAMN</option>
                                    <option value="OBST I EMBRION 6 - 8 SEMANAS.docx">OBST I EMBRION 6 - 8 SEMANAS</option>
                                    <option value="OBST I EMBRION 9 SEMANAS.docx">OBST I EMBRION 9 SEMANAS</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE BICO, BIAMN.docx">OBST GEMELAR II, III TRIMESTRE BICO, BIAMN</option>
                                    <option value="OBST I EMBRION 6 - 8 SEMANAS.docx">OBST I EMBRION 6 - 8 SEMANAS</option>
                                    <option value="OBST I EMBRION 9 SEMANAS.docx">OBST I EMBRION 9 SEMANAS</option>
                                    <option value="OBST I FETO 10 - 11SS.docx">OBST I FETO 10 - 11SS</option>
                                    <option value="OBST I FETO 12 - 14SS.docx">OBST I FETO 12 - 14SS</option>

                                    <option value="OBST DOPPLER TAMIZAJE II TRIMESTRE NRML.docx">OBST DOPPLER TAMIZAJE II TRIMESTRE NRML</option>

                                    <option value="OBST I TV DOPPLER TAMIZAJE.docx">OBST I TV DOPPLER TAMIZAJE</option>
                                    <option value="OBST I TV FETO 10 - 11SS DOBLE BIAMN BICOR.docx">OBST I TV FETO 10 - 11SS DOBLE BIAMN BICOR</option>
                                    <option value="OBST I TV FETO 10 - 11SS DOBLE BIAMN MONOCOR.docx">OBST I TV FETO 10 - 11SS DOBLE BIAMN MONOCOR</option>

                                    <option value="OBST I TV FETO 10 - 11SS.docx">OBST I TV FETO 10 - 11SS</option>
                                    <option value="OBST I TV FETO 12 - 14SS.docx">OBST I TV FETO 12 - 14SS</option>
                                    <option value="OBST I TV NO EVOLUTIVO LCN.docx">OBST I TV NO EVOLUTIVO LCN</option>
                                    <option value="OBST I TV NO EVOLUTIVO SG.docx">OBST I TV NO EVOLUTIVO SG</option>
                                    <option value="OBST I TV NO EVOLUTIVO vs VIABILIDAD SG.docx">OBST I TV NO EVOLUTIVO vs VIABILIDAD SG</option>
                                    <option value="OBST I TV UTERO BICORNE.docx">OBST I TV UTERO BICORNE</option>
                                    <option value="OBST I TV, GEST TEMPR, EPI.docx">OBST I TV, GEST TEMPR, EPI</option>
                                    <option value="OBST II.docx">OBST II</option>
                                    <option value="OBST III DISCORDANTE DC CIR TIPO II, CC.docx">OBST III DISCORDANTE DC CIR TIPO II, CC</option>
                                    <option value="OBST III DISCORDANTE DC CIR TIPO II.docx">OBST III DISCORDANTE DC CIR TIPO II</option>
                                    <option value="OBST III DOPPLER NIVEL II CC.docx">OBST III DOPPLER NIVEL II CC</option>
                                    <option value="OBST III DOPPLER NIVEL II.docx">OBST III DOPPLER NIVEL II</option>

                                    <option value="OBST III DOPPLER NIVEL II-3p.docx">OBST III DOPPLER NIVEL II-3p</option>
                                    <option value="OBST III PB SOSPECHA DE CC.docx">OBST III PB SOSPECHA DE CC</option>
                                    <option value="OBST III TRIMESTRE SOSPECHA DE CC.docx">OBST III TRIMESTRE SOSPECHA DE CC</option>

                                    <option value="OBST III PB.docx">OBST III PB</option>
                                    <option value="OBST III TRIMESTRE CIRCULAR DE CORDON.docx">OBST III TRIMESTRE CIRCULAR DE CORDON</option>
                                    <option value="OBST III.docx">OBST III</option>
                                    <option value="OBST MORFOLOGICA II TRIMESTRE-2p.docx">OBST MORFOLOGICA II TRIMESTRE-2p</option>
                                    <option value="PB CADERAS NRML.docx">PB CADERAS NRML</option>
                                    <option value="PB INGLE NRML, HERNIA POSITIVO.docx">PB INGLE NRML, HERNIA POSITIVO</option>
                                    <option value="PB TESTICULAR NRML.docx">PB TESTICULAR NRML</option>
                                    <option value="PB TIROIDES NRML.docx">PB TIROIDES NRML</option>
                                    <option value="PROSTATA HPB G II ADENOMA.docx">PROSTATA HPB G II ADENOMA</option>
                                    <option value="PROSTATA HPB G I.docx">PROSTATA HPB G I</option>

                                    <option value="PROSTATA NRML.docx">PROSTATA NRML</option>
                                    <option value="PROSTATA QT LINEA MEDIA.docx">PROSTATA QT LINEA MEDIA</option>
                                    <option value="PROSTATA REMANENTE.docx">PROSTATA REMANENTE</option>
                                    <option value="PROSTATA SEC DE PROSTATITIS.docx">PROSTATA SEC DE PROSTATITIS</option>
                                    <option value="RENAL DOBLE SISTEMA.docx">RENAL DOBLE SISTEMA</option>
                                    <option value="RENAL HIDROURETERONEFROSIS.docx">RENAL HIDROURETERONEFROSIS</option>
                                    <option value="RENAL LITIASIS BILATERAL.docx">RENAL LITIASIS BILATERAL</option>
                                    <option value="RENAL LITIASIS UNILATERAL.docx">RENAL LITIASIS UNILATERAL</option>
                                    <option value="RENAL NRML.docx">RENAL NRML</option>
                                    <option value="RENAL QT SIMPLE.docx">RENAL QT SIMPLEL</option>
                                    <option value="RENAL Y VIAS URINARIAS.docx">RENAL Y VIAS URINARIAS</option>

                                    <option value="RX. ABDOMEN SIMPLE.docx">RX. ABDOMEN SIMPLE</option>

                                    <option value="RX. ANTEBRAZO NRML.docx">RX. ANTEBRAZO NRML</option>
                                    <option value="RX. ANTEBRAZO FX.docx">RX. ANTEBRAZO FX</option>
                                    <option value="RX. BRAZO NRML.docx">RX. BRAZO NRML</option>
                                    <option value="RX. CADERA NRML.docx">RX. CADERA NRML</option>
                                    <option value="RX. CALCANEO ESPOLON.docx">RX. CALCANEO ESPOLON</option>
                                    <option value="RX. CALCANEOS.docx">RX. CALCANEOS</option>
                                    <option value="RX. CAVUM HIPERTROFIA.docx">RX. CAVUM HIPERTROFIA</option>
                                    <option value="RX. CAVUM.docx">RX. CAVUM</option>
                                    <option value="RX. CLAVICULA NRML.docx">RX. CLAVICULA NRML</option>
                                    <option value="RX. CLAVICULA FX.docx">RX. CLAVICULA FX</option>
                                    <option value="RX. CODO.docx">RX. CODO</option>
                                    <option value="RX. COLUMNA CERV NRML.docx">RX. COLUMNA CERV NRML</option>
                                    <option value="RX. COLUMNA CERVICAL ESPOND.docx">RX. COLUMNA CERVICAL ESPOND</option>
                                    <option value="RX. COLUMNA DORSAL ESPOND, ESC.docx">RX. COLUMNA DORSAL ESPOND, ESC</option>
                                    <option value="RX. COLUMNA DORSAL NRML.docx">RX. COLUMNA DORSAL NRML</option>
                                    <option value="RX. COLUMNA DORSOLUMBAR ESPONDILOSIS, ESCOLIOSIS.docx">RX. COLUMNA DORSOLUMBAR ESPONDILOSIS, ESCOLIOSIS</option>
                                    <option value="RX. COLUMNA LUMB SACRA NRML.docx">RX. COLUMNA LUMB SACRA NRML</option>
                                    <option value="RX. COLUMNA LUMB SACRA PINZ L5 S1.docx">RX. COLUMNA LUMB SACRA PINZ L5 S1</option>
                                    <option value="RX. COLUMNA LUMBO SACRA ESPOND.docx">RX. COLUMNA LUMBO SACRA ESPOND</option>
                                    <option value="RX. COLUMNA SACRO COXIS NRML.docx">RX. COLUMNA SACRO COXIS NRML</option>
                                    <option value="RX. CRANEO.docx">RX. CRANEO</option>
                                    <option value="RX. FEMUR NRML.docx">RX. FEMUR NRML</option>
                                    <option value="RX. HOMBRO.docx">RX. HOMBRO</option>
                                    <option value="RX. HOMBRO TENDINITIS INICIAL.docx">RX. HOMBRO TENDINITIS INICIAL</option>
                                    <option value="RX. HPN.docx">RX. HPN</option>
                                    <option value="RX. HPN FX.docx">RX. HPN FX</option>
                                    <option value="RX. MANO EDAD OSEA NRML.docx">RX. MANO EDAD OSEA NRML</option>
                                    <option value="RX. MANO.docx">RX. MANO</option>
                                    <option value="RX. MUÑECA NRML.docx">RX. MUÑECA NRML</option>
                                    <option value="RX. PARRILLA COSTAL NRML.docx">RX. PARRILLA COSTAL NRML</option>
                                    <option value="RX. PARRILLA COSTAL FX.docx">RX. PARRILLA COSTAL FX</option>
                                    <option value="RX. PELVIS AP DISPLASIA NEGAT.docx">RX. PELVIS AP DISPLASIA NEGAT</option>
                                    <option value="RX. PELVIS AP NRML.docx">RX. PELVIS AP NRML</option>
                                    <option value="RX. PIE.docx">RX. PIE</option>
                                    <option value="RX. PIERNA NRML.docx">RX. PIERNA NRML</option>
                                    <option value="RX. RODILLA.docx">RX. RODILLA</option>
                                    <option value="RX. RODILLA GONARTROSIS.docx">RX. RODILLA</option>

                                    <option value="RX. SPN PROCESO ALERGICO.docx">RX. SPN PROCESO ALERGICO</option>
                                    <option value="RX. SPN RINOSINUSITIS.docx">RX. SPN RINOSINUSITIS</option>
                                    <option value="RX. SPN SINUSOPATIA.docx">RX. SPN SINUSOPATIA</option>
                                    <option value="RX. SPN.docx">RRX. SPN</option>
                                    <option value="RX. TOBILLO.docx">RX. TOBILLO</option>
                                    <option value="RX. TORAX ATELECTASIA.docx">RX. TORAX ATELECTASIA</option>
                                    <option value="RX. TORAX DERRAME PLEURAL.docx">RX. TORAX DERRAME PLEURAL</option>
                                    <option value="RX. TORAX FIBROSIS PULMONAR.docx">RX. TORAX FIBROSIS PULMONAR</option>
                                    <option value="RX. TORAX INFLAMT BRONQ.docx">RX. TORAX INFLAMT BRONQ</option>
                                    <option value="RX. TORAX NEUMOPATIA NIÑO.docx">RX. TORAX NEUMOPATIA NIÑO</option>
                                    <option value="RX. TORAX NRML NIÑO.docx">RX. TORAX NRML NIÑO</option>
                                    <option value="RX. TORAX NRML.docx">RX. TORAX NRML</option>
                                    <option value="RX. TORAX PEP.docx">RX. TORAX PEP</option>
                                    <option value="RX. TORAX SECUELAS DE PEP.docx">RX. TORAX SECUELAS DE PEP</option>


                                    
					     </select>
                                                             @endif

							</td>
							<td><input type="submit" class="btn btn-success" value="Asociar">
                            <a href="resultados-descartar-{{$p->id}}" class="btn btn-danger" onclick="return confirm('¿Desea Descartar este registro?')">Descartar</a>

                            </td>

							@endif

						</tr>
						</form>
						@endforeach	
					</tbody>
					<tfoot>
						<tr>
						    <th>Id</th>
							<th>Fecha</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Informe</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#el2").select2();
            $("#el1").select2();
            $("#el3").select2({disabled : true});
      });
      WinMove();
});

$('#input_date').on('change', getAva);
$('#el1').on('change', getAva);

function getAva (){
            var d = $('#input_date').val();
            var e = $("#el1").val();
            if(!d) return;
            $.ajax({
      url: "available-time/"+e+"/"+d,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type: "get",
      success: function(res){
            $('#el3').find('option').remove().end();
            for(var i = 0; i < res.length; i++){
                              var newOption = new Option(res[i].start_time+"-"+res[i].end_time, res[i].id, false, false);
                              $('#el3').append(newOption).trigger('change');
            }
      }
    });     
}

function DemoTimePicker(){
      $('#input_date').datepicker({
      setDate: new Date(),
      minDate: 0});
}
</script>
@endsection
@endsection
