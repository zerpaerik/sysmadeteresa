@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Consultas</span>
					<a href="{{route('consultas.create')}}" class="btn btn-success">Agregar</a>

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
			{!! Form::open(['method' => 'get', 'route' => ['consultas.inicio']]) !!}

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
							<th>Id</th>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Horas</th>
							<th>Estatus</th>
							<th>Tipo</th>
							<th>TipoIngreso</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($eventos as $d)
						<tr>
						<td>{{$d->EventId}}</td>
						<td>{{$d->apellidos}} {{$d->nombres}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->monto}}</td>
						<td>{{$d->date}}</td>
						<td>{{$d->start_time}}-{{$d->end_time}}</td>
						@if($d->atendido == 1)
						<td style="background: #82FA58;">Fue Atendido</td>
						@else
						<td style="background: #FE642E;">No ha sido Atendido</td>
						@endif
						<td>{{$d->tipo}}</td>
						<td>{{$d->tipo_ingreso}}</td>
						<td>



                        @if($d->tipo == 'CONSULTAS')

						<a class="btn btn-danger" href="event-{{$d->EventId}}">Cargar Historia</a>
						@else

						<a class="btn btn-danger" href="prenatal-create-{{$d->paciente}}-{{$d->EventId}}">Cargar Control</a>
						@endif

						<a target="_blank" class="btn btn-primary" href="consulta-ticket-ver-{{$d->EventId}}">Ticket</a>
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 

						<a  class="btn btn-success" href="consulta-edit-{{$d->EventId}}">Editar</a>	

						<a _blank" class="btn btn-warning" href="consulta-delete-{{$d->EventId}}" onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>

						<a _blank" class="btn btn-danger" href="prenatal-eliminar-{{$d->paciente}}" onclick="return confirm('¿Desea Finalizar?')">Finalizar</a>	
						@endif
							

						</td>

				        @endforeach
				    </tr>
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Especialista</th>
							<th>Monto</th>
							<th>Fecha</th>
							<th>Horas</th>
							<th>Estatus</th>
							<th>Tipo</th>
							<th>Acciones:</th>
						</tr>
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
