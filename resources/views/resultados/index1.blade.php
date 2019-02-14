@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Resultados/Redactar Laboratorios</span>

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
				</div>s
				<div class="no-move"></div>
			</div>

			{!! Form::open(['method' => 'get', 'route' => ['resultados.index1']]) !!}

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
								<form action="{{$model . '-asoc1-' .$p->id}}" method="get">
								<select name="informe" id="informe">
									<option value="">Seleccione</option>
                                 
                                    <option value="ACIDO URICO.docx">ACIDO URICO</option>
                                    <option value="AGLUTINACIONES.docx">AGLUTINACIONES</option>
                                    <option value="ALFA FETOPROTEINAS.docx">ALFA FETOPROTEINASsss</option>
                                    <option value="AMILASA SERICA.docx">AMILASA SERICA</option>
                                    <option value="ASO.docx">ASO</option>
                                    <option value="BETA HCG(cuantitativo).docx">BETA HCG(cuantitativo)</option>
                                    <option value="BK-SERIADO.docx">BK-SERIADO</option>
                                    <option value="CAMPAÑA.docx">CAMPAÑA</option>
                                    <option value="COLESTEROL TOTAL.docx">COLESTEROL TOTAL</option>
                                    <option value="COPROFUNCIONAL.docx">COPROFUNCIONAL</option>
                                    <option value="CPK-MB.docx">CPK-MB</option>
                                    <option value="CREATININA.docx">CREATININA</option>
                                    <option value="CULTIVO SECRECION.docx">CULTIVO SECRECION</option>
                                    <option value="CONSTANTES CORPUSCULARES.docx">CONSTANTES CORPUSCULARES</option>
                                    <option value="CULTIVO DE SECRECION VAGINAL POSITIVO.docx">CULTIVO DE SECRECION VAGINAL POSITIVO</option>
                                    <option value="CULTIVO DE SEMEN  NEGATIVO.docx">CULTIVO DE SEMEN  NEGATIVO</option>
                                    <option value="DOSAJE DE POTASIO.docx">DOSAJE DE POTASIO</option>
                                    <option value="ESPERMATOGRAMA.docx">ESPERMATOGRAMA</option>
                                    <option value="EX. COMPLETO DE ORINA.docx">EX. COMPLETO DE ORINA</option>
                                    <option value="EXTRADIOL.docx">EXTRADIOL</option>
                                    <option value="FTA.docx">FTA</option>
                                    <option value="GLOCOSA POST PANDRIAL.docx">GLOCOSA POST PANDRIAL</option>
                                    <option value="GLOCOSA.docx">GLOCOSA</option>
                                    <option value="GLU - COLT - TRIG.docx">GLU - COLT - TRIG</option>
                                    <option value="GRUPO SANGUINEO.docx">GRUPO SANGUINEO</option>
                                    <option value="HEMOGLOBINA.docx">HEMOGLOBINA</option>
                                    <option value="HEMOGRAMA COMPLETA.docx">HEMOGRAMA COMPLETA</option>
                                    <option value="HEMOGLOBINA GLUCOSILADA.docx">HEMOGLOBINA GLUCOSILADA</option>
                                    <option value="HEMOGLOBINA -HEMATOCRITO.docx">HEMOGLOBINA -HEMATOCRITO</option>
                                    <option value="HEPATITIS B.docx">HEPATITIS B</option>
                                    <option value="HIV.docx">HIV</option>
                                    <option value="LIPASA.docx">LIPASA</option>
                                    <option value="PARASITO SERIADO.docx">PARASITO SERIADO</option>
                                    <option value="PARASITOLOGICO SIMPLE.docx">PARASITOLOGICO SIMPLE</option>
                                    <option value="PCR.docx">PCR</option>
                                    <option value="PERFIL DE COAGULACION.docx">PERFIL DE COAGULACION</option>
                                    <option value="PERFIL HEPATICO.docx">PERFIL HEPATICO</option>
                                    <option value="PERFIL LIPIDICO.docx">PERFIL LIPIDICOs</option>
                                    <option value="PERFIL OBSTETRICO.docx">PERFIL OBSTETRICO</option>
                                    <option value="PERFIL TIROIDEO.docx">PERFIL TIROIDEO</option>
                                    <option value="PROTENURIA.docx">PROTENURIA</option>
                                    <option value="PSA TOTAL.docx">PSA TOTAL</option>
                                    <option value="RECUENTO DE PLAQUETAS.docx">RECUENTO DE PLAQUETAS</option>
                                    <option value="RPR.docx">RPR</option>
                                    <option value="RASPADO DE PIEL.docx">RASPADO DE PIEL</option>
                                    <option value="RX.INFLAMATORIO.docx">RX.INFLAMATORIO</option>
                                    <option value="SECRECION VAGINAL.docx">SECRECION VAGINAL</option>
                                      <option value="SECRECION FARINGEA.docx">SECRECION FARINGEA</option>
                                    <option value="SECRECION URETRAL.docx">SECRECION URETRAL</option>
                                    <option value="SUB UNIDAD NEGATIVO.docx">SUB UNIDAD NEGATIVO</option>
                                    <option value="SUB UNIDAD POSITIVO.docx">SUB UNIDAD POSITIVO</option>
                                    <option value="TEST DE GRAHAM.docx">TEST DE GRAHAM</option>
                                    <option value="THEVENON.docx">THEVENON</option>
                                    <option value="TIEMPO DE COAGULACION - TIEMPO DE SANGRIA.docx">TIEMPO DE COAGULACION - TIEMPO DE SANGRIA</option>
                                    <option value="TRIGLICERIDOS.docx">TRIGLICERIDOS</option>
                                    <option value="TSH.docx">TSH</option>
                                    <option value="UREA.docx">UREA</option>
                                    <option value="UROCULTIVO NEGATIVO.docx">UROCULTIVO NEGATIVO</option>
                                    <option value="UROCULTIVO POSITIVO.docx">UROCULTIVO POSITIVO</option>
                                    <option value="VOLUMEN CORPUSCULARES.docx">VOLUMEN CORPUSCULARES</option>
                                    <option value="VSG.docx">VSG</option>






                                  

                                    











                                 













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
