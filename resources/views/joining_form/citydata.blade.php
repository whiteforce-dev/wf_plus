@foreach($cities as $city)
<select>
    <option value={{ $city->id}}>{{ $city->city_name}}</option>
</select>
@endforeach