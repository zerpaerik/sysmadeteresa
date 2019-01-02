@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Comisiones por Pagar</strong></span>
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
												               <div class="box-content no-padding table-responsive">				

				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/comporpagar-search" method="get">
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for=""></label>
						<input type="text" placeholder="Buscador" name="nom" style="line-height: 20px; margin-left: 30px;">
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>
					<form action="/pagarmultiple" method="post">
					<thead>
						<tr>
							<th>Marcar</th>
							<th>Id</th>
							<th width="20%">Paciente</th>
							<th width="20%">Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Porcentaje</th>
							<th>Monto a Pagar</th>
							<th>Fecha Atenciòn</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
					
					</tbody>
					<tfoot>
							<th>
								{{ csrf_field() }}
								<button style="margin-left: -5px;" type="submit" class="btn btn-xs btn-danger">Pagar.Selecc.</button>
							</th>
					</tfoot>
					</form>
				</table>
				</div>
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