@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Programacion</span>
					<a href="{{route('service.create')}}" class="btn btn-success">Agregar</a>

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
			{!! Form::open(['method' => 'get', 'route' => ['service.inicio']]) !!}

			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$f1}}" name="fecha" style="line-height: 20px">
				</div>
				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$f2}}" name="fecha2" style="line-height: 20px">
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
							<th>Fecha</th>
							<th>Horas</th>
							<th>Tiempo</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($data as $d)
						<tr>
						<td>{{$d->SerId}}</td>
						<td>{{$d->apepac}} {{$d->nompac}}</td>
						<td>{{$d->nombrePro}} {{$d->apellidoPro}}</td>
						<td>{{$d->date}}</td>
						<td>{{$d->start_time}}-{{$d->end_time}}</td>
						<td>{{$d->tiempo}}</td>
						<td>{{$d->name}}-{{$d->lastname}}</td>
						<td>
						@if(\Auth::user()->role_id <> 6 && \Auth::user()->role_id <> 7)							 

						<a class="btn btn-primary" href="service-{{$d->SerId}}">Ver</a>

						<a  class="btn btn-success" href="services-edit-{{$d->SerId}}">Editar</a>	

						<a _blank" class="btn btn-warning" href="services-delete-{{$d->SerId}}" onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>	
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
							<th>Fecha</th>
							<th>Horas</th>
							<th>Registrado Por:</th>
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
