
        <select name="times_post_Graduation_Specialisation" class="form-control" id="">
            <option value="-1">Select Specification </option>
            @if(count($times_post_greduations))
            @foreach($times_post_greduations as $times_post_greduation)
            <option value="{{ $times_post_greduation->id }}">
                {{ isset($times_post_greduation->value)?$times_post_greduation->value:'' }}
            </option>
            @endforeach
            @endif
        </select>
    