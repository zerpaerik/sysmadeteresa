@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<a href="{{asset('visitar-create')}}" class="btn btn-primary">Agregar</a>

			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-truck"></i>
					<span><strong>Registro de Visitas</strong></span>
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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/visitas-search" method="get">
						<h5>Rango de Fechas</h5>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<label for="">Final</label>
						<input type="date" name="final" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<input type="submit">
					</form>
				
					<thead>
						<tr>
							<th>Profesional</th>
							<th>Consultorio</th>
							<th>Especialidad</th>
							<th>Visitador</th>
							<th>Fecha de Visita</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($visitas as $atec)	

						<tr>
							<td>{{$atec->name}},{{$atec->apellidos}}</td>
							<td>{{$atec->centro}}</td>
							<td>{{$atec->especialidad}}</td>
							<td>{{$atec->nomvi}},{{$atec->apevi}}</td>
							<td>{{$atec->created_at}}</td>
						</tr>
						@endforeach
					</tbody>
					<tfoot>
							
					</tfoot>
				</table>
			</div>
		
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif
@section('scripts')

<script type="text/javascript">
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
  $("#el4").select2();
}
</script>

@endsection
@endsection