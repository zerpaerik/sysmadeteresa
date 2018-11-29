@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
						<a href="{{route($model.'.create')}}" class="btn btn-primary">Agregar</a>

			<div class="box-header">
				<div class="box-name">
					<i class="fa {{$icon}}"></i>
					<span><strong>{{ucfirst($model)}}</strong></span>
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
				<form action="/search-personal" method="get">
					<label for="">Buscar</label>
					<input type="text" name="nom">
					<input type="submit" value="Buscar" class="btn btn-primary">
				</form>
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead> 
						<tr>
							@foreach($headers as $header)
								<th>{{$header}}</th>
							@endforeach
						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
							@foreach($fields as $f)
								<td>{{$d->$f}}</td>
							@endforeach					
							@if($model == 'servicios')
								<td>
									<a id="{{$d->id}}" onclick="view(this)" class="btn btn-primary">Ver</a>
									<a href="servicios-addItems-{{$d->id}}" class="btn btn-success"> Agregar items</a>
								</td>
							@endif	
							<td><a class="btn btn-warning" href="{{$model . '-edit-' .$d->id}}">Editar</a></td>
								<td><a class="btn btn-danger" href="{{$model.'-delete-'.$d->id}}">Eliminar</a></td>

						</tr>
						@endforeach						
					</tbody>
					<tfoot>
						<tr>
							<th>
								<button type="button" class="btn btn-danger">Eliminar</button>
							</th>
						</tr>
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

<script type="text/javascript">
	function del(id){
		$.ajax({
      url: "{{$model}}-delete-"+id,
      headers: {
    		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  		},
      type: "delete",
      dataType: "json",
      data: {},
      success: function(res){
      	location.reload(true);
      }
    });
	}

	function closeModal(){
		$('#myModal').modal('hide');
	}

	function openmodal(){
		$("#myModal").show();
	}

</script>

<div id="myModal" class="modal" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Modal Body</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" onclick="closeModal()" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

@if ($model == 'servicios')
	<!-- MODAL SECTION -->
    <div class="modal fade" id="viewServicio" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalles del servicio</h4>
          </div>
          <div class="modal-body"></div>
        </div>
      </div>
    </div>

	<script type="text/javascript">
		function view(e){
		    var id = $(e).attr('id');
		    
		    $.ajax({
		        type: "GET",
		        url: "/servicio/view/"+id,
		        success: function (data) {
		            $("#viewServicio .modal-body").html(data);
		            $('#viewServicio').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

		function eliminar(e) {
			var id = $(e).attr('id');
			var r = confirm("Seguro que deseas eliminar este material!");
			if (r) {
				//$(e).parent('div').hide('slow');
				$.ajax({
		        type: "GET",
			        url: "/servicio/material_eliminar/"+id,
			        success: function (data) {
			        	if (data == 1) {
			        		$(e).parent('div').hide('slow');
			            	toastr.success('El materia ha sido eliminado.', 'Servicios!');
			        	} else {
			        		toastr.error('El material no pudo ser eliminado.', 'Servicios!')
			        	}
			        },
			        error: function (data) {
			            toastr.error('Se genero un problema al momento de realizar el proceso de eliminación.', 'Servicios!')
			        }
			    });
			}
			
		}
	</script>
	<style type="text/css">
		.modal-backdrop.in {
		    filter: alpha(opacity=50);
		    opacity: 0;
		    z-index: 0;
		}

		.modal {
			top:35px;
		}
	</style>
@endif
@endsection
