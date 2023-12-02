@foreach($cities as $city)
<option value={{ $city->id}}>{{ $city->city_name}}</option>
@endforeach