@extends('layouts.app')
@section("content")
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-block">
				<div class="row">
					<div class="col-md-12">
						<h4 class="card-title">Actualizar Informe</h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						 {!! Form::model($atencion, ['method' => 'PUT', 'route' => ['informes1.update', $atencion->id],'enctype'=>'multipart/form-data']) !!}
							<div class="row">
							
						
								<div class="col-md-6">
									<div class="form-group row">
										<label for="form-1-1" class="col-md-12 control-label">
											Informe
										</label>
										<div class="col-md-12">
											{{Form::file('informe', ["class"=>"form-control", "required"])}}
										</div>
									</div>
								</div>
							
								
								
								<div class="col-md-12">
									<button type="submit" class="btn btn-success">
										<i class="ti-save pdd-right-5"></i>
										<span>Guardar</span>
									</button>
								</div>
							</div>
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
