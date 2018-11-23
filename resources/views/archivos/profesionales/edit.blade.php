@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Profesional</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="profesionales/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="name" data-toggle="tooltip" data-placement="bottom" value="{{$name}}" title="name">
						</div>
						<label class="col-sm-1 control-label">Apellido</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="apellidos" data-toggle="tooltip" data-placement="bottom" value="{{$apellidos}}" title="apellidos">
						</div>
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="dni" data-toggle="tooltip" data-placement="bottom" value="{{$dni}}" title="dni">
						</div>
						<label class="col-sm-1 control-label">CMP</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cmp" placeholder="cmp" data-toggle="tooltip" data-placement="bottom" value="{{$cmp}}" title="cmp">
						</div>

						<label class="col-sm-1 control-label">Centro</label>
						<div class="col-sm-3">
							<select class="form-control" name="centro"  data-toggle="tooltip" data-placement="bottom">
								@foreach($centros as $cen)
									<option value="{{$cen->id}}">{{$cen->name}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Especialidad</label>
						<div class="col-sm-3">
							<select class="form-control" name="especialidad"  data-toggle="tooltip" data-placement="bottom">
								@foreach($especialidades as $esp)
									<option value="{{$esp->id}}">{{$esp->nombre}}</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="nacimiento" placeholder="nacimiento" data-toggle="tooltip" data-placement="bottom" title="nacimiento" value="{{$nacimiento}}">
						</div>

						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="phone" placeholder="telefono" data-toggle="tooltip" data-placement="bottom" value="{{$phone}}" title="phone">
						</div>

						<label class="col-sm-1 control-label">Tecnólogo</label>
						<div class="col-sm-3">
							<select name="tipo">
								@if ($tipo === 3)
									<option value="3" selected="selected">Si</option>
									<option value="2">No</option>
								@else
									<option value="3">Si</option>
									<option value="2" selected="selected">No</option>
								@endif
							</select>
						</div>	


						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('profesionales.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection