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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">CIERRE</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">FECHA</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">MONTO DE CIERRE</th>
            <th style="padding: 0;width: 5%;text-overflow: ellipsis;">CERRADO POR:</th>
		</tr>
		<tr>
                @if($caja->cierre_matutino)
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">Matutino: {{$caja->cierre_matutino}}</td>
                @else
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">Vespertino: {{$caja->cierre_vespertino}}</td>
                @endif			
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->created_at}}</td>
                @if($caja->cierre_matutino)
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->cierre_matutino}}</td>
                @else
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->cierre_vespertino}}</td>
                @endif	
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->name}},{{$caja->lastname}}</td>
		</tr>
	
		
	</table>
</div>


<div style="font-weight: bold; font-size: 14px">
		SERVICIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ticket</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Total</th>
		    <th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Abonado</th>
		</tr>
		@foreach ($servicios as $serv)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->servicio }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->nombres }},{{ $serv->apellidos }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80" style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$totalServicios->abono}}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		LABORATORIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ticket</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Total</th>
		    <th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Abonado</th>
		</tr>
		@foreach ($laboratorios as $lab)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->laboratorio }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->nombres }},{{ $lab->apellidos }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80" style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totalLaboratorios->monto }}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		PAQUETES
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ticket</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Total</th>
		    <th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Abonado</th>
		</tr>
		@foreach ($paquetes as $lab)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;"> {{ $lab->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->paquete }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->nombres }},{{ $lab->apellidos }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->abono }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Doctor</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto</th>
		</tr>
		@foreach ($consultas as $con)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->nombres }},{{ $con->apellidos }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->name }},{{ $con->apepro }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">EF</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80" style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totalconsultas->monto }}</td>
		</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		OTROS INGRESOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Descripciòn</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de INGRESO</th>
		</tr>
		@foreach ($otrosingresos as $con)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->descripcion }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->tipo_ingreso }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80" style="padding: 0;width: 5%;text-overflow: ellipsis;"> {{ $totalotrosingresos->monto }}</td>
		</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		CUENTAS POR COBRAR
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de INGRESO</th>
		</tr>
		@foreach ($cuentasporcobrar as $con)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->nombres }},{{ $con->apellidos }}</td>
				@if($con->es_servicio == 1)
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->servicio }}</td>
				@elseif($con->es_laboratorio == 1)
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->laboratorio }}</td>
				@else
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->paquete }}</td>
				@endif
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->tipo_ingreso }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80" style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totalcuentasporcobrar->monto }}</td>
		</tr>
	</table>
</div>




