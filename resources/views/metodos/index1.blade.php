@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Pacientes por Llamar HOY</span>
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

			{!! Form::open(['method' => 'get', 'route' => ['metodos.index1']]) !!}

			<div class="row">
				<div class="col-md-2">
					{!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
					{!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha'))
					<p class="help-block">
						{{ $errors->first('fecha') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
					{!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
					<p class="help-block"></p>
					@if($errors->has('fecha2'))
					<p class="help-block">
						{{ $errors->first('fecha2') }}
					</p>
					@endif
				</div>
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>	
			

	
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					                          @foreach($metodos as $atec)	
					<thead>
						<tr>
							<th>Fecha de Registro</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Teléfono</th>
							<th>Método</th>
							<th>Monto</th>
							<th>Próxima Aplicación</th>
							<th>Lo Aplicara</th>
						    <th>Registrado Por:</th>
						    <th>Estatus:</th>
						    @if($atec->estatus == 'Llamado')
						    <th>Observacion:</th>
						    @endif
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>

							<tr>
								<td>{{$atec->created_at}}</td>
								<td>{{$atec->apellidos}},{{$atec->nombres}}</td>
								<td>{{$atec->dni}}</td>
								<td>{{$atec->telefono}}</td>
								<td>{{$atec->producto}}</td>
								<td>{{$atec->monto}}</td>
								<td style="background: #00FFFF;">{{$atec->proximo}}</td>
								<td>{{$atec->personal}}</td>
								<td>{{$atec->name}},{{$atec->lastname}}</td>
								<td style="background: #F781D8">{{$atec->estatus}}</td>
								@if($atec->estatus == 'Llamado')
							    <td>ffff</td>
							    @endif
								<td>
								@if($atec->estatus == 'No Llamado')
							    <a href="#" class="btn btn-danger view" onclick="view(this)" data-id="{{$atec->id}}">Llamado</a>
							    @endif


								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Fecha de Registro</th>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Teléfono</th>
							<th>Método</th>
							<th>Monto</th>
							<th>Próxima Aplicación</th>
						    <th>Registrado Por:</th>
							<th>Acciones</th>
						  

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
                <h4 class="modal-title" id="myModalLabel">Llamar a Paciente</h4>
              </div>
              <div class="modal-body"></div>
            </div>
          </div>
        </div>

</body>



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<script type="text/javascript">
	function view(e){
        var id = $(e).attr('data-id');
        
        $.ajax({
            type: "GET",
            url: "/metodos-llamar-"+id,
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
@endsection
