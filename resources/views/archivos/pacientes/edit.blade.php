@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Paciente</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="pacientes/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombres" placeholder="nombres" data-toggle="tooltip" data-placement="bottom" value="{{$nombres}}" title="nombres">
						</div>
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="apellidos" data-toggle="tooltip" data-placement="bottom" value="{{$apellidos}}" title="apellidos">
						</div>
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="dni" data-toggle="tooltip" data-placement="bottom" value="{{$dni}}" title="dni">
						</div>
						<label class="col-sm-1 control-label">Direccion</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="direccion" placeholder="direccion" data-toggle="tooltip" data-placement="bottom" value="{{$direccion}}" title="direccion">
						</div>

						<label class="col-sm-1 control-label">Ocupaciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="ocupacion" placeholder="ocupacion" data-toggle="tooltip" data-placement="bottom" value="{{$ocupacion}}" title="ocupacion">
						</div>

						<label class="col-sm-1 control-label">Teléfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="telefono" data-toggle="tooltip" data-placement="bottom" value="{{$telefono}}" title="telefono">
						</div>

						<label class="col-sm-1 control-label">Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="fechanac" placeholder="fechanac" data-toggle="tooltip" data-placement="bottom" title="nacimiento" value="{{$fechanac}}">
						</div>

					
						<label class="col-sm-1 control-label">Provincia</label>
						<div class="col-sm-3">
							<select class="form-control" name="provincia"  data-toggle="tooltip" data-placement="bottom">
								@foreach($provincias as $cen)
									<option value="{{$cen->id}}">{{$cen->nombre}}</option>
								@endforeach
							</select>
						</div>	

					    <label class="col-sm-1 control-label">Distrito</label>
						<div class="col-sm-3">
							<select class="form-control" name="distrito"  data-toggle="tooltip" data-placement="bottom">
								@foreach($distritos as $cen)
									<option value="{{$cen->id}}">{{$cen->nombre}}</option>
								@endforeach
							</select>
						</div>	

						 <label class="col-sm-1 control-label">Edo.Civil</label>
						<div class="col-sm-3">
							<select class="form-control" name="edocivil"  data-toggle="tooltip" data-placement="bottom">
								@foreach($edocivil as $cen)
									<option value="{{$cen->id}}">{{$cen->nombre}}</option>
								@endforeach
							</select>
						</div>	


						 <label class="col-sm-1 control-label">Instrucción</label>
						<div class="col-sm-3">
							<select class="form-control" name="gradoinstruccion"  data-toggle="tooltip" data-placement="bottom">
								@foreach($gradoinstruccion as $cen)
									<option value="{{$cen->nombre}}">{{$cen->nombre}}</option>
								@endforeach
							</select>
						</div>	
					


						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('pacientes.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection