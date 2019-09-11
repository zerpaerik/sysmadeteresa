@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Controles Prenatales</strong></span>
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
			{!! Form::open(['method' => 'get', 'route' => ['prenatal.index']]) !!}

			<div class="row">
					<div class="col-md-4">

							<select id="el1"  name="paciente">
								<option value="">Busque el Paciente</option>
								@foreach($pacientes as $role)
									<option value="{{$role->id}}">{{$role->apellidos}},{{$role->nombres}}-{{$role->dni}}</option>
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
							<th>Paciente</th>
							<th>DNI</th>
							<th>Registro</th>
							<th>Ver Ficha</th>
							<th>Completar</th>
							
						</tr>
					</thead>
					<tbody>
						@foreach($prenatal as $d)					
							<tr>
								<td>{{$d->apellidos}} {{$d->nombres}}</td>
								<td>{{$d->dni}}</td>
								<td>{{$d->created_at}}</td>
								<td><a href="prenatal-ver-{{$d->idPaciente}}" class="btn btn-success">Ver ficha</a></td>
								@if(\Auth::user()->role_id == 4)
								<td><a href="control-edit-{{$d->id}}" class="btn btn-primary">Reevaluar</a></td>
								@endif
								@if(\Auth::user()->role_id == 5)
								<td><a href="control-edit-{{$d->id}}" class="btn btn-primary">Reevaluar</a></td>
								@if(\Auth::user()->role_id == 7)
								<td><a href="control-edit-{{$d->id}}" class="btn btn-primary">Reevaluar</a></td>
								@endif
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

@section('scripts')
<script type="text/javascript">
// Run Select2 on element
$(document).ready(function() {
      LoadTimePickerScript(DemoTimePicker);
      LoadSelect2Script(function (){
            $("#el2").select2();
            $("#el1").select2();
            $("#el3").select2({disabled : true});
      });
      WinMove();
});

$('#input_date').on('change', getAva);
$('#el1').on('change', getAva);

function getAva (){
            var d = $('#input_date').val();
            var e = $("#el1").val();
            if(!d) return;
            $.ajax({
      url: "available-time/"+e+"/"+d,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
      type: "get",
      success: function(res){
            $('#el3').find('option').remove().end();
            for(var i = 0; i < res.length; i++){
                              var newOption = new Option(res[i].start_time+"-"+res[i].end_time, res[i].id, false, false);
                              $('#el3').append(newOption).trigger('change');
            }
      }
    });     
}

function DemoTimePicker(){
      $('#input_date').datepicker({
      setDate: new Date(),
      minDate: 0});
}
</script>
@endsection

@endsection