@foreach($states as $state)
<option value={{ $state->id}}>{{ $state->state_name}}</option>
@endforeach