@extends('layouts.app')
@section('content')
	<h1>Cita medica {{$data->title}}</h1>
	<p>Paciente: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>Doctor: {{$data->nombrePro}} {{$data->apellidoPro}}</p>
	<p>Fecha de cita: {{$data->date}}</p>
	<p>Hora: {{$data->start_time}} Hasta las {{$data->end_time}}</p>
	<br>

	<h2>Datos del paciente</h2>
	<p>Nombre: {{$data->nombres}} {{$data->apellidos}} </p>
	<p>DNI paciente: {{$data->dni}}</p>
	<p>Direccion del paciente: {{$data->direccion}}</p>
	<p>Telefono del paciente: {{$data->telefono}}</p>
	<p>Fecha de nacimiento: {{$data->fechanac}}</p>
	<p>Grado de isntruccion del paciente: {{$data->gradoinstruccion}}</p>
	<p>Ocupacion del paciente: {{$data->ocupacion}}</p>	
    <p>Edad del paciente: {{$edad}} años</p>	


	<br>	

	@if($historial)
	<h2>Historia Base de {{$data->nombres}} {{$data->apellidos}}</h2>
		<p>Alergias: {{$historial->alergias}}</p>
		<p>Antecedentes patologicos: {{$historial->antecedentes_patologicos}}</p>
		<p>Antecedentes Personales: {{$historial->antecedentes_personales}}</p>
		<p>Antecedentes Familiares: {{$historial->antecedentes_familiar}}</p>
		<p>Menarquia: {{$historial->menarquia}}</p>
		<p>1º R.S : {{$historial->prs}}</p>

	@else
	<h4>Este usuario no cuenta con un historial base, por favor agregue uno</h4>
		<div></div>
		<form action="historial/create" method="post">
			<div class="form-group">
				{{ csrf_field() }}
				<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
				<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
				<h3>Antecedentes Medicos</h3>

				<label for="" class="col-sm-12">Antecedentes familiares</label>
				<div class="col-sm-12">
					<input required type="text" name="a_familiares">
				</div>

				<label for="" class="col-sm-12">Antecedentes personales</label>
				<div class="col-sm-12">			
					<input required type="text" name="a_personales">
				</div>

				<label for="" class="col-sm-12">Antecedentes patologicos</label>
				<div class="col-sm-12">			
					<input required type="text" name="a_patologicos">
				</div>

				<label for="" class="col-sm-12">Alergias</label>
				<div class="col-sm-12">
					<input required type="text" name="alergias">
				</div>
				<label for="" class="col-sm-12">Menarquia</label>
				<div class="col-sm-12">
					<input type="text" name="menarquia">
				</div>
				<label for="" class="col-sm-12">1º R.S</label>
				<div class="col-sm-12">
					<input type="text" name="prs">
				</div>
				<br>
				<div class="col-sm-12">
					<input type="button" onclick="form.submit()" value="Registrar" class="btn btn-success">
				</div>
			</div>
		</form>
	@endif
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
				<p class="col-sm-6"><strong>peso:</strong> {{ $consulta->peso }}</p>
				<p class="col-sm-6"><strong>FUR:</strong> {{ $consulta->fur }}</p>
				<p class="col-sm-6"><strong>PAP:</strong> {{ $consulta->pap }}</p>
			    <p class="col-sm-6"><strong>MAC:</strong> {{ $consulta->mac }}</p>
				<p class="col-sm-6"><strong>P:</strong> {{ $consulta->p }}</p>
				<p class="col-sm-6"><strong>G:</strong> {{ $consulta->g }}</p>
				<p class="col-sm-6"><strong>Motivo de Consulta:</strong> {{ $consulta->motivo_consulta }}</p>
				<p class="col-sm-6"><strong>Tipo de Enfermedad:</strong> {{ $consulta->tipo_enfermedad }}</p>
				<p class="col-sm-6"><strong>Evolucion Enfermedad:</strong>{{ $consulta->evolucion_enfermedad }}</p>
				<p class="col-sm-6"><strong>Examen Fisico Regional: </strong>{{ $consulta->examen_fisico_regional }}</p>
				<p class="col-sm-6"><strong>Presuncion Diagnostica:</strong> {{ $consulta->presuncion_diagnostica }}</p>
				<p class="col-sm-6"><strong>Diagnostico Final: </strong>{{ $consulta->diagnostico_final }}</p>
				<p class="col-sm-6"><strong>CIEX:</strong> {{ $consulta->CIEX }}</p>
				<p class="col-sm-6"><strong>CIEX: </strong>{{ $consulta->CIEX2 }}</p>
				<p class="col-sm-6"><strong>Examen Auxiliar: </strong>{{ $consulta->examen_auxiliar }}</p>
				<p class="col-sm-6"><strong>Plan de Tratamiento: </strong>{{ $consulta->plan_tratamiento }}</p>
				<p class="col-sm-6"><strong>Proxima CITA </strong>{{ $consulta->prox }}</p>
		        <p  class="col-sm-12"><strong>Atendido Por: </strong> {{ $consulta->personal }}</p>
				<p  class="col-sm-12"><strong>Observaciones: </strong> {{ $consulta->observaciones }}</p>


				<br>
			</div>
		</div>
	
	@endforeach
	<div class="col-sm-12">
	<h3>Registrar nueva Historia</h3>
	<form action="observacion/create" method="post" class="form-horizontal">
		{{ csrf_field() }}
		<div class="form-group">
			<input type="hidden" name="paciente_id" value="{{$data->pacienteId}}">
			<input type="hidden" name="profesional_id" value="{{$data->profesionalId}}">
			<input type="hidden" name="evento" value="{{$data->id}}">
             <div class="row">
			  <label class="col-sm-3">DEJAR PENDIENTE?:</label>
			<div class="col-sm-2">
				<select id="el3" name="pendiente" required="true">
					<option value="0">No</option>
					<option value="1">Si</option>
				</select>
			</div> 
			</div>
           <div class="row">
            <label for="" class="col-sm-2 control-label">Motivo de Consulta</label>
			<div class="col-sm-4 control-label">	
				<input  required class="form-control" type="text" name="motivo_consulta">		
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
				<input type="text" name="apetito" class="form-control">
			</div>
			
		
			<label for="" class="col-sm-2 control-label">P/A</label>
			<div class="col-sm-4">
				<input type="text" name="pa" class="form-control">
			</div>
			<label for="" class="col-sm-2 control-label">Sed:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="sed">
			</div>
			<label for=""class="col-sm-2 control-label">Frec.Cardìaca</label>
			<div class="col-sm-4">
				<input class="form-control" type="text" name="card">
			</div>
			

			<label for="" class="col-sm-2 control-label">Frecuencia.Micciones</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Frecuencia Micciones" type="text" name="orina">
			</div>
			<label for="" class="col-sm-2 control-label">Peso</label>
			<div class="col-sm-4">			
				<input  class="form-control" type="text" name="peso">
			</div>
			<label for="" class="col-sm-2 control-label">Animo</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="animo">
			</div>
			<label for="" class="col-sm-2 control-label">Temperatura</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="temperatura">
			</div>
			<label for="" class="col-sm-2 control-label">Frecuencia.Deposiciones</label>
			<div class="col-sm-4">	
				<input  class="form-control" placeholder="Frecuencia Deposiciones" type="text" name="deposiciones">
			</div>
			<label for="" class="col-sm-2 control-label">Pulso:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="pulso">
			</div>
			<label for="" class="col-sm-2 control-label">Evol.Enf</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Evolucion de la enfermedad" type="text" name="evolucion_enfermedad">
			</div>	
			<label for="" class="col-sm-2 control-label">Tipo de enfermedad:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="tipo_enfermedad">
			</div>
			<br>
			<label for="" class="col-sm-12 control-label"><strong>Solo para pacientes Femeninas:</strong></label>

			<label for="" class="col-sm-2 control-label">FUR:</label>
			<div class="col-sm-4">	
				<input class="form-control" type="date" name="fur">
			</div>

			<label for="" class="col-sm-2 control-label">PAP:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="date" name="pap">
			</div>

			<label for="" class="col-sm-2 control-label">MAC:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="mac">
			</div>

			<label for="" class="col-sm-2 control-label">P:</label>
			<div class="col-sm-4">	
				<input  class="form-control" type="text" name="p">
			</div>

			<label for="" class="col-sm-2 control-label">G:</label>
			<div class="col-sm-4">	
				<input   class="form-control" type="text" name="g">
			</div>


			<br>
			<label class="col-sm-12" for="">Examen Fisico General y Regional</label>
			<div class="col-sm-12">	
				<input   class="form-control" type="text" name="examen_fisico_regional">
			</div>
			<br>
            <div class="row">
			<label for="" class="col-sm-2 control-label">Pres.Diag</label>
			<div class="col-sm-4">	
				<input   class="form-control" placeholder="Presunciòn Diagnostica" type="text" name="presuncion_diagnostica">
			</div>

		
			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el6" name="ciex">
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
				<input   class="form-control" placeholder="Diagnostica Final" type="text" name="diagnostico_final">
			</div>

			<label class="col-sm-2">CIE-X:</label>
			<div class="col-sm-4">
				<select id="el4" name="ciex2">
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
				<input   class="form-control" type="text" name="examen_auxiliar">
			</div>
			
			
			<div class="row">
			<label for="" class="col-sm-3 control-label">Plan de Tratamiento</label>
			<div class="col-sm-12">	
				<input   class="form-control" type="text" name="plan_tratamiento">
			</div>
			</div>

			<label for="" class="col-sm-2 control-label">Observaciones</label>
			<div class="col-sm-10">	
				<textarea name="observaciones" cols="10" rows="10" class="form-control" ></textarea>
			</div>
			<label for="" class="col-sm-2 ">Pròxima Cita</label>
			<div class="col-sm-3">
				<input type="date" name="prox" class="form-control" >
			</div>






			<label class="col-sm-2">Personal Responsable:</label>
			<div class="col-sm-3">
				<select id="el1" name="personal">
					@foreach($personal as $per)
					<option value="{{$per->name}},{{$per->lastname}}">
						{{$per->name}} {{$per->lastname}}
					</option>
					@endforeach
				</select>
			</div> 

				
			
			<label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Materiales Usados</label>
            <!-- sheepIt Form -->
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">

                    <label for="laboratorios_#index#_laboratorio" class="col-sm-1 control-label">Materiales</label>
                    <div class="col-sm-4">
                      <select id="laboratorios_#index#_laboratorio" name="id_laboratorio[laboratorios][#index#][laboratorio]" class="selectLab form-control">
                        <option value="1">Seleccionar Material</option>
                        @foreach($productos as $pac)
                          <option value="{{$pac->id}}">
                            {{$pac->nombre}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="laboratorios_#index#_abonoL" class="col-sm-1 control-label">Cantidad Usada:</label>
                    <div class="col-sm-2">

                      <input id="laboratorios_#index#_abonoL" name="monto_abol[laboratorios][#index#][abono] type="text" class="number form-control abonoL" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono" value="0.00">
                    </div>

                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún laboratorios</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="laboratorios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="laboratorios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Producto</span></a></div>
                    <div id="laboratorios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
                    <div id="laboratorios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
						
					</div>
          <hr>

          <div class="form-group form-inline">
            <div class="col-sm-8 col-sm-offset-7">
              <div class="col-sm-2 text-right" style="font-weight: 600; font-size: 12px">
                Total Solicitados:
              </div>
              <input type="text" name="total_a" class="number form-control" value="0.00" id="total_a" readonly="readonly" style="width: 150px">
            </div>
          </div>
			
		
			<div class="col-sm-12">
				<input type="button" onclick="form.submit()" value="Registrar" class="btn btn-success" class="form-control">
			</div>
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
    $("#el6").select2();
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