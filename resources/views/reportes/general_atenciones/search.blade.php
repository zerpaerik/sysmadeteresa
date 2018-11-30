@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Ingresos General por Atenciones</strong></span>
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
					<form action="/generalatenciones-search" method="get">
						<h4>Total Ingreso: {{$total}}</h4>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for=""></label>
						<input type="text" placeholder="Buscador" name="nom" style="line-height: 20px; margin-left: 30px;">
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>
					<form action="/pagarmultiple" method="post">
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
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								@if($atec->es_servicio =='1')
								<td>{{$atec->servicio}}</td>
								@else
								<td>{{$atec->laboratorio}}</td>
								@endif
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->porc_pagar}}%</td>
								<td>{{$atec->porcentaje}}</td>
								<td></td>
								<td>{{$atec->created_at}}</td>
							</tr>
						@endforeach
					</tbody>
					
					</form>
				</table>
				{{$atenciones->links()}}	
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