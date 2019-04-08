@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Requerimientos/Enviados</span>
					@if(Session::get('sedeName') <> 'PROCERES')
				    <a href="{{route('requerimientos.create')}}" class="btn btn-success">Agregar</a>
				    @else
                    <a href="{{route('requerimientos.create1')}}" class="btn btn-success">Agregar</a>
				    @endif

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
							<th>ID</th>
							<th>Dirigida A:</th>
							<th>Usuario Solicitante</th>
							@if(Session::get('sedeName') == 'PROCERES')
							<th>Almacen Solicitante</th>
							@endif
							<th>Producto Solicitado</th>
							<th>Cantidad</th>
							<th>Cantidad Entregada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Acciones:</th>



						</tr>
					</thead>
					<tbody>
					@foreach($requerimientos as $req)					
							<tr>
								<td>{{$req->id}}</td>
								<td>{{$req->sede}}</td>
								<td>{{$req->solicitante}}</td>
								@if(Session::get('sedeName') == 'PROCERES')
								@if($req->almacen_solicita == 1)
								<td>Recepciòn</td>
								@elseif($req->almacen_solicita == 2)
								<td>Laboratorio</td>
								@elseif($req->almacen_solicita == 3)
								<td>Rayos</td>
								@else
								<td>Obstetra</td>
                                @endif
								@endif
								<td>{{$req->nombre}}</td>
								<td>{{$req->cantidad}}</td>
								<td>{{$req->cantidadd}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
								<td>
								@if($req->estatus=='Solicitado')
								<a href="requerimientos-delete-{{$req->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>
								@endif
								</td>


							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Dirigida A:</th>
							<th>Usuario Solicitante</th>
							<th>Producto Solicitado</th>
							<th>Cantidad</th>
							<th>Cantidad Entregada</th>
							<th>Estatus</th>
							<th>Fecha</th>
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
