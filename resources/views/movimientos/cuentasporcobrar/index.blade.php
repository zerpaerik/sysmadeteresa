@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Cuentas Por Cobrar</span>

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
							<th>Paciente</th>
						    <th>Fecha</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Monto Pendiente</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>	

					  @foreach($cuentasporcobrar as $d)
					  <tr>
					    <td>{{$d->id}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
						<td>{{$d->created_at}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						<td>{{$d->pendiente}}</td>
						<td>
						<a  class="btn btn-success" href="cuentasporcobrar-edit-{{$d->id}}">Cobrar</a>	
						</td>
						</tr>

					     @endforeach					
					
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
						    <th>Fecha</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Monto Pendiente</th>
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
