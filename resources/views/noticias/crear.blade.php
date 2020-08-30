@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-book"></i>
					<span><strong>Redactar Noticia</strong></span>
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
				<form class="form-horizontal" role="form" method="post" action="noticias/crear" accept-charset="UTF-8" enctype="multipart/form-data">
					{{ csrf_field() }}
					<div class="form-group">
                       <div class="panel-body">
                        <div class="row">
                        <label class="col-sm-1 control-label">Imagen</label>
						<div class="col-sm-2">
							<input type="file" class="form-control" name="imagen" placeholder="Titulo de Noticia" data-toggle="tooltip" data-placement="bottom" title="Titulo">
						</div>
                        <label class="col-sm-1 control-label">Titulo</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="tittle" placeholder="Titulo de Noticia" data-toggle="tooltip" data-placement="bottom" title="Titulo">
						</div>
                        <label class="col-sm-1 control-label">Link</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="link" placeholder="Link de Noticia" data-toggle="tooltip" data-placement="bottom" title="Subtitulo">
						</div>
                        </div>
						<div class="row">
                       
                        <label class="col-sm-1 control-label">Origen</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="origin" placeholder="Origen de Noticia" data-toggle="tooltip" data-placement="bottom" title="Titulo">
						</div>
                        <label class="col-sm-1 control-label">Categoria</label>
						<div class="col-sm-4">
							<input type="text" class="form-control" name="category" placeholder="Subtitulo de Noticia" data-toggle="tooltip" data-placement="bottom" title="Subtitulo">
						</div>
                        </div>
                       </div>
						

						<div class="panel-body">
							<form>
								<textarea class="ckeditor" name="cuerpo" id="cuerpo" rows="10" cols="80">  
								</textarea>
							</form>
						</div>
					
						<br>
						<input type="submit" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-primary" value="Guardar">

						<a href="{{route('noticias.index')}}" style="margin-left:15px; margin-top: 20px;" class="col-sm-2 btn btn-danger">Volver</a>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection