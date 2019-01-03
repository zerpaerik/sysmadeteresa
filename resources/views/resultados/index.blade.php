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
                                    <option value="OBST III DOPPLER NIVEL II-3p.docx">OBST III DOPPLER NIVEL II-3p</option>

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
