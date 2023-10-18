<div id="ziprecruiter_portals_form"  class="col-sm-12">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">

            <img height="25" src="https://www.white-force.com/onrole/job-posting-assets/zip.png" alt="">
           
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-sm-4">
            <div class="form-group"> --}}
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label pay">Experience</label>
            
                    <div class="col-sm-9">
             
                <select class="form-control" name="experience" id="experience">
                    <option value="intern">Intern</option>
                    <option value="entry">Entry Level (0-2 years)</option>
                    <option value="mid">Mid Level (3-6 years)</option>
                    <option value="senior">Senior Level (7+ years)</option>
                    <option value="director">Director</option>
                    <option value="executive">Executive</option>
                </select>

            </div>
        </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label pay">Education</label>
            
                    <div class="col-sm-9">
             
                        <select name="education" id="education" class="form-control">
                            <option value="ged">High School Diploma/GED</option>
                            <option value="assoc">Associates Degree</option>
                            <option value="undergrad">Bachelors Degree</option>
                            <option value="grad">Masters or Ph. D</option>
                        </select>

            </div>
        </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label pay">Pay Type</label>
            
                    <div class="col-sm-9">
             
                        <select name="pay_type" id="pay_type" class="form-control">
                            <option value="Annually">Annually</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="Daily">Daily</option>
                            <option value="Hourly">Hourly</option>
                        </select>

            </div>
        </div>
        {{-- <div class="col-sm-4">
            <div class="form-group">
                <label for="">Education<small>(ziprecuiter)</small></label>
                <select name="education" id="education" class="form-control">
                    <option value="ged">High School Diploma/GED</option>
                    <option value="assoc">Associates Degree</option>
                    <option value="undergrad">Bachelors Degree</option>
                    <option value="grad">Masters or Ph. D</option>
                </select>

            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label for="">Pay Type<small>(ziprecuiter)</small></label>
                <select name="pay_type" id="pay_type" class="form-control">
                    <option value="Annually">Annually</option>
                    <option value="Monthly">Monthly</option>
                    <option value="Weekly">Weekly</option>
                    <option value="Daily">Daily</option>
                    <option value="Hourly">Hourly</option>
                </select>

            </div>
        </div>

    </div> --}}
</div>
<hr>
{{-- <div id="googlejobtext" class="col-sm-12">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">

            <img height="25" src="{{ url('logo/ziprecruiter.svg') }}" alt="">
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
</div> --}}
