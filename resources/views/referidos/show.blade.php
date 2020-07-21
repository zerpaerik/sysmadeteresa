<div class="row">
	<div class="col-xs-12">
    <form class="form-horizontal" role="form" method="post" action="referidos/create">
					{{ csrf_field() }}
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Paciente - {{$data->apellidos}} {{$data->nombres}} / Profesional - {{$data->usuariop}} {{$data->usuario}}</strong>
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-10">
						<strong>Detalle:</strong> {{$data->item}}
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4">
						<strong>Monto:</strong><input type="text" class="form-control" name="monto" value="{{$data->precio}}"  data-placement="bottom" title="Precio">
					</div>
                    <div class="col-sm-4">
						<strong>Abono:</strong><input type="text" class="form-control" name="abono" placeholder="Monto a abonar" data-placement="bottom" title="Precio">
					</div>
                    <div class="col-sm-4">
						<strong>Tipo de Pago:</strong>
                        <select class="form-control" name="tipopago">
							<option value="EF">EF</option>
							<option value="TJ">TJ</option>
						</select>
					</div>
				</div>

                <input type="hidden" name="se" value="{{$id2}}">
                <input type="hidden" name="la" value="{{$id3}}">
                <input type="hidden" name="item" value="{{$data->itd}}">
                <input type="hidden" name="paciente" value="{{$data->pac}}">
                <input type="hidden" name="prof" value="{{$data->prof}}">
                <input type="hidden" name="porcentaje" value="{{$data->porcentaje}}">
                <input type="hidden" name="referido" value="{{$data->id}}">




                <div class="row">
					<div class="col-sm-12" style="justify-content:center">
                    <input type="button" onclick="form.submit()" style=" margin-top: 20px;" class="col-sm-3 btn btn-danger" value="Guardar">
					</div>
				</div>
               
              
							
			</div>
		</div>
        </form>
	</div>
</div>