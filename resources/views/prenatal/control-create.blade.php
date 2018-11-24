@extends('layouts.app')
@section('content')
<br>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-users"></i>
          <span><strong>Agregar Informe Prenatal</strong></span>
        </div>
        <div class="box-icons">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
          <a class="expand-link">
            <i class="fa fa-expand"></i>
          </a>
        </div>
        <div class="no-move"></div>
      </div>
      <div class="box-content"> 
        <form class="form-horizontal" role="form" method="post" action="control/create">
          {{ csrf_field() }}
          <div class="form-group">          
            <h2>Control Prenatal de {{$paciente->nombres}} {{$paciente->apellidos}}</h2>
            
            <input type="hidden" name="id_paciente" value="{{$data->paciente}}">
            <input type="hidden" name="id_ficha_prenatal" value="{{$data->id}}">
            <label for="">Fecha Control</label>
            <input type="date" name="fecha_cont"> 
            <br>  
            
            <label for="">Edad Gestacion (Semanas)</label>
            <input type="text" name="gesta_semanas">  
            <br>

            <label for="">Peso Madre</label>
            <input type="text" name="peso_madre"> 
            <br>

            <label for="">Temperatura</label>
            <input type="text" name="temp"> 
            <br>

            <label for="">Tension Arterialo</label>
            <input type="text" name="tension"> 
            <br>  

            <label for="">Altura Uterina</label>
            <input type="text" name="altura_uterina"> 
            <br>  

            <label for="">Presentacion</label>
            <input type="text" name="presentacion"> 
            <br>  

            <label for="">F.C.F</label>
            <input type="text" name="fcf"> 
            <br>

            <label for="">Movimiento Fetal</label>
            <input type="text" name="movimiento_fetal"> 
            <br>

            <label for="">Edema</label>
            <input type="text" name="edema"> 
            <br>  

            <label for="">Pulso Materno por Min</label>
            <input type="text" name="pulso_materno"> 
            <br>

            <label for="">Consejeria PF</label>
            <input type="text" name="consejeria">  
            <br>

            <label for="">Sulfato ferroso</label>
            <input type="text" name="sulfato"> 
            <br>

            <label for="">Perfil Biofisico</label>
            <input type="text" name="perfil_biofisico">  
            <br>

            <label for="">Visita a domicilio</label>
            <input type="text" name="visita_domicilio">  
            <br>   

            <label for="">Establecimiento de la atencion</label>
            <input type="text" name="establecimiento_atencion">  
            <br>  

            <label for="">Nombre del responsable de control</label>
            <input type="text" name="responsable_control">  
            <br>
            <input type="submit" class="btn btn-primary" value="Guardar">                           
          </div>
          </div>                                                                                                                    
          </div>
        </div>
        </form>
      </div>  
    </div>
  </div>
</div>  
@endsection