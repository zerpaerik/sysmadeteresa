@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Método</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="metodos/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Pacientes</label>
						<div class="col-sm-3">
							<select id="el1" value="{{$paciente}}" name="paciente">
								@foreach($pacientes as $paciente)
									<option value="{{$paciente->id}}">
										{{$paciente->dni}} - 
										{{$paciente->nombres}} {{$paciente->apellidos}}
									</option>
								@endforeach
							</select>
						</div>

	               <label class="col-sm-1 control-label">Productos</label>
						<div class="col-sm-3">
							<select id="el2" value="{{$producto}}" name="producto">
								@foreach($productos as $paciente)
									<option value="{{$paciente->id}}">
										{{$paciente->nombre}}
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" value="{{$monto}}"  name="monto" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>
			

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="button" onclick="form.submit()" class="col-sm-2 btn btn-primary" value="Editar">
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