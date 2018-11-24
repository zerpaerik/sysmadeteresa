<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resultado de Informe</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>
	<p style="margin-left: 260px; font-size: 16px;"><strong>CONTROL PRENATAL</strong></p>
	@foreach($controles as $c)
	<br>
	<p style="margin-left: 150px;"><strong>CONTROL DEL DIA: </strong>{{ $c->fecha_cont}}</p>
	<p style="margin-left: 150px;"><strong>GESTACION EN SEMANAS: </strong>{{ $c->gesta_semanas}} semanas</p>
	<p style="margin-left: 150px;"><strong>PESO DE LA MADRE: </strong>{{ $c->peso_madre}}</p>
	<p style="margin-left: 150px;"><strong>TEMPERATURA: </strong>{{ $c->temp}}</p>
	<p style="margin-left: 150px;"><strong>TENSION ARTERIAL: </strong>{{ $c->tension}}</p>
	<p style="margin-left: 150px;"><strong>ALTURA UTERINA: </strong>{{ $c->altura_uterina}}</p>
	<p style="margin-left: 150px;"><strong>PRESENTACION:</strong>{{ $c->presentacion}}</p>
	<p style="margin-left: 150px;"><strong>F.C.F: </strong>{{ $c->fcf}}</p>
	<p style="margin-left: 150px;"><strong>MOVIMIENTO FETAL: </strong>{{ $c->movimiento_fetal}}</p>
	<p style="margin-left: 150px;"><strong>EDEMA: </strong>{{ $c->edema}}</p>
	<p style="margin-left: 150px;"><strong>PULSO AMTERNO POR MINUTO: </strong>{{ $c->pulso_materno}}</p>
	<p style="margin-left: 150px;"><strong>CONSERJERIA PF: </strong>{{ $c->consejeria}}</p>
	<p style="margin-left: 150px;"><strong>SULFATO FERROSO </strong>{{ $c->sulfato}}</p>
	<p style="margin-left: 150px;"><strong>PERFIL BIOFISICO: </strong>{{ $c->perfil_biofisico}}</p>
	<p style="margin-left: 150px;"><strong>VISITA A DOMICILIO: </strong>{{ $c->visita_domicilio}}</p>
	<p style="margin-left: 150px;"><strong>LUGAR DE ATENCION: </strong>{{ $c->establecimiento_atencion}}</p>
	<p style="margin-left: 150px;"><strong>RESPONSABLE DEL CONTROL: </strong>{{ $c->responsable_control}}</p>
    <br>
  @endforeach()
</body>
</html>