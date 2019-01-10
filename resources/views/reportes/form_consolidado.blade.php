@extends('layouts.app')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<form action="reporte/detallado" method="post">
				<div class="form-group">
					<div class="col-xs-6">
						<label class="control-label">Fecha a solictar</label>
						<input type="date" name="fecha" value="{{ Carbon\Carbon::now()->toDateString()}}" style="line-height: 20px">
						<button target="_blank" type="submit">Generar Reporte</button>
						{{ csrf_field() }}
					</div>
				</div>
			</form>
		</div>
	</div>
@endsection