@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar persona</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="personal/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="Nombres" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="lastname" placeholder="Apellidos" data-toggle="tooltip" data-placement="bottom" title="Apellidos">
						</div>
						<label class="col-sm-1 control-label">Email</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="email" placeholder="Email" data-toggle="tooltip" data-placement="bottom" title="Email">
						</div>
						
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" title="DNI">
						</div>

						<label class="col-sm-1 control-label">Dirección</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="address" placeholder="Dirección" data-toggle="tooltip" data-placement="bottom" title="Dirección">
						</div>	
						
						<label class="col-sm-1 control-label">Telefono</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="phone" placeholder="Telefono" data-toggle="tooltip" data-placement="bottom" title="Telefono">
						</div>	

						<label class="col-sm-1 control-label">Cargo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cargo" placeholder="cargo" data-toggle="tooltip" data-placement="bottom" title="cargo">
						</div>
                        
                       <label class="col-sm-1 control-label">Tipo</label>
						<div class="col-sm-2">
							<select class="form-control" name="tipo">
							<option value="Especialista">Especialista</option>
							<option value="Tecnologo">Tecnòlogo</option>
							<option value="ProfSalud">Prof. de Salud</option>
                            <option value="Otro">Otro</option>

						</select>
						</div>							

						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('personal.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection