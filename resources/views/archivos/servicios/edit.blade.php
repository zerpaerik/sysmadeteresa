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
				<form class="form-horizontal" role="form" method="post" action="servicios/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Detalle</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="detalle" placeholder="detalle" data-toggle="tooltip" data-placement="bottom" value="{{$detalle}}" title="detalle">
						</div>

						<label class="col-sm-1 control-label">Precio</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="precio" placeholder="precio" data-toggle="tooltip" data-placement="bottom" value="{{$precio}}" title="precio">
						</div>

						<label class="col-sm-1 control-label">Porcentaje</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="porcentaje" placeholder="porcentaje" data-toggle="tooltip" data-placement="bottom" value="{{$porcentaje}}" title="porcentaje">
						</div>
						
						<label class="col-sm-1 control-label">Porcentaje Personal</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="por_per" value="{{$por_per}}" placeholder="porcentaje personal" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>

						<label class="col-sm-2 control-label">Porcentaje Tecnólogo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="por_tec" value="{{$por_tec}}" placeholder="porcentaje tecnólogo" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>

				

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('servicios.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection