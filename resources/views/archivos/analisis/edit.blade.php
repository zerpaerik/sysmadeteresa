@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Analisis</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="analisis/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="name" placeholder="name" data-toggle="tooltip" data-placement="bottom" value="{{$name}}" title="name">
						</div>
						<label class="col-sm-1 control-label">Precio al Pùblico</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="preciopublico" placeholder="preciopublico" data-toggle="tooltip" data-placement="bottom" value="{{$preciopublico}}" title="preciopublico">
						</div>
						<label class="col-sm-1 control-label">Costo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="costlab" placeholder="costlab" data-toggle="tooltip" data-placement="bottom" value="{{$costlab}}" title="costlab">
						</div>
						<label class="col-sm-1 control-label">Tiempo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="tiempo" placeholder="tiempo" data-toggle="tooltip" data-placement="bottom" value="{{$tiempo}}" title="tiempo">
						</div>
						<label class="col-sm-1 control-label">Material</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="material" placeholder="material" data-toggle="tooltip" data-placement="bottom" value="{{$material}}" title="material">
						</div>

						<label class="col-sm-1 control-label">Porcentaje</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="porcentaje" placeholder="porcentaje" data-toggle="tooltip" data-placement="bottom" value="{{$porcentaje}}"  title="porcentaje">
						</div>	

						<label class="col-sm-1 control-label">Laboratorio</label>
						<div class="col-sm-3">
							<select class="form-control" name="laboratorio"  data-toggle="tooltip" data-placement="bottom">
								@foreach($laboratorios as $lab)
									<option value="{{$lab->id}}">{{$lab->name}}</option>
								@endforeach
							</select>
						</div>						

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('analisis.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection