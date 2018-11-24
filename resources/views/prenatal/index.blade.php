@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Analisis de Laboratorio</strong></span>
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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Registro</th>
							<th>Ver Ficha</th>
							<th>Registrat Control</th>
							<th>Descargar</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)					
							<tr>
								<td>{{$d->nombres}} {{$d->apellidos}}</td>
								<td>{{$d->created_at}}</td>
								<td><a href="prenatal-ficha-{{$d->idPaciente}}" class="btn btn-success">Ver ficha</a></td>
								<td><a href="prenatal-control-{{$d->idPaciente}}" class="btn btn-primary">registrar</a></td>
								<td><a href="prenatal-vercontrol-{{$d->idPaciente}}" class="btn btn-danger">Descargar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif
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