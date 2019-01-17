@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Existencias/{{ucfirst($model1)}}</span>
				<a href="{{route($model.'.create')}}" class="btn btn-primary">Agregar</a>

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
							
						 @if(\Auth::user()->role_id <> 6)							

							<td><a class="btn btn-warning" href="{{$model . '-edit-' .$d->id}}">Editar</a></td>
								<td><a class="btn btn-danger" href="{{$model.'-delete-'.$d->id}}">Eliminar</a></td>

						@endif

						</tr>
						@endforeach		
					</tbody>
					<tfoot>
						<tr>
							@foreach($headers as $header)
								<th>{{$header}}</th>
							@endforeach
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

@if ($model == 'pacientes')
	<!-- MODAL SECTION -->
    <div class="modal fade" id="viewPaciente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            <h4 class="modal-title" id="myModalLabel">Detalles del Paciente</h4>
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
		        url: "/pacientes/view/"+id,
		        success: function (data) {
		            $("#viewPaciente .modal-body").html(data);
		            $('#viewPaciente').modal('show');
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
@endif




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
