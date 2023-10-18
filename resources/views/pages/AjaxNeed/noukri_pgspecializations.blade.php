<select name="PG_Specializations" class="form-control" id="PG_Specializations">
    <option value="-1">Select</option>
    @if (count($noukri_pgspecializations))
        @foreach ($noukri_pgspecializations as $noukri_pgspecialization)
            <option value="{{ $noukri_pgspecialization->PGSpec_ID }}">
                {{ isset($noukri_pgspecialization->PG_Specilization) ? $noukri_pgspecialization->PG_Specilization : '' }}
            </option>
        @endforeach
    @endif
</select>
