
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
	
	<div class="" style="font-size: 35px; text-align: center; margin-bottom: -15px;">
		<img src="/var/www/html/syspro/public/img/image.png"  style="width: 30%;"/>
	</div>

  <div class="" style="font-size: 40px; text-align: center;margin-bottom:-60px;margin-top: 2px;">
       @if(Session::get('sedeName') == 'ZARATE')
		<p><strong>SYSMEDIC PERU SAC - {{Session::get('sedeName')}}</strong></p>
		@else
		<p><strong>MADRE TERESA SAC- {{Session::get('sedeName')}}</strong></p>
		@endif
          
		@if(Session::get('sedeName') == 'ZARATE')
		<p><strong>RUC: 20606283980</strong></p>
	    <p><strong>DIRECCIÒN: Av Gran Chimú 745 Zarate, San Juan de Lurigancho</strong></p>
		<p><strong>Teléfono: 7820512</strong></p>
		<p><strong>WhatsApp: 924 520 026</strong></p>
		@else
		<p><strong>RUC: 20600971116</strong></p>
	    <p><strong>DIRECCIÒN: Av Próceres de la independencia 1781 3er piso SJL</strong></p>
		<p><strong>Teléfono: 01 3764637</strong></p>
		<p><strong>WhatsApp: 942 066 567</strong></p>
		@endif
	</div>



	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
  <p><strong>FECHA:</strong> {{ date('d/m/Y h:i a', strtotime($paciente->created_at)) }} </p>
	<p><strong>PACIENTE:</strong> {{$paciente->apellidos}},{{$paciente->nombres}}</p>
    	<p><strong>DNI:</strong> {{$paciente->dni}}</p>

    	<p><strong>TIPO:</strong> {{$paciente->tipo}}</p>

	</div>

	

	

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-40px;">
		<p><strong>MONTO: {{ $paciente->monto}}</strong></p>
	</div>



	<br><br><br><br><br><br><br><br>
	<center><p style="font-size: 60px;">COMUNICADO</p></center>
	<p style="text-align: justify;font-size: 30px;">Estimado cliente se informa, que todo estudio que quede pendiente de su realizaciòn <strong>tiene un plazo no mayor a 30 dias,</strong>contando desde la fecha de su cancelaciòn, <strong>pasado este tiempo quedarà como anulado dicho estudio</strong>. Asi mismo las <strong>consultas de reevaluaciòn tienen un plazo de 15 dias,</strong> pasado este tiempo el paciente deberà cancelar por su consulta.</p>

	

	



</body>
</html> 
