<!-- <style>

.select2-container--default .select2-selection--multiple {
    background-color: white;
    border: 1px solid #aaa;
    border-radius: 4px;
    cursor: text;
    width: 300px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<div class="form-group">
    <label class="pay">Education Stream <small>(shine)</small></label>-->
    <!-- <select name="shine_study_id[]"class="form-control  select-study"   multiple="multiple" id="shine_study_id" multiple>
        <option value="-1">-Select Education Stream-</option> -->
        @if(count($shine_studies))
        @foreach($shine_studies as $shine_study)
        <option value="{{ $shine_study->study_id }}">
            {{ isset($shine_study->study_desc)?$shine_study->study_desc:'' }}
        </option>
        @endforeach
        @endif
    <!-- </select>
</div>

<script>
    $(".select-study").select2({
            tags: true,
            tokenSeparators: [',']
        });
</script> -->
