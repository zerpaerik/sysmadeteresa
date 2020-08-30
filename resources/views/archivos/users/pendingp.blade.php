@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Pacientes por VALIDAR APP</strong></span>
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

			{!! Form::open(['method' => 'get', 'route' => ['users.pendingp']]) !!}

			<div class="row">
				<div class="col-md-3">
						<select id="el2" name="paciente">
							<option>Seleccione un Paciente</option>
							@foreach($pacientes as $user)
									<option value="{{$user->dni}}">{{$user->apellidos}},{{$user->nombres}}</option>
							@endforeach
						</select>
				</div>
				
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<thead>
						<tr>
							<th>Nombres</th>
							<th>Apellidos</th>
							<th>Email</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)					
							<tr>
								<td>{{$user->name}}</td>
								<td>{{$user->lastname}}</td>
								<td>{{$user->email}}</td>
								<td>
                                    @if($user->validate == NULL)
									<a class="btn btn-success" href="user-validar-{{$user->id}}"  onclick="return confirm('¿Desea Validar este acceso?')">Validar</a>	
                                    @else
                                    <a class="btn btn-danger" href="user-denegar-{{$user->id}}"  onclick="return confirm('¿Desea Denegar este acceso?')">Denegar</a>	
                                    @endif
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
@if(isset($created))
	<div class="alert alert-success" role="alert">
	  A simple success alert—check it out!
	</div>
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