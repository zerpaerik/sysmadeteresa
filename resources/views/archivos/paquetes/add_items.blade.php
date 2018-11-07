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
				<form class="form-horizontal" role="form" method="post" action="paquetes/storeItems/{{$paquete->id}}">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-1 control-label">Nombre</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="detalle" value="{{$paquete->detalle}}">
						</div>
					
						<label class="col-sm-1 control-label">Precio</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="precio" value="{{$paquete->precio}}">
						</div>
					
						<label class="col-sm-1 control-label">Porcentaje</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="porcentaje" value="{{$paquete->porcentaje}}">
						</div>
					</div>
						
					<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Servicios seleccionados</label>
				            <!-- sheepIt Form -->
				            <div id="servicios" class="embed ">
				                <!-- Form template-->
				                <div id="servicios_template" class="template row">

				                    <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Servicio</label>
				                    <div class="col-sm-3">
				                      <select id="servicios_#index#_servicio" name="id_servicio[servicios][#index#][servicio]" class="selectServ form-control">
				                        <option value="1">Seleccionar servicio</option>}
				                        option
				                        @foreach($servicios as $pac)
				                          <option value="{{$pac->id}}">
				                            {{$pac->detalle}}-Precio:{{$pac->precio}}
				                          </option>
				                        @endforeach
				                      </select>
				                    </div>
				                    <a id="servicios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
				                </div>
				                <!-- /Form template-->
				                
				                <!-- No forms template -->
				                <div id="servicios_noforms_template" class="noItems col-sm-12 text-center">Ningún servicio</div>
				                <!-- /No forms template-->
				                
				                <!-- Controls -->
				                <div id="servicios_controls" class="controls col-sm-11 col-sm-offset-1">
				                    <div id="servicios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar servicio</span></a></div>
				                    <div id="servicios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
				                    <div id="servicios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
				                </div>
				                <!-- /Controls -->
				            </div>
				            <!-- /sheepIt Form --> 
				          </div>
					</div>
					
					<div class="form-group">
						<div class="row">
				            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Laboratorios seleccionados</label>
				            <!-- sheepIt Form -->
				            <div id="laboratorios" class="embed ">
				                <!-- Form template-->
				                <div id="laboratorios_template" class="template row">

				                    <label for="laboratorios_#index#_laboratorio" class="col-sm-1 control-label">Lab</label>
				                    <div class="col-sm-3">
				                      <select id="laboratorios_#index#_laboratorio" name="id_laboratorio[laboratorios][#index#][laboratorio]" class="selectLab form-control">
				                        <option value="1">Seleccionar laboratorio</option>
				                        @foreach($laboratorios as $pac)
				                          <option value="{{$pac->id}}">
				                            {{$pac->name}}-Precio:{{$pac->preciopublico}}
				                          </option>
				                        @endforeach
				                      </select>
				                    </div>
				                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
				                </div>
				                <!-- /Form template-->
				                
				                <!-- No forms template -->
				                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún laboratorios</div>
				                <!-- /No forms template-->
				                
				                <!-- Controls -->
				                <div id="laboratorios_controls" class="controls col-sm-11 col-sm-offset-1">
				                    <div id="laboratorios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar laboratorio</span></a></div>
				                    <div id="laboratorios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
				                    <div id="laboratorios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
				                </div>
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

@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
    // Main sheepIt form
    var phonesForm = $("#servicios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 0,
        iniFormsCount: 0,
        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?'
    });

    // Main sheepIt form
    var phonesForm = $("#laboratorios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 0,
        iniFormsCount: 0,
        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?'
    });    
});

</script>
@endsection

@endsection