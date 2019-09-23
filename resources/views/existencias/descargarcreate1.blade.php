@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Descargar Stock</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="existencia/descargarstock1">
					{{ csrf_field() }}
					<div class="form-group">

						<div class="row">
							<div class="col">

								<label>Producto</label>
							<select  name="producto" style="width: 350px;">
							@foreach($producto as $p)
							<option value="{{$p->id}}">{{$p->nombre}}</option>
							@endforeach
						    </select>
						    </div>
						   
							
						</div>
						<div class="row">
							 <div class="col-md-2">
						    <label class="col-sm-1 control-label">Cantidad</label>
							<input type="text" class="form-control" name="cantidad" placeholder="Cantidad" data-toggle="tooltip" data-placement="bottom" title="Cantidad">
						    </div>
						    <div class="col-md-7">
						    <label class="col-sm-1 control-label">Observacion</label>
							<input type="text" class="form-control" name="observacion" placeholder="Observacion" data-toggle="tooltip" data-placement="bottom" title="Observacion">
						    </div>
							
						</div>

					</div>



		
		
					
          <hr>

         
					
						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('descargar.index1')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jqNumber/jquery.number.min.js') }}" type="text/javascript"></script>


    






@endsection
@endsection