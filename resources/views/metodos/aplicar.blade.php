@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Aplicar Método -Paciente: {{$pacientee->nombres}} {{$pacientee->apellidos}} - Mètodo {{$metodo->nombre}}</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="metodos/aplicar">
					{{ csrf_field() }}
				<h2>Aplicaciones anteriores de {{$pacientee->nombres}} {{$pacientee->apellidos}}</h2>
	@foreach($metodos as $m)
	<div class="rows">
		<div class="col-sm-12">
			<div class="rows">
				<h3 class="col-sm-12"><strong>Aplicacion del {{$m->created_at}}</strong></h3>
				<p class="col-sm-6"><strong>Peso:</strong> {{ $m->peso }}</p>
		     	<p class="col-sm-6"><strong>Talla:</strong> {{ $m->talla }}</p>
				<p class="col-sm-6"><strong>Observacion:</strong> {{ $m->observacion }}</p>
				<p class="col-sm-6"><strong>Registrado Por:</strong> {{ $m->name }} {{ $m->lastname }}</p>

				
			
				<br>
			</div>
		</div>
	
	@endforeach
					<div class="form-group">

						<label class="col-sm-1 control-label">Peso</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="peso" placeholder="Peso" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

						<label class="col-sm-1 control-label">Talla</label>
						<div class="col-sm-1">
							<input type="text" class="form-control" name="talla" placeholder="Talla" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

							<label class="col-sm-1 control-label">Observaciòn</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="observacion" placeholder="Observaciòn" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>
			

						<input type="hidden" name="id" value="{{$id}}">
						<input type="hidden" name="paciente" value="{{$paciente}}">


						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Aplicar">
							<a href="{{route('metodos.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
	LoadTimePickerScript(DemoTimePicker);
	LoadSelect2Script(function (){
		$("#el2").select2();
		$("#el1").select2();
		$("#el3").select2({disabled : true});
	});
	WinMove();
});

$('#input_date').on('change', getAva);
$('#el1').on('change', getAva);

function getAva (){
		var d = $('#input_date').val();
		var e = $("#el1").val();
		if(!d) return;
		$.ajax({
      url: "available-time/"+e+"/"+d,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "get",
      success: function(res){
      	$('#el3').find('option').remove().end();
      	for(var i = 0; i < res.length; i++){
					var newOption = new Option(res[i].start_time+"-"+res[i].end_time, res[i].id, false, false);
					$('#el3').append(newOption).trigger('change');
      	}
      }
    });	
}

function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
}
</script>
@endsection
@endsection