
    <select name="shine_study_id[]"class="form-control  select-study" multiple="multiple" id="shine_study_id" multiple>
        {{-- <option value="-1">-Select Education Stream-</option> --}}
        @if(count($shine_studies))
        @foreach($shine_studies as $shine_study)
        <option value="{{ $shine_study->study_id }}">
            {{ isset($shine_study->study_desc)?$shine_study->study_desc:'' }}
        </option>
        @endforeach
        @endif
    </select>


    <script>
        $("#shine_study_id").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            placeholder: "Select Education Stream",
        });
    </script>
    