<!DOCTYPE html>
<html lang="en">
<head>
	<title>Recibo de Gasto</title>

</head>
<body>
     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <p><center><strong>RECIBO Nº</strong>0000{{$gastos->id}}</center></p>
            <p><center>FECHA {{$gastos->created_at}}</center></p>
        </fieldset> 
     </div>
 

    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <center><p></p></center>
            <center><p><strong>DESCRIPCIÒN:</strong>{{$gastos->descripcion}}</p></center>
            <center><p><strong>MONTO:</strong>{{$gastos->monto}}</p></center>
            <center><p><strong>RECIBIDO POR:</strong>{{$gastos->nombre}}</p></center>
            <center><p><strong>ENTREGADO POR:</strong>{{$gastos->name}},{{$gastos->lastname}}</p></center>
        </fieldset> 
     </div>


	





   
  

     



 
</body>
</html>