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
				<center><strong>LISTADO DE MOVIMIENTOS</strong> </center>
		       <strong>SEDE:</strong> {{ Session::get('sedeName') }}
		       <strong>DESDE:</strong>: {{$f1}} -
		       <strong>HASTA:</strong>: {{$f2}} -

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

<br>

<div style="background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">FECHA</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">INGRESOS</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">EFECTIVO</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">TARJETA</th>




		</tr>
        @if($ingresos > 0)
		@foreach($ingresos as $c)
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->date}}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->monto}}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->efectivo}}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->tarjeta}}</td>
			
		</tr>
		@endforeach
        @endif
	</table>
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">FECHA</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">EGRESOS</th>
			



		</tr>
		@foreach($egresos as $c)
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->date}}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$c->egreso}}</td>
		</tr>
		@endforeach
	</table>

	<strong>TOTAL INGRESOS:</strong>{{$total->monto}}<br>
	<strong>TOTAL EGRESOS:</strong>{{$debitos->monto}}<br>
	<strong>SALDO:</strong>{{$saldo}}

	
	
</div>







