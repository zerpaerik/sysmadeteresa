@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Requerimiento</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="requerimientos/create">
					{{ csrf_field() }}
					<div class="form-group">

					<div class="row">

				
            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Productos seleccionados</label>
            <!-- sheepIt Form -->
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">

                    <label for="laboratorios_#index#_laboratorio" class="col-sm-1 control-label">Productos</label>
                    <div class="col-sm-4">
                      <select id="laboratorios_#index#_laboratorio" name="id_laboratorio[laboratorios][#index#][laboratorio]" class="selectLab form-control">
                        <option value="1">Seleccionar Producto</option>
                        @foreach($productos as $pac)
                          <option value="{{$pac->id}}">
                            {{$pac->nombre}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="laboratorios_#index#_abonoL" class="col-sm-1 control-label">Solicitar:</label>
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
					
						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('requerimientos.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
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