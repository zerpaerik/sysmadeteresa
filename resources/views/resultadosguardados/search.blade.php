@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header">
				<div class="box-name">
					<i class=""></i>
					<span><strong>Informes de Servicios</strong></span>
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
					<form action="/resultadosguardados-search" method="get">
						<h5>Rango de fechas</h5>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<input type="submit" class="btn btn-primary" value="Buscar">
					</form>
					<thead> 
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha</th>
							<th>Acciones</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($resultadosguardados as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->created_at}}</td>
						<td>						
                        <a href="{{route('descargar2',$d->informe)}}" class="btn btn-primary" target="_blank">Ver Informe</a>
						@if(\Auth::user()->role_id == 4)

						<td><a class="btn btn-success" href="/resultadosg-editar-{{$d->id2}}">Actualizar Informe</a></td>
                        						@endif

						</td>
						</tr>
						@endforeach						
					</tbody>
					
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
