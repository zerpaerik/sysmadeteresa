@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			@if(session('created'))
				<div class="alert alert-success" role="alert">
				  A simple success alert—check it out!
				</div>
			@endif
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Paquetes</strong></span>
					<a href="{{route('paquetes.create')}}" class="btn btn-primary">Agregar</a>
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
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Porcentaje</th>
						</tr>
					</thead>
					<tbody>
						@foreach($paquetes as $paq)					
							<tr>
								<td>{{$paq->detalle}}</td>
								<td>{{$paq->precio}}</td>
								<td>{{$paq->porcentaje}}</td>
								<td>
									<a href="#" class="btn btn-primary view" onclick="view(this)" data-id="{{$paq->id}}">ver</a>
									<a href="paquetes-edit-{{$paq->id}}" class="btn btn-warning edit">Editar</a>
									<a href="paquetes/{{$paq->id}}" class="btn btn-danger">Eliminar</a>
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- MODAL SECTION -->
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
</script>

@endsection