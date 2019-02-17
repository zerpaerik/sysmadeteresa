@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Paciente</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="pacientes/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Apellidos</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" data-toggle="tooltip" data-placement="bottom" title="Apellidos" onkeyup="mayus(this);">
						</div>
						<label class="col-sm-1 control-label">Nombres</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="nombres" placeholder="Nombres" data-toggle="tooltip" data-placement="bottom" title="Nombres" onkeyup="mayus(this);">
						</div>
						
						<label class="col-sm-1 control-label">DNI</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="dni" placeholder="DNI" data-toggle="tooltip" data-placement="bottom" title="DNI" onkeyup="mayus(this);">
						</div>
						<label class="col-sm-1 control-label">Telèfono</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="telefono" placeholder="Telèfono" data-toggle="tooltip" data-placement="bottom" title="Telèfono">
						</div>
						
						<label class="col-sm-1 control-label">Dirección</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="direccion" placeholder="Dirección" data-toggle="tooltip" data-placement="bottom" title="Dirección" onkeyup="mayus(this);">
						</div>	
						
						<label class="col-sm-1 control-label">Referencia</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="Referencia" placeholder="Referencia" data-toggle="tooltip" data-placement="bottom" title="Referencia" onkeyup="mayus(this);">
						</div>

						<label class="col-sm-1 control-label">Provincia</label>
						<div class="col-sm-3">
							<select class="form-control" name="provincia">
							@foreach($provincias as $pro)
							<option value="{{$pro->id}}">{{$pro->nombre}}</option>
							@endforeach
						</select>
						</div>	

							<label class="col-sm-1 control-label">Distritos</label>
						<div class="col-sm-3">
							<select class="form-control" name="distrito">
							@foreach($distritos as $dis)
							<option value="{{$dis->id}}">{{$dis->nombre}}</option>
							@endforeach
						</select>
						</div>	

						<label class="col-sm-1 control-label">GradoInst.</label>
						<div class="col-sm-3">
							<select class="form-control" name="gradoinstruccion">
							@foreach($gradoinstruccion as $gdo)
							<option value="{{$gdo->nombre}}">{{$gdo->nombre}}</option>
							@endforeach
						</select>
						</div>


						<label class="col-sm-1 control-label">Ocupaciòn</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="ocupacion" placeholder="ocupacion" data-toggle="tooltip" data-placement="bottom" title="ocupacion" onkeyup="mayus(this);">
						</div>


						<label class="col-sm-1 control-label">Nacimiento</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" name="fechanac" placeholder="fechanac" data-toggle="tooltip" data-placement="bottom" title="fechanac">
						</div>

						<label class="col-sm-1 control-label">Estado Civìl</label>
						<div class="col-sm-3">
							<select class="form-control" name="edocivil">
							@foreach($edocivil as $edo)
							<option value="{{$edo->id}}">{{$edo->nombre}}</option>
							@endforeach
						</select>
						</div>									

						<br>
						<input type="button" onclick="form.submit()" style="margin-left:20px; margin-top: 20px;" class="col-sm-3 btn btn-primary" value="Agregar">

						<a href="{{route('pacientes.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-3 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection

	
<script type="text/javascript">
	function mayus(e) {
    e.value = e.value.toUpperCase();
}
</script>

