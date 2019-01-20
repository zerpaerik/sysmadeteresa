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
	<title>Cierre de Caja</title>
</head>

<div>
	<div class="text-center title-header col-12">
		<center><strong>REPORTE DE CIERRE DE CAJA</strong> </center>
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

<div style="background: #eaeaea;">
	<table>
		<tr>
			<th>INGRESOS</th>
			<th>CANTIDAD</th>
			<th>MONTO</th>
		</tr>
		<tr>
			<td>Atenciones</td>
			<td>{{ $atenciones->cantidad }}</td>
			<td>{{ $atenciones->monto }}</td>
		</tr>
		<tr>
			<td>Consultas</td>
			<td>{{ $consultas->cantidad }}</td>
			<td>{{ $consultas->monto }}</td>
		</tr>
		<tr>
			<td>Otros Ingresos</td>
			<td>{{ $otros_servicios->cantidad }}</td>
			<td>{{ $otros_servicios->monto }}</td>
		</tr>
		<tr>
			<td>Cuentas por Cobrar</td>
			<td>{{ $cuentasXcobrar->cantidad }}</td>
			<td>{{ $cuentasXcobrar->monto }}</td>
		</tr>
		<tr>
			<td>Métodos Anticonceptivos</td>
			<td>{{ $metodos->cantidad }}</td>
			<td>{{ $metodos->monto }}</td>
		</tr>
		
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		EGRESOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th>Descripción</th>
			<th>Origen</th>
			<th>Monto</th>
		</tr>
		@foreach ($egresos as $egreso)
			<tr>
				<td>{{ $egreso->descripcion }}</td>
				<td>{{ $egreso->origen }}</td>
				<td>{{ $egreso->monto }}</td>
			</tr>
		@endforeach
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalEgresos }}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		TIPO DE INGRESO AL CIERRE
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th>Total efectivo</th>
			<th>Total tarjeta</th>
		</tr>
		<tr>
			<td>{{ $efectivo->monto }}</td>
			<td>{{ $tarjeta->monto }}</td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td width="80">
				{{ $efectivo->monto + $tarjeta->monto }}
			</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		SALDO AL CIERRE
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th>Ingresos</th>
			<th>Egresos</th>
		</tr>
		<tr>
			<td>{{ $totalIngresos }}</td>
			<td>{{ $totalEgresos }}</td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td width="80">
				{{ $totalIngresos - $totalEgresos }}
			</td>
		</tr>
	</table>
</div>


