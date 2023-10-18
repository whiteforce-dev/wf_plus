{{-- <div class="form-group">
<label class="pay">graduation specializations <small>(timesjobs)</small> </label>
    <select name="times_Graduation_Specialisation" class="list-dt form-control basic-select" id=""  style="width: 580px !important;">
        <option value="-1">-Select -</option>
        @if(count($Times_graduation_specializations))
        @foreach($Times_graduation_specializations as $Times_graduation_specialization)
        <option value="{{ $Times_graduation_specialization->id }}">
            {{ isset($Times_graduation_specialization->value)?$Times_graduation_specialization->value:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div> --}}


{{-- <div class="mb-12 row"> --}}
    {{-- <label class="col-sm-3 col-form-label">UG Specializations</label> --}}
    <div class="col-sm-12">
        <select name="times_Graduation_Specialisation" class="form-control times_Graduation_Specialisation" id="times_Graduation_Specialisation_id">
            <option value="-1">-Select -</option>
            @if(count($Times_graduation_specializations))
            @foreach($Times_graduation_specializations as $Times_graduation_specialization)
            <option value="{{ $Times_graduation_specialization->id }}">
                {{ isset($Times_graduation_specialization->value)?$Times_graduation_specialization->value:'' }}
            </option>
            @endforeach
            @endif
        </select>
    </div>
{{-- </div> --}}
<script>
    // $(document).ready(function() {
    //     $('.times_Graduation_Specialisation').select2();
    // });

</script>