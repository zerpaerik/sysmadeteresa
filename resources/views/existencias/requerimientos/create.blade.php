@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Redactar Requerimiento</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="requerimientos/create">
					{{ csrf_field() }}
					<div class="form-group">

						<label class="col-sm-2 control-label">Solicitar A:</label>
						<div class="col-sm-2">
							<select class="form-control" name="id_sede_solicitada">
								<option value="0">Seleccione:</option>
								@foreach($sedes as $sede)
								<option value="{{$sede->id}}">{{$sede->name}}</option>
								@endforeach
							</select>
						</div>	
						<br>
						<br>
						<div class="panel-body">
							<form>
								<textarea class="ckeditor" name="descripcion" id="descripcion" rows="10" cols="80">  Acà se tipea el requerimiento:
								</textarea>
							</form>
						</div>
					
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Guardar">

						<a href="{{route('requerimientos.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection