@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Comisiones Por Entregar</strong></span>
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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
		{!! Form::open(['method' => 'get', 'route' => ['comporentregar.index']]) !!}

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
					@if($total)
					<strong>Total:</strong> {{$total->total}}
					@else
					<strong>Total:</strong> 0
										@endif


				</div>
			</div>
					<thead>
						<tr>
							<th>Recibo</th>
							<th>Monto</th>
							<th>Origen</th>
							<th>Fecha Pago</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $atec)	

							<tr>
								<td>{{$atec->recibo}}</td>
								<td>{{$atec->totalrecibo}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td>{{$atec->fecha_pago_comision}}</td>
                                <td>
                                <form method="get" action="entregar">
                                    <input type="hidden" value="{{$atec->recibo}}" name="id">
                                    <select  name="tipo" id="tipo">
                                    <option value="EF">EFECTIVO</option>
                                    <option value="TF">TRANSFERENCIA</option>
                                    </select>
                                    <button style="margin-left: 35px;" type="submit" class="btn btn-xs btn-danger">Entregar</button>
                                    </form>
                                </td>
						@endforeach
					</tbody>
					<tfoot>
							
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
@endif

@endsection
