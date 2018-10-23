<label class="col-sm-5 control-label">Profesional</label>
						<div class="col-sm-3">
							<select id="el1" name="origen_usuario">
								@foreach($profesional as $pac)
									<option value="{{$pac->id}}">
										{{$pac->name}} {{$pac->lastname}}-{{$pac->dni}}
									</option>
								@endforeach
							</select>
						</div>

						</div>
@section('scripts')

<script type="text/javascript">
// Run Select2 on element
function Select2Test(){
	$("#el1").select2();
}
$(document).ready(function() {
	// Load script of Select2 and run this
	LoadSelect2Script(Select2Test);
	LoadTimePickerScript(DemoTimePicker);
	WinMove();
});
function DemoTimePicker(){
	$('#input_date').datepicker({
	setDate: new Date(),
	minDate: 0});
	$('#input_time').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
	$('#input_time2').timepicker({
		setDate: new Date(),
		stepMinute: 10
	});
}
</script>

@endsection