<div id="googlejobtext" class="col-sm-12">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">

            <img height="25" src="{{ url('logo/google.png') }}" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label pay">Employment Type</label>

        <div class="col-sm-9">
            <select class="form-control" name="employment_type">
                <option value="FULL_TIME">FULL_TIME</option>
                <option value="PART_TIME">PART_TIME</option>
                <option value="CONTRACTOR">CONTRACTOR </option>
                <option value="TEMPORARY">TEMPORARY </option>
                <option value="INTERN">INTERN </option>
                <option value="VOLUNTEER">VOLUNTEER </option>
                <option value="PER_DIEM">PER_DIEM </option>
                <option value="OTHER">OTHER </option>
            </select>
        </div> 
        @error('employment_type')
        {{ $message }}
        @enderror
    </div>
</div>
<hr>