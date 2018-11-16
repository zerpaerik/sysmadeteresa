@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<span><strong>Modelo de informes</strong></span>
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
					<form action="/resultados-informe-search" method="get">
						<h5>Informe por nombre</h5>
						<label for="">Busqueda </label>
						<input type="text" name="title" style="line-height: 20px">
						<input type="submit" class="btn btn-primary">
					</form>
					<thead> 
						<tr>
							<th>Id</th>
							<th>Titulo</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->title}}</td>
							<td><a class="btn btn-primary" href="/resultados-informe-editar-{{$d->id}}">Editar</a></td>
						</tr>
						@endforeach						
					</tbody>
					
				</table>
				{{$data->links()}}
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

@endsection
