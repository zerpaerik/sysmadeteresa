@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Nueva consulta</strong></span>
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
			   <a href="{{route('pacientes.create3')}}"><i class="fa fa-wheelchair"></i> Crear Pacientes<a>
			<form class="form-horizontal" role="form" method="post" action="consulta/create">

			<div class="box-content">

				<h4 class="page-header"></h4>
				<div class="row">

				<div class="col-md-4">
					<input type="text" name="filtro" id="filtros" placeholder="Buscar por DNI">
				</div>

			
			</div>

            			

			<div class="row">
					<div class="col-md-6">
					     <select name="paciente" id="pacientes">
                         <option value="">Seleccione Paciente</option>
                         </select>
						</div>	
				<div class="col-md-6">
				
				</div>
			</div>
					{{ csrf_field() }}

				
					<div class="form-group">
						
						<label class="col-sm-1 control-label">Especialistas</label>
						<div class="col-sm-2">
							<select id="el2" name="especialista">
									<option value="33">ALEX CALERO</option>
						            <option value="19">JENNY MOLINA</option>
									<option value="35">ROSA GOLINDARO</option>
									<option value="36">OTROS</option>
							</select>
						</div>

					
						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-2">
							<input type="text" class="form-control" placeholder="Monto" name="monto" required="required">
						</div>

					
						

							<label class="col-sm-1 control-label">TipoPago</label>
							<div class="col-sm-2">
								<select id="el4" name="tipopago">
										<option value="EF">EF</option>
										<option value="TJ">TJ</option>
								</select>
							</div>	

							<label class="col-sm-1 control-label">Tipo</label>
							<div class="col-sm-2">
								<select id="el5" name="tipo">
										<option value="CONSULTAS">CONSULTAS</option>
										<option value="CONTROLES">CONTROLES</option>
								</select>
							</div>		

						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-3 btn btn-primary" value="Agregar">

					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script type="text/javascript">

  $(document).ready(function(){
    $("#filtros").change(function(){
      var filtro = $(this).val();
      $.get('pacienteByFiltro/'+filtro, function(data){
//esta el la peticion get, la cual se divide en tres partes. ruta,variables y funcion
        console.log(data);
          var pacient_select = '<option value="">Seleccione Paciente</option>'
            for (var i=0; i<data.length;i++)
              pacient_select+='<option value="'+data[i].id+'">'+data[i].dni+' '+data[i].apellidos+' '+data[i].nombres+'</option>';

            $("#pacientes").html(pacient_select);

      });
    });
  });


// Run Select2 on element
$(document).ready(function() {
	LoadTimePickerScript(DemoTimePicker);
	LoadSelect2Script(function (){
		$("#el2").select2();
		$("#el4").select2();
		$("#el5").select2();
		$("#pacientes").select2();
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
