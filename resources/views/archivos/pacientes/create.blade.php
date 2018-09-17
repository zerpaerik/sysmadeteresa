@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Paciente</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="pacientes/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombres" placeholder="Nombres" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" data-toggle="tooltip" data-placement="bottom" title="Apellidos">
						</div>
						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="Telèfono" data-toggle="tooltip" data-placement="bottom" title="Telèfono">
						</div>
						
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" title="DNI">
						</div>

						<label class="col-sm-1 control-label">Dirección</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="direccion" placeholder="Dirección" data-toggle="tooltip" data-placement="bottom" title="Dirección">
						</div>	
						
						<label class="col-sm-1 control-label">Referencia</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="Referencia" placeholder="Referencia" data-toggle="tooltip" data-placement="bottom" title="Referencia">
						</div>

						<label class="col-sm-1 control-label">Estado Civìl</label>
						<div class="col-sm-2">
							<select class="form-control" name="laboratorio">
							@foreach($edocivil as $edo)
							<option value="{{$edo->nombre}}">{{$edo->nombre}}</option>
							@endforeach
						</select>
						</div>	
						<label class="col-sm-1 control-label">Grado de Inst.</label>
						<div class="col-sm-2">
							<select class="form-control" name="gradoinstruccion">
							@foreach($gradoinstruccion as $gdo)
							<option value="{{$gdo->nombre}}">{{$gdo->nombre}}</option>
							@endforeach
						</select>
						</div>	
						<label class="col-sm-1 control-label">Provincia</label>
						<div class="col-sm-2">
							<select class="form-control" name="provincia">
							@foreach($provincias as $pro)
							<option value="{{$pro->nombre}}">{{$pro->nombre}}</option>
							@endforeach
						</select>
						</div>	
							<label class="col-sm-1 control-label">Distritos</label>
						<div class="col-sm-2">
							<select class="form-control" name="distrito">
							@foreach($distritos as $dis)
							<option value="{{$dis->nombre}}">{{$dis->nombre}}</option>
							@endforeach
						</select>
						</div>									

						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('pacientes.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection