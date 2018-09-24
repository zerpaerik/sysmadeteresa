@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar producto</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="producto/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" value="{{$nombre}}" title="Nombre">
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

						<label class="col-sm-1 control-label">Cantidad</label>
						<div class="col-sm-3">
							<input type="number" class="form-control" name="cantidad" placeholder="Cantidad inicial" data-toggle="tooltip" data-placement="bottom" title="Cantidad" value="{{$cantidad}}" min="0">
						</div>

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('productos.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection