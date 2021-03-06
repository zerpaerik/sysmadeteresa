@extends('layouts.app')
@section('content')



<br>
<h3>SERVICIOS</h3>
<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Servicio</th>
							<th>Estatus</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($serv as $s)					
						<tr>
						<td>{{$s->id}}</td>
						<td>{{$s->detalle}}</td>
						@if($s->estatus == NULL)
						<td style="background: #1660A9;">Sin Atender</td>
						@else
						<td style="background: #F31E08;">Atendido</td>
						@endif
					
					
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Servicio</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>

<h3>LABORATORIOS</h3>

<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Laboratorios</th>
							<th>Estatus</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($lab as $s)					
						<tr>
						<td>{{$s->id}}</td>
						<td>{{$s->detalle}}</td>
						@if($s->estatus == NULL)
						<td style="background: #1660A9;">Sin Atender</td>
						@else
						<td style="background: #F31E08;">Atendido</td>
						@endif
					
					
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Laboratorios</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>

<h3>CONSULTAS</h3>

<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Consulta</th>
							<th>Titulo</th>
							<th>Estatus</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($con as $s)					
						<tr>
						<td>{{$s->id}}</td>
						<td>{{$s->tipo}}</td>
						<td>{{$s->title}}</td>
						@if($s->estatus == NULL)
						<td style="background: #1660A9;">Sin Atender</td>
						@else
						<td style="background: #F31E08;">Atendido</td>
						@endif
					
					
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Consulta</th>
							<th>Titulo</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>

<h3>CONTROLES</h3>

<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Control</th>
							<th>Titulo</th>
							<th>Estatus</th>
							
						</tr>
					</thead>
					<tbody>
					@foreach($cont as $s)					
						<tr>
						<td>{{$s->id}}</td>
						<td>{{$s->tipo}}</td>
						<td>{{$s->title}}</td>
						@if($s->estatus == NULL)
						<td style="background: #1660A9;">Sin Atender</td>
						@else
						<td style="background: #F31E08;">Atendido</td>
						@endif
					
					
						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Id</th>
							<th>Control</th>
							<th>Titulo</th>
							<th>Estatus</th>
						</tr>
					</tfoot>
				</table>
			</div>



@endsection
