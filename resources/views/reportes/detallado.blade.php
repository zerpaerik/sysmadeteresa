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

<div>
	<div class="text-center title-header col-12">
				<center><strong>REPORTE DETALLADO</strong> </center><
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
<div style="width: 49%;padding: 8px 5px;font-size: 18px;">
		Fecha de Consulta: {{$hoy}}
</div>
<br>

<div style="font-weight: bold; font-size: 14px">
		SERVICIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ticket</th>
			<th style="padding: 0;width: 20%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 20%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">Monto Total</th>
		    <th style="padding: 0;width: 10%;text-overflow: ellipsis;">Monto Abonado</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo Pago</th>
		</tr>
		@foreach ($servicios as $serv)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($serv->servicio,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($serv->apellidos.' '.$serv->nombres,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->abono }}</td>
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->tipopago }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ticket</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Total</th>
		    <th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto Abonado</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de Pago</th>
		</tr>
		@foreach ($laboratorios as $lab)
			<tr>
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($lab->laboratorio,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($lab->apellidos.' '.$lab->nombres,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->abono }}</td>
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->tipopago }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalLaboratorios->abono }}</td>
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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de Pago</th>
		</tr>
		@foreach ($paquetes as $serv)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->id }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($serv->paquete,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($serv->apellidos.' '.$serv->nombres,0,22)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->abono }}</td>
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $serv->tipopago }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total Abonado</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{$totalPaquetes->abono}}</td>
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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de Pago</th>
		</tr>
		@foreach ($consultas as $con)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($con->apellidos.' '.$con->nombres,0,15)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{substr($con->apepro.' '.$con->name,0,15)}}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $con->monto }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">EF</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
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
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Descripciòn</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo de INGRESO</th>
		</tr>
		@foreach ($cuentasporcobrar as $con)
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
			<td width="80">{{ $totalcuentasporcobrar->monto }}</td>
		</tr>
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		MÉTODOS ANTICONCEPTIVOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 30%;text-overflow: ellipsis;">Paciente</th>
			<th style="padding: 0;width: 30%;text-overflow: ellipsis;">Método</th>
			<th style="padding: 0;width: 30%;text-overflow: ellipsis;">Monto</th>
			<th style="padding: 0;width: 30%;text-overflow: ellipsis;">Tipo de Pago</th>
		</tr>
		@foreach ($metodos as $serv)
			<tr>
				<td style="padding: 0;width: 30%;text-overflow: ellipsis;">{{substr($serv->apellidos.' '.$serv->nombres,0,15)}}</td>
				<td style="padding: 0;width: 30%;text-overflow: ellipsis;">{{ $serv->producto }}</td>
				<td style="padding: 0;width: 30%;text-overflow: ellipsis;">{{ $serv->monto }}</td>
			    <td style="padding: 0;width: 30%;text-overflow: ellipsis;">EF</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td width="80">{{$totalmetodos->monto}}</td>
		</tr>
	</table>
</div>





