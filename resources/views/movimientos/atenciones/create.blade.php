@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Atencion</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="atenciones/create">
					{{ csrf_field() }}
					<div class="form-group">

						<div class="row">

						<label class="col-sm-1 control-label">Pacientes</label>
						<div class="col-sm-3">
							<select id="el1" name="id_paciente">
								@foreach($pacientes as $pac)
									<option value="{{$pac->id}}">
										{{$pac->nombres}} {{$pac->apellidos}}-{{$pac->dni}}
									</option>
								@endforeach
							</select>
						</div>

						</div>
						<br>
						<div class="row">

						<label class="col-sm-1 control-label">Origen</label>
						<div class="col-sm-3">
							<select id="el2" name="origen">
								    <option value="0">Seleccione el Origen</option>
									<option value="1">Personal</option>
									<option value="2">Profesional</option>
							</select>
						</div>

						<div class="col-sm-3">
							  <div id="origen1">
						</div>


						</div>
					</div>
					<br>
					
          <div class="row">
            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Servicios seleccionados</label>
            <!-- sheepIt Form -->
            <div id="servicios" class="embed ">
            
                <!-- Form template-->
                <div id="servicios_template" class="template row">

                    <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Servicio</label>
                    <div class="col-sm-3">
                      <select id="servicios_#index#_servicio" name="id_servicio[servicios][#index#][servicio]" class="selectServ form-control">
                        <option value="">Seleccionar servicio</option>}
                        option
                        @foreach($servicios as $pac)
                          <option value="{{$pac->id}}">
                            {{$pac->detalle}}-Precio:{{$pac->precio}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="servicios_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-2">
                      <input id="servicios_#index#_montoHidden" name="monto_h[servicios][#index#][montoHidden]" class="number" type="hidden" value="">

                      <input id="servicios_#index#_monto" name="monto_s[servicios][#index#][monto] type="text" class="number form-control monto" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Monto" value="0.00">
                    </div>

                    <label for="servicios_#index#_monto" class="col-sm-1 control-label">Abono</label>
                    <div class="col-sm-2">

                      <input id="servicios_#index#_abonoS" name="monto_abos[servicios][#index#][abono] type="text" class="number form-control abonoS" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono" value="0.00">
                    </div>

                    <a id="servicios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="servicios_noforms_template" class="noItems col-sm-12 text-center">Ningún servicio</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="servicios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="servicios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar servicio</span></a></div>
                    <div id="servicios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
                    <div id="servicios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
          </div>
					<br>
					<div class="row">

						<!-- <label class="col-sm-1 control-label">Laboratorios</label>
						<div class="col-sm-5">
							<select id="el5" class="selectLab" name="id_laboratorio" multiple="true">
								@foreach($laboratorios as $pac)
									<option value="{{$pac->id}}">
										{{$pac->name}}-Precio:{{$pac->preciopublico}}
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-3">
							<input type="text" class="number monto form-control" name="monto_l" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Monto" value="0.00">
						</div> -->

            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Laboratorios seleccionados</label>
            <!-- sheepIt Form -->
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">

                    <label for="laboratorios_#index#_laboratorio" class="col-sm-1 control-label">Lab</label>
                    <div class="col-sm-3">
                      <select id="laboratorios_#index#_laboratorio" name="id_laboratorio[laboratorios][#index#][laboratorio]" class="selectLab form-control">
                        <option value="">Seleccionar laboratorio</option>}
                        @foreach($laboratorios as $pac)
                          <option value="{{$pac->id}}">
                            {{$pac->name}}-Precio:{{$pac->preciopublico}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="laboratorios_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-2">
                      <input id="laboratorios_#index#_montoHidden" name="monto_h[laboratorios][#index#][montoHidden]" class="number" type="hidden" value="">

                      <input id="laboratorios_#index#_monto" name="monto_l[laboratorios][#index#][monto] type="text" class="number form-control montol" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Monto" value="0.00">
                    </div>

                    <label for="laboratorios_#index#_abonoL" class="col-sm-1 control-label">Abono</label>
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
                    <div id="laboratorios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar laboratorio</span></a></div>
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
                Forma de Pago:
              </div> 
              <select name="tipopago" class="selectLab form-control">
                        <option value="">Seleccionar Tipo de Pago</option>
                        <option value="EF">Efectivo</option>}
                        <option value="TJ">Tarjeta</option> 
              </select>
            </div>
          </div>
          <div class="form-group form-inline">
            <div class="col-sm-8 col-sm-offset-7">
              <div class="col-sm-2 text-right" style="font-weight: 600; font-size: 12px">
                Total:
              </div> 
              <input type="text" name="total" class="number form-control" value="0.00" id="total" readonly="readonly" style="width: 150px">
            </div>
          </div>

          <div class="form-group form-inline">
            <div class="col-sm-8 col-sm-offset-7">
              <div class="col-sm-2 text-right" style="font-weight: 600; font-size: 12px">
                Total abono:
              </div>
              <input type="text" name="total_a" class="number form-control" value="0.00" id="total_a" readonly="readonly" style="width: 150px">
            </div>
          </div>

          <div class="form-group form-inline">
            <div class="col-sm-8 col-sm-offset-7">
              <div class="col-sm-2 text-right" style="font-weight: 600; font-size: 12px">
                Total restante:  
              </div>
               
              <input type="text" name="total_g" class="number form-control" value="0.00" id="total_g" readonly="readonly" style="width: 150px">
            </div>
          </div>

											
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('atenciones.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
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
    var phonesForm = $("#servicios").sheepIt({
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

    $(document).on('change','.selectServ',function(){
      var selectId = $(this).attr('id');
      var selectArr = selectId.split('_');
      var id = selectArr[1];

      $.ajax({
         type: "GET",
         url:  "servicios/getServicio/"+$(this).val(),
         success: function(a) {
            $('#servicios_'+id+'_montoHidden').val(a.precio);
            $('#servicios_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            calcular();
            calculo_general();
         }
      });
    })

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

$('.number').number(true,2,'.',',');

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

<script type="text/javascript">
      $(document).ready(function(){
        $('#el2').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/movimientos/atencion/personal/';
          }else{
            link = '/movimientos/atencion/profesional/';
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#origen1').html(a);
                 }
          });

        });
        

      });
       
    </script>

    <script>
    	    function add_li()
        {
            var nuevoLi=document.getElementById("el3").value;
            if(nuevoLi.length>0)
            {
                    var li=document.createElement('el3');
                    li.id=nuevoLi;
                    li.innerHTML="<span onclick='eliminar(this)'>X</span>"+nuevoLi;
                    document.getElementById("listaDesordenada").appendChild(li);
            }
            return false;
        }

 
        /**
         * Funcion para eliminar los elementos
         * Tiene que recibir el elemento pulsado
         */
        function eliminar(elemento)
        {
            var id=elemento.parentNode.getAttribute("id");
            node=document.getElementById(id);
            node.parentNode.removeChild(node);
        }


    </script>
@endsection
@endsection