@extends('layouts.app')

@section('content')
<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-header">
				<div class="box-name">
					<i class="fa fa-users"></i>
					<span><strong>Visualizar Requerimiento</strong></span>
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
				        <div class="panel-body">
							<form>
								<textarea class="" name="descripcion" id="descripcion" rows="10" cols="80">
									{!!json_decode($descripcion)!!}
								</textarea>
							</form>
						</div>
               </div>
						<br>
						<br>					

						<input type="hidden" name="id" value="{{$id}}">

						<div class="col-sm-8">
							<input type="submit" class="col-sm-2 btn btn-primary" value="Editar">
							<a href="{{route('requerimientos.index')}}" class="col-sm-2 btn btn-danger">Volver</a>
						</div>
					</div>			
				</form>	
			</div>
		</div>
	</div>
</div>
@endsection