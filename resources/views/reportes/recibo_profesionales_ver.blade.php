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

		 <img src="/var/www/html/sysmadeteresa/public/img/logo.jpeg"  style="width: 20%;"/>


	<p style="margin-left: 550px;margin-top: -100px;"><strong>SEDE:</strong>{{ Session::get('sedeName') }}</p>


 <p><strong>DOCTOR:</strong>{{ $reciboe->name.' '.$reciboe->lastname}}</p>
  <p><strong>CUENTA:</strong>{{ $reciboe->dni}}</p>
  <p><strong>TELÈFONO:</strong>{{ $reciboe->phone}}</p>
  <p><strong>CONSULTORIO:</strong>MADRE TERESA</p>
  <p><strong>RECIBO: </strong>{{ $reciboe->recibo}}</p>





<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:35%;" scope="col">PACIENTE</th>
    <th style="width:15%;" scope="col">FECHA</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">DETALLE</th>
    <th scope="col">MONTO</th>
    <th scope="col">PORC</th>
    <th scope="col">COMISION</th></tr>
  
 
  </thead>
  <tbody>
    @foreach($reciboprofesional as $recibo)
    <tr><td style="padding: 0;text-align: left;">{{substr($recibo->apellidos.' '.$recibo->nombres,0,24)}}</td>
    <td style="padding: 0;">{{date('d-m-Y', strtotime($recibo->created_at))}}</td>
    @if($recibo->es_servicio == '1')
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{substr($recibo->servicio,0,18)}}</td>
    @elseif($recibo->es_laboratorio == '1')s
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{substr($recibo->laboratorio,0,18)}} </td>
    @else
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{substr($recibo->paquete,0,18)}} </td>
    @endif
    <td style="padding: 0;">{{$recibo->monto}}</td>
    <td style="padding: 0;">{{$recibo->porc_pagar}}</td>
    <td style="padding: 0;">{{$recibo->porcentaje}}</td></tr>

  @endforeach
 </tbody>

  @foreach($totalrecibo as $recibo)
 <p style="margin-left: 570px;"><strong>TOTAL:</strong>{{ $recibo->totalrecibo}}</p>
  @endforeach

  <p style="text-align: left"><strong>FECHA EMISIÒN:</strong>{{$hoy}}</p>






</table>


</body>
</html>

