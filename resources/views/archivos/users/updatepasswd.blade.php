@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Modificar Contraseña</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="users/updatepassw">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" disabled="true" class="form-control" name="name" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" value="{{$usuario->name}}" title="Nombre">
						</div>

						<label class="col-sm-1 control-label">Apellido</label>
						<div class="col-sm-3">
							<input type="text" disabled="true" class="form-control" name="direccion" placeholder="direccion" data-toggle="tooltip" data-placement="bottom" value="{{$usuario->lastname}}" title="direccion">
						</div>

						<label class="col-sm-1 control-label">Email</label>
						<div class="col-sm-3">
							<input type="text" disabled="true" class="form-control" name="direccion" placeholder="direccion" data-toggle="tooltip" data-placement="bottom" value="{{$usuario->email}}" title="direccion">
						</div>

							<label class="col-sm-1 control-label">Nueva Contraseña</label>
						<div class="col-sm-3">
							<input type="password"  class="form-control" name="password" placeholder="Ingrese nueva contraseña" data-toggle="tooltip" data-placement="bottom" title="direccion">
						</div>

					
			

						<input type="hidden" name="id" value="{{$usuario->id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection