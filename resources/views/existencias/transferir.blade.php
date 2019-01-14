@extends('layouts.app')

@section('content')
<style type="text/css invisible">
	
		visibility: hidden;
	}
</style>

<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Transferir productos</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="producto/add">
						<div class="form-group">
						{{ csrf_field() }}

						<label class="col-sm-1 control-label">Producto</label>
						<div class="col-sm-3">
							<select class="form-control" id="prod" name="producto"  data-toggle="tooltip" data-placement="bottom">
								<option value="0">Seleccione un producto</option>
								@foreach($productos as $producto)
									<option value="{{$producto->id}}">{{$producto->nombre}}</option>
								@endforeach
							</select>
						</div>						

						<label class="col-sm-1 control-label">Medida</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="medida" name="medida" data-toggle="tooltip" data-placement="bottom" title="Medida" disabled="disabled">
						</div>

						<label class="col-sm-2 control-label">Cantidad actual</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad actual" data-toggle="tooltip" data-placement="bottom" title="Cantidad" min="0" disabled="disabled">
						</div>

						<label class="col-sm-6 control-label">Sede</label>
						<div class="col-sm-2">
							<select class="form-control" id="sede" name="sede"  data-toggle="tooltip" data-placement="bottom">
								@foreach($sedes as $sede)
									<option value="{{$sede->id}}">{{$sede->name}}</option>
								@endforeach
							</select>
						</div>	

						<label class="col-sm-2 control-label">Salida</label>
						<div class="col-sm-2">
							<input type="number" class="form-control" id="cantidadplus" name="cantidadplus" data-toggle="tooltip" data-placement="bottom" title="Cantidad" required="required">
						</div>

						<div class="col-sm-12" style="float:right;">
							<input type="button" onclick="forma.submit()" id="updatepro" class="col-sm-2 btn btn-primary" value="Ejecutar" style="float:right;">
						</div>						

						<input type="hidden" name="id" id="idp">

					</form>	
					</div>			
			</div>
		</div>
		<div class="alert alert-success invisible" id="successalrt" role="alert">Actualizado</div>
	</div>

	<table class="table">
		<thead>
			<tr>
				<th>Tipo</th>
				<th>Para</th>
				<th>Producto</th>
				<th>Cantidad</th>
			</tr>
		</thead>
		<tbody id="table-b">
		</tbody>
	</table>

<script type="text/javascript">
	document.getElementById("prod").addEventListener('change', function(evt){
		var id = document.getElementById("prod").value;
		if(id < 1) return;
		$.ajax({
      url: "producto/"+id,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "get",
      success: function(res){
      	$('#medida').val(res.producto.medida);
      	$('#cantidad').val(res.producto.cantidad);
      	$("#cantidadplus").attr('max', res.producto.cantidad);
      	$('#idp').val(res.producto.id);
      }
    });
	});
</script>

<script type="text/javascript">

	document.getElementById("updatepro").addEventListener('click', function(evt){
		evt.preventDefault();
		if($('#idp').val() < 1) return;


		if(parseInt($('#cantidadplus').val()) > parseInt($("#cantidad").val())){
			return alert("La cantidad de salida ("+$('#cantidadplus').val()+") sobrepasa el stock de "+$("#cantidad").val());
		}

		var d = {
			"id" : $("#idp").val(),
			"sede" : $('#sede').val(),
			"cantidadplus" : ($('#cantidadplus').val())
		};
		
		$.ajax({
      url: "transfer",
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "POST",
      data: d,
      success: function(res){
      	if(res.success){
      		$( "#table-b" ).append( "<tr><td>Transferencia</td><td>"+res.producto.sede_id+"->"+res.to.sede_id+"</td><td>"+res.producto.nombre+"</td><td>"+$('#cantidadplus').val()+"</td></tr>" );
	      	$('#cantidad').val(res.producto.cantidad);
	      	$('#cantidadplus').val(0);      		
      		$("#successalrt").toggleClass("invisible");
      		setTimeout(function(){
      			$("#successalrt").toggleClass("invisible");
      		}, 3000)
      	};
      }
    });
	});

	
</script>



@endsection