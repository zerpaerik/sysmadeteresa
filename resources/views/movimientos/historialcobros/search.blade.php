@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Historial de Cobros a Pacientes</strong></span>
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
					<form action="/historialcobros-search" method="get">
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
						    <th>Nº Atenciòn</th>
							<th width="30%">Paciente</th>
							<th>Monto Total</th>
							<th>Monto Abonado</th>
							<th>Monto Total Abonado</th>
							<th>Monto Pendiente</th>
							<th>Fecha</th>
						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->id_atencion}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->monto}}</td>
								<td>{{$atec->abono_parcial}}</td>
								<td>{{$atec->abono}}</td>
								<td>{{$atec->pendiente}}</td>
								<td>{{$atec->updated_at}}</td>
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