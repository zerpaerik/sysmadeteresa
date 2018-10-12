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

						<label class="col-sm-1 control-label">Servicios</label>
						<div class="col-sm-5">
							<select id="el3" name="id_servicio">
								@foreach($servicios as $pac)
									<option value="{{$pac->id}}">
										{{$pac->detalle}}-Precio:{{$pac->precio}}
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="monto_s" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Tiempo">
						</div>

						<input type="button" onclick="return add_li()" value="añadir li">
						
					</div>
					<br>
					<div class="row">

						<label class="col-sm-1 control-label">Laboratorios</label>
						<div class="col-sm-5">
							<select id="el5" name="id_laboratorio" multiple="true">
								@foreach($laboratorios as $pac)
									<option value="{{$pac->id}}">
										{{$pac->name}}-Precio:{{$pac->preciopublico}}
									</option>
								@endforeach
							</select>
						</div>

						<label class="col-sm-1 control-label">Monto</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="monto_l" placeholder="Monto" data-toggle="tooltip" data-placement="bottom" title="Tiempo">
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
<script type="text/javascript">
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