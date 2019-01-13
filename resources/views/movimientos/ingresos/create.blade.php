@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Ingreso</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="ingresos/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Descripciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="descripcion" placeholder="descripcion" data-toggle="tooltip" data-placement="bottom" title="descripcion">
						</div>
						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" name="monto" placeholder="monto" data-toggle="tooltip" data-placement="bottom" title="monto">
						</div>

						<label class="col-sm-1 control-label">Tipo de Ingreso</label>
						<div class="col-sm-3">
							<select id="el2" name="tipo_ingreso">
								    <option value="0">Seleccione el Tipo de Ingreso</option>
									<option value="EF">Efectivo</option>
									<option value="TJ">Tarjeta</option>
							</select>
						</div>
					
										

						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('ingresos.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
function Select2Test(){
	$("#el2").select2();
</script>

}
@endsection
@endsection