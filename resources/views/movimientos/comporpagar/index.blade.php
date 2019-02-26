@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Movimientos/Comisiones Por Pagar Profesional</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['comporpagar.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					<label>Fecha Inicio</label>
					<input type="date" value="{{$f1}}" name="fecha" style="line-height: 20px">
				</div>
				<div class="col-md-2">
					<label>Fecha Fin</label>
					<input type="date" value="{{$f2}}" name="fecha2" style="line-height: 20px">
				</div>
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
				<div class="col-md-2">
				<strong>Monto a Pagar:</strong>{{number_format($aten->monto, 2, ',', '.')}}
					
				</div>
				<div class="col-md-2">
				<strong>Item por Pagar:</strong>{{$totalorigen->total}}
				</div>
			</div>	

			{!! Form::open(['method' => 'get', 'route' => ['comporpagar.index1']]) !!}

			<div class="row">
				<div class="col-md-4">
						<select id="el2" name="origen">
							<option>Seleccione un Origen</option>
							@foreach($origen as $user)
								    <option value="{{$user->origen_usuario}}">{{$user->lastname}},{{$user->name}}</option>
							@endforeach
						</select>

					<input type="hidden" value="{{$f1}}" name="f1">
				    <input type="hidden" value="{{$f2}}" name="f2">

				</div>
				
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	

	



			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
				<form action="/pagarmultiple" method="post">
					<thead>
						<tr>
							<th>Marcar</th>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Monto</th>
							<th>Porcentaje</th>
							<th>Monto a Pagar</th>
							<th>Fecha Atenciòn</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>
                          @foreach($atenciones as $atec)	

							<tr>
								<td><input value="{{$atec->id}}" type="checkbox" name="com[]"></td>
								<td>{{$atec->id}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								@if($atec->es_servicio =='1')
								<td>{{$atec->servicio}}</td>
								@elseif($atec->es_laboratorio =='1')
								<td>{{$atec->laboratorio}}</td>
								@else
								<td>{{$atec->paquete}}</td>
								@endif
								<td>{{number_format($atec->monto, 2, ',', '.')}}</td>
								<td>{{$atec->porc_pagar}}</td>
								<td>{{number_format($atec->porcentaje, 2, ',', '.')}}</td>
								<td>{{$atec->created_at}}</td>
								<td><a href="{{asset('/pagarcom')}}/{{$atec->id}}" onclick="return confirm('¿Desea Pagar esta Comisión?')" class="btn btn-xs btn-danger">Pagar</a></td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Marcar</th>
							<th>Id</th>
						</tr>
						    <th>
								{{ csrf_field() }}
								<button style="margin-left: -5px;" type="submit" onclick="return confirm('¿Desea Pagar esta Comisión?')" class="btn btn-xs btn-danger">Pagar.Selecc.</button>
							</th>

					</tfoot>
											</form>

				</table>
			</div>
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
