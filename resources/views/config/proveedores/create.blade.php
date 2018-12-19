@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar nuevo proveedor</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="proveedor/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombre" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" title="Nombre">
						</div>

						<label class="col-sm-1 control-label">Codigo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="codigo" placeholder="Codigo" data-toggle="tooltip" data-placement="bottom">
						</div>	
						
						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="telefono" data-toggle="tooltip" data-placement="bottom">
						</div>	
                        		
                        						
						
						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Agregar">
							<a href="{{route('proveedores.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection