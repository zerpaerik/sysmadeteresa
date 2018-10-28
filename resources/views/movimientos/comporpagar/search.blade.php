@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Comisiones por Pagar</strong></span>
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
					<form action="/comporpagar-search" method="get">
						<h3>Rango de fechas</h3>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}">
						<label for="">final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}">
						<input type="submit">
					</form>
					<thead>
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Servicios</th>
							<th>Laboratorios</th>
							<th>Monto</th>
							<th>Porcentaje</th>
							<th>Monto a Pagar</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->nompro}},{{$atec->apepro}}</td>
								<td>{{$atec->servicio}}</td>
								<td>{{$atec->laboratorio}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->porc_pagar}}</td>
                                <td>{{$atec->porcentaje}}</td>
								<td><a href="{{asset('/pagarcom')}}/{{$atec->id}}" class="btn btn-xs btn-danger">Pagar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>
								<button type="button" class="btn btn-danger">Eliminar</button>
							</th>
						</tr>
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

@endsection