<!DOCTYPE html>
<html lang="en">
<head>
	<title>Resultado de Informe</title>
	<link rel="stylesheet" type="text/css" href="css/pdf.css">

</head>
<body>

	<p style="margin-left: 260px; font-size: 16px;"><strong>CIERRE DE CAJA</strong></p>
	<br>

	<p style="margin-left: 150px;"><strong>DIA DE CIERRE: </strong>{{ $caja[1]->created_at}}</p>
	<p style="margin-left: 150px;"><strong>CIERRE MATUTINO: </strong>{{ $caja[0]->cierre_matutino }}</p>
    <p style="margin-left: 150px;"><strong>CIERRE VESPERTINO: </strong>{{ $caja[1]->cierre_vespertino }}</p>
    <p style="margin-left: 150px;"><strong>SEDE:</strong>{{ $caja[0]->name}}</p>
    <br>

</body>
</html>