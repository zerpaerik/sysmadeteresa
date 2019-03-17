@extends('layouts.app')
@section('content')
<div class="col-sm-4">
	<h2>Datos del paciente</h2>
	<p>Nombre: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>DNI paciente: {{$data->dni}}</p>
	<p>Direccion del paciente: {{$data->direccion}}</p>
	<p>Telefono del paciente: {{$data->telefono}}</p>
	<p>Fecha de nacimiento: {{$data->fechanac}}</p>
	<p>Grado de isntruccion del paciente: {{$data->gradoinstruccion}}</p>
	<p>Ocupacion del paciente: {{$data->ocupacion}}</p>	
</div>	
<div class="col-sm-8">

	@if($historial)
	<h2>Historia Base de {{$data->nombres}} {{$data->apellidos}}</h2>
		<p>Alergias: {{$historial->alergias}}</p>
		<p>Antecedentes patologicos: {{$historial->antecedentes_patologicos}}</p>
		<p>Antecedentes Personales: {{$historial->antecedentes_personales}}</p>
		<p>Antecedentes Familiares: {{$historial->antecedentes_familiar}}</p>
		<p>Menarquia: {{$historial->menarquia}}</p>
		<p>1º R.S : {{$historial->prs}}</p>

	@else
	
	@endif
</div>	

<br>
	
	<br>
	<h2>Resultados anteriores de {{$data->nombres}} {{$data->apellidos}}</h2>
	@foreach($consultas as $consulta)
	<div class="rows">
		<div class="col-sm-6">
			<div class="rows">
				<h3 class="col-sm-12"><strong>Consulta del {{$consulta->created_at}}</strong></h3>
				<p class="col-sm-6"><strong>P/A:</strong> {{ $consulta->pa }}</p>
				<p class="col-sm-6"><strong>Sed:</strong> {{ $consulta->sed }}</p>
				<p class="col-sm-6"><strong>Apetito:</strong> {{ $consulta->apetito }}</p>
				<p class="col-sm-6"><strong>Animo:</strong> {{ $consulta->animo }}</p>
				<p class="col-sm-6"><strong>Frecuencia Micciones:</strong> {{ $consulta->orina }}</p>
				<p class="col-sm-6"><strong>Frecuencia Deposiciones:</strong> {{ $consulta->deposiciones }}</p>
				<p class="col-sm-6"><strong>Frecuencia Cardìaca:</strong> {{ $consulta->card }}</p>
				<p class="col-sm-6"><strong>Pulso:</strong> {{ $consulta->pulso }}</p>
				<p class="col-sm-6"><strong>Temperatura:</strong> {{ $consulta->temperatura }}</p>
				<p class="col-sm-6"><strong>Peso:</strong> {{ $consulta->peso }} kG</p>
				<p class="col-sm-6"><strong>FUR:</strong> {{ $consulta->fur }}</p>
        <p class="col-sm-6"><strong>Amenorrea:</strong> {{ $consulta->amenorrea }}</p>
        <p class="col-sm-6"><strong>Andria:</strong> {{ $consulta->andria }}</p>
				<p class="col-sm-6"><strong>PAP:</strong> {{ $consulta->pap }}</p>
			  <p class="col-sm-6"><strong>MAC:</strong> {{ $consulta->MAC }}</p>
				<p class="col-sm-6"><strong>P:</strong> {{ $consulta->p }},<strong>G:</strong>{{ $consulta->g }}</p>
				<p class="col-sm-6"><strong>Motivo de Consulta:</strong> {{ $consulta->motivo_consulta }}</p>
				<p class="col-sm-6"><strong>Tipo de Enfermedad:</strong> {{ $consulta->tipo_enfermedad }}</p>
				<p class="col-sm-6"><strong>Evolucion Enfermedad:</strong>{{ $consulta->evolucion_enfermedad }}</p>
				<p class="col-sm-6"><strong>Examen Fisico Regional: </strong></p>
        <p class="col-sm-6"><strong>Piel/Mucosas: </strong>{{ $consulta->piel }}</p>
        <p class="col-sm-6"><strong>Mamas: </strong>{{ $consulta->mamas }}</p>
        <p class="col-sm-6"><strong>Abdomen: </strong>{{ $consulta->abdomen }}</p>
        <p class="col-sm-6"><strong>Genitales Externos: </strong>{{ $consulta->genext }}</p>
        <p class="col-sm-6"><strong>Genitales Internos: </strong>{{ $consulta->genint }}</p>
        <p class="col-sm-6"><strong>Miembros Inferiores: </strong>{{ $consulta->miembros }}</p>
				<p class="col-sm-6"><strong>Presuncion Diagnostica:</strong> {{ $consulta->presuncion_diagnostica }}</p>
				<p class="col-sm-6"><strong>Diagnostico Final: </strong>{{ $consulta->diagnostico_final }}</p>
				<p class="col-sm-6"><strong>CIEX:</strong> {{ $consulta->CIEX }}</p>
				<p class="col-sm-6"><strong>CIEX: </strong>{{ $consulta->CIEX2 }}</p>
				<p class="col-sm-6"><strong>Examen Auxiliar: </strong>{{ $consulta->examen_auxiliar }}</p>
				<p class="col-sm-6"><strong>Plan de Tratamiento: </strong>{{ $consulta->plan_tratamiento }}</p>
				<p class="col-sm-6"><strong>Proxima CITA </strong>{{ $consulta->prox }}</p>
				<p class="col-sm-12"><strong>Atendido Por: </strong> {{ $consulta->personal }}</p>
				<p class="col-sm-12"><strong>Observaciones: </strong> {{ $consulta->observaciones }}</p>
				<br>
			</div>
		</div>
	
	@endforeach
	<div class="col-sm-12">
	<form action="observacion/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
          

	

			
			
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

         
			
		
		</div>
		</div>
	</form>
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