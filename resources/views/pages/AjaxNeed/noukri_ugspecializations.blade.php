<select name="UG_Specializations" class="form-control" id="monster_education_stream_id">
    <option value="-1">Select</option>
    @if (count($noukri_ugspecializations))
        @foreach ($noukri_ugspecializations as $noukri_ugspecialization)
            <option value="{{ $noukri_ugspecialization->UGSpec_ID }}">
                {{ isset($noukri_ugspecialization->UG_Specilization) ? $noukri_ugspecialization->UG_Specilization : '' }}
            </option>
        @endforeach
    @endif
</select>
