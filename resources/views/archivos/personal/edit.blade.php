@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Personal</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="personal/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" value="{{$name}}" title="Nombre">
						</div>

						<label class="col-sm-1 control-label">Apellido</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="lastname" placeholder="Apellido" data-toggle="tooltip" data-placement="bottom" value="{{$lastname}}" title="Apellido">
						</div>

						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" value="{{$dni}}" title="DNI">
						</div>

						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="phone" placeholder="phone" data-toggle="tooltip" data-placement="bottom" value="{{$phone}}" title="phone">
						</div>

						<label class="col-sm-1 control-label">Direcciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="address" placeholder="address" data-toggle="tooltip" data-placement="bottom" value="{{$address}}" title="address">
						</div>

						<label class="col-sm-1 control-label">Email</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="email" placeholder="email" data-toggle="tooltip" data-placement="bottom" value="{{$email}}" title="email">
						</div>

						<label class="col-sm-1 control-label">Cargo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="cargo" placeholder="cargo" data-toggle="tooltip" data-placement="bottom" value="{{$cargo}}" title="cargo">
						</div>

											

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('personal.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection