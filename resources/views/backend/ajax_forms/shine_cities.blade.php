 <select name="shine_cities_id[]" class="select-single form-control" id="shine_cities_id">
     @if (count($shine_cities))
         @foreach ($shine_cities as $shine_city)
             <option value="{{ $shine_city->city_id }}">
                 {{ isset($shine_city->city_desc) ? $shine_city->city_desc : '' }}
             </option>
         @endforeach
     @endif

 </select>
