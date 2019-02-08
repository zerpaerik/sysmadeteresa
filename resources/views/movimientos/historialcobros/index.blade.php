@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Historial de Cobros a Pacientes</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['historialcobros.index']]) !!}

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
						    <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
                         	@foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->id_atencion}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->dni}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono_parcial}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->updated_at}}</td>
								<td>
										@if(\Auth::user()->role_id = 4)							 
									<a class="btn btn-danger" href="historialcobros-delete-{{$atec->id_atencion}}"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	

									@endif

								</td>
							</tr>
						@endforeach
					</tbody>
					</tbody>
					<tfoot>
					<tr>
						   <th>Nº Atenciòn</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
							<th>Acciones</th>
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
