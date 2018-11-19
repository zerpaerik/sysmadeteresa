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
						<h4>Total de deuda: {{$total}}</h4>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<input type="text" placeholder="Buscador" name="nom" style="line-height: 20px; margin-left: 30px;">
						<input type="submit" value="Buscar" class="btn btn-primary">
					</form>
					<form action="/pagarmultiple" method="post">
					<thead>
						<tr>
							<th>Marcar Varios</th>
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
								@else
								<td>{{$atec->laboratorio}}</td>
								@endif
								<td>{{$atec->monto}}</td>
								<td>{{$atec->porc_pagar}}</td>
								<td>{{$atec->porcentaje}}</td>
								<td>{{$atec->created_at}}</td>
								<td><a href="{{asset('/pagarcom')}}/{{$atec->id}}" class="btn btn-xs btn-danger">Pagar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
							<th>
								{{ csrf_field() }}
								<button style="margin-left: 35px;" type="submit" class="btn btn-xs btn-danger"><input type="submit">Pagar Seleccionadas</button>
							</th>
					</tfoot>
					</form>
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