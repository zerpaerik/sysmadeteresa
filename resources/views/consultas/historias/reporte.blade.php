<!DOCTYPE html>
<html lang="en">
<head>
	<title>Historia Clínica</title>

</head>
<body>

	 <img src="/var/www/html/sysmadeteresa/public/img/logo.jpeg"  style="width: 20%;"/>
	<br>
	<CENTER><p><strong>HISTORIA CLÍNICA</strong></p></CENTER>
<br>

     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>DATOS DEL PACIENTE</strong></legend>
            <p style="margin-bottom: 8px;">Nombre: {{$data->apellidos}}, {{$data->nombres}}</p>
            <p style="margin-left:380px;margin-top: -30px;">DNI paciente: {{$data->dni}}</p>
            <p style="margin-bottom: 8px;">Dirección del paciente: {{$data->direccion}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Distrito: {{$data->nombre}}</p>
            <p style="margin-bottom: 8px;">Fecha de nacimiento: {{$data->fechanac}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Grado de isntruccion del paciente: {{$data->gradoinstruccion}}</p>
            <p style="margin-bottom: 8px;">Ocupacion del paciente: {{$data->ocupacion}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Teléfono del paciente: {{$data->telefono}}</p>

        </fieldset> 
     </div> 

    @if($historial)
     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>HISTORIA BASE DE {{$data->nombres}} {{$data->apellidos}}</strong></legend>
            <p style="margin-bottom: 8px;">Alergias: {{$historial->alergias}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Antecedentes patologicos: {{$historial->antecedentes_patologicos}}</p>
            <p style="margin-bottom: 8px;">Antecedentes Personales: {{$historial->antecedentes_personales}}</p>
            <p style="margin-left:380px;margin-top: -30px;">Antecedentes Familiares: {{$historial->antecedentes_familiar}}</p>
            <p style="margin-bottom: 8px;">Menarquia: {{$historial->menarquia}}</p>
            <p style="margin-left:380px;margin-top: -30px;">1º R.S : {{$historial->prs}}</p>
        </fieldset> 
     </div>

    @else
    
    @endif
 

<br>
    
    <br>
     <div style="width: 100%;">
        <fieldset style="border: 1px solid #000; border-radius: 5px;">
            <legend style="border-radius: 5px;"><strong>Consulta del {{$consulta->created_at}}</strong></legend>
            <p><strong>Motivo de Consulta:</strong> {{ $consulta->motivo_consulta }}</p>
            <p><strong>Funciones vitales</strong></p>
            <p style="margin-bottom: 8px;"><strong>P/A:</strong> {{ $consulta->pa }}</p>
            <p style="margin-left:120px;margin-top: -30px;"><strong>Pulso:</strong> {{ $consulta->pulso }}</p>
            <p style="margin-left:250px;margin-top: -40px;"><strong>Temperatura:</strong> {{ $consulta->temperatura }}</p>
            <p style="margin-left:430px;margin-top: -50px;"><strong>Peso:</strong> {{ $consulta->peso }} kG</p>
            <p style="margin-left:550px;margin-top: -60px;"><strong>Talla:</strong> {{ $consulta->talla }} cm</p>
            <p><strong>Funciones biológicas</strong></p>
            <p style="margin-bottom: 8px;"><strong>Apetito:</strong> {{ $consulta->apetito }}</p>
            <p style="margin-left:250px; margin-top: -30px;"><strong>Sed:</strong> {{ $consulta->sed }}</p>
            <p style="margin-left:470px;margin-top: -40px;"><strong>Animo:</strong> {{ $consulta->animo }}</p>
            <p style="margin-bottom: 8px;"><strong>Frecuencia Micciones:</strong> {{ $consulta->orina }}</p>
            <p style="margin-left:250px;margin-top: -30px;"><strong>R/C:</strong> {{ $consulta->card }}</p>
            <p style="margin-left:470px;margin-top: -40px;"><strong>Frecuencia Deposiciones:</strong> {{ $consulta->deposiciones }}</p>
            <p><strong>Antecedentes</strong></p>
            <p style="margin-bottom: 8px;"><strong>FUR:</strong> {{ $consulta->fur }}</p>
            <p style="margin-left:250px;margin-top: -30px;"><strong>PAP:</strong> {{ $consulta->pap }}</p>
            <p style="margin-left:470px;margin-top: -40px;"><strong>MAC:</strong> {{ $consulta->MAC }}</p>
            <p style="margin-bottom: 8px;"><strong>Andria:</strong> {{ $consulta->andria }}</p>
            <p style="margin-left:250px;margin-top: -30px;"><strong>G: </strong>{{ $consulta->g }}, <strong>P: </strong> {{ $consulta->p }}</p>
            <p style="margin-left:470px;margin-top: -40px;"><strong>Amenorrea:</strong> {{ $consulta->amenorrea }}</p>
            <p><strong>Exámen físico y regional</strong></p>
            <p style="margin-bottom: 8px"><strong>Piel/Mucosas: </strong>{{ $consulta->piel }}</p>
            <p style="margin-left:380px;margin-top: -30px;"><strong>Mamas: </strong>{{ $consulta->mamas }}</p>
            <p style="margin-bottom: 8px;"><strong>Abdomen: </strong>{{ $consulta->abdomen }}</p>
            <p style="margin-bottom: 8px;"><strong>Genitales Externos: </strong>{{ $consulta->genext }}</p>
            <p style="margin-bottom: 8px;"><strong>Genitales Internos: </strong>{{ $consulta->genint }}</p>
            <p style="margin-bottom: 8px;"><strong>Miembros Inferiores: </strong>{{ $consulta->miembros }}</p>
            <p style="margin-bottom: 8px;"><strong>Evolucion Enfermedad:</strong>{{ $consulta->evolucion_enfermedad }}</p>
            <p style="margin-left:380px;margin-top: -30px;"><strong>Tipo de Enfermedad:</strong> {{ $consulta->tipo_enfermedad }}</p>
            <p style="margin-bottom: 8px;"><strong>Presuncion Diagnostica:</strong> {{ $consulta->presuncion_diagnostica }}</p>
            <p style="margin-bottom: 8px;"><strong>CIEX:</strong> {{ $consulta->CIEX }}</p>
            <p style="margin-bottom: 8px;"><strong>Diagnostico Final: </strong>{{ $consulta->diagnostico_final }}</p>
            <p style="margin-bottom: 8px;"><strong>CIEX: </strong>{{ $consulta->CIEX2 }}</p>
            <p style="margin-bottom: 8px;"><strong>Examen Auxiliar: </strong>{{ $consulta->examen_auxiliar }}</p>
            <p style="margin-bottom: 8px;"><strong>Plan de Tratamiento: </strong>{{ $consulta->plan_tratamiento }}</p>
            <p style="margin-bottom: 8px;"><strong>Observaciones: </strong> {{ $consulta->observaciones }}</p>
            <p style="margin-bottom: 8px;"><strong>Proxima CITA </strong>{{ $consulta->prox }}</p>
            <p style="margin-left:380px;margin-top: -30px;"><strong>Atendido Por: </strong> {{ $consulta->personal }}</p>
        </fieldset>  
     </div>
 
</body>
</html>