@foreach($collection as $c)
	@if(count($c->names))
		<option value="{{ $c->id }}" class="optionResponse">{{ $c->names->first()->text }}</option>
	@endif
@endforeach