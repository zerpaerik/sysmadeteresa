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
            <h3>Control Prenatal de {{$paciente->nombres}} {{$paciente->apellidos}}</h3>
            <br>
            
            <input type="hidden" name="id_paciente" value="{{$data->paciente}}">
            <input type="hidden" name="id_ficha_prenatal" value="{{$data->id}}">
            <label for="">Fecha Control</label>
            <input type="date" name="fecha_cont" style="line-height: 20px"> 
            <br>  

            <label class="col-sm-1 control-label">Gestaciòn</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="gesta_semanas" placeholder="Semanas de gestacion" data-toggle="tooltip" data-placement="bottom" title="gesta_semanas">
            </div>

            <label class="col-sm-1 control-label">PesoMadre.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="peso_madre" placeholder="Peso de Madre" data-toggle="tooltip" data-placement="bottom" title="m37m">
            </div>

            <label class="col-sm-1 control-label">Temp.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="temp" placeholder="Temperatura" data-toggle="tooltip" data-placement="bottom" title="Temperatura">
            </div>

            <label class="col-sm-1 control-label">Tensiòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="tension" placeholder="tension arterial" data-toggle="tooltip" data-placement="bottom" title="tension">
            </div>

             <label class="col-sm-1 control-label">Alt.Ute.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="altura_uterina" placeholder="Altura Uterina" data-toggle="tooltip" data-placement="bottom" title="altura uterina">
            </div>

            <label class="col-sm-1 control-label">Presentaciòn.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="presentacion" placeholder="presentacion" data-toggle="tooltip" data-placement="bottom" title="presentacion">
            </div>

            <label class="col-sm-1 control-label">F.C.F.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="fcf" placeholder="FCF" data-toggle="tooltip" data-placement="bottom" title="fcf">
            </div>

             <label class="col-sm-1 control-label">Movimiento.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="movimiento_fetal" placeholder="Movimiento Fetal" data-toggle="tooltip" data-placement="bottom" title="movimiento_fetal">
            </div>

             <label class="col-sm-1 control-label">Edema.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="edema" placeholder="Edema" data-toggle="tooltip" data-placement="bottom" title="edema">
            </div>

             <label class="col-sm-1 control-label">Pulso.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="pulso_materno" placeholder="Pulso Materno" data-toggle="tooltip" data-placement="bottom" title="pulso_materno">
            </div>


             <label class="col-sm-1 control-label">Consejeria</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="consejeria" placeholder="Consejeria PF" data-toggle="tooltip" data-placement="bottom" title="consejeria">
            </div>


             <label class="col-sm-1 control-label">Sulfato.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="sulfato" placeholder="Sulfato Ferroso" data-toggle="tooltip" data-placement="bottom" title="sulfato">
            </div>


             <label class="col-sm-1 control-label">Perfil.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="perfil_biofisico" placeholder="Perfil Biosfisico" data-toggle="tooltip" data-placement="bottom" title="perfil_biofisico">
            </div>


             <label class="col-sm-1 control-label">Visita.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="visita_domicilio" placeholder="Visita a domicilio" data-toggle="tooltip" data-placement="bottom" title="visita_domicilio">
            </div>

             <label class="col-sm-1 control-label">Establ.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="establecimiento_atencion" placeholder="Establecimiento de atencion" data-toggle="tooltip" data-placement="bottom" title="establecimiento_atencion">
            </div>

             <label class="col-sm-1 control-label">Responsable.</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="responsable_control" placeholder="Responsable de Control" data-toggle="tooltip" data-placement="bottom" title="responsable_control">
            </div> 
            <br>
            <div class="col-sm-3">
            <input type="button" onclick="form.submit()" class="btn btn-primary" value="Guardar">  
            </div>                         
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