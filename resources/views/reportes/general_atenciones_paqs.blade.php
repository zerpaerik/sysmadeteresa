@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Reportes/General de Atenciones por Paquete</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['generalp.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$f1}}" name="fecha" style="line-height: 20px">
				</div>
				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$f2}}" name="fecha2" style="line-height: 20px">
				</div>
				<div class="col-md-4">
						<select id="el2" name="lab">
							<option value="">Seleccione un Paquete</option>
							@foreach($paquetes as $p)
								    <option value="{{$p->id}}">{{$p->detalle}}</option>
							@endforeach
						</select>

				</div>
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	

			<div class="row">
				<div class="col-md-2">
				<strong>Total Monto:</strong>{{$monto->monto}}
				</div>
				<div class="col-md-2">
				<strong>Total Abono:</strong>{{$abono->monto}}
				</div>
				<div class="col-md-2">
				<strong>Total ComisionPagar:</strong>{{$comision->monto}}
				</div>
				
			</div>


			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Abono</th>
							<th>Pendiente</th>
							<th>Porcentaje</th>
					        <th>Com.Pagar</th>
					        <th>Atendido:</th>
							<th>Fecha Atenciòn</th>
						</tr>
					</thead>
					<tbody>
                        @foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->apellidos}},{{$atec->nombres}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->paquete}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->porc_pagar}}%</td>
								<td>{{$atec->porcentaje}}</td>
								<td>{{$atec->usuarioinforme}}</td>
								<td>{{$atec->created_at}}</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						   <th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Abono</th>
							<th>Pendiente</th>
							<th>Porcentaje</th>
					        <th>Com.Pagar</th>
					         <th>Atendido:</th>
							<th>Fecha Atenciòn</th>
						
					</tfoot>

				</table>
			</div>
		</div>
	</div>
</div>

</body>







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
