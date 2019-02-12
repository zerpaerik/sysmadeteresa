@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Requerimientos/Recibidos</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['requerimientos.index2']]) !!}

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
				<div class="col-md-4">

							<select  name="sede">
								<option value="">Seleccione una Sede</option>
								@foreach($sedes as $role)
									<option value="{{$role->id}}">{{$role->name}}</option>
								@endforeach
							</select>
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
							<th>ID:</th>
							<th>Solicitado Por:</th>
							<th>Usuario Solicitante</th>
							<th>Producto</th>
							<th>Cantidad Solicitada</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Cantidad a Entregar</th>
						
						</tr>
					</thead>
					<tbody>
						@foreach($requerimientos2 as $req)					

						<tr>
								<td>{{$req->id}}</td>
								<td>{{$req->sede}}</td>
								<td>{{$req->solicitante}}</td>
								<td>{{$req->nombre}}</td>
							    <td>{{$req->cantidad}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
							    <td><form method="get" action="requerimientos-edit"><input type="hidden" value="{{$req->id}}" name="id"><input type="text" name="cantidadd" value="" size="8"><button style="margin-left: 35px;" type="submit" class="btn btn-xs btn-danger">Procesar</button></form></td>		
						
							</tr>
						@endforeach
				
					</tbody>
					
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
