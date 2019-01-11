@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Resultados/Redactar</span>

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
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
					{!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha2'))
					<p class="help-block">
						{{ $errors->first('fecha2') }}
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
							<th>Detalle</th>
							<th>Informe</th>
							<th>Acciones:</th>
							


						</tr>
					</thead>
					<tbody>
					@foreach($data as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->created_at}}</td>
						<td>{{$p->nombres}},{{$p->apellidos}}</td>
						<td>{{$p->name}},{{$p->lastname}}</td>
						@if($p->es_servicio =='1')
						<td>{{$p->servicio}}</td>
						@else
						<td>{{$p->laboratorio}}</td>
						@endif
					
						  
							@if($p->informe)
						<td>

					    <a href="resultados-desoc-{{$p->id}}" class="btn btn-success">Reversar</a>
	
						<a href="/modelo-informe-{{$p->id}}-{{$p->informe}}" class="btn btn-danger" target="_blank">Descargar Modelo</a>
							
						<td><a class="btn btn-primary" href="/resultados-guardar-{{$p->id}}">Adjuntar Informe</a></td>

							@else
								<td>
								<form action="{{$model . '-asoc-' .$p->id}}" method="get">
								<select name="informe" id="informe">
									<option value="">Seleccione</option>
                                    <option value="ABDOMEN COLECISTITIS CRONICA FASE AGUDA.docx">ABDOMEN COLECISTITIS CRONICA FASE AGUDA</option>
                                    <option value="ABDOMEN COLECISTITIS CRONICA.docx">ABDOMEN COLECISTITIS CRONICA</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, CCC.docx">ABDOMEN ESTEATOSIS LEVE, CCC</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE, SVB.docx">ABDOMEN ESTEATOSIS LEVE, SVB</option>
                                    <option value="ABDOMEN ESTEATOSIS LEVE.docx">ABDOMEN ESTEATOSIS LEVE</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA, SVB.docx">ABDOMEN ESTEATOSIS MODERADA, SVB</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA,PANCREAS INUSUAL.docx">ABDOMEN ESTEATOSIS MODERADA,PANCREAS INUSUAL</option>
                                    <option value="ABDOMEN ESTEATOSIS MODERADA.docx">ABDOMEN ESTEATOSIS MODERADA</option>
                                    <option value="ABDOMEN NRML.docx">ABDOMEN NRML</option>
                                    <option value="ABDOMEN POLIPO VB.docx">ABDOMEN POLIPO VB</option>
                                    <option value="ABDOMEN POLIPOSIS VB.docx">ABDOMEN POLIPOSIS VB</option>
                                    <option value="ABDOMEN STATUS POST COLECISTECTOMIA.docx">ABDOMEN STATUS POST COLECISTECTOMIA</option>
                                    <option value="GIN EPI.docx">GIN EPI</option>
                                    <option value="GIN NRML.docx">GIN NRML</option>
                                    <option value="GIN POLIFOL, EPI.docx">GIN POLIFOL, EPI</option>
                                    <option value="GIN POLIFOL.docx">GIN POLIFOL</option>
                                    <option value="GIN TV AMNRR.docx">GIN TV AMNRR</option>s
                                    <option value="GIN TV CONSIDERAR AB EN CURSO.docx">GIN TV CONSIDERAR AB EN CURSO</option>
                                    <option value="GIN TV DIU NRML.docx">GIN TV DIU NRML</option>
                                    <option value="GIN TV DIU SITUACION BAJA.docx">GIN TV DIU SITUACION BAJA</option>
                                    <option value="GIN TV INVOLUTIVO.docx">GIN TV INVOLUTIVO</option>
                                    <option value="GIN TV DIU SITUACION BAJA.docx">GIN TV DIU SITUACION BAJA</option>
                                    <option value="GIN TV MIOMATOSIS.docx">GIN TV MIOMATOSIS</option>
                                    <option value="GIN TV NRML.docx">GIN TV NRML</option>
                                    <option value="GIN TV OV MORFOLOGIA POLIQUISTICA.docx">GIN TV OV MORFOLOGIA POLIQUISTICA</option>
                                    <option value="GIN TV POLIFOL, EPI.docx">GIN TV POLIFOL, EPI</option>
                                    <option value="GIN TV POLIFOL.docx">GIN TV POLIFOL</option>
                                    <option value="GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION.docx">GIN TV PRODUCTOS RETENIDOS DE LA CONCEPCION</option>
                                    <option value="GIN TV SEGUIMIENTO OVULATORIO NRML.docx">GIN TV SEGUIMIENTO OVULATORIO NRML</option>
                                    <option value="GIN TV SITUACION INDETERMIDA BETA +.docx">GIN TV SITUACION INDETERMIDA BETA +</option>
                                    <option value="MAMAS FIBROADENOMA MAMA DER.docx">MAMAS FIBROADENOMA MAMA DER</option>
                                    <option value="MAMAS FIBROADENOMA MAMA IZQ.docx">MAMAS FIBROADENOMA MAMA IZQ</option>
                                    <option value="MAMAS.docx">MAMAS</option>
                                    <option value="OBST 4D II TRIMESTRE-2p.docx">OBST 4D II TRIMESTRE-2p</option>
                                    <option value="OBST 4D II TRIMESTRE-3p.docx">OBST 4D II TRIMESTRE-3p</option>
                                    <option value="OBST 4D III TRIMESTRE CC-2p.docx">OBST 4D III TRIMESTRE CC-2p</option>
                                    <option value="OBST 4D III TRIMESTRE CC-3p.docx">OBST 4D III TRIMESTRE CC-3p</option>
                                    <option value="OBST 4D III TRIMESTRE-2p.docx">OBST 4D III TRIMESTRE-2p</option>
                                    <option value="OBST 4D III TRIMESTRE-3p.docx">OBST 4D III TRIMESTRE-3p</option>
                                    <option value="OBST 5D II TRIMESTRE-2p.docx">OBST 5D II TRIMESTRE-2p</option>
                                    <option value="OBST 5D III TRIMESTRE-2p.docx">OBST 5D III TRIMESTRE-2p</option>
                                    <option value="OBST DOPPLER TAMIZAJE II TRIMESTRE NRML-3p.docx">OBST DOPPLER TAMIZAJE II TRIMESTRE NRML-3p</option>
                                    <option value="OBST GEMELAR II, III TRIMESTRE BICO, BIAMN.docx">OBST GEMELAR II, III TRIMESTRE BICO, BIAMN</option>
                                    <option value="OBST I EMBRION 6 - 8 SEMANAS.docx">OBST I EMBRION 6 - 8 SEMANAS</option>
                                    <option value="OBST I EMBRION 9 SEMANAS.docx">OBST I EMBRION 9 SEMANAS</option>
                                    <option value="OBST I FETO 10 - 11SS.docx">OBST I FETO 10 - 11SS</option>
                                    <option value="OBST I FETO 12 - 14SS.docx">OBST I FETO 12 - 14SS</option>
                                    <option value="OBST I TV DOPPLER TAMIZAJE PATOLOGICO.docx">OBST I TV DOPPLER TAMIZAJE PATOLOGICO</option>
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
                                    <option value="OBST III DOPPLER NIVEL II CC-2p.docx">OBST III DOPPLER NIVEL II CC-2p</option>
                                    <option value="OBST III DOPPLER NIVEL II CC-3p.docx">OBST III DOPPLER NIVEL II CC-3p</option>
                                    <option value="OBST III DOPPLER NIVEL II-2p.docx">OBST III DOPPLER NIVEL II-2p</option>
                                    <option value="OBST III DOPPLER NIVEL II-3p.docx">OBST III DOPPLER NIVEL II-3p</option>
                                    <option value="OBST III PB CIRCULAR DE CORDON.docx">OBST III PB CIRCULAR DE CORDON</option>
                                    <option value="OBST III PB.docx">OBST III PB</option>
                                    <option value="OBST III TRIMESTRE CIRCULAR DE CORDON.docx">OBST III TRIMESTRE CIRCULAR DE CORDON</option>
                                    <option value="OBST III.docx">OBST III</option>
                                    <option value="OBST MORFOLOGICA II TRIMESTRE-2p.docx">OBST MORFOLOGICA II TRIMESTRE-2p</option>
                                    <option value="PB CADERAS NRML.docx">PB CADERAS NRML</option>
                                    <option value="PB CICATRIZ FID NRML.docx">PB CICATRIZ FID NRML</option>
                                    <option value="PB INGLE NRML, HERNIA NEGATIVO.docx">PB INGLE NRML, HERNIA NEGATIVO</option>
                                    <option value="PB INGLE NRML, HERNIA POSITIVO.docx">PB INGLE NRML, HERNIA POSITIVO</option>
                                    <option value="PB TESTICULAR NRML.docx">PB TESTICULAR NRML</option>
                                    <option value="PB TIROIDES NRML.docx">PB TIROIDES NRML</option>
                                    <option value="PB TRANSFONTANELAR NRML.docx">PB TRANSFONTANELAR NRML</option>
                                    <option value="PROSTATA HPB G I.docx">PROSTATA HPB G I</option>
                                    <option value="PROSTATA HPB G II ADENOMA.docx">PROSTATA HPB G II ADENOMA</option>
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






								</select>
							</td>
							<td><input type="submit" class="btn btn-success" value="Asociar"></td>
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



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
@endsection
