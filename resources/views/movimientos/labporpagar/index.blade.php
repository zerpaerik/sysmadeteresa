@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Laboratorios por Pagar</strong></span>
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
					<form action="/labporpagar-search" method="get">
						<h5>Buscar por pacientes</h5>
						<label for="">Nombre</label>
						<input type="text" name="nom">
						<input type="submit" class="btn btn-primary" value="Buscar">
					</form>					
					<thead>
						<tr>
							<th>Paciente</th>
							<th>Analisis</th>
							<th>Laboratorio a Pagar</th>
							<th>Monto por Pagar</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $atec)					
							<tr>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->nombreana}}</td>
							    <td>{{$atec->nombrelab}}</td>
								<td>{{$atec->costo}}</td>
								<td><a href="{{asset('/pagar')}}/{{$atec->id}}" class="btn btn-xs btn-danger">Pagar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
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