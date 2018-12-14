@extends('layouts.app')

@section('content')
<div class="container">

  <div class="row">
    <form class="form-horizontal" role="form" method="post" action="events">
    {{ csrf_field() }}
    <label class="col-sm-1 control-label">Buscar</label>
    <div class="col-sm-3">
      <select id="el1" name="especialista">
        @foreach($especialistas as $especialista)
          <option value="{{$especialista->id}}">
            {{$especialista->name}} {{$especialista->lastname}}
            / {{$especialista->dni}}
          </option>
        @endforeach
      </select>
    </div> 
    <input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Buscar">    
   </form>                          
  </div>    

  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Citas programadas</div>
        @if($calendar)
        <div class="panel-body">
            {!! $calendar->calendar() !!}
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@section('scripts')
<script>
  $(document).ready(function() {
    LoadSelect2Script(Select2Test);
    WinMove();
  });
  function Select2Test(){
    $("#el1").select2();
  }
</script>
@if($calendar)
  {!!$calendar->script()!!}
@endif
@endsection
@endsection