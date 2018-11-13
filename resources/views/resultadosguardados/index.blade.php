@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">

			<div class="box-header">
				<div class="box-name">
					<i class="fa {{$icon}}"></i>
					<span><strong>Resultados Guardados</strong></span>
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
					<form action="/resultadosguardados-search" method="get">
						<h5>Rango de fechas</h5>
						<label for="">Inicio</label>
						<input type="date" name="inicio" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<input type="submit">
					</form>
					<thead> 
						<tr>
							<th>Id</th>
							<th>Paciente</th>
							<th>Origen</th>
							<th>Detalle</th>
							<th>Fecha</th>
							<th>Acciones</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->nombres}},{{$d->apellidos}}</td>
						<td>{{$d->name}},{{$d->lastname}}</td>
						@if($d->es_servicio =='1')
						<td>{{$d->servicio}}</td>
						@elseif($d->es_laboratorio =='1')
						<td>{{$d->laboratorio}}</td>
						@else
						<td>{{$d->paquete}}</td>
						@endif
						<td>{{$d->created_at}}</td>
												
							<td><a class="btn btn-warning" href="{{asset('resultadosguardados')}}-ver-{{$d->id}}">Ver informe</a>
							<a class="btn btn-danger" href="{{asset('resultadosguardados')}}-editar-{{$d->id}}">Editar Informe</a></td>
						</tr>
						@endforeach						
					</tbody>
					
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

@endsection
