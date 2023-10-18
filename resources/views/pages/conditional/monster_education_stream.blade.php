



<label class="col-sm-3 col-form-label">Education Stream</label>
<div class="col-sm-9">
    <select name="monster_education_stream_id" class="list-dt form-control basic-single" id="monster_education_stream_id">
        <option value="-1">Select Education Stream</option>
        @if (count($monster_education_streams))
            @foreach ($monster_education_streams as $monster_education_stream)
                <option value="{{ $monster_education_stream->stream_id }}">
                    {{ isset($monster_education_stream->specialization) ? $monster_education_stream->specialization : '' }}
                </option>
            @endforeach
        @endif
    </select>
</div>

