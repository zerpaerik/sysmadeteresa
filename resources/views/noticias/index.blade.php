@extends('layouts.app')

@section('content')

<body>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-linux"></i>
					<span>App/Noticias</span>
					<a href="{{route('noticias.create')}}" class="btn btn-success">Agregar</a>

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
			<div class="box-content no-padding">
				<table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
					<thead>
						<tr>
							<th>Titulo</th>
							<th>Link</th>
							<th>Cuerpo</th>
							<th>Categoria</th>
							<th>Fecha Redacciòn</th>
							<th>Acciones:</th>


						</tr>
					</thead>
					<tbody>
					@foreach($noticias as $n)					
						<tr>
						<td>{{$n->tittle}}</td>
						<td>{{$n->link}}</td>
						<td>{{$n->description}}</td>
						<td>{{$n->category}}</td>
						<td>{{$n->date}}</td>
						<td><a href="noticias/{{$n->id}}" class="btn btn-danger"  onclick="return confirm('¿Desea Eliminar este registro?')">Eliminar</a></td>

						</tr>
						
				    @endforeach
					</tbody>
					<tfoot>
						<tr>
                        <th>Titulo</th>
							<th>Subtitulo</th>
							<th>Cuerpo</th>
							<th>Fecha Redacciòn</th>
							<th>Acciones:</th>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




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