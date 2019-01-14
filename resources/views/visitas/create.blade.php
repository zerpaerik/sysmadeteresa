@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-truck"></i>
					<span><strong>Registrar Visita</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="visitar/create">
					{{ csrf_field() }}
					<div class="form-group">
						
						<label class="col-sm-1 control-label">Profesional</label>
						<div class="col-sm-9">
							<select class="form-control" name="profesional" id="profesional">
							@foreach($profesionales as $lab)
							<option value="{{$lab->id}}">{{$lab->name}},{{$lab->apellidos}}</option>
							@endforeach
						</select>
						</div>	
													
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('visitas.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection