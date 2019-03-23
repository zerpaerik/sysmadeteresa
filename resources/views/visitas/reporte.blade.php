<style>
	.row{
		width: 1024px;
		margin: 0 auto;
	}

	.col-12{
		width: 100%;
	}
	
	.col-6{
		width: 49%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}

	.text-center{
		text-align: center;
	}
	
	.text-right{
		text-align: right;
	}

	.title-header{
		font-size: 22px; 
		text-transform: uppercase; 
		padding: 12px 0;
	}
	table{
		width: 100%;
		text-align: center;
		margin: 10px 0;
	}
	
	tr th{
		font-size: 14px;
		text-transform: uppercase;
		padding: 8px 5px;
	}

	tr td{
		font-size: 14px;
		padding: 8px 5px;
	}
</style>
		 <img src="/var/www/html/sysmadeteresa/public/img/logo.jpeg"  style="width: 20%;"/>

<div>
	<div class="text-center title-header col-12">
				<center><strong>REPORTE DE VISITAS</strong> </center><
		<strong>SEDE:</strong> {{ Session::get('sedeName') }}
	</div>
</div>
<div>
	<div class="col-6">
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6">
		Fecha de Consulta: {{$f1}}-{{$f2}}
	</div>
	

</div>

<br>


<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Profesional</th>
			<th>Consultorio</th>
			<th>Especialidad</th>
		    <th>Visitador</th>
		    <th>Fecha de Visita</th>

			
		</tr>
		@foreach ($visitas as $atec)
			<tr>
					       <td>{{$atec->name}},{{$atec->apellidos}}</td>
							<td>{{$atec->centro}}</td>
							<td>{{$atec->especialidad}}</td>
							<td>{{$atec->nomvi}},{{$atec->apevi}}</td>
							<td>{{$atec->created_at}}</td>
			</tr>
		@endforeach
	</table>
</div>











