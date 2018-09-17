@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Paquete</strong></span>
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
			<div class="box-content">
				<h4 class="page-header"></h4>
				<form class="form-horizontal" role="form" method="post" action="paquetes/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						
						<label class="col-sm-1 control-label">Costo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="costo" placeholder="Costo" data-toggle="tooltip" data-placement="bottom" title="Costo">
						</div>
						
						<label class="col-sm-1 control-label">Servicios</label>
						<div class="col-sm-3">
							<select class="form-control" name="servicio" multiple>
							@foreach($servicios as $serv)
							<option value="{{$serv->id}}">{{$serv->detalle}}</option>
							@endforeach
						    </select>
						</div>

						<label class="col-sm-2 control-label">Analisis</label>
						<div class="col-sm-3">
							<select class="form-control" multiple="multiple" name="analisis">
							@foreach($analisis as $lab)
							<option value="{{$lab->id}}">{{$lab->name}}</option>
							@endforeach
						</select>
						</div>
						
						
										

						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('paquetes.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection