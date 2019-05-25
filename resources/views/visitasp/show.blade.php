@extends('layouts.app')
@section('content')
	<h3>VISITA PROGRAMADA: {{$data->title}}</h3>
    <p>Centro: {{$data->centro}}</p>
	<p>Visitador: {{$data->name}} {{$data->lastname}} </p>
	<p>Fecha: {{$data->date}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	@if($data->observacion == NULL)
	<form class="form-horizontal" role="form" method="post" action="visitasp/edit2">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="row">

					  
					<label class="col-sm-1 control-label">Observaciòn</label>
						<div class="col-sm-10">
							<input type="text" id="observacion" class="form-control" placeholder="Observaciòn por el Visitador" name="observacion" required="required">
						</div>

					
					</div>

						<input type="hidden" name="id_visita" value="{{$data->id}}">
						
					
						<br>
						<input onclick="form.submit()"  type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Guardar">

						
					</div>			
				</form>	
@else
	<p>Observaciòn por Visitador: {{$data->observacion}}</p>
	<p>Fecha y Hora: {{$data->fecha_obs}}</p>


@endif
	
@endsection