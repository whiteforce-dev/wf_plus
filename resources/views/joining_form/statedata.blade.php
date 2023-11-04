@foreach($states as $state)
<select>
    <option value={{ $state->id}}>{{ $state->state_name}}</option>
</select>
@endforeach