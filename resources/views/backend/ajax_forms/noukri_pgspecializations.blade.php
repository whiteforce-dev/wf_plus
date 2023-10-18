<div class="form-group">
    <label class="pay"> pg specification <small>(Noukri)</small></label>
    <select name="PG_Specializations" class="list-dt form-control pg-single" id="PG_Specializations">
        <option value="-1">-Select -</option>
        @if(count($noukri_pgspecializations))
        @foreach($noukri_pgspecializations as $noukri_pgspecialization)
        <option value="{{ $noukri_pgspecialization->PGSpec_ID }}">
            {{ isset($noukri_pgspecialization->PG_Specilization)?$noukri_pgspecialization->PG_Specilization:'' }}
        </option>
        @endforeach
        @endif
    </select>
</div>
<script>
  $('.pg-single').select2();
</script>