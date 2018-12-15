@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Profesional</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="profesionales/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="Nombres" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" data-toggle="tooltip" data-placement="bottom" title="Apellidos">
						</div>
						<label class="col-sm-1 control-label">CMP</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cmp" placeholder="CMP" data-toggle="tooltip" data-placement="bottom" title="CMP">
						</div>
						
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" title="DNI">
						</div>

						<label class="col-sm-1 control-label">Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="nacimiento" placeholder="Nacimiento" data-toggle="tooltip" data-placement="bottom" title="Dirección">
						</div>	
						
						
						<label class="col-sm-1 control-label">Especialidad</label>
						<div class="col-sm-3">
							<select class="form-control" name="especialidad">
							@foreach($especialidades as $esp)
							<option value="{{$esp->id}}">{{$esp->nombre}}</option>
							@endforeach
						</select>
						</div>	
						<label class="col-sm-1 control-label">Centro Mèdico</label>
						<div class="col-sm-3">
							<select class="form-control" name="centro">
							@foreach($centros as $centro)
							<option value="{{$centro->id}}">{{$centro->name}}</option>
							@endforeach
						</select>
						</div>	

						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="phone" placeholder="Telèfono" data-toggle="tooltip" data-placement="bottom" title="Telefono">
						</div>

												
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-4 btn btn-primary" value="Agregar">

						<a href="{{route('profesionales.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-4 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection