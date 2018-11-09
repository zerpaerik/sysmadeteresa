<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Servicio:</strong>{{$servicio->detalle}}
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-6">
						<strong>Precio:</strong> {{$servicio->precio}}
					</div>
					<div class="col-sm-6">
						<strong>Porcentaje:</strong> {{$servicio->porcentaje}}
					</div>
				</div>			
					
				@if(count($servicio->materiales) > 0)
					<div class="row">
						<div class="col-sm-12" style="padding: 5px 0 5px 15px; margin: 5px 0; background: #f5f5f5;">
							<strong>Materiales</strong>
						</div>
						@foreach($servicio->materiales as $material)
							<div class="col-sm-12" >
								{{$material->material->nombre}}
								<i class="fa fa-times" id="{{$material->id}}" aria-hidden="true" onclick="eliminar(this)" title="Eliminar material"></i>
							</div>
						@endforeach

					</div>
				@endif
			
			</div>
		</div>
	</div>
</div>
