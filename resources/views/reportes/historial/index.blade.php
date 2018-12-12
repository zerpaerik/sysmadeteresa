@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Historial de Transacciones</strong></span>
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
					<form action="/historial-search" method="get">
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
				         <label for=""></label>
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>
					<thead>
				       @foreach($atenciones as $atec)	

						<tr>
							<th>Acciòn</th>
							<th>Origen</th>
							<th>Usuario</th>
							@if($atec->origen =='Personal')
							<th>Dni</th>
							@elseif($atec->origen =='Paciente')
							<th>Dni</th>
						    @elseif($atec->origen =='Profesional de Apoyo')
							<th>Dni</th>
							@elseif($atec->origen =='Ingreso de Atenciones')
							<th>Id de Atenciòn</th>
							@elseif($atec->origen =='Gastos')
							<th>Monto</th>
							@elseif($atec->origen =='Otros Ingresos')
							<th>Monto</th>
							@elseif($atec->origen =='Lab por Pagar')
							<th>Monto</th>
							@else
							<th>Fecha</th>
						    @endif

						</tr>
					</thead>
					<tbody>

							<tr>
							<td>{{$atec->accion}}</td>
							<td>{{$atec->origen}}</td>
							<td>{{$atec->name}},{{$atec->lastname}}</td>
							<td>{{$atec->detalle}}</td>
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