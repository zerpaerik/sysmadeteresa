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
		font-size: 22px;
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
		background: #eaeaea;
	}
	th, td{
		border-bottom: 1px solid black;
	}

	tr th{
		font-size: 20px;
		text-transform: uppercase;
		padding: 8px 5px;
	}

	tr td{
		font-size: 22px;
		padding: 8px 5px;
	}
</style>

<div class="row">
	<div class="text-center title-header col-12">
		<strong>EMPRESA:</strong> Alberto Veliz
	</div>
	<div class="text-center title-header col-12">
		<strong>SUCURSAL:</strong> Aleander
	</div>
</div>

<div class="row" style="overflow: auto;">
	<div class="col-6">
		Fecha de Impresión: 05/11/2018
	</div>
	<div class="col-6 text-right">
		Hora de Impresión: 00:00 am
	</div> 
	<div class="col-6">
		Fecha de Consulta:
	</div>
</div>
<div class="row">
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
			<td>TOTAL</td>
			<td></td>
			<td></td>
			<td width="150">{{ $atenciones->monto + $consultas->monto + $otros_servicios->monto + $cuentasXcobrar->monto }}</td>
		</tr>
	</table>
</div>
<div class="row">
	<div class="col-6" style="font-weight: bold; ">
		EGRESOS
	</div>
</div>
<div class="row">
	<table>
		<tr>
			<th>Descripción</th>
			<th>Origen</th>
			<th>Monto</th>
		</tr>
		@foreach ($egresos as $egreso)
			<tr>
				<th>{{ $egreso->descripcion }}</th>
				<th>{{ $egreso->origen }}</th>
				<th>{{ $egreso->monto }}</th>
			</tr>
		@endforeach
		<tr>
			<th>Total</th>
			<th></th>
			<th></th>
			<th width="150">0</th>
		</tr>
	</table>
</div>
<div class="row">
	<div class="col-6" style="font-weight: bold; ">
		SALDO TOTAL
	</div>
</div>
<div class="row">
	<table>
		<tr>
			<th>Total efectivo</th>
			<th>Total tarjeta</th>
		</tr>
		<tr>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td width="150">0</td>
		</tr>
	</table>
</div>
<div class="row">
	<div class="col-6" style="font-weight: bold; ">
		SALDO DEL DÍA
	</div>
</div>
<div class="row">
	<table>
		<tr>
			<th>Ingresos</th>
			<th>Egresos</th>
		</tr>
		<tr>
			<td>0</td>
			<td>0</td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td width="150">0</td>
		</tr>
	</table>
</div>