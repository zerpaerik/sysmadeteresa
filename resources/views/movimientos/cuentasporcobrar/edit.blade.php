@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Cuenta por Cobrar Pendiente</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="cuentasporcobrar/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Monto Pendiente</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="pendiente" placeholder="pendiente" data-toggle="tooltip" data-placement="bottom" value="{{$pendiente}}" title="pendiente" readonly="readonly">
						</div>

						<label class="col-sm-1 control-label">Monto a Cobrar</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="monto" placeholder="Monto a Cobrar" data-toggle="tooltip" data-placement="bottom"  title="monto">
						</div>
						
						<label class="col-sm-1 control-label">TipoPago</label>
						<div class="col-sm-3">
							<select class="form-control" name="tipopago">
							<option value="EF">Efectivo</option>
							<option value="TJ">Tarjeta</option>
						</select>
						</div>	

						
						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Cobrar">
							<a href="{{route('cuentasporcobrar.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection