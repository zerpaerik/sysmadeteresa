@extends('layouts.app')

@section('content')
</br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Laboratorios por Pagar</strong></span>
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
									               <div class="box-content no-padding table-responsive">				

				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-1">
					<form action="/labporpagar-search" method="get">
						<label for="">Buscar</label>
						<input type="text" placeholder="Buscador" name="nom" style="line-height: 20px;">
						<input type="submit" value="Buscar" class="btn btn-primary" style="margin-left: 30px;">
					</form>	
					<thead>
						<tr>
							<th>Fecha Atenciòn</th>
							<th>Paciente</th>
							<th>Analisis</th>
							<th>Laboratorio a Pagar</th>
							<th>Monto por Pagar</th>
							<th>Acciones</th>

						</tr>
					</thead>
					<tbody>
						@foreach($atenciones as $atec)					
							<tr>
								<td>{{$atec->created_at}}</td>
								<td>{{$atec->nombres}},{{$atec->apellidos}}</td>
								<td>{{$atec->nombreana}}</td>
							    <td>{{$atec->nombrelab}}</td>
								<td>{{$atec->costo}}</td>
								 @if(\Auth::user()->role_id <> 6)							 
								<td><a href="{{asset('/pagar')}}/{{$atec->id}}" class="btn btn-xs btn-danger">Pagar</a></td>
							    @endif
							</tr>
						@endforeach
					</tbody>
					<tfoot>
						
					</tfoot>
				</table>
				</div>
				{{$atenciones->links()}}
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