@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Analisis</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="analisis/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="Nombre" data-toggle="tooltip" data-placement="bottom" title="Nombres">
						</div>
						<label class="col-sm-1 control-label">Precio</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="preciopublico" placeholder="Precio al Pùblico" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>
						<label class="col-sm-1 control-label">Costo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="costlab" placeholder="Costo" data-toggle="tooltip" data-placement="bottom" title="Costo">
						</div>
						
						<label class="col-sm-1 control-label">Tiempo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="tiempo" placeholder="Tiempo" data-toggle="tooltip" data-placement="bottom" title="Tiempo">
						</div>

						<label class="col-sm-1 control-label">Material</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="material" placeholder="Material" data-toggle="tooltip" data-placement="bottom" title="Material">
						</div>	

						<label class="col-sm-1 control-label">Porcentaje</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="porcentaje" placeholder="porcentaje" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>	
						
						
						<label class="col-sm-1 control-label">Laboratorio</label>
						<div class="col-sm-2">
							<select class="form-control" name="laboratorio">
							@foreach($laboratorios as $lab)
							<option value="{{$lab->id}}">{{$lab->name}}</option>
							@endforeach
						</select>
						</div>	
													
						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('analisis.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection