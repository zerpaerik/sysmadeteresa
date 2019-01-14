@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Producto</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="producto/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" title="Nombre">
						</div>


						<label class="col-sm-1 control-label">Categoria</label>
						<div class="col-sm-3">
							<select class="form-control" name="categoria"  data-toggle="tooltip" data-placement="bottom">
								@foreach($categorias as $categoria)
									<option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Medida</label>
						<div class="col-sm-3">
							<select class="form-control" name="medida"  data-toggle="tooltip" data-placement="bottom">
								@foreach($medidas as $medida)
									<option value="{{$medida->id}}">{{$medida->nombre}}</option>
								@endforeach
							</select>
						</div>
						<label class="col-sm-1 control-label">Precio Unit.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="preciounidad" placeholder="preciounidad" data-toggle="tooltip" data-placement="bottom" title="preciounidad">
						</div>

						<label class="col-sm-1 control-label">Precio Venta.</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="precioventa" placeholder="precioventa" data-toggle="tooltip" data-placement="bottom" title="precioventa">
						</div>

						<label class="col-sm-1 control-label">Vencimiento.</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="vence" placeholder="vence" data-toggle="tooltip" data-placement="bottom" title="vence">
						</div>

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Agregar">
							<a href="{{route('productos.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection