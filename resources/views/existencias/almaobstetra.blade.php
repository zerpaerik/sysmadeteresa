	<select id="el2" name="producto">
			<option>Seleccione un Producto</option>
			@foreach($producto as $p)
			<option value="{{$p->id}}">{{$p->nombre}}</option>
			@endforeach
		</select>