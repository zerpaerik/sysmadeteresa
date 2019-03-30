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
<head>
	<title>Cierre de Caja Detallado</title>
</head>

<div>
			<img src="/var/www/html/sysmadeteresa/public/img/logo2.jpeg"  style="width: 20%;"/>

	<div class="text-center title-header col-12">
		<center><strong>REPORTE DE CIERRE DE CAJA DETALLADO</strong> </center>
		<strong>SEDE:</strong> {{ Session::get('sedeName') }}
	</div>
</div>
<div>
	<div class="col-6">
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6 text-right">
		Hora de Impresión: {{ Carbon\Carbon::now('America/Lima')->format('h:i a') }}
	</div> 
</div>

<div style="background: #eaeaea;">
	<table>
		<tr>
			<th>CIERRE</th>
			<th>FECHA</th>
			<th>MONTO DE CIERRE</th>
            <th>CERRADO POR:</th>
		</tr>
		<tr>
                @if($caja->cierre_matutino)
                <td>Matutino: {{$caja->cierre_matutino}}</td>
                @else
                <td>Vespertino: {{$caja->cierre_vespertino}}</td>
                @endif			
                <td>{{$caja->created_at}}</td>
                @if($caja->cierre_matutino)
                <td>{{$caja->cierre_matutino}}</td>
                @else
                <td>{{$caja->cierre_vespertino}}</td>
                @endif	
			    <td>{{$caja->name}},{{$caja->lastname}}</td>
		</tr>
	
		
	</table>
</div>


<div style="font-weight: bold; font-size: 14px">
		SERVICIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Ticket</th>
			<th>Detalle</th>
			<th>Paciente</th>
			<th>Monto Total</th>
		    <th>Monto Abonado</th>
		</tr>
		@foreach ($servicios as $serv)
			<tr>
				<td>{{ $serv->id }}</td>
				<td>{{ $serv->servicio }}</td>
				<td>{{ $serv->nombres }},{{ $serv->apellidos }}</td>
				<td>{{ $serv->monto }}</td>
				<td>{{ $serv->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{$totalServicios->abono}}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		LABORATORIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Ticket</th>
			<th>Detalle</th>
			<th>Paciente</th>
			<th>Monto Total</th>
		    <th>Monto Abonado</th>
		</tr>
		@foreach ($laboratorios as $lab)
			<tr>
				<td>{{ $lab->id }}</td>
				<td>{{ $lab->laboratorio }}</td>
				<td>{{ $lab->nombres }},{{ $serv->apellidos }}</td>
				<td>{{ $lab->monto }}</td>
				<td>{{ $lab->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalLaboratorios->monto }}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		PAQUETES
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Ticket</th>
			<th>Detalle</th>
			<th>Paciente</th>
			<th>Monto Total</th>
		    <th>Monto Abonado</th>
		</tr>
		@foreach ($paquetes as $lab)
			<tr>
				<td>{{ $lab->id }}</td>
				<td>{{ $lab->paquete }}</td>
				<td>{{ $lab->nombres }},{{ $lab->apellidos }}</td>
				<td>{{ $lab->monto }}</td>
				<td>{{ $lab->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalpaquetes->monto }}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		CONSULTAS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Paciente</th>
			<th>Doctor</th>
			<th>Monto</th>
		</tr>
		@foreach ($consultas as $con)
			<tr>
				<td>{{ $con->nombres }},{{ $con->apellidos }}</td>
				<td>{{ $con->name }},{{ $con->apepro }}</td>
				<td>{{ $con->monto }}</td>
				<td>EF</td>
			</tr>
		@endforeach
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalconsultas->monto }}</td>
		</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		OTROS INGRESOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Descripciòn</th>
			<th>Monto</th>
			<th>Tipo de INGRESO</th>
		</tr>
		@foreach ($otrosingresos as $con)
			<tr>
				<td>{{ $con->descripcion }}</td>
				<td>{{ $con->monto }}</td>
				<td>{{ $con->tipo_ingreso }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalotrosingresos->monto }}</td>
		</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		CUENTAS POR COBRAR
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Paciente</th>
			<th>Detalle</th>
			<th>Monto</th>
			<th>Tipo de INGRESO</th>
		</tr>
		@foreach ($cuentasporcobrar as $con)
			<tr>
				<td>{{ $con->nombres }},{{ $con->apellidos }}</td>
				@if($con->es_servicio == 1)
				<td>{{ $con->servicio }}</td>
				@elseif($con->es_laboratorio == 1)
				<td>{{ $con->laboratorio }}</td>
				@else
				<td>{{ $con->paquete }}</td>
				@endif
				<td>{{ $con->monto }}</td>
				<td>{{ $con->tipo_ingreso }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalcuentasporcobrar->monto }}</td>
		</tr>
	</table>
</div>




