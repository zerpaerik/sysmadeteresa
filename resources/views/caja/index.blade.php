@extends('layouts.app')

@section('content')
<h1>Cierre de caja de turno {{$mensaje}}</h1>
<p>Total del dia: {{$total}}</p>
<form action="/cierre-caja-create" method="post">
  {{ csrf_field() }}
  <h3>Cerrar turno</h3>
  <input type="hidden" value="{{$total}}" name="total">
  <input type="submit" class="btn btn-danger" value="Cerrar">
</form>
<table class="table table-bordered table-striped table-hover table-heading table-datatable">
  <thead>
    <tr>
      <th>Id</th>
      <th>Fecha</th>
      <th>Cierre</th>
    </tr>
  </thead>
  <tbody>
    @foreach($caja as $c)
    <tr>
      <td>{{$c->id}}</td>
      <td>{{$c->fecha}}</td>
      @if($c->cierre_matutino)
      <td>Matutino: {{$c->cierre_matutino}}</td>
      @else
      <td>Vespertino: {{$c->cierre_vespertino}}</td>
      @endif
    </tr>
    @endforeach
  </tbody>
</table>
@section('scripts')
<script src="{{ asset('plugins/sheepit/jquery.sheepItPlugin.min.js') }}" type="text/javascript"></script>
@endsection
@endsection