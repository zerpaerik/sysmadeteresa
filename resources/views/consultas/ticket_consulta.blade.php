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


<div class="paciente">
		<p><strong>Paciente: {{$paciente->apellidos}} {{$paciente->nombres}}</strong></p>
	</div>

	<div class="fecha">
		<p><strong>Fecha de cita: {{ $paciente->date}}</strong></p>
	</div>
	<div class="servicios">
		@if($paciente->tipo == 'CONTROLES')
		<p><strong>Tipo: CONTROL PRENATAL</strong></p>
		@else
		<p><strong>Tipo: CONSULTA</strong></p>
		@endif
	</div>

	<div class="servicios">
		<p><strong>Hora de cita: </strong></p>
	</div>

	<div class="total">
		<p><strong>Monto: {{ $paciente->monto}}</strong></p>
	</div>
</body>
</html>
