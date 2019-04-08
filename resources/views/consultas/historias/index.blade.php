@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>Historias de Pacientes</span>

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

		{!! Form::open(['method' => 'get', 'route' => ['historias.index']]) !!}

			<div class="row">
				<div class="col-md-4">
					<select id="el2" name="paciente">
							<option selected hidden disabled>Seleccione un Paciente</option>
							@foreach($pacientes as $p)
								    <option value="{{$p->id}}">{{$p->apellidos}},{{$p->nombres}}</option>
							@endforeach
						</select>
				</div>
				
				<div class="col-md-2">
					{!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
					{!! Form::close() !!}

				</div>
			</div>

			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Registro</th>
							<th>Historia</th>


						</tr>
					</thead>
					<tbody>
						@foreach($historias as $h)					
							<tr>
								<td>{{$h->nombres}},{{$h->apellidos}}</td>
								<td>{{$h->dni}}</td>
								<td>{{$h->created_at}}</td>
								<td>
								<a  class="btn btn-success" href="historias-{{$h->consultaid}}">Ver Historia</a>
								<a target="_blank" class="btn btn-danger" href="historiasr-{{$h->consultaid}}">Ver Reporte</a>	
								</td>
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						<tr>
							<th>Paciente</th>
							<th>DNI</th>
							<th>Registro</th>
							<th>Historia</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>


@section('scripts')
<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

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
