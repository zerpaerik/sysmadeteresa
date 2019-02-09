<label class="col-sm-5 control-label">Personal</label>
						<div class="col-sm-3">
							<select id="el22" name="origen_usuario" class="el22">
								@foreach($personal as $pac)
									<option value="{{$pac->id}}">
										{{$pac->lastname}} {{$pac->name}}-{{$pac->dni}}
									</option>
								@endforeach
							</select>
			
						</div>
@section('scripts')


<script type="text/javascript">
// Run Select2 on elementss
function Select2Test(){
	$(".el22").select2();
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	WinMove();
});
</script>
</script>

@endsection