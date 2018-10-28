<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Paquete:</strong>{{$paquete->detalle}}
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-6">
						<strong>Precio:</strong> {{$paquete->precio}}
					</div>
					<div class="col-sm-6">
						<strong>Porcentaje:</strong> {{$paquete->porcentaje}}
					</div>
				</div>			
					
				@if(count($servicios) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Servicios</strong>
						</div>
						@foreach($servicios as $servicio)
							<div class="col-sm-12">
								{{$servicio->servicio->detalle}}
							</div>
						@endforeach

					</div>
				@endif
				
				@if(count($laboratorios) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Laboratorios</strong>
						</div>
						@foreach($laboratorios as $laboratorio)
							<div class="col-sm-12">
								{{$laboratorio->laboratorio->name}}
							</div>
						@endforeach

					</div>
				@endif

			</div>
		</div>
	</div>
</div>
