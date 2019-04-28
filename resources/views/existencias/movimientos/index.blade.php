@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Reportes/ Movimientos de Productos</span>

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

			{!! Form::open(['method' => 'get', 'route' => ['movimientosp.index']]) !!}

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
                        <div class="col-md-3">
                           <select id="el2" name="producto">
                            <option>Seleccione un Producto</option>
                            @foreach($productos as $p)
                                    <option value="{{$p->id}}">{{$p->nombre}} ALM:{{$p->almacen}}</option>
                            @endforeach
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
							<th>Producto</th>
							<th>Acciòn</th>
							<th>Origen</th>
							<th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Almacen Origen</th>
							<th>Almacen Destino</th>
							<th>Registrado Por:</th>
					
						</tr>
					</thead>
					<tbody>
					  @foreach($productosm as $p)					
						<tr>
						<td>{{$p->nombre}}</td>
						<td>{{$p->accion}}</td>
						<td>{{$p->origen}}</td>
                        <td>{{$p->cantidad}}</td>
                        <td>{{$p->created_at}}</td>
                        <td>{{$p->alm2}}</td>
                        <td>{{$p->alm1}}</td>
						<td>{{$p->lastname}},{{$p->name}}</td>
						
						</tr>
						@endforeach	
					</tbody>
					<tfoot>
						<tr>
						  <th>Producto</th>
                            <th>Acciòn</th>
                            <th>Origen</th>
                            <th>Cantidad</th>
                            <th>Fecha</th>
                            <th>Registrado Por:</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




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
