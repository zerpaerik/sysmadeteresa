@extends('layouts.app')
@section('content')

	
 <div class="box-content"> 
        <form class="form-horizontal" role="form" method="post" action="control/edit">
          {{ csrf_field() }}
          <div class="form-group">          
            <h3>Control Prenatal Mensual de {{$paciente->nombres}} {{$paciente->apellidos}} Fecha: {{$control->created_at}}</h3>
            <br>

                        <input type="hidden" name="id" value="{{$control->id}}">

            
             <label class="col-sm-3">CERRAR CONTROL?:</label>
			<div class="col-sm-2">
				<select style="background: #F0CD1C;" name="pendiente" required="true" value="{{$control->pendiente}}">
					<option value="0">Si</option>
					<option value="1">No</option>
				</select>
			</div> 
            <label for="">Fecha Control</label>
            <input type="date" name="fecha_cont" value="{{$control->fecha_cont}}" style="line-height: 20px"> 
            <br>  
            <div class="row">

            <label class="col-sm-1 control-label">Gestaciòn</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gesta_semanas" value="{{$control->gesta_semanas}}" placeholder="Semanas de gestacion" data-toggle="tooltip" data-placement="bottom" title="gesta_semanas" readonly="">
            </div>

            <label class="col-sm-1 control-label">PesoMadre.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="peso_madre" value="{{$control->peso_madre}}" placeholder="Peso de Madre" data-toggle="tooltip" data-placement="bottom" title="m37m" readonly="">
            </div>

            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="temp" value="{{$control->temp}}" placeholder="Temperatura" data-toggle="tooltip" data-placement="bottom" title="Temperatura" readonly=""> 
            </div>

            </div>
            <div class="row">

            <label class="col-sm-1 control-label">Tensiòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="tension" value="{{$control->tension}}" placeholder="tension arterial" data-toggle="tooltip" data-placement="bottom" title="tension" readonly="">
            </div>

             <label class="col-sm-1 control-label">Alt.Ute.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="altura_uterina" value="{{$control->altura_uterina}}" placeholder="Altura Uterina" data-toggle="tooltip" data-placement="bottom" title="altura uterina" readonly="">
            </div>

            <label class="col-sm-1 control-label">Presentaciòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="presentacion" value="{{$control->presentacion}}" placeholder="presentacion" data-toggle="tooltip" data-placement="bottom" title="presentacion" readonly="">
            </div>

            </div>

                        <div class="row">


            <label class="col-sm-1 control-label">F.C.F.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="fcf" value="{{$control->fcf}}" placeholder="FCF" data-toggle="tooltip" data-placement="bottom" title="fcf" readonly="">
            </div>

             <label class="col-sm-1 control-label">Movimiento.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="movimiento_fetal" value="{{$control->movimiento_fetal}}" placeholder="Movimiento Fetal" data-toggle="tooltip" data-placement="bottom" title="movimiento_fetal" readonly="">
            </div>

             <label class="col-sm-1 control-label">Edema.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="edema" value="{{$control->edema}}" placeholder="Edema" data-toggle="tooltip" data-placement="bottom" title="edema" readonly="">
            </div>
        </div>

                    <div class="row">


             <label class="col-sm-1 control-label">Pulso.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="pulso_materno" value="{{$control->pulso_materno}}" placeholder="Pulso Materno" data-toggle="tooltip" data-placement="bottom" title="pulso_materno" readonly="">
            </div>


             <label class="col-sm-1 control-label">Consejeria</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="consejeria" value="{{$control->consejeria}}" placeholder="Consejeria PF" data-toggle="tooltip" data-placement="bottom" title="consejeria" readonly="">
            </div>


             <label class="col-sm-1 control-label">Sulfato.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="sulfato" value="{{$control->sulfato}}" placeholder="Sulfato Ferroso" data-toggle="tooltip" data-placement="bottom" title="sulfato" readonly="">
            </div>

        </div>

                    <div class="row">



             <label class="col-sm-1 control-label">Perfil.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="perfil_biofisico" value="{{$control->perfil_biofisico}}" placeholder="Perfil Biosfisico" data-toggle="tooltip" data-placement="bottom" title="perfil_biofisico" readonly="">
            </div>


             <label class="col-sm-1 control-label">Visita.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="visita_domicilio" value="{{$control->visita_domicilio}}" placeholder="Visita a domicilio" data-toggle="tooltip" data-placement="bottom" title="visita_domicilio" readonly="">
            </div>

             <label class="col-sm-1 control-label">Establ.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="establecimiento_atencion" value="{{$control->establecimiento_atencion}}" placeholder="Establecimiento de atencion" data-toggle="tooltip" data-placement="bottom" title="establecimiento_atencion" readonly="">
            </div>

        </div>


                    <div class="row">
             <label class="col-sm-1 control-label">Serologia</label>
            <div class="col-sm-3">
             <select id="el11" name="sero" value="{{$control->sero}}" readonly="">
							<option value="Negativo">Negativo</option>
							<option value="Positivo">Positivo</option>
						     <option value="No">No se hizo</option>
			</select>
				<input type="date" name="serod" style="line-height: 20px">	

            </div>


             <label class="col-sm-1 control-label">Glucosa</label>
            <div class="col-sm-3">
               <select id="el12" name="gluco" readonly="">
							<option value="Normal">Normal</option>
							<option value="Anormal">Anormal</option>
						     <option value="No">No se hizo</option>
			</select>
							<input type="date" name="glucod" style="line-height: 20px">	

            </div>

             <label class="col-sm-1 control-label">VIH</label>
            <div class="col-sm-3">
               <select id="el13" name="vih" readonly="">
							<option value="Positivo">Positivo</option>
							<option value="Negativo">Negativo</option>
						     <option value="No">No se hizo</option>
			</select>
							<input type="date" name="vihd" style="line-height: 20px">	

            </div>

        </div>

           <div class="row">



             <label class="col-sm-1 control-label">Hemoglobina</label>
            <div class="col-sm-3">
             	<input type="text" name="hemo" value="{{$control->hemo}}" readonly="" style="line-height: 20px">gr/dl	
				<input type="date" name="hemod" value="{{$control->hemod}}" readonly=""  style="line-height: 20px">	

            </div>


          </div>
     
          <div class="row">
			<label class="col-sm-12" for="">Examen Fisico General y Regional</label>
			<div class="col-sm-2">Piel/Mucosas	
				<input class="form-control" type="text" name="piel" value="{{$control->piel}}" readonly="">
			</div>
			<div class="col-sm-2">Mamas	
				<input class="form-control" type="text" name="mamas" value="{{$control->mamas}}" readonly="">
			</div>
			<div class="col-sm-2">Abdomen	
				<input class="form-control" type="text" name="abdomen" value="{{$control->abdomen}}" readonly="">
			</div>
			<div class="col-sm-2">Genitales Externos	
				<input class="form-control" type="text" name="genext" value="{{$control->genext}}" readonly="">
			</div>
			<div class="col-sm-2">Genitales Internos	
				<input class="form-control" type="text" name="genint" value="{{$control->genint}}" readonly="">
			</div>
			<div class="col-sm-2">Miembros Inferiores	
				<input class="form-control" type="text" name="miembros" value="{{$control->miembros}}" readonly="">
			</div>


		    </div>

		    <div class="row">
		    	<div class="col-sm-3">Diag.Pres	
				<input class="form-control" type="text" name="pres" value="{{$control->pres}}" readonly="">
			    </div>

			    <div class="col-sm-3">Exa.Auxiliares	
				<input class="form-control" type="text" name="exa" value="{{$control->exa}}" readonly="">
			</div>

			<div class="col-sm-3">Diag.Def	
				<input class="form-control" type="text" name="def" value="{{$control->def}}" readonly="">
			</div>

			<div class="col-sm-3">PlanTratamiento	
				<input class="form-control" type="text" name="tra" value="{{$control->tra}}" readonly="">
			</div>

		    	
		    </div>

    

        </div>
      
      
    </div>

    <div class="row">
            <label for="" class="col-sm-2 ">Observaciòn:</label>
      <div class="col-sm-10 control-label"> 
        <textarea name="observacion" cols="10" rows="4" class="form-control" ></textarea>   
      </div>
      </div>


            <br>
            <div class="col-sm-3">
            <input type="button" onclick="form.submit()" class="btn btn-primary" value="Guardar">  
            </div>                         
      </form>
  </div>











@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>

<script src="{{ asset('plugins/multi-select/js/jquery.multi-select.js') }}" type="text/javascript"></script>



<script type="text/javascript">

// Run Select2 on element
function Select2Test(){
	$("#el2").select2();
	$("#el1").select2();
	$("#el3").select2();
  $("#el5").select2();
    $("#el6").select2();
  $("#el7").select2();
  $("#el4").select2();
  $("#el8").select2();
  $("#el9").select2();
  $("#el10").select2();
  $("#el11").select2();
  $("#el12").select2();
  $("#el13").select2();
  $("#el14").select2();
  $("#el15").select2();
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
            link = '/antf/otro/';
          } else {
           his.GetType ();
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#af1').html(a);
                 }
          });

        });
        

      });
       
</script>

<script type="text/javascript">
      $(document).ready(function(){
        $('#el3').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/antp/otro/';
          } else {
           his.GetType ();
          }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#ap1').html(a);
                 }
          });

        });
        

      });
       
</script>
<script type="text/javascript">

$('#my-select').multiSelect()
$('#my-select2').multiSelect()



</script>



   
@endsection	
@endsection