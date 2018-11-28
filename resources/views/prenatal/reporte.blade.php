<!DOCTYPE html>
<html lang="en">
<head>
	<title>Control Prenatal</title>

</head>
<body>
	<p style="margin-left: 160px;font-size: large;"><strong>CARNET DE CONTROL MATERNO PERINATAL</strong></p>
      @foreach($controles as $c)

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">CITAS DE CONTROL</legend>
            <p><center>Fecha:{{ $c->fecha_cont}}</center></p>
        </fieldset> 
     </div>
     @endforeach
        @foreach($pacientes as $pac)

    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <center><p>{{ $pac->apellidos}},{{ $pac->nombres}}</p></center>
            <center><p><strong>APELLIDOS Y NOMBRES</strong></p></center>
            <center><p><strong>Nº HC: {{ $pac->dni}}</strong></p></center>

        </fieldset> 
     </div>
     @endforeach
       


	 <div style="width: 60%;float: left;">
     	<fieldset style="border: 1px solid #000; border-radius: 5px;">
     		<legend style="background: #FF9999; border-radius: 5px;">Nombres y Apellidos</legend>
     		<p>Establ. Origen:</p>
     		<p>Direcciòn:</p>
     		<p>Localidad:</p>
     		<p>Departamento:</p>
     		<p>Provincia:</p>
            <p>Distrito:</p>
     		<p>Telefono:</p>
     	</fieldset>	
     </div>
     <div style="width: 40%;float: right; height: 250px">
     	<fieldset style="border: 1px solid #000; border-radius: 5px">
     		<legend style="background: #FF9999; border-radius: 5px;">Establecimiento</legend>
     		<p>Nº SEGURO:</p>
     		<p>Ocupaciòn:</p>
     		<p>Estudios:</p>
     		<p>Edad:</p>
            <p>Edo Civil:</p>
     		<p>Padre RN:</p>
     	</fieldset>	
     </div>
     <br>
    @foreach($prenatal as $pre)
     <div style="width: 60%;float: right; margin-top: 280px">
     	<fieldset style="border: 1px solid #000; border-radius: 5px;">
     		<legend style="background: #FF9999; border-radius: 5px;">Antecedentes Obstètricos</legend>
     		<p style="margin-left: 5px;">Gestas:{{ $pre->gesta}}</p>
            <p style="margin-left: 250px; margin-top: -35px;">Partos:{{ $pre->parto}}</p>
            <p style="margin-left: 5px;">Abortos:{{ $pre->aborto}}</p>
            <p style="margin-left: 250px; margin-top: -35px;">Cesareas:{{ $pre->cesaria}}</p>
            <p style="margin-left: 5px;">Vaginales:{{ $pre->vaginales}}</p>
            <p style="margin-left: 250px; margin-top: -35px;">Nacidos Muertos:</p>
            <p style="margin-left: 5px;">Nacidos Vivos:</p>
            <p style="margin-left: 250px; margin-top: -35px;">Despues 1eraSem.:</p>
            <p style="margin-left: 5px;">Viven:{{ $pre->viven}}</p>

     	</fieldset>	
     </div>

      <div style="width: 40%;float: left; margin-top: 280px">
     	<fieldset style="border: 1px solid #000; border-radius: 5px;">
     		<legend style="background: #FF9999; border-radius: 5px;">Fin Gestación Ant.</legend>
     		<p><strong>Terminación</strong></p>
     		<p style="margin-left: 140px; margin-top: -35px;">Fecha:{{ $pre->fecha_terminacion}}</p>
     		<p style="margin-top: -5px; font-size:x-small;">Parto:</p>
     		<p style="margin-left: 35px;margin-top: -35px; font-size:x-small;">Aborto:</p>
            <p style="margin-left: 80px;margin-top: -35px; font-size:x-small;">Ectópico:</p>
     		<p style="margin-left: 130px;margin-top: -35px; font-size:x-small;">Molar:</p>
     		<p style="margin-left: 170px;margin-top: -35px; font-size:x-small;">Otro:</p>
     		<p style="margin-left: 210px;margin-top: -35px; font-size:x-small;">No aplica:</p>
            <p style="margin-top: 2px;"><strong>Si fue Aborto: Tipo de Aborto</strong></p>
            <p style="margin-top: -5px; font-size:x-small;">Incompleto:</p>
            <p style="margin-left: 65px;margin-top: -35px; font-size:x-small;">Completo:</p>
            <p style="margin-left: 120px;margin-top: -35px; font-size:x-small;">Frustro:</p>
            <p style="margin-left: 170px;margin-top: -35px; font-size:x-small;">Sèptico:</p>
            <p style="margin-left: 210px;margin-top: -35px; font-size:x-small;">Otro:</p>
            <p style="margin-left: 240px;margin-top: -35px; font-size:x-small;">No aplica:</p>
            <p style="margin-top: 2px;"><strong>RN de Mayor Peso GR</strong></p>


     	</fieldset>	

    </div>

    <div style="width: 100%;margin-top: 520px;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Antecedentes Familiares</legend>
            <p style="margin-left: 5px;">Ninguno:</p>
            <p style="margin-left: 200px; margin-top: -35px;">Hipertensiòn Arterial:</p>
            <p style="margin-left: 430px;margin-top: -35px;">Epilepsia:</p>
            <p style="margin-left: 570px; margin-top: -35px;">Gemelares:</p>
            <p style="margin-left: 5px;">Alergias:</p>
            <p style="margin-left: 200px; margin-top: -35px;">Neoplasia:</p>
            <p style="margin-left: 430px;margin-top: -35px;">Diabetes:</p>
            <p style="margin-left: 570px;margin-top: -35px;">Otros:</p>
            <p style="margin-left: 5px;">Anomalias Congen.:</p>
            <p style="margin-left: 200px; margin-top: -35px;">TBC Pulmonar:</p>
            <p style="margin-left: 430px;margin-top: -35px;">Enferm. Congènitas:</p>
        </fieldset> 
    </div>
  
    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Antecedentes Personales</legend>
            <p style="margin-left: 5px;font-size: small;">Ninguno:</p>
            <p style="margin-left: 160px; margin-top: -35px;font-size: small;">Aborto Habitual:</p>
            <p style="margin-left: 300px;margin-top: -35px;font-size: small;">Aborto Recurrente:</p>
            <p style="margin-left: 430px; margin-top: -35px;font-size: small;">Alcoholismo:</p>
            <p style="margin-left: 530px; margin-top: -35px;font-size: small;">Epilepsia:</p>
            <p style="margin-left: 5px;font-size: small;">Alergias:</p>
            <p style="margin-left: 160px; margin-top: -35px;font-size: small;">Asma Bronquial:</p>
            <p style="margin-left: 300px;margin-top: -35px;font-size: small;">Bajo Peso:</p>
            <p style="margin-left: 430px;margin-top: -35px;font-size: small;">Cardiopatia:</p>
            <p style="margin-left: 530px; margin-top: -35px;font-size: small;">Hoja de COCA:</p>
            <p style="margin-left: 5px;font-size: small;">Anomalias Congen.:</p>
            <p style="margin-left: 160px; margin-top: -35px;font-size: small;">CirugiaPELV:</p>
            <p style="margin-left: 300px;margin-top: -35px;font-size: small;">Diabetes:</p>
            <p style="margin-left: 430px;margin-top: -35px;font-size: small;">Enfer.Conge:</p>
            <p style="margin-left: 530px; margin-top: -35px;font-size: small;">Neoplasia:</p>

        </fieldset> 
    </div>
    <br><br>
  
     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Peso y Talla</legend>
            <p style="margin-left: 5px;">Peso Pregest.: GR</p>
            <p style="margin-left: 450px;margin-top: -35px;">Talla.: CM</p>
        </fieldset> 
    </div>
      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Antitetànica</legend>
            <p style="margin-left: 5px;">Nº Dosis Prev.</p>
            <p style="margin-left: 250px;margin-top: -35px;">Primera Dosis</p>
            <p style="margin-left: 450px;margin-top: -35px;">Segunda Dosis</p>
        </fieldset> 
    </div>
      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Tipo de Sangre</legend>
            <p style="margin-left: 5px;"><strong>Grupo:</strong></p>
            <p style="margin-left: 150px;margin-top: -35px;">A</p>
            <p style="margin-left: 250px;margin-top: -35px;">B</p>
            <p style="margin-left: 350px;margin-top: -35px;">AB</p>
            <p style="margin-left: 450px;margin-top: -35px;">O</p>
            <p style="margin-left: 5px;"><strong>Rh:</strong></p>
            <p style="margin-left: 150px;margin-top: -35px;">Rh+</p>
            <p style="margin-left: 250px;margin-top: -35px;">Rh-</p>
            <p style="margin-left: 350px;margin-top: -35px;">Rh -NoS</p>
            <p style="margin-left: 450px;margin-top: -35px;">Rh -Sen></p>

        </fieldset> 
    </div>

    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">F.U.M</legend>
            <p style="margin-left: 5px;">Ultim.Menstruaciòn.</p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha Probable Parto</p>
            <p style="margin-left: 500px;margin-top: -35px;">Eco EG</p>
        </fieldset> 
    </div>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Serologìa</legend>
            <p style="margin-left: 5px;"><strong>Negativo:</strong></p>
            <p style="margin-left: 200px;margin-top: -35px;">Positivo</p>
            <p style="margin-left: 350px;margin-top: -35px;">No se hizo</p>
            <p style="margin-left: 500px;margin-top: -35px;">Fecha</p>
             <p style="margin-left: 5px;"><strong>Negativo:</strong></p>
            <p style="margin-left: 200px;margin-top: -35px;">Positivo</p>
            <p style="margin-left: 350px;margin-top: -35px;">No se hizo</p>
            <p style="margin-left: 500px;margin-top: -35px;">Fecha</p>

        </fieldset> 
    </div>
      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Hemoglobina</legend>
            <p style="margin-left: 5px;"><strong>Hb:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">No se hizo</p>
            <p style="margin-left: 500px;margin-top: -35px;">Fecha</p>
             <p style="margin-left: 5px;"><strong>Hb:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">No se hizo</p>
            <p style="margin-left: 500px;margin-top: -35px;">Fecha</p>

        </fieldset> 
    </div>

       <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Examenes</legend>
            <p style="margin-left: 5px;font-size: small;">Clinico:</p>
            <p style="margin-left: 60px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 120px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 170px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 240px; margin-top: -35px;font-size: small;">PAP:</p>
             <p style="margin-left:280px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 340px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 390px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 490px; margin-top: -35px;font-size: small;">HIV:</p>
             <p style="margin-left:520px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 580px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 630px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 5px;font-size: small;">Mamas:</p>
            <p style="margin-left: 60px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 120px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 170px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 240px; margin-top: -35px;font-size: small;">Orina:</p>
             <p style="margin-left:280px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 340px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 390px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 490px; margin-top: -35px;font-size: small;">BK:</p>
             <p style="margin-left:520px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 580px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 630px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 5px;font-size: small;">Odont.:</p>
             <p style="margin-left: 60px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 120px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 170px; margin-top: -35px;font-size: x-small;">Patològico:</p>
            <p style="margin-left: 240px; margin-top: -35px;font-size: small;">Gluco.:</p>
             <p style="margin-left:280px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 340px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 390px; margin-top: -35px;font-size: x-small;">Patològico:</p>
             <p style="margin-left: 490px; margin-top: -35px;font-size: small;">Torch:</p>
             <p style="margin-left:520px; margin-top: -35px;font-size: x-small;">Sin Exam.:</p>
            <p style="margin-left: 580px;margin-top: -35px;font-size: x-small;">Normal:</p>
            <p style="margin-left: 630px; margin-top: -35px;font-size: x-small;">Patològico:</p>

        </fieldset> 
    </div>

    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Patologías Maternas CIE10</legend>
            <p style="margin-left: 5px;"><strong>1:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>
             <p style="margin-left: 5px;"><strong>2:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>
            <p style="margin-left: 5px;"><strong>3:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>

        </fieldset> 
    </div>
      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Terminación</legend>
            <p style="margin-left: 5px;"><strong>Fecha:</strong></p>
            <p style="margin-left: 20px;">Espontanea</p>
            <p style="margin-left: 400px;margin-top: -35px;">Cesarea</p>
             <p style="margin-left: 20px;">Forceps</p>
            <p style="margin-left: 400px;margin-top: -35px;">Vacumm</p>

        </fieldset> 
    </div>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Atención</legend>
            <p style="margin-left: 5px;font-size: small;"><strong>Nivel:</strong></p>
            <p style="margin-left: 60px; margin-top: -35px;font-size: x-small;">Primario:</p>
            <p style="margin-left: 120px;margin-top: -35px;font-size: x-small;">Secundario:</p>
            <p style="margin-left: 190px; margin-top: -35px;font-size: x-small;">Terciario:</p>
            <p style="margin-left: 250px; margin-top: -35px;font-size: x-small;">Domiciario:</p>
            <p style="margin-left: 330px; margin-top: -35px;font-size: x-small;">Otro:</p>
            <p style="margin-left: 5px;font-size: small;"><strong>Parto o legrado:</strong></p>
            <p style="margin-left: 120px; margin-top: -35px;font-size: x-small;">Medico:</p>
            <p style="margin-left: 180px;margin-top: -35px;font-size: x-small;">Obtetriz:</p>
            <p style="margin-left: 240px; margin-top: -35px;font-size: x-small;">Interno:</p>
            <p style="margin-left: 300px; margin-top: -35px;font-size: x-small;">Estudd.:</p>
            <p style="margin-left: 360px; margin-top: -35px;font-size: x-small;">Partera:</p>
            <p style="margin-left: 450px; margin-top: -35px;font-size: x-small;">Aux.Enf:</p>
            <p style="margin-left: 520px; margin-top: -35px;font-size: x-small;">Enferm.:</p>
            <p style="margin-left: 590px; margin-top: -35px;font-size: x-small;">Familiar:</p>
            <p style="margin-left: 650px; margin-top: -35px;font-size: x-small;">Otro:</p>
             <p style="margin-left: 5px;font-size: small;"><strong>Neonato:</strong></p>
            <p style="margin-left: 120px; margin-top: -35px;font-size: x-small;">Medico:</p>
            <p style="margin-left: 180px;margin-top: -35px;font-size: x-small;">Obtetriz:</p>
            <p style="margin-left: 240px; margin-top: -35px;font-size: x-small;">Interno:</p>
            <p style="margin-left: 300px; margin-top: -35px;font-size: x-small;">Estudd.:</p>
            <p style="margin-left: 360px; margin-top: -35px;font-size: x-small;">Partera:</p>
            <p style="margin-left: 450px; margin-top: -35px;font-size: x-small;">Aux.Enf:</p>
            <p style="margin-left: 520px; margin-top: -35px;font-size: x-small;">Enferm.:</p>
            <p style="margin-left: 590px; margin-top: -35px;font-size: x-small;">Familiar:</p>
            <p style="margin-left: 650px; margin-top: -35px;font-size: x-small;">Otro:</p>


           
        </fieldset> 
    </div>


    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Recien Nacido</legend>
            <p style="margin-left: 5px;"><strong>N° HC:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Nombre</p>
            <p style="margin-left: 500px;margin-top: -35px;">Sexo</p>
             <p style="margin-left: 5px;">Talla:</p>
            <p style="margin-left: 250px;margin-top: -35px;">Peso</p>
            <p style="margin-left: 500px;margin-top: -35px;">P.Cef</p>
            <p style="margin-left: 5px;font-size: medium;">Temp:</p>
            <p style="margin-left: 250px;margin-top: -35px;"><2500gr</p>
            <p style="margin-left: 500px;margin-top: -35px;"><1500gr</p>

        </fieldset> 
    </div>

    <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <p style="margin-left: 5px;">Edad.Ex.Fis:</p>
            <p style="margin-left: 250px;margin-top: -35px;">[ ]</p>
            <p style="margin-left: 500px;margin-top: -35px;">[ ]</p>
             <p style="margin-left: 5px;">Peso.Ed.Gest:</p>
            <p style="margin-left: 250px;margin-top: -35px;">Adecuado</p>
            <p style="margin-left: 400px;margin-top: -35px;">Pequeño</p>
            <p style="margin-left: 550px;margin-top: -35px;">Grande</p>
            <p style="margin-left: 5px;font-size: medium;">APGAR:</p>
            <p style="margin-left: 250px;margin-top: -35px;">[ ]</p>
            <p style="margin-left: 500px;margin-top: -35px;">[ ]</p>

        </fieldset> 
    </div>

      <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Patologías Recien Nacido</legend>
            <p style="margin-left: 5px;"><strong>1:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>
             <p style="margin-left: 5px;"><strong>2:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>
            <p style="margin-left: 5px;"><strong>3:</strong></p>
            <p style="margin-left: 250px;margin-top: -35px;">Fecha</p>
            <p style="margin-left: 500px;margin-top: -35px;">Otros CIE10</p>

        </fieldset> 
    </div>
         @endforeach


    <img style="margin-left: -10px;" src="{!! public_path().'/img/cua.jpg'!!}"/>
    @foreach($controles as $c)

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="background: #FF9999; border-radius: 5px;">Controles Prenatales</legend>
            <p><strong>Fecha de Control:</strong>{{ $c->fecha_cont}}</p>
            <p><strong>Edad Gest ( Semanas):</strong>{{ $c->gesta_semanas}}</p>
            <p><strong>Peso Madre KG:</strong>{{ $c->peso_madre}}</p>
            <p><strong>Temperatura(°C):</strong>{{ $c->temp}}</p>
            <p><strong>Tensión arter.(mm.Hg):</strong>{{ $c->tension}}</p>
            <p><strong>Altura Uterina (cm):</strong>{{ $c->altura_uterina}}</p>
            <p><strong>Presentación (C/P/T/NA):</strong>{{ $c->presentacion}}</p>
            <p><strong>F.C.F (Por Min N/A):</strong>{{ $c->fcf}}</p>
            <p><strong>Mov.Fetal(+,++,+++,SE):</strong>{{ $c->movimiento_fetal}}</p>
            <p><strong>Edema (+,++,+++,SE):</strong>{{ $c->edema}}</p>
            <p><strong>Pulso materno(por.min):</strong>{{ $c->pulso_materno}}</p>
            <p><strong>Consejeria PF (Si,No,NA):</strong>{{ $c->consejeria}}</p>
            <p><strong>Sulfato Ferroso:</strong>{{ $c->sulfato}}</p>
            <p><strong>Perfíl Biofisico:</strong>{{ $c->perfil_biofisico}}</p>
            <p><strong>Visita Domicilio (Si,No,NA):</strong>{{ $c->visita_domicilio}}</p>
            <p><strong>Estable. Atención:</strong>{{ $c->establecimiento_atencion}}</p>
            <p><strong>Responsable de Control:</strong>{{ $c->responsable_control}}</p>
        </fieldset> 
     </div>

    @endforeach()

 
</body>
</html>