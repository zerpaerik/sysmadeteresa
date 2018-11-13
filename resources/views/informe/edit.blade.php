@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Redactar Informe</strong></span>
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
				<h4 class="page-header"></h4>
				<form class="form-horizontal" role="form" method="post" action="/resultados-informe-edit-{{$data->id}}">
					{{ csrf_field() }}
					<div class="form-group">

						<div class="panel-body">
							<form>
								<label for="">Titulo del informe</label>
								<input type="text" name="title" value="{{ $data->title }}" required >
								<textarea class="ckeditor" name="content" id="content" rows="10" cols="80">  
									{{$data->content}}
								</textarea>
							</form>
						</div>
					
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Guardar">

						<a href="{{route('resultados.informe-index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection