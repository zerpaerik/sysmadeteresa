<style>
	.paciente {

margin-left: 100px;
margin-top: 45px;
margin-bottom: 2px;
}
.fecha {

margin-left: 100px;
margin-top:-30px;


}
.servicios {

margin-left: 50px;
margin-top:40px;

}
.analisis {

margin-left: 50px;
margin-top:-30px;

}

.acuenta {

margin-left: 50px;
margin-top:40px;
margin-bottom: 1px;

}

.pendiente {

margin-left: 180px;
margin-top:-50px;

}

.origen {

margin-left: 50px;
margin-top:-60px;

}

.total {

margin-left: 410px;
margin-top: -20px;
}
</style>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ticket de Consulta</title>
</head>
<body>


<div class="" style="font-size: 35px; text-align: center; margin-top: -40px;">
		<img src="/var/www/html/sysmadeteresa/public/img/image.png"  style="width: 30%;"/>
	</div>

 <div class="" style="font-size: 30px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
		<p><strong>MADRE TERESA SAC- {{Session::get('sedeName')}}</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20600971116</strong></p>
	    <p style="margin-top: -20px;"><strong>DIRECCIÒN: Av Próceres de la independencia 1781 3er piso SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono: 01 3764637</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 942 066 567</strong></p>

	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-50px;">
		<p><strong>FECHA DE CITA:{{ $paciente->date}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>PACIENTE:{{$paciente->apellidos}} {{$paciente->nombres}}</strong></p>
	</div>
   		@if($paciente->tipo == 'CONTROLES')

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>TIPO: CONTROL</strong></p>
	</div>
	@else


	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>TIPO: CONSULTA</strong></p>
	</div>
	@endif

	

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;;">
		<p><strong>MONTO: {{ $paciente->monto}}</strong></p>
	</div>

	
</body>
</html>
