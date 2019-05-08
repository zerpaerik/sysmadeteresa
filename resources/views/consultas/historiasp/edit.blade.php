	
@extends('layouts.app')

@section('content')
	<div class="col-sm-12">
	<h3>Completar Historia</h3>
	<form action="observacion/edit" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			
             <div class="row">
             	<br>
			  <label class="col-sm-3">CERRAR HISTORIA?:</label>
			<div class="col-sm-2">
				<select style="background: #F0CD1C;" name="pendiente" required="true">
					<option value="0">Si</option>
					<option value="1">No</option>
				</select>
			</div> 
			</div>
           <div class="row">
            <label for="" class="col-sm-2 ">Motivo de Consulta:</label>
			<div class="col-sm-10 control-label">	
				<textarea name="motivo_consulta" cols="10" rows="4" class="form-control">{{$historias->motivo_consulta}}</textarea>		
			</div>
		  </div>

		<div class="row">
			<label for="" class="col-sm-2">Funciones Vitales:</label>
		</div>
		<br>
		<div class="row">

			<label for="" class="col-sm-1 control-label">P/A:</label>
			<div class="col-sm-1">
				<input type="text" name="pa" class="form-control" placeholder="mmgh-" value="{{$historias->pa}}">
			</div>

			<label for="" class="col-sm-1 control-label">Pulso:</label>
			<div class="col-sm-1">	
				<input   class="form-control" type="text" name="pulso" value="{{$historias->pulso}}">
			</div>

			<label for="" class="col-sm-1 control-label">Temperatura:</label>
			<div class="col-sm-1">	
				<input   class="form-control" type="text" name="temperatura" placeholder="ºC" value="{{$historias->temperatura}}">
			</div>

			<label for="" class="col-sm-1 control-label">Peso:</label>
			<div class="col-sm-1">			
				<input  class="form-control" type="text" name="peso" placeholder="Kg" value="{{$historias->peso}}">
			</div>

			<label for="" class="col-sm-1 control-label">Talla:</label>
			<div class="col-sm-1">			
				<input  class="form-control" type="text" name="talla" placeholder="Cm" value="{{$historias->talla}}">
			</div>

		</div>
		<br>

		<div class="row">
			<label for="" class="col-sm-2">Funciones Biológicas:</label>
		</div>
		<br>
		<div class="row">
			<label for="" class="col-sm-1 control-label">Apetito:</label>
			<div class="col-sm-2">
				<input type="text" name="apetito" class="form-control" value="{{$historias->apetito}}">
			</div>

			<label for="" class="col-sm-1 control-label">Sed:</label>
			<div class="col-sm-2">	
				<input type="text" name="sed" class="form-control" value="{{$historias->sed}}">
			</div>

			<label for="" class="col-sm-1 control-label">Animo</label>
			<div class="col-sm-2">	
				<input type="text" name="animo" class="form-control" value="{{$historias->animo}}">
			</div>

			<label for="" class="col-sm-1 control-label">Frec.Mic:</label>
			<div class="col-sm-2">	
				<input   class="form-control" placeholder="Frec. Micciones" type="text" name="orina" placeholder="c 24/hrs" value="{{$historias->orina}}">
			</div>

			<label for=""class="col-sm-1 control-label">Frec.Card:</label>
			<div class="col-sm-2">
				<input class="form-control" type="text" name="card" placeholder="x min" value="{{$historias->card}}">
			</div>

			<label for="" class="col-sm-1 control-label">Frec.Depo:</label>
			<div class="col-sm-2">	
				<input  class="form-control" placeholder="Frec. Deposiciones" type="text" name="deposiciones" placeholder="c 24/hrs" value="{{$historias->deposiciones}}">
			</div>

		</div>
		<br>
		<div class="row">
			<label for="" class="col-sm-2">Antecedentes:</label>
		</div>
		<div class="row">
			<label for="" class="col-sm-1 control-label">FUR:</label>
			<div class="col-sm-2">	
				<input class="form-control" type="date" name="fur" value="{{$historias->fur}}">
			</div>

			<label for="" class="col-sm-1 control-label">PAP:</label>
			<div class="col-sm-2">	
				<input   class="form-control" type="text" name="pap" value="{{$historias->pap}}">
			</div>

			<label for="" class="col-sm-1 control-label">MAC:</label>
			<div class="col-sm-2">	
				<input  class="form-control" type="text" name="mac" value="{{$historias->MAC}}">
			</div>

			<label for="" class="col-sm-1 control-label">Andria:</label>
			<div class="col-sm-2">	
				<input class="form-control" type="text" name="andria" value="{{$historias->andria}}">
			</div>
		</div>
		<div class="row">

			<label for="" class="col-sm-1 control-label">G:</label>
			<div class="col-sm-2">	
				<input   class="form-control" type="text" name="g" value="{{$historias->g}}">
			</div>

			<label for="" class="col-sm-1 control-label">P:</label>
			<div class="col-sm-2">	
				<input  class="form-control" type="text" name="p" value="{{$historias->p}}">
			</div>

			<label for="" class="col-sm-1 control-label">Amenorrea:</label>
			<div class="col-sm-2">	
				<input class="form-control" type="text" name="amenorrea" value="{{$historias->amenorrea}}">
			</div>
		</div>
		<br>
		<div class="row">
			<label class="col-sm-4">Exámen Físico y Regional:</label>
		</div>
		<div class="row">
			
			<div class="col-sm-4"><strong>Piel/Mucosas:</strong>
				<input class="form-control" type="text" name="piel" value="{{$historias->piel}}">
			</div>
			<div class="col-sm-4"><strong>Mamas:</strong>
				<input class="form-control" type="text" name="mamas" value="{{$historias->mamas}}">
			</div>
			<div class="col-sm-4"><strong>Abdomen:</strong>
				<input class="form-control" type="text" name="abdomen" value="{{$historias->abdomen}}">
			</div>
			<div class="col-sm-4"><strong>Genitales Externos:</strong>
				<input class="form-control" type="text" name="genext" value="{{$historias->genext}}">
			</div>
			<div class="col-sm-4"><strong>Genitales Internos:</strong>
				<input class="form-control" type="text" name="genint" value="{{$historias->genint}}">
			</div>
			<div class="col-sm-4"><strong>Miembros Inferiores:</strong>
				<input class="form-control" type="text" name="miembros" value="{{$historias->miembros}}">
			</div>

		</div>
		<br>
		<div class="row">
			<label for="" class="col-sm-2">Evol. Enfermedad:</label>
			<div class="col-sm-4">	
				<input type="text" name="evolucion_enfermedad" class="form-control" value="{{$historias->evolucion_enfermedad}}">
			</div>	
			<label for="" class="col-sm-2 control-label">Tipo de enfermedad:</label>
			<div class="col-sm-4">	
					<input type="text" name="tipo_enfermedad" class="form-control" value="{{$historias->tipo_enfermedad}}">
			</div>
		</div>
		<br>
        <div class="row">
			<label for="" class="col-sm-2">Presunción Diagóstica</label>
			<div class="col-sm-4">	
				<input class="form-control" placeholder="Presunción Diagnostica" type="text" name="presuncion_diagnostica" value="{{$historias->presuncion_diagnostica}}">
			</div>

			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<input type="text" name="ciex" class="form-control" value="{{$historias->CIEX}}">
			</div> 
			
		</div>
            
		<div class="row">
			<label for="" class="col-sm-2">Diagnóstico Final</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Diagnostica Final" type="text" name="diagnostico_final" value="{{$historias->diagnostico_final}}">
			</div>

			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<input type="text" name="ciex2" class="form-control" value="{{$historias->CIEX2}}">
			</div> 
			
		</div>
		<br>
		<div class="row">

			<label for="" class="col-sm-2">Examen Auxiliar:</label>
			<div class="col-sm-10">	
				<textarea class="form-control" cols="10" rows="4" name="examen_auxiliar">{{$historias->examen_auxiliar}}</textarea>
			</div>

			<label for="" class="col-sm-2"><strong>Plan de Tratamiento:</strong></label>
			<div class="col-sm-10">	
				<textarea class="form-control" cols="10" rows="4" name="plan_tratamiento">{{$historias->plan_tratamiento}}</textarea>
			</div>

			<label for="" class="col-sm-2">Observaciones</label>
			<div class="col-sm-10">	
				<textarea name="observaciones" cols="10" rows="4" class="form-control">{{$historias->observaciones}}</textarea>
			</div>
			<label for="" class="col-sm-2 ">Pròxima Cita</label>
			<div class="col-sm-3">
				<input type="date" name="prox" class="form-control" value="{{$historias->prox}}">
			</div>

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
            		<input type="hidden" name="id" value="{{$historias->id}}">

			
	
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


