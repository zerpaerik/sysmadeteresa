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

<div style="margin-left: 600px;margin-bottom:-35px;">
		<p><strong>{{$ticket->ticket}}</strong></p>
	</div>

<div class="paciente">
		<p><strong>{{$ticket->nombres}},{{$ticket->apellidos}}</strong></p>
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

	<div class="" style="margin-left: 50px; margin-top: -25px;">
		<p><strong>Origen:{{ $ticket->nompac}},{{ $ticket->apepac}}</strong></p>
	</div>

	<div class="total">
		<p><strong>{{ $ticket->monto}}</strong></p>
	</div>




</body>
</html>
