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
	<title>Ticket de Atenciòn</title>
</head>
<body>


	@if(Session::get('sedeName') == 'PROCERES' || Session::get('sedeName') == 'CANTO REY')
	<div class="" style="font-size: 35px; text-align: center; margin-top: -40px;">
		<img src="/var/www/html/sysmadeteresa/public/img/image.png"  style="width: 30%;"/>
	</div>

 <div class="" style="font-size: 30px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
		<p><strong>MADRE TERESA SAC- {{Session::get('sedeName')}}</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20600971116</strong></p>
	    <p style="margin-top: -20px;"><strong>DIRECCIÒN: Av Próceres de la independencia 1781 3er piso SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono: 01 3764637</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 942 066 567</strong></p>
	   <p style="margin-top: -20px;"><strong>TICKET:{{ $ticket->id}}</strong></p>

	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-bottom:-50px;">
		<p><strong>FECHA:{{ date('d/m/Y h:i a', strtotime($ticket->created_at)) }}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>PACIENTE:{{ $ticket->nombres}},{{ $ticket->apellidos}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>DETALLE:{{ $ticket->detalle}}
		</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;;">
		<p><strong>MONTO: {{ $ticket->monto}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>ABONO:{{ $ticket->abono}}</strong></p>
	</div>

	<div class="" style="font-size: 40px; text-align: left;margin-top: -50px;">
		<p><strong>RESTA: {{ $ticket->pendiente}}</strong></p>
	</div>
    
    <br><br><br><br><br><br><br><br>
	<center><p style="font-size: 60px;">COMUNICADO</p></center>
	<p style="text-align: justify;font-size: 30px;">Estimado cliente se informa, que todo estudio que quede pendiente de su realizaciòn <strong>tiene un plazo no mayor a 30 dias,</strong>contando desde la fecha de su cancelaciòn, <strong>pasado este tiempo quedarà como anulado dicho estudio</strong>. Asi mismo las <strong>consultas de reevaluaciòn tienen un plazo de 15 dias,</strong> pasado este tiempo el paciente deberà cancelar por su consulta.</p>

	

    

@else

<div style="margin-left: 600px;margin-bottom:-35px;">
		<p><strong>{{$ticket->ticket}}</strong></p>
	</div>


<div class="paciente">
		<p><strong>{{$ticket->apellidos}},{{$ticket->nombres}}</strong></p>
	</div>


	<div class="fecha">
		<p><strong>{{ $ticket->created_at}}</strong></p>
	</div>
	<div class="servicios">
		<p><strong>{{ $ticket->detalle}}</strong></p>
	</div>

	<div class="acuenta">
		<p><strong>A Cuenta:{{ $ticket->abono}}</strong></p>
	</div>

	<div class="pendiente">
		<p><strong>Deuda: {{ $ticket->pendiente}}</strong></p>
	</div>

	

	<div class="total">
		<p><strong>{{ $ticket->monto}}</strong></p>
	</div>
    
    <br><br><br><br><br><br><br><br>
	<center><p style="font-size: 60px;">COMUNICADO</p></center>
	<p style="text-align: justify;font-size: 30px;">Estimado cliente se informa, que todo estudio que quede pendiente de su realizaciòn <strong>tiene un plazo no mayor a 30 dias,</strong>contando desde la fecha de su cancelaciòn, <strong>pasado este tiempo quedarà como anulado dicho estudio</strong>. Asi mismo las <strong>consultas de reevaluaciòn tienen un plazo de 15 dias,</strong> pasado este tiempo el paciente deberà cancelar por su consulta.</p>

	


@endif

</body>
</html>
