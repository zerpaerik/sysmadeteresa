@extends('layouts.app')

@section('content')
</br>

<div class="row">
	<div class="col-xs-12">
		<div class="box">
		
			<div class="box-header">
				
				<div class="box-name">
					<i class="fa {{$icon}}"></i>
					<span><strong>{{ucfirst($model)}}</strong></span>				
				</div>
				<div class="col-sm-3">
					<input type="date" id="input_date" class="form-control" placeholder="Fecha" name="date">
				</div>
				<div class="box-icons">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					<a class="expand-link">
						<i class="fa fa-expand"></i>
					</a>
				</div>
			</div>
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/resultados-search" method="get">
						<label for="">Nombre y apellido</label>
						<input type="text" name="nom" value="" style="line-height: 20px">					
						<input type="submit" class="btn btn-primary" value="Buscar">
					</form>
					<thead>
						<tr>
								<th>Fecha</th>
								<th width="20%">Paciente</th>
								<th>Origen</th>
								<th>Detalle</th>
								<th>Informe</th>
								<th>Accion</th>

						</tr>
					</thead>
					<tbody>
						@foreach($data as $d)
						<tr>
								<td>{{$d->created_at}}</td>
						        <td>{{$d->nombres}},{{$d->apellidos}}</td>
								<td>{{$d->name}},{{$d->lastname}}</td>
								@if($d->es_servicio =='1')
								<td>{{$d->servicio}}</td>
							    @else
								<td>{{$d->laboratorio}}</td>
							    @endif

							  
							@if($d->informe)
						<td>						
                        <a href="{{route('descargar',$d->informe)}}" class="btn btn-danger" target="_blank">Descargar Modelo</a>
						</td>	
							<td><a class="btn btn-primary" href="/resultados-guardar-{{$d->id}}">Adjuntar Informe</a></td>

							@else
								<td>
								<form action="{{$model . '-asoc-' .$d->id}}" method="get">
								<select name="informe" id="informe">
									<option value="">Seleccione</option>
                                    <option value="OBST III DOPPLER NIVEL II-3p.docx">OBST III DOPPLER NIVEL II-3p</option>

								</select>
							</td>
							<td><input type="submit" class="btn btn-success" value="Asociar"></td>
							@endif
							
						</tr>
						</form>
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
	
	var informe = ""

	function informe_value(value)
	{
		console.log(this.informe = value);
	}

	$('#input_date').on('change', getAva);

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
