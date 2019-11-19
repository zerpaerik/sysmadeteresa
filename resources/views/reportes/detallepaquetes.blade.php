@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header">
				<div class="box-name">
					<span><strong>Detalle de Paquetes</strong></span>
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
			{!! Form::open(['method' => 'get', 'route' => ['detallepaquetes.index']]) !!}

			<div class="row">
				<div class="col-md-6">

							<select id="el1"  name="paciente">
								<option value="">Busque el Paciente</option>
								@foreach($pacientes as $role)
									<option value="{{$role->dni}}">{{$role->apellidos}},{{$role->nombres}}-{{$role->dni}}</option>
								@endforeach
							</select>
						</div>	
				<div class="col-md-6">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	
			<div class="box-content no-padding">
			               <div class="box-content no-padding table-responsive">				

				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					
					<thead> 
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
							<th>Fecha</th>
							<th>RP:</th>
							<th>Ver</th>
						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->apellidos}},{{$d->nombres}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->monto}}</td>
						<td>{{$d->abono}}</td>
						
						<td>{{date('d-m-Y H:i', strtotime($d->created_at))}}</td>
						<td>{{$d->user}}</td>
						@if($d->es_delete <> 1)
		               

						      @if(\Auth::user()->role_id <> 6)	
						  <td>						 
						<a class="btn btn-danger" href="detalle_paquetes-{{$d->id}}">Ver</a></td>
						<td>
		                 </td>
		                     @endif
		                 @else
		                 <td style="background:#CF5F2F">Fue Eliminado</td>
		                 @endif
						</tr>
						@endforeach						
					</tbody>
					
				</table>
				</div>
			</div>
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif

@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#el2").select2();
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
