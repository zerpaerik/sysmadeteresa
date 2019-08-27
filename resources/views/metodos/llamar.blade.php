
    {!! Form::open(['method' => 'POST', 'route' => ['metodos.llamada']]) !!}

    						<input type="hidden" name="id" value="{{$id}}">


    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('observacion', 'Observaciòn', ['class' => 'control-label']) !!}
                    {!! Form::textarea('observacion', old('observacion'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('dni'))
                        <p class="help-block">
                            {{ $errors->first('observacion') }}
                        </p>
                    @endif
                </div>
            
              
            </div>
            
            
        </div>
    </div>

    {!! Form::submit(trans('Guardar'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}

@section('javascript') 


<script type="text/javascript">
    $('#provincia').on('change',function(){
      var id= $('#provincia').val();
      var link= '{{asset("pacientes/distbypro/id")}}';
      link= link.replace('id',id);
      $.ajax({
       type: "get",
       url: link ,
       success: function(a) {
        $('#distbypro').html(a);
    }
});

  });
</script>
@endsection




