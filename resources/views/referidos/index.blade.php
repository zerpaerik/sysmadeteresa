@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span><strong>Referidos del APP</strong></span>

				</div>


				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>

				<div class="no-move"></div>
				
			</div>
					{!! Form::open(['method' => 'get', 'route' => ['referidos.index']]) !!}

			<br>
			<div class="row">
            <div class="col-md-3">
					<label>Buscar por Profesional</label>
					<select name="pro" id="el1">
						<option value="">Seleccione</option>
						@foreach($profesionales as $p)
						<option value="{{$p->id}}">{{$p->name}} {{$p->lastname}}</option>
						@endforeach
					</select>
					
				</div>

			
					
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info', 'style' => 'margin-top:25px; width:75px' )) !!}
					{!! Form::close() !!}

				</div>
			</div>
			
			<br>
			<hr class="page-header"></hr>	

          <span><strong></strong></span>
				<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Profesional</th>
							<th>Detalle</th>
                            <th>Paciente</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($referidos as $d)
						<tr>
						<td>{{$d->usuariop}} {{$d->usuario}}</td>
						<td>{{$d->item}}</td>
						<td>{{$d->apellidos}} {{$d->nombres}}</td>
						@if($d->estatus == 1)
						<td>Enviado</td>
						@elseif($d->estatus == 2)
						<td>Atendido</td>
                        @else
						@endif
						<td>{{$d->created_at}}</td>
						<td>
						@if($d->estatus == 1)
						<a id="{{$d->id}}" id2="{{$d->se}}" id3="{{$d->la}}" onclick="view(this)" class="btn btn-danger">Registrar</a>
						@else
						<p>YA FUE INGRESADO</p>
						@endif
						</td>
						
						
					</tr>
						@endforeach
		
                      
					</tbody>
					<tfoot>
                    <th>Profesional</th>
							<th>Detalle</th>
                            <th>Profesional</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Acciones</th>
					</tfoot>
				</table>
			</div>

			<br>

		


		<br>
		
		<br>
		

		</div>
	</div>
</div>

<div class="modal fade" id="viewReferido" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalles del Registro</h4>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>

</body>

<style type="text/css">
		.modal-backdrop.in {
		    filter: alpha(opacity=50);
		    opacity: 0;
		    z-index: 0;
		}

		.modal {
			top:35px;
		}
</style>

<script type="text/javascript">
		function view(e){
		    var id = $(e).attr('id');
			var id2 = $(e).attr('id2');
		    var id3 = $(e).attr('id3');


		    $.ajax({
		        type: "GET",
		        url: "/referido/view/"+id+"/"+id2+"/"+id3,
		        success: function (data) {
		            $("#viewReferido .modal-body").html(data);
		            $('#viewReferido').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

	
	</script>



@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#tipo").select2();
            $("#el1").select2();
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
