@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Paquete</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="paquetes/edit/{{$paquete->id}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" value="{{$paquete->detalle}}" name="detalle" placeholder="Nombre" title="Nombre">
						</div>
					
						<label class="col-sm-1 control-label">Precio</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" value="{{$paquete->precio}}" name="precio" placeholder="Precio" title="Precio">
						</div>
					
						<label class="col-sm-1 control-label">Porcentaje</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" value="{{$paquete->porcentaje}}" name="porcentaje" placeholder="Porcentaje" title="Porcentaje">
						</div>
					</div>
						
					<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Servicios seleccionados</label>
				            <!-- sheepIt Form -->
				            <div id="servicios" class="embed ">
				            	@foreach ($serviciosP as $serv)
				                <!-- Form template-->
				                <div id="servicios_template{{$loop->index}}" class="template row">

				                    <label for="servicios_{{$loop->index}}_servicio" class="col-sm-1 control-label">Servicio</label>
				                    <div class="col-sm-3">
				                    	<input type="hidden" name="id_servicio[servicios][{{$loop->index}}][id]" value="{{$serv->id}}">
				                      <select id="servicios_{{$loop->index}}_servicio" name="id_servicio[servicios][{{$loop->index}}][servicio]" class="selectServ form-control">
				                        <option value="1">Seleccionar servicio</option>
				                        @foreach($servicios as $pac)
				                        	@if ($serv->servicio->id == $pac->id)
					                         	<option value="{{$pac->id}}" selected="selected">
					                            	{{$pac->detalle}}-Precio:{{$pac->precio}}
					                         	</option>
					                        @else 
					                        	<option value="{{$pac->id}}">
					                            	{{$pac->detalle}}-Precio:{{$pac->precio}}
					                         	</option>
					                        @endif
				                        @endforeach
				                      </select>
				                    </div>
				                </div>
				                <!-- /Form template-->
				                @endforeach
				            </div>
				            <!-- /sheepIt Form --> 
				          </div>
					</div>
					
					<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Laboratorios seleccionados</label>
				            <!-- sheepIt Form -->
				            <div id="laboratorios" class="embed ">
				            	@foreach ($laboratoriosP as $lab)
					                <!-- Form template-->
					                <div id="laboratorios_template{{$loop->index}}" class="template row">

					                    <label for="laboratorios_{{$loop->index}}_laboratorio" class="col-sm-1 control-label">Lab</label>
					                    <div class="col-sm-3">
					                    	<input type="hidden" name="id_laboratorio[laboratorios][{{$loop->index}}][id]" value="{{$serv->id}}">
					                      <select id="laboratorios_{{$loop->index}}_laboratorio" name="id_laboratorio[laboratorios][{{$loop->index}}][laboratorio]" class="selectLab form-control">
					                        <option value="1">Seleccionar laboratorio</option>
					                        @foreach($laboratorios as $pac)
					                        	@if ($lab->laboratorio->id == $pac->id)
						                         	<option value="{{$pac->id}}" selected="selected">
						                            	{{$pac->name}}-Precio:{{$pac->precio}}
						                         	</option>
						                        @else 
						                        	<option value="{{$pac->id}}">
						                            	{{$pac->name}}-Precio:{{$pac->precio}}
						                         	</option>
						                        @endif
					                        @endforeach
					                      </select>
					                    </div>
					                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
					                </div>
					                <!-- /Form template-->
				                @endforeach
				            </div>
				            <!-- /sheepIt Form --> 
						</div>
					</div>
						<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Cantidad de Consultas</label>
				            <!-- sheepIt Form -->
				            <div id="consultas" class="embed ">
				                <!-- Form template-->
				                <div id="consultas_template" class="template row">
				                   @if($consultasP)
				                    <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Cantidad</label>
				                    <div class="col-sm-3">
				                      <input type="text"  class="form-control" name="consultas" value="{{$consultasP->cantidad}}" placeholder="Cantidad de Consultas" data-toggle="tooltip" data-placement="bottom" title="Nombres">
				                    </div>
				                    @else
				                     <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Cantidad</label>
				                    <div class="col-sm-3">
				                      <input type="text"  class="form-control" name="consultas" placeholder="Cantidad de Consultas" data-toggle="tooltip" data-placement="bottom" title="Nombres">
				                    </div>
				                    @endif
				                 
				                </div>
				                <!-- /Form template-->
				                
				                <!-- No forms template -->
				             
				                <!-- /Controls -->
				            </div>
				            <!-- /sheepIt Form --> 
				          </div>
					</div>


					<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Cantidad de Controles</label>
				            <!-- sheepIt Form -->
				            <div id="controles" class="embed ">
				                <!-- Form template-->
				                <div id="controles_template" class="template row">
                                  @if($controlesP)
				                    <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Cantidad</label>
				                    <div class="col-sm-3">
				                       <input type="text"  class="form-control" name="controles" value="{{$controlesP->cantidad}}" placeholder="Cantidad de Controles" data-toggle="tooltip" data-placement="bottom" title="Nombres">
				                    </div>
				                    @else
				                     <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Cantidad</label>
				                    <div class="col-sm-3">
				                       <input type="text"  class="form-control" name="controles"  placeholder="Cantidad de Controles" data-toggle="tooltip" data-placement="bottom" title="Nombres">
				                    </div>
				                    @endif
				                   				                </div>
				                <!-- /Form template-->
				                
				                <!-- No forms template -->
				                
				                <!-- /Controls -->
				            </div>
				            <!-- /sheepIt Form --> 
				          </div>
					</div>

					<div class="form-group">
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">
						<a href="{{route('paquetes.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>		
				</form>	
			</div>
		</div>
	</div>
</div>

@endsection