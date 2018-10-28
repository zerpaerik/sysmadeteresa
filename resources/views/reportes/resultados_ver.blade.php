<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resultado de Informe</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="margin-left: 260px; font-size: 16px;"><strong>INFORME DE RESULTADOS</strong></p>
	<br>

	@foreach($resultados as $res)

	<p style="margin-left: 150px;"><strong>PACIENTE:</strong>{{ $res->nompac.' '.$res->apepac }}</p>
	<p style="margin-left: 150px;"><strong>EXAMEN/SERVICIO:</strong>{{ $res->detalle }}</p>
    <p style="margin-left: 150px;"><strong>INDICACIÒN:</strong></p>
    <p style="margin-left: 150px;"><strong>FECHA:</strong>{{ $res->detalle}}</p>
    <br>

    <div style="margin-right: 80px; margin-left: 15px; text-align: justify; font-size: 16px; line-height: 1.6;">{!!html_entity_decode($res->descripcion)!!}</div>
  




	@endforeach



</body>
</html>