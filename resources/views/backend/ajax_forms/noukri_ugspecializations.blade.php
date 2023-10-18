<div class="form-group">
<label class="pay">UG Specializations <small>(Noukri)</small> </label>
    <select name="UG_Specializations" class="list-dt form-control ug-single" id="monster_education_stream_id">
        <option value="-1">-Select -</option>
        @if(count($noukri_ugspecializations))
        @foreach($noukri_ugspecializations as $noukri_ugspecialization)
        <option value="{{ $noukri_ugspecialization->UGSpec_ID }}">
            {{ isset($noukri_ugspecialization->UG_Specilization)?$noukri_ugspecialization->UG_Specilization:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>
<script>
  
    $(document).ready(function() {
      $('.ug-single').select2();
    });
</script>