<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ url('send-to-clickIndia') }}" method="post">
        @csrf
        @method('POST')

        <button type="submit">send to clickIndia</button>
    </form>
</body>

</html> -->

<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<script src="https://kit.fontawesome.com/aea6f081fa.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/aea6f081fa.js" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"
integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <div id="clicktext" class="col-sm-12">
    {{-- <hr>
    <center>
        <img class="img-logo" src="https://white-force.com/onrole/logo/clickindia.png" width="200">
    </center>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Job Category <small>(click
                        india)</small></label>
                <br>
                <select name="click_india_job_category" class="list-dt form-control js-example-basic-single"
                    style="width: 260px !important;" id="click_india_job_category">
                    <option value="-1">-Select Job Category-</option>
                    <?php $clickIndiaJobCategory = App\Models\ClickCategory::get(); ?>
                    @if (count($clickIndiaJobCategory))
                        @foreach ($clickIndiaJobCategory as $jobcategory)
                            <option value="{{ $jobcategory->id }}">
                                {{ isset($jobcategory->category_name) ? $jobcategory->category_name : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Job City <small>(click india)</small></label>
                <br>
                <select name="click_india_city_id" class="list-dt form-control js-example-basic-single"
                    id="click_india_city_id" style="width: 260px !important;" onchange="getCityNameField(this.value);">
                    <option value="-1">-Select City-</option>
                    <option value="-1">Not Found</option>
                    <?php $clickIndiaCity = App\Models\ClickCity::get(); ?>
                    @if (count($clickIndiaCity))
                        @foreach ($clickIndiaCity as $jobcity)
                            <option value="{{ $jobcity->id }}">
                                {{ isset($jobcity->city_name) ? $jobcity->city_name : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Qualification
                    <small>(clickindia)</small></label>
                <br>
                <select name="click_india_minimum_qualification" style="width: 260px !important;"
                    class="list-dt form-control js-example-basic-single" id="click_india_minimum_qualification">
                    <option value="< 10th">Below 10th</option>
                    <option value="10th">10th</option>
                    <option value="12th">12th</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Bachelors" selected>Bachelors</option>
                    <option value="Masters">Masters</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Minimum Experience: <small>(click
                        india)</small></label>
                <br>
                <select name="click_india_minimum_experience" style="width: 260px !important;"
                    class="list-dt form-control js-example-basic-single" id="click_india_minimum_experience">
                    <option value="Fresher" selected>Fresher</option>
                    <option value="1 yr">1 yr</option>
                    <option value="2 yrs">2 yrs</option>
                    <option value="3 yrs">3 yrs</option>
                    <option value="4 yrs">4 yrs</option>
                    <option value="5 yrs">5 yrs</option>
                    <option value="6-9 yrs">6-9 yrs</option>
                    <option value="10-15 yrs">10-15 yrs</option>
                    <option value="15 above">15 Above</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Job Type <small>(click india)</small></label>
                <br>
                <select name="job_type" class="list-dt form-control js-example-basic-single" id="job_type"
                    style="width: 260px !important;">
                    <option value="Full time jobs">Full time jobs
                    </option>
                    <option value="Part time jobs">Part time jobs</option>
                    <option value="Work from home jobs">Work from home jobs</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Salary Type <small>(click
                        india)</small></label>
                <br>
                <select name="salary_type" class="list-dt form-control js-example-basic-single" id="salary_type"
                    style="width: 260px !important;">
                    <option value="Per Annum">Per Annum</option>
                    <option value="Per Hour">Per Hour</option>
                    <option value="Per Day">Per Day</option>
                    <option value="Per Week">Per Week</option>
                    <option value="Per Month">Per Month</option>
                </select>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Required Candidate <small>(click
                        india)</small></label>
                <br>
                <select name="click_india_required_candidate"
                    class="list-dt form-control js-example-basic-single" id="click_india_required_candidate">
                    <option value="Male / Female" selected>Male / Female</option>
                    <option value="Male only">Male only</option>
                    <option value="Female only">Female only</option>
                </select>
            </div>
        </div>
        <div class="col-sm-12 mt-2 mb-2">
            <div class="form-group">
                <label class="pay">Working Day <small>(click
                        india)</small></label>
                <br>
                <div class="col-sm-12 row mt-2">
                    <div class="col-1">Mon <p></p>     <input type="checkbox" name="click_india_working_days[]" id="mon"
                            value="Mon" checked>
                    </div>
                    <div class="col-1">
                        Tue <p></p>  <input type="checkbox" name="click_india_working_days[]" id="tue" value="Tue"
                            checked>
                    </div>
                    <div class="col-1">Wed <p></p>  <input type="checkbox" name="click_india_working_days[]" id="wed"
                            value="Wed" checked>
                    </div>
                    <div class="col-1">Thu <p></p>  <input type="checkbox" name="click_india_working_days[]" id="thu"
                            value="Thu" checked>
                    </div>
                    <div class="col-1">Fri <p></p>  <input type="checkbox" name="click_india_working_days[]" id="fri"
                            value="Fri" checked>
                    </div>
                    <div class="col-1">Sat <p></p> <input type="checkbox" name="click_india_working_days[]" id="sat"
                            value="Sat">
                    </div>
                    <div class="col-1">Sun <p></p> <input type="checkbox" name="click_india_working_days[]" id="sun"
                            value="Sun">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <label class="pay">Hiring Process <small>(click
                        india)</small></label>
                <input type="text" class="form-control" name="click_india_hiring_process"
                    id="click_india_hiring_process" style="width: 100% !important;"
                    placeholder="Telephonic, Walk-In, Written test, Group Discussion, Interview"
                    value="Telephonic, Walk-In, Written test, Group Discussion, Interview" />
            </div>
        </div>

    </div> --}}
    <body>
        <form action="{{ url('send-to-clickIndia') }}" method="post">
            @csrf
            @method('POST')

    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">

                <img  height="25" src="https://white-force.com/onrole/logo/clickindia.png" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Job Category</label>
        <div class="col-sm-9">
            <select name="click_india_job_category" class="list-dt form-control js-example-basic-single"
                style="width: 100% !important;" id="click_india_job_category" required>
                <option value="-1"selected disabled>-Select Job Category-</option>
                <?php $clickIndiaJobCategory = App\Models\ClickCategory::get(); ?>
                @if (count($clickIndiaJobCategory))
                    @foreach ($clickIndiaJobCategory as $jobcategory)
                        <option value="{{ $jobcategory->id }}">
                            {{ isset($jobcategory->category_name) ? $jobcategory->category_name : '' }}
                        </option>
                    @endforeach
                @endif
            </select>

        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Job City</label>
        <div class="col-sm-9">
            <select name="click_india_city_id" class="list-dt form-control js-example-basic-single"
                id="click_india_city_id" style="width: 100% !important;" onchange="getCityNameField(this.value);" Required>
                <option value="-1" selected disabled>-Select City-</option>
                <option value="-1">Not Found</option>
                <?php $clickIndiaCity = App\Models\ClickCity::get(); ?>
                @if (count($clickIndiaCity))
                    @foreach ($clickIndiaCity as $jobcity)
                        <option value="{{ $jobcity->id }}">
                            {{ isset($jobcity->city_name) ? $jobcity->city_name : '' }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Qualification</label>
        <div class="col-sm-9">
            <select name="click_india_minimum_qualification" style="width: 100% !important;"
                class="list-dt form-control js-example-basic-single" id="click_india_minimum_qualification" Required>
                <option value="< 10th">Below 10th</option>
                <option value="10th">10th</option>
                <option value="12th">12th</option>
                <option value="Diploma">Diploma</option>
                <option value="Bachelors" selected>Bachelors</option>
                <option value="Masters">Masters</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Minimum Experience:</label>
        <div class="col-sm-9">
            <select name="click_india_minimum_experience" style="width: 100% !important;"
                class="list-dt form-control js-example-basic-single" id="click_india_minimum_experience" Required>
                <option value="Fresher" selected>Fresher</option>
                <option value="1 yr">1 yr</option>
                <option value="2 yrs">2 yrs</option>
                <option value="3 yrs">3 yrs</option>
                <option value="4 yrs">4 yrs</option>
                <option value="5 yrs">5 yrs</option>
                <option value="6-9 yrs">6-9 yrs</option>
                <option value="10-15 yrs">10-15 yrs</option>
                <option value="15 above">15 Above</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Job Type</label>
        <div class="col-sm-9">
            <select name="job_type" class="list-dt form-control js-example-basic-single" id="job_type"
                style="width: 100% !important;" Required>
                <option value="Full time jobs">Full time jobs
                </option>
                <option value="Part time jobs">Part time jobs</option>
                <option value="Work from home jobs">Work from home jobs</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Salary Type</label>
        <div class="col-sm-9">

                <select name="salary_type" class="list-dt form-control js-example-basic-single" id="salary_type" Required
                >
                <option value="Per Annum">Per Annum</option>
                <option value="Per Hour">Per Hour</option>
                <option value="Per Day">Per Day</option>
                <option value="Per Week">Per Week</option>
                <option value="Per Month">Per Month</option>
            </select>

        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Working Day </label>
                <div class="col-sm-9">
                    <div class=" row">
            <div class="col-1" style="width:62px">Mon <p></p> <input type="checkbox" name="click_india_working_days[]" id="mon"
                    value="Mon" checked>
            </div>
            <div class="col-1"style="width:62px">
                Tue <p></p> <input type="checkbox" name="click_india_working_days[]" id="tue" value="Tue"
                    checked>
            </div>
            <div class="col-1"style="width:62px">Wed <p></p> <input type="checkbox" name="click_india_working_days[]" id="wed"
                    value="Wed" checked>
            </div>
            <div class="col-1"style="width:62px">Thu <p></p> <input type="checkbox" name="click_india_working_days[]" id="thu"
                    value="Thu" checked>
            </div>
            <div class="col-1"style="width:62px">Fri<p></p> <input type="checkbox" name="click_india_working_days[]" id="fri"
                    value="Fri" checked>
            </div>
            <div class="col-1"style="width:62px">Sat<p></p> <input type="checkbox" name="click_india_working_days[]" id="sat"
                    value="Sat">
            </div>
            <div class="col-1"style="width:62px">Sun <p></p> <input type="checkbox" name="click_india_working_days[]" id="sun"
                    value="Sun">
            </div>
        </div>
        </div>
    </div>

    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Hiring Process</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="click_india_hiring_process"
                    id="click_india_hiring_process" style="width: 100% !important;"required
                    placeholder="Telephonic, Walk-In, Written test, Group Discussion, Interview" value="Telephonic, Walk-In, Written test, Group Discussion, Interview"
                     />
        </div>
        @error('click_india_hiring_process')
        {{ $message }}
        @enderror
    </div>
</div>
<button type="submit">send to clickIndia</button>
        </form>
    </body>

