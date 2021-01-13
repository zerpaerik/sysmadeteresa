<style>
	
	.col-12{
		width: 50%;
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

	
</style>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Hora de Cierre de Turno:</strong> {{$hoy}}
					</span>
				</div>
			</div>
			<div class="box-content">
				<div style="background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">INGRESOS</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">CANTIDAD</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">MONTO</th>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Atenciones</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $atenciones->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $atenciones->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Consultas</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $consultas->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $consultas->monto }}</td>
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
			<td>Ventas</td>
			<td>{{ $ventas->cantidad }}</td>
			<td>{{ $ventas->monto }}</td>
		</tr>
		<tr>
			<td>Metodos Anticonceptivos</td>
			<td>{{ $metodos->cantidad }}</td>
			<td>{{ $metodos->monto }}</td>
		</tr>
		<tr>
			<td>TOTAL</td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalIngresos }}</td>
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
			<td>{{ $egreso->tipo }}</td>
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
		SALDO TOTAL
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
		SALDO DEL DÍA
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th>Ingresos</th>
			<th>Egresos</th>
		</tr>
		<tr>
			<td>{{ $efectivo->monto }}</td>
			<td>{{ $totalEgresos }}</td>
		</tr>
		<tr>
			<td>Total</td>
			<td></td>
			<td width="80">
				{{ $efectivo->monto - $totalEgresos }}
			</td>
		</tr>
	</table>
</div>			
					
			
				
			

			</div>
		</div>
	</div>
</div>
