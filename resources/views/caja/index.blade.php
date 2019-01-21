@extends('layouts.app')

@section('content')

<body>
<div class="row">
  <div class="col-xs-12">
    <div class="box">
      <div class="box-header">
        <div class="box-name">
          <i class="fa fa-linux"></i>
          <span>Cierres de Caja</span>

        </div>


        <div class="box-icons">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
          <a class="expand-link">
            <i class="fa fa-expand"></i>
          </a>
          <a class="close-link">
            <i class="fa fa-times"></i>
          </a>
        </div>

        <div class="no-move"></div>
        
      </div>
      {!! Form::open(['method' => 'get', 'route' => ['cierre.index']]) !!}

      <div class="row">
        <div class="col-md-2">
          {!! Form::label('fecha', 'Fecha Inicio', ['class' => 'control-label']) !!}
          {!! Form::date('fecha', old('fechanac'), ['id'=>'fecha','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
          <p class="help-block"></p>
          @if($errors->has('fecha'))
          <p class="help-block">
            {{ $errors->first('fecha') }}
          </p>
          @endif
        </div>
        <div class="col-md-2">
          {!! Form::label('fecha2', 'Fecha Fin', ['class' => 'control-label']) !!}
          {!! Form::date('fecha2', old('fecha2'), ['id'=>'fecha2','class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
          <p class="help-block"></p>
          @if($errors->has('fecha2'))
          <p class="help-block">
            {{ $errors->first('fecha2') }}
          </p>
          @endif
        </div>
        <div class="col-md-2">
          {!! Form::submit(trans('Buscar'), array('class' => 'btn btn-info')) !!}
          {!! Form::close() !!}

        </div>
      </div>  

      

      <div class="row">
        <form action="/cierre-caja-create" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="{{$total->monto}}" name="total">
        <input type="submit" class="btn btn-danger" value="Cerrar Turno">
      </form>
    </div>


      <div class="box-content no-padding">
        <table class="table table-bordered table-striped table-hover table-heading table-datatable" id="datatable-3">
          <thead>
            <tr>
               <th>Id</th>
              <th>Fecha</th>
              <th>Cierre</th>
              <th>Registrado Por:</th>
              <th>Recibo:</th>
           
            </tr>
          </thead>
          <tbody>
                  @foreach($caja as $c)          
            <tr>
                <td>{{$c->id}}</td>
                <td>{{$c->created_at}}</td>
                @if($c->cierre_matutino)
                <td>Matutino: {{$c->cierre_matutino}}</td>
                @else
                <td>Vespertino: {{$c->cierre_vespertino}}</td>
                @endif
                <td>{{$c->name}},{{$c->lastname}}</td>
                <td>
                  @if($c->cierre_matutino > 0)
                  <a  href="{{asset('recibo_caja_ver')}}/{{$c->id}}" class="btn btn-xs btn-primary">VerM</a>
                  @else
                  <a  href="{{asset('recibo_caja_ver2')}}/{{$c->id}}" class="btn btn-xs btn-primary">VerT</a>
                  @endif
                                    @if(\Auth::user()->role_id <> 6)               
                  <a class="btn btn-danger" href="caja-delete-{{$c->id}}"  onclick="return confirm('¿Desea Reversar este Cierre de Caja?')">Reversar</a> 
                  @endif
                </td>

            </tr>
            
            @endforeach
          </tbody>
        

        </table>
      </div>
    </div>
  </div>
</div>

</body>



<script src="{{url('/tema/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{url('/tema/plugins/jquery-ui/jquery-ui.min.js')}}"></script>




<script type="text/javascript">
// Run Datables plugin and create 3 variants of settings
function AllTables(){
  TestTable1();
  TestTable2();
  TestTable3();
  LoadSelect2Script(MakeSelect2);
}
function MakeSelect2(){
  $('select').select2();
  $('.dataTables_filter').each(function(){
    $(this).find('label input[type=text]').attr('placeholder', 'Search');
  });
}
$(document).ready(function() {
  // Load Datatables and run plugin on tables 
  LoadDataTablesScripts(AllTables);
  // Add Drag-n-Drop feature
  WinMove();
});
</script>
@endsection
