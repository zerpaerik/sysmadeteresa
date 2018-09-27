@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Salida de productos</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="producto/add">
					<div class="form-group">
						{{ csrf_field() }}

						<label class="col-sm-1 control-label">Producto</label>
						<div class="col-sm-3">
							<select class="form-control" name="producto"  data-toggle="tooltip" data-placement="bottom">
								<option value="0">Seleccione un producto</option>
								@foreach($productos as $producto)
									<option value="{{$producto->id}}">{{$producto->nombre}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Medida</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="medida" data-toggle="tooltip" data-placement="bottom" title="Medida">
						</div>

						<label class="col-sm-1 control-label">Cantidad</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="cantidad" placeholder="Cantidad inicial" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0">
						</div>

						<input type="hidden" name="id">

						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Agregar">
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection