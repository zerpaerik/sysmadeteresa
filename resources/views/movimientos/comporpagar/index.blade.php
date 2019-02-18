@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Comisiones Por Pagar Personal/Profesional</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['comporpagar.index']]) !!}

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
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	

			{!! Form::open(['method' => 'get', 'route' => ['comporpagar.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					<input type="text" class="form-control" name="origen" placeholder="Origen" data-toggle="tooltip" data-placement="bottom" title="Nombres">

					<input type="hidden" value="{{$f1}}" name="f1">
				    <input type="hidden" value="{{$f2}}" name="f2">

				</div>
				
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	

			<div class="row">
				<strong>Monto a Pagar:</strong>{{$aten->monto}}
				
			</div>


			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
				<form action="/pagarmultiple" method="post">
					<thead>
						<tr>
							<th>Marcar</th>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Porcentaje</th>
							<th>Monto a Pagar</th>
							<th>Fecha Atenciòn</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
                          @foreach($atenciones as $atec)	

							<tr>
								<td><input value="{{$atec->id}}" type="checkbox" name="com[]"></td>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								@if($atec->es_servicio =='1')
								<td>{{$atec->servicio}}</td>
								@elseif($atec->es_laboratorio =='1')
								<td>{{$atec->laboratorio}}</td>
								@else
								<td>{{$atec->paquete}}</td>
								@endif
								<td>{{$atec->monto}}</td>
								<td>{{$atec->porc_pagar}}</td>
								<td>{{$atec->porcentaje}}</td>
								<td>{{$atec->created_at}}</td>
								<td><a href="{{asset('/pagarcom')}}/{{$atec->id}}" onclick="return confirm('¿Desea Pagar esta Comisión?')" class="btn btn-xs btn-danger">Pagar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Marcar</th>
							<th>Id</th>
						</tr>
						    <th>
								{{ csrf_field() }}
								<button style="margin-left: -5px;" type="submit" onclick="return confirm('¿Desea Pagar esta Comisión?')" class="btn btn-xs btn-danger">Pagar.Selecc.</button>
							</th>

					</tfoot>
											</form>

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
