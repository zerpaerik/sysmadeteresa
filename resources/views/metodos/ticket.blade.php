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
	<title>Ticket de Mètodo</title>
</head>
<body>


<div class="paciente">
		<p><strong>Paciente: {{$metodos->nombres}} {{$metodos->apellidos}}</strong></p>
	</div>

	<div class="fecha">
		<p><strong>Fecha: {{ $metodos->created_at}}</strong></p>
	</div>
	<div class="servicios">
		<p><strong>Mètodo: {{ $metodos->producto}}</strong></p>
	</div>

	<div class="servicios">
		<p><strong></strong></p>
	</div>

	<div class="total">
		<p><strong>Monto: {{ $metodos->monto}}</strong></p>
	</div>
</body>
</html>
