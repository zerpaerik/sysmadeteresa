@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Editar Programaciòn de Visita</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="visitasp/edit">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="row">

					    <label class="col-sm-1 control-label">Centro</label>
						<div class="col-sm-3">
							<select id="el4" name="centro" value="{{$visitasp->centro}}">
								@foreach($centros as $atec)
								@if($visitasp->centro == $atec->id)
								<option value="{{$atec->id}}" selected="selected">
			                      {{$atec->name}}
			                    </option>
								@else
									<option value="{{$atec->id}}">
										{{$atec->name}}
									</option>
								@endif
								@endforeach
							</select>
						</div>

					<label class="col-sm-1 control-label">Fecha</label>
						<div class="col-sm-3">
							<input type="text" id="input_date" class="form-control" placeholder="Fecha" name="date" required="required" value="{{$visitasp->date}}">
						</div>

						<label class="col-sm-1 control-label">Hora</label>
							<div class="col-sm-3">
								<select id="el3" name="time" value="{{$visitasp->hora_id}}">
									@foreach($tiempos as $tiempo)
										@if($visitasp->hora_id == $tiempo->id)
                                        <option value="{{$tiempo->id}}" selected="selected">
										{{$tiempo->start_time}} {{$tiempo->end_time}}
					                    </option>
										@else
										<option value="{{$tiempo->id}}">
											{{$tiempo->start_time}} {{$tiempo->end_time}}
										</option>
										@endif
									@endforeach
								</select>
							</div>	

						
					</div>

						<input type="hidden" name="id_visita" value="{{$visitasp->id}}">
						
						
											

						<br>
						<input onclick="form.submit()"  type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="#" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
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
		$("#el9").select2();
		$("#el1").select2();
		$("#el4").select2();
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
      url: "service-available-time/"+e+"/"+d,
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


<script type="text/javascript">
      $(document).ready(function(){
        $('#el9').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/service/servicios/';
          }else if($(this).val() ==  2){
            link = '/service/consultas/';
          }else {
            link = '/service/controles/';
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
@endsection
@endsection