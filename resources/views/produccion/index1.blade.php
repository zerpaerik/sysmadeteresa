@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span><strong>Producción del Dia Atenciones</strong></span>

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
					{!! Form::open(['method' => 'get', 'route' => ['produccion.index2']]) !!}

			<br>
			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$f1}}" name="fecha" style="line-height: 20px">
				</div>

				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$f2}}" name="fecha2" style="line-height: 20px">
				</div>

				<div class="col-md-3">
					<label>Especialistas</label>
					<select name="pro" id="el1">
						<option value="">Seleccione</option>
						@foreach($personal as $p)
						<option value="{{$p->id}}">{{$p->name}} {{$p->lastname}}</option>
						@endforeach
					</select>
					
				</div>
					
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info', 'style' => 'margin-top:25px; width:75px' )) !!}
					{!! Form::close() !!}

				</div>
			</div>
			<div class="row">
				<div class="col-md-2">
                 <strong>Monto Atenciones: </strong>{{$totalsesiones->monto}}
                 <br>
                 <strong>Total Atenciones: </strong>{{$totals->cantidad}}
				</div>


				
				
			</div>
			<br>
			<hr class="page-header"></hr>	

      
	

		<br>
		 <span><strong>ATENCIONES ATENDIDAS</strong></span>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							 <th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
						    <th>Atendido Por:</th>
						    <th>Sede:</th>
							<th>Fecha</th>
					
						</tr>
					</thead>
					<tbody>
						<tr>

						@foreach($sesiones as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
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
						<td>{{$d->usuarioinforme}}</td>
						<td>{{$d->sede}}</td>
						<td>{{$d->created_at}}</td>
						@endforeach
						
					</tr>
                      
					</tbody>
					<tfoot>
						   <th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Monto Abonado</th>
						    <th>Atendido Por:</th>
						    <th>Sede:</th>
							<th>Fecha</th>
							
					</tfoot>
				</table>
			</div>

		<br>
		

		</div>
	</div>
</div>

</body>



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
