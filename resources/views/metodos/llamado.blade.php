



    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                   <p>{{$llamada->detalle_llamada}}</p>
                </div>
            
              
            </div>
            
            
        </div>
    </div>

  

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




