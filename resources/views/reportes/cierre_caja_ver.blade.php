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
@foreach($caja as $c)		
		<tr>
                @if($c->cierre_matutino)
                <td>Matutino: {{$c->cierre_matutino}}</td>
                @else
                <td>Vespertino: {{$c->cierre_vespertino}}</td>
                @endif			
                <td>{{$c->created_at}}</td>
			    <td>{{$c->balance}}</td>
			    <td>{{$c->name}},{{$c->lastname}}</td>
		</tr>
@endforeach		
	
		
	</table>
</div>


