@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Agregar Servicio</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="servicios/create">
					{{ csrf_field() }}
					<div class="form-group">
						<label class="col-sm-2 control-label">Detalle</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="detalle" placeholder="Detalle" data-toggle="tooltip" data-placement="bottom" title="Detalle">
						</div>
						<label class="col-sm-2 control-label">Precio</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="precio" placeholder="Precio Particular" data-toggle="tooltip" data-placement="bottom" title="Precio">
						</div>

					

						<label class="col-sm-2 control-label">Porcentaje</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="porcentaje" placeholder="porcentaje" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>
						
						<label class="col-sm-2 control-label">Porcentaje Personal</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="por_per" placeholder="porcentaje personal" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>

						<label class="col-sm-2 control-label">Porcentaje Tecnólogo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="por_tec" placeholder="porcentaje tecnólogo" data-toggle="tooltip" data-placement="bottom" title="porcentaje">
						</div>
						
						<label class="col-sm-2 control-label">Se Programa?</label>
						<div class="col-sm-3">
							<select class="form-control" name="programa">
							<option value="0">No</option>
							<option value="1">Si</option>
						</select>
						</div>

						<div class="form-group">
							<div class="row">
					            <label class="col-sm-12 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Materiales seleccionados</label>
					            <!-- sheepIt Form -->
					            <div id="materiales" class="embed ">
					                <!-- Form template-->
					                <div id="materiales_template" class="template row">

					                    <label for="materiales_#index#material" class="col-sm-1 control-label">Material</label>
					                    <div class="col-sm-5">
					                      <select id="materiales_#index#material" name="materiales[#index#][material]" class="selectServ form-control">
					                        <option value="">Seleccionar material</option>
					                        @foreach($materiales as $pac)
					                          <option value="{{$pac->id}}">
					                            {{$pac->nombre}}-Categoria:{{$pac->categoria}}
					                          </option>
					                        @endforeach
					                      </select>
					                    </div>
					                    <label for="materiales_#index#cantidad" class="col-sm-1 control-label">Cantidad</label>
					                    <div class="col-sm-3">
					                     	<input type="number" id="materiales_#index#cantidad" name="materiales[#index#][cantidad]" class="form-control">
					                    </div>
					                    <a id="materiales_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
					                </div>
					                <!-- /Form template-->
					                
					                <!-- No forms template -->
					                <div id="materiales_noforms_template" class="noItems col-sm-12 text-center">Ningún material</div>
					                <!-- /No forms template-->
					                
					                <!-- Controls -->
					                <div id="materiales_controls" class="controls col-sm-11 col-sm-offset-1">
					                    <div id="materiales_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar material</span></a></div>
					                    <div id="materiales_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
					                    <div id="materiales_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
					                </div>
					                <!-- /Controls -->
					            </div>
					            <!-- /sheepIt Form --> 
					          </div>
						</div>					

						<br>
						<input type="button" onclick="form.submit()"style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('servicios.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
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
	    var phonesForm = $("#materiales").sheepIt({
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