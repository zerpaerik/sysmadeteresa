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
				<form class="form-horizontal" role="form" method="post" action="existencia/descargarstock">
					{{ csrf_field() }}
					<div class="form-group">

						<div class="row">
							 <label class="alert"><i class="fa fa-tasks" aria-hidden="true"></i> Almacen a Descargar</label>
							<select id="el5" name="almacen" style="width: 350px;">
							<option value="">Seleccione un Almacen</option>
							<option value="1">Recepcion</option>
							<option value="2">Laboratorio</option>
							<option value="3">Rayos</option>
							<option value="4">Obstetra</option>
						    </select>
							
						</div>


		<div class="row">
		 <div id="product" class="col-md-3">
		 	

		 </div>
		 <div class="col-md-2">
		 	<input type="text" class="form-control" name="cantidad" placeholder="Cantidad a descargar">
		 	
		 </div>
		 <div class="col-md-7">
		 	<input type="text" class="form-control" name="observacion" placeholder="Observacion">
		 	
		 </div>

		
			
		</div>
		
					
          <hr>

         
					
						<br>
						<input type="button" onclick="form.submit()" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Agregar">

						<a href="{{route('descargar.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/jqNumber/jquery.number.min.js') }}" type="text/javascript"></script>


    <script type="text/javascript">
      $(document).ready(function(){
        $('#el5').on('change',function(){
          var link;
          if ($(this).val() ==  1) {
            link = '/almacen/recepcion/';
          }else if ($(this).val() ==  2){
            link = '/almacen/laboratorios/';
          }else if ($(this).val() ==  3){
            link = '/almacen/rayos/';
          } else {
        link = '/almacen/obstetra/';
      }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#product').html(a);
                 }
          });

        });
        

      });
       
    </script>






@endsection
@endsection