@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Archivos/Paquetes</span>
				    <a href="{{route('paquetes.create')}}" class="btn btn-success">Agregar</a>

				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
					<a class="close-link">
						<i class="fa fa-times"></i>
					</a>
				</div>
				<div class="no-move"></div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Porcentaje</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>


						</tr>
					</thead>
					<tbody>
					@foreach($paquetes as $p)					
						<tr>
						<td>{{$p->id}}</td>
						<td>{{$p->detalle}}</td>
						<td>{{$p->precio}}</td>
						<td>{{$p->porcentaje}}</td>
						<td>{{$p->user}}</td>
						<td>
						<a href="#" class="btn btn-primary view" onclick="view(this)" data-id="{{$p->id}}">ver</a>
						<a href="paquetes-edit-{{$p->id}}" class="btn btn-warning edit">Editar</a>
						<a href="paquetes-delete-{{$p->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a>
						<a href="paquetes-addItems-{{$p->id}}" class="btn btn-success">Agregar items</a>

						</td>
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Porcentaje</th>
							<th>Registrado Por:</th>
							<th>Acciones:</th>


						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Detalles del paquete</h4>
              </div>
              <div class="modal-body"></div>
            </div>
          </div>
        </div>

</body>

<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}

function view(e){
        var id = $(e).attr('data-id');
        
        $.ajax({
            type: "GET",
            url: "/paquete/view/"+id,
            success: function (data) {
                $(".modal-body").html(data);
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    };

function eliminarServ(e) {
	var id = $(e).attr('id');
	var r = confirm("Seguro que deseas eliminar este Servicio!");
	if (r) {
		$.ajax({
        type: "GET",
	        url: "/paquete/servicio_eliminar/"+id,
	        success: function (data) {
	        	if (data == 1) {
	        		$(e).parent('div').hide('slow');
	            	toastr.success('El servicio ha sido eliminado.', 'Paquetes!');
	        	} else {
	        		toastr.error('El servicio no pudo ser eliminado.', 'Paquetes!')
	        	}
	        },
	        error: function (data) {
	            toastr.error('Se genero un problema al momento de realizar el proceso de eliminación.', 'Paquetes!')
	        }
	    });
	}
	
}

function eliminarLab(e) {
	var id = $(e).attr('id');
	var r = confirm("Seguro que deseas eliminar este laboratorio!");
	if (r) {
		//$(e).parent('div').hide('slow');
		$.ajax({
        type: "GET",
	        url: "/paquete/laboratorio_eliminar/"+id,
	        success: function (data) {
	        	if (data == 1) {
	        		$(e).parent('div').hide('slow');
	            	toastr.success('El laboratorio ha sido eliminado.', 'Paquetes!');
	        	} else {
	        		toastr.error('El laboratorio no pudo ser eliminado.', 'Paquetes!')
	        	}
	        },
	        error: function (data) {
	            toastr.error('Se genero un problema al momento de realizar el proceso de eliminación.', 'Paquetes!')
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



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
	TestTable1();
	TestTable2();
	TestTable3();
	LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
	$('select').select2();
	$('.dataTables_filter').each(function(){
		$(this).find('label input[type=text]').attr('placeholder', 'Search');
	});
}
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
@endsection
