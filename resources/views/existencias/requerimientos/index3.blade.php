@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Requerimientos/Procesados</span>

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

			{!! Form::open(['method' => 'get', 'route' => ['requerimientos.index3']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
					{!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha2'))
					<p class="help-block">
						{{ $errors->first('fecha2') }}
					</p>
					@endif
				</div>
				<div class="col-md-4">

					<select  name="almacen" id="">
						<option value="">Seleccione una Almacen</option>
						<option value="1">Recepcion</option>
						<option value="2">Laboratorio</option>
						<option value="3">Rayos</option>
						<option value="4">Obstetra</option>
						<option value="5">Independencia</option>
						<option value="6">Olivos</option>
													
					</select>
						</div>
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
						   <th>ID:</th>
							<th>Solicitado Por:</th>
							<th>Usuario Solicitante</th>
							<th>Almacen Solicitante</th>
							<th>Producto</th>
							<th>Cantidad Solicitada</th>
						    <th>Cantidad Entregada</th>
							<th>Estatus</th>
							<th>Fecha Sol.</th>
							<th>Fecha Pro.</th>
						    <th>Acciones</th>
						
						</tr>
					</thead>
					<tbody>
						@foreach($requerimientos3 as $req)					

						<tr>
								<td>{{$req->id}}</td>
								<td>{{$req->sede}}</td>
								<td>{{$req->solicitante}}</td>
								@if($req->almacen_solicita == 1)
								<td>Recepciòn</td>
								@elseif($req->almacen_solicita == 2)
								<td>Laboratorio</td>
								@elseif($req->almacen_solicita == 3)
								<td>Rayos</td>
								@elseif($req->almacen_solicita == 4)
								<td>Obstetra</td>
								@elseif($req->almacen_solicita == 5)
								<td>Independencia</td>
								@elseif($req->almacen_solicita == 6)
								<td>Olivos</td>
								@else
								<td>{{$req->sede}}</td>
                                @endif
								<td>{{$req->nombre}}</td>
							    <td>{{$req->cantidad}}</td>
							    <td>{{$req->cantidadd}}</td>
								<td>{{$req->estatus}}</td>
								<td>{{$req->created_at}}</td>
								<td>{{$req->updated_at}}</td>
								<td>
									<a href="requerimientos-reversar-{{$req->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Reversar este Requerimiento?')">Reversar</a>
								</td>
							   	
							</tr>
						@endforeach
				
					</tbody>
					
				</table>
			</div>
		</div>
	</div>
</div>

</body>



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
