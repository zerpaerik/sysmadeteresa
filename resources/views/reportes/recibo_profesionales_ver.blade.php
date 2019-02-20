<!DOCTYPE html>
<html lang="en">
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
	<title>Recibo de Profesional</title>

</head>
<body>
	<p style="text-align: right;"><h2>CENTRO MÈDICO</h2></p>
	<p style="text-align: right;"><h2>MADRE TERESA</h2></p>
	<br>

	<p style="margin-left: -20px;"><center><h2>SEDE:{{ Session::get('sedeName') }}</h2></center></p>
   @foreach($reciboprofesional2 as $recibo)
  <p style="margin-left: 15px; margin-top: 10px;"><strong>DOCTOR:</strong>{{ $recibo->name.' '.$recibo->lastname}}</p>
  <p style="margin-left: 15px;margin-top: 2px;"><strong>CONSULTORIO:</strong></p>
  <p style="margin-left: 15px;margin-top: 2px;"><strong>RECIBO: </strong>{{ $recibo->recibo}}</p>
   @endforeach


<table>
  <thead>
  <tr>
    <th style="width: 40%;" scope="col">PACIENTE</th>
    <th scope="col">FECHA</th>
    <th scope="col">DETALLE</th>
    <th scope="col">MONTO</th>
  </tr>
 
  </thead>
  <tbody>
    @foreach($reciboprofesional as $recibo)
    <tr><td>{{ $recibo->nombres.' '.$recibo->apellidos}}</td>
    <td>{{date('d-m-Y', strtotime($recibo->created_at))}}</td>
    @if($recibo->es_servicio == '1')
    <td>{{$recibo->servicio}}</td>
    @elseif($recibo->es_laboratorio == '1')
    <td>{{$recibo->laboratorio}} </td>
    @else
    <td>{{$recibo->paquete}} </td>
    @endif
    <td>{{ $recibo->porcentaje}}</td></tr>
  @endforeach
 </tbody>

  @foreach($totalrecibo as $recibo)
 <p style="margin-left: 550px;"><strong>TOTAL:</strong>{{ $recibo->totalrecibo}}</p>
  @endforeach





</table>


</body>
</html>

