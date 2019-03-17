	
@extends('layouts.app')

@section('content')
	<div class="col-sm-12">
	<h3>Completar Historia</h3>
	<form action="observacion/edit" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			
             <div class="row">
			  <label class="col-sm-3">DEJAR PENDIENTE?:</label>
			<div class="col-sm-2">
				<select id="el3" name="pendiente" required="true" value="{{$historias->pendiente}}">
					<option value="0" value="{{$historias->pendiente}}">No</option>
					<option value="1" value="{{$historias->pendiente}}">Si</option>
				</select>
			</div> 
			</div>
           <div class="row">
            <label for="" class="col-sm-2 control-label">Motivo de Consulta</label>
			<div class="col-sm-4 control-label">	
				<input  required class="form-control" value="{{$historias->motivo_consulta}}" type="text" name="motivo_consulta">		
			</div>
		  </div>

		

		  <div class="col-md-6">
		  	            <label for="" class="col-sm-2 control-label">Func.Biològicas</label>
		  </div>
		   <div class="col-md-6">
		  	            <label for="" class="col-sm-2 control-label">Func.Vitales</label>
		  </div>
			 <label for="" class="col-sm-2 control-label">Apetito</label>
			<div class="col-sm-4">
				<input type="text" name="apetito" value="{{$historias->apetito}}" class="form-control">
			</div>
			
		
			<label for="" class="col-sm-2 control-label">P/A</label>
			<div class="col-sm-4">
				<input type="text" name="pa" value="{{$historias->pa}}" class="form-control">
			</div>
			<label for="" class="col-sm-2 control-label">Sed:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="sed" value="{{$historias->sed}}">
			</div>
			<label for=""class="col-sm-2 control-label">Frec.Cardìaca</label>
			<div class="col-sm-4">
				<input class="form-control" type="text" name="card" value="{{$historias->card}}">
			</div>
			

			<label for="" class="col-sm-2 control-label">Frecuencia.Micciones</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Frecuencia Micciones" type="text" name="orina" value="{{$historias->orina}}">
			</div>
			<label for="" class="col-sm-2 control-label">Peso</label>
			<div class="col-sm-4">			
				<input  class="form-control" type="text" name="peso" value="{{$historias->peso}}">
			</div>
			<label for="" class="col-sm-2 control-label">Animo</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="animo" value="{{$historias->animo}}">
			</div>
			<label for="" class="col-sm-2 control-label">Temperatura</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="temperatura" value="{{$historias->temperatura}}">
			</div>
			<label for="" class="col-sm-2 control-label">Frecuencia.Deposiciones</label>
			<div class="col-sm-4">	
				<input  class="form-control" placeholder="Frecuencia Deposiciones" type="text" name="deposiciones" value="{{$historias->deposiciones}}">
			</div>
			<label for="" class="col-sm-2 control-label">Pulso:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="pulso" value="{{$historias->pulso}}">
			</div>
			<label for="" class="col-sm-2 control-label">Evol.Enf</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Evolucion de la enfermedad" type="text" name="evolucion_enfermedad" value="{{$historias->evolucion_enfermedad}}">
			</div>	
			<label for="" class="col-sm-2 control-label">Tipo de enfermedad:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="tipo_enfermedad" value="{{$historias->tipo_enfermedad}}">
			</div>
			<br>
			<label for="" class="col-sm-12 control-label"><strong>Solo para pacientes Femeninas:</strong></label>

			<label for="" class="col-sm-2 control-label">FUR:</label>
			<div class="col-sm-4">	
				<input class="form-control" type="date" name="fur" value="{{$historias->fur}}">
			</div>

				<label for="" class="col-sm-2 control-label">Amenorrea:</label>
			<div class="col-sm-4">	
				<input class="form-control" type="date" name="amenorrea" value="{{$historias->amenorrea}}">
			</div>

				<label for="" class="col-sm-2 control-label">Andria:</label>
			<div class="col-sm-4">	
				<input class="form-control" type="date" name="andria" value="{{$historias->andria}}">
			</div>

			<label for="" class="col-sm-2 control-label">PAP:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="date" name="pap" value="{{$historias->pap}}">
			</div>

			<label for="" class="col-sm-2 control-label">MAC:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="mac" value="{{$historias->mac}}">
			</div>

			<label for="" class="col-sm-2 control-label">P:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="p" value="{{$historias->p}}">
			</div>

			<label for="" class="col-sm-2 control-label">G:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="g" value="{{$historias->g}}">
			</div>


			<br>
			<label class="col-sm-12" for="">Examen Fisico General y Regional</label>
			<div class="col-sm-12">	
				<input   class="form-control" type="text" name="examen_fisico_regional" value="{{$historias->examen_fisico_regional}}">
			</div>
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">Pres.Diag</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Presunciòn Diagnostica" type="text" name="presuncion_diagnostica" value="{{$historias->presuncion_diagnostica}}">
			</div>

		
			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el3" name="ciex" value="{{$historias->CIEX}}">
					@foreach($ciex as $c)
					<option value="{{$c->codigo}}-{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
			</div>
            
		<div class="row">
			<label for="" class="col-sm-2 ">Diag.Final</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnostica Final" type="text" name="diagnostico_final" value="{{$historias->diagnostico_final}}">
			</div>

			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el4" name="ciex2" value="{{$historias->CIEX2}}">
					@foreach($ciex as $c)
					<option value="{{$c->nombre}}">
						{{$c->codigo}}-{{$c->nombre}}
					</option>
					@endforeach
				</select>
			</div> 
			
		</div>

			<label for="" class="col-sm-2 control-label">Examen Auxiliar</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="examen_auxiliar" value="{{$historias->examen_auxiliar}}">
			</div>
			
			
			<div class="row">
			<label for="" class="col-sm-3 control-label">Plan de Tratamiento</label>
			<div class="col-sm-12">	
				<input   class="form-control" type="text" name="plan_tratamiento" value="{{$historias->plan_tratamiento}}">
			</div>
			</div>

			<label for="" class="col-sm-2 control-label">Observaciones</label>
			<div class="col-sm-10">	
				<textarea name="observaciones" cols="10" rows="10" class="form-control" value="{{$historias->observaciones}}"></textarea>
			</div>
			<label for="" class="col-sm-2 ">Pròxima Cita</label>
			<div class="col-sm-3">
				<input type="date" name="prox" class="form-control" value="{{$historias->prox}}">
			</div>






			<label class="col-sm-2">Personal Responsable:</label>
			<div class="col-sm-3">
				<select id="el1" name="personal" value="{{$historias->personal}}">
					@foreach($personal as $per)
					<option value="{{$per->name}},{{$per->lastname}}">
						{{$per->name}} {{$per->lastname}}
					</option>
					@endforeach
				</select>
			</div> 

				
			
            <!-- sheepIt Form -->
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">

                  

                    <div class="col-sm-2">

                     
                    </div>

                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún laboratorios</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
						
					</div>
          <hr>
            		<input type="hidden" name="id" value="{{$historias->consulta}}">

			
	
			<div class="col-sm-12">
				<input type="button" onclick="form.submit()" value="Registrar" class="btn btn-success" class="form-control">
			</div>
		</div>


@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jqNumber/jquery.number.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">

  $(document).ready(function() {

    $(".monto").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#servicios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#servicios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".montol").keyup(function(event) {
      var montoId = $(this).attr('id');
      var montoArr = montoId.split('_');
      var id = montoArr[1];
      var montoH = parseFloat($('#laboratorios_'+id+'_montoHidden').val());
      var monto = parseFloat($(this).val());
      $('#laboratorios_'+id+'_montoHidden').val(monto);
      calcular();
      calculo_general();
    });

    $(".abonoL, .abonoS").keyup(function(){
      var total = 0;
      var selectId = $(this).attr('id');
      var selectArr = selectId.split('_');
      
      if(selectArr[0] == 'servicios'){
          if(parseFloat($(this).val()) > parseFloat($("#servicios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      } else {
        if(parseFloat($(this).val()) > parseFloat($("#laboratorios_"+selectArr[1]+"_monto").val())){
              alert('La cantidad insertada en abono es mayor al monto.');
              $(this).val('0.00');
              calculo_general();
          } else {
              calculo_general();
          }
      }
    });

    var botonDisabled = true;

    // Main sheepIt form
    var phonesForm = $("#laboratorios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        
        afterRemoveCurrent: function(source, event){
          calcular();
          calculo_general();
        }
    });

 
    $(document).on('change', '.selectLab', function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "analisis/getAnalisi/"+$(this).val(),
         success: function(a) {
            $('#laboratorios_'+id+'_montoHidden').val(a.preciopublico);
            $('#laboratorios_'+id+'_monto').val(a.preciopublico);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.preciopublico));
            calcular();
            calculo_general();
         }
      });
    })
});


function calcular() {
  var total = 0;
      $(".monto").each(function(){
        total += parseFloat($(this).val());
      })

      $(".montol").each(function(){
        total += parseFloat($(this).val());
      })

      $("#total").val(total);
}

function calculo_general() {
  var total = 0;
  $(".abonoL").each(function(){
    total += parseFloat($(this).val());
  })

  $(".abonoS").each(function(){
    total += parseFloat($(this).val());
  })

  $("#total_a").val(total);
  $("#total_g").val(parseFloat($("#total").val()) - parseFloat(total));
}

// Run Select2 on element
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
  $("#el4").select2();
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	LoadTimePickerScript(DemoTimePicker);
	WinMove();
});

function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
	$('#input_time').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
	$('#input_time2').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
}
</script>


@endsection
@endsection


