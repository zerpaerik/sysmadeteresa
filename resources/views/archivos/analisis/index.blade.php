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
					<a href="{{route('analisis.create')}}" class="btn btn-primary">Agregar</a>
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
							<th>Nombre</th>
							<th>Precio</th>
							<th>Laboratorio</th>
							<th>Tiempo</th>
							<th>Material</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($analisis as $ana)					
							<tr>
								<td>{{$ana->name}}</td>
								<td>{{$ana->preciopublico}}</td>
								<td>{{$ana->laboratorio}}</td>
								<td>{{$ana->tiempo}}</td>
								<td>{{$ana->material}}</td>
						
								<td><a href="analisis/{{$ana->id}}" class="btn btn-danger">Eliminar</a></td>
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