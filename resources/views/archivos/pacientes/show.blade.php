<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">					
					<span>
						<strong>Datos de Paciente - H.C:</strong>{{$pacientes->historia}}
					</span>
				</div>
			</div>
			<div class="box-content">
				<div class="row">
					<div class="col-sm-4">
						<strong>Nombres:</strong> {{$pacientes->nombres}}
					</div>
					<div class="col-sm-4">
						<strong>Apellidos:</strong> {{$pacientes->apellidos}}
					</div>
					<div class="col-sm-4">
						<strong>DNI:</strong> {{$pacientes->dni}}
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4">
						<strong>Distrito:</strong> {{$pacientes->nombre}}
					</div>
					<div class="col-sm-6">
						<strong>Dirección:</strong> {{$pacientes->direccion}}
					</div>
					<div class="col-sm-2">
						<strong>Telèfono:</strong> {{$pacientes->telefono}}
					</div>
					
				</div>	
                <div class="row">
					<div class="col-sm-4">
						<strong>Nacimiento:</strong> {{$pacientes->fechanac}}
					</div>
					<div class="col-sm-4">
						<strong>Grado.Ins:</strong> {{$pacientes->gradoinstruccion}}
					</div>
					<div class="col-sm-4">
						<strong>Ocupaciòn:</strong> {{$pacientes->ocupacion}}
					</div>
				</div>				
			</div>
		</div>
	</div>
</div>
