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
	<title>Materiales Malogrados</title>

</head>
<body>

		 <img src="/var/www/html/sysmadeteresa/public/img/logo.jpeg"  style="width: 20%;"/>

    <strong><p style="margin-left: 200px;margin-top: -100px;">MATERIALES MALOGRADOS</p></strong>
	<p style="margin-left: 550px;margin-top: -100px;"><strong>SEDE:</strong>{{ Session::get('sedeName') }}</p>



<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  
    <tr>
    <th scope="col">PRODUCTO</th>
    <th scope="col">CANTIDAD</th>
    <th scope="col">PACIENTE</th>
    <th scope="col">SERVICIO</th>
    <th scope="col">USUARIO</th>
    <th scope="col">FECHA</th>
    </tr>
  
 
    @foreach($materiales as $recibo)
    <tr>
     <td style="padding: 0;">{{$recibo->nombre}}</td>
    <td style="padding: 0;">{{$recibo->total}}</td>
     <td style="padding: 0;">{{substr($recibo->nom,0,5)}} {{substr($recibo->ape,0,5)}}</td>
    <td style="padding: 0;">{{substr($recibo->servicio,0,10)}}</td>
    <td style="padding: 0;">{{substr($recibo->name,0,5)}} {{substr($recibo->lastname,0,5)}}</td>
    <td style="padding: 0;">{{substr($recibo->created_at,0,10)}}</td>
</tr>
  @endforeach

 







</table>


</body>
</html>

