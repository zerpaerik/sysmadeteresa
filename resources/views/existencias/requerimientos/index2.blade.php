@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Requerimientos Recibidos</strong></span>
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
					<form action="/requerimientos-search" method="get">
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px;margin-left: 10px;">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for=""></label>
						<input type="text" placeholder="Buscador" name="sede" style="line-height: 20px; margin-left: 30px;">
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>
					        @foreach($requerimientos2 as $req)					
					<thead>
						<tr>
						  @if($req->estatus == 'Solicitado')
							<th>Solicitado Por:</th>
							<th>Usuario Solicitante</th>
							<th>Producto</th>
							<th>Cantidad Solicitada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Cantidad a Entregar</th>
							@else
							<th>Solicitado Por:</th>
							<th>Usuario Solicitante</th>
							<th>Producto</th>
							<th>Cantidad</th>
						    <th>Cantidad Entregada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							@endif
						</tr>
					</thead>
					<tbody>
							<tr>
							   @if($req->estatus == 'Solicitado')
								<td>{{$req->sede}}</td>
								<td>{{$req->solicitante}}</td>
								<td>{{$req->nombre}}</td>
							    <td>{{$req->cantidad}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
							    <td><form method="get" action="requerimientos-edit"><input type="hidden" value="{{$req->id}}" name="id"><input type="text" name="cantidadd" value="" size="8"><button style="margin-left: 35px;" type="submit" class="btn btn-xs btn-danger">Procesar</button></form></td>		
								@else
								<td>{{$req->sede}}</td>
								<td>{{$req->solicitante}}</td>
								<td>{{$req->nombre}}</td>
							    <td>{{$req->cantidad}}</td>
							    <td>{{$req->cantidadd}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
								@endif
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