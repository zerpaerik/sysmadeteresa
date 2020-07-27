@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Comunicaciones/App</span>

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
			{!! Form::open(['method' => 'get', 'route' => ['comunica.index']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('fecha', 'Seleccione una Fecha', ['class' => 'control-label']) !!}
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif

					
				</div>
				<div class="col-md-2">

					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
				
			</div>	

			<div class="box-content no-padding">
			<div class="box-content no-padding table-responsive">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Id</th>
							<th>Asunto</th>
							<th>Enviado Por:</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Acciones:</th>
						</tr>
					</thead>
					<tbody>

						@foreach($comunica as $d)
						<tr>
						<td>{{$d->id}}</td>
						<td>{{$d->asunto}}</td>
						<td>{{$d->name}} {{$d->lastname}}</td>
                        @if($d->estatus == 1)
                        <td style="color: red;">Recibida</td>
                        @else
                        <td style="color: green;">Respondida</td>
                        @endif
						<td>{{$d->created_at}}</td>
						<td>
                        <a href="comunica-responde-{{$d->id}}" class="btn btn-success">Responder</a>

						</td>

				        @endforeach
				    </tr>
					</tbody>
					<tfoot>
						<tr>
                        <th>Id</th>
							<th>Asunto</th>
							<th>Enviado Por:</th>
							<th>Estatus</th>
							<th>Fecha</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
			</div>
			</div>
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
$(document).ready(function() {
	// Load Datatables and run plugin on tables 
	LoadDataTablesScripts(AllTables);
	// Add Drag-n-Drop feature
	WinMove();
});
</script>
@endsection
