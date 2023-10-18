<?php 
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;    
?>



{{-- <div id="shinetext" class="col-sm-12">
    <hr>
    <center>
        <img class="img-logo" src="{{ url('logo/shine.png') }}" width="100">
    </center>
    <br>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">City Group <small>(shine)</small></label>
                <br>
                <select name="shine_cities_groups_id"
                    class="list-dt form-control js-example-basic-single"
                    id="shine_cities_groups_id" onchange="getShineCity(this.value);">
                    <option value="-1">-Select City Group-</option>
                    @php
                        $shine_cities_collection = new Collection(App\Models\ShineCity::orderBy('city_grouping_desc')->cursor());
                        $shine_cities_groups = $shine_cities_collection->unique('city_grouping_desc');

                        @endphp
                        
                    @if (count($shine_cities_groups))
                        @foreach ($shine_cities_groups as $shine_cities_group)
                            <option value="{{ $shine_cities_group->city_grouping_id }}">
                                {{ isset($shine_cities_group->city_grouping_desc) ? $shine_cities_group->city_grouping_desc : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>

            </div>
        </div>
        <div class="col-sm-4" id="shine_cities_id_div">
            <div class="form-group">
                <label class="pay">City Name<small>(shine)</small></label>
                <br>
                <select name="shine_cities_id[]" class="select-single form-control"
                    id="shine_cities_id">
                    <option value="-1">-Select City Name-</option>
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Industry <small>(shine)</small></label>
                <br>
                <select name="shine_industries_id" class="list-dt form-control"
                    id="shine_industries_id">
                    <option value="-1">-Select Industry-</option>
                    <?php $shine_industries = App\Models\ShineIndustry::orderBy('industry_desc')->cursor(); ?>
                    @if (count($shine_industries))
                        @foreach ($shine_industries as $shine_industry)
                            <option value="{{ $shine_industry->industry_id }}">
                                {{ isset($shine_industry->industry_desc) ? $shine_industry->industry_desc : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">Functional Area <small>(shine)</small></label>
                <br>
                <select class="form-control select-single"
                    name="shine_functional_areas_id[]" id="shine_functional_areas_id">
                    <option value="-1">-Select Functional Area-</option>
                    <?php $shine_functional_areas = App\Models\ShineFunctionalArea::cursor(); ?>
                    @if (count($shine_functional_areas))
                        @foreach ($shine_functional_areas as $shine_functional_area)
                            <option value="{{ $shine_functional_area->codes }}">
                                {{ isset($shine_functional_area->value) ? $shine_functional_area->value : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-sm-6 col-lg-6 col-sm-4 col-sm-4 col-12" style="display: none">
            <div class="form-group">
                <label class="pay">Job Apply URL</label>
                <input type="hidden" class="list-dt form-control" name="apply_button_url"
                    placeholder="e.g. white-force.com/job_temp_description/" required
                    maxlength="254"
                    value="https://white-force.com/jobs_temp_descriptionOnrole/" />
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label class="pay">
                    Education Levels <small>(shine)</small>
                </label>
                <br>
                <select name="shine_study_field_grouping_id[]"
                    class="form-control select-single" id="shine_study_field_grouping_id"
                    onchange="getShineEducationStream(this.value);">
                    <option value="-1">-Select Education Level-</option>

                    <?php
                    $shine_degree_levels_collection = new Collection(App\Models\ShineDegreeLevel::orderBy('study_field_grouping_id')->cursor());
                    
                    $study_field_groupings = $shine_degree_levels_collection->unique('study_field_grouping_id');
                    
                    ?>
                    @if (count($study_field_groupings))
                        @foreach ($study_field_groupings as $study_field_group)
                            <option value="{{ $study_field_group->study_field_grouping_id }}">
                                {{ isset($study_field_group->study_field_grouping_desc) ? $study_field_group->study_field_grouping_desc : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>

        <div class="col-sm-4" id="shine_education_stream_div">
            <div class="form-group">
                <label class="pay">Education Stream <small>(shine)</small></label>
                <br>
                <select name="shine_study_id[]" class="form-control select-single"
                    id="shine_study_id" >
                    <option value="-1">-Select Education Stream-</option>
                </select>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group">

                <div class="mt-12">
                    <div class="">
                        <label class="pay">Experience Look up *</label>
                        <p style="color:#E67E22; font-weight:bold;">
                            Difference
                            between max and min experience values should be less than equal to 5.
                            (shine)
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <select name="shine_min_experience_id"
                                class="list-dt form-control js-example-basic-single"
                                id="shine_min_experience_id">
                                <option value="-1">-Select Min. Exp.-</option>
                                <?php $shine_experience_lookups = App\Models\ShineExperienceLookup::cursor(); ?>
                                @foreach ($shine_experience_lookups as $shine_experience_lookup)
                                    <option value="{{ $shine_experience_lookup->id }}">
                                        {{ $shine_experience_lookup->display }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <select name="shine_max_experience_id"
                                class="list-dt form-control js-example-basic-single"
                                id="shine_max_experience_id" >
                                <option value="">-Select Max. Exp.-</option>
                                <?php $shine_experience_lookups = App\Models\ShineExperienceLookup::cursor(); ?>
                                @foreach ($shine_experience_lookups as $shine_experience_lookup)
                                    <option value="{{ $shine_experience_lookup->id }}">
                                        {{ $shine_experience_lookup->display }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-12">
            <div class="form-group">
                <label class="pay">Salary Range *</label>
                <p style="color:#E67E22; font-weight:bold;">
                    Difference between max and min salary values should be less than equal to 6.
                    (shine)
                </p>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <select name="shine_min_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_min_salary_id">
                        <option value="">-Select Min. Salary -</option>
                        <?php $shine_salaries = App\Models\ShineSalary::cursor(); ?>
                        @foreach ($shine_salaries as $shine_salary)
                            <option value="{{ $shine_salary->salary_id }}">
                                {{ $shine_salary->salary }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                    <select name="shine_max_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_max_salary_id">
                        <option value="">-Select Max. Salary -</option>
                        <?php $shine_salaries = App\Models\ShineSalary::cursor(); ?>
                        @foreach ($shine_salaries as $shine_salary)
                            <option value="{{ $shine_salary->salary_id }}">
                                {{ $shine_salary->salary }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

</div>  --}}



{{-- <div id="shinetext">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">
           
                <img  height="25" src="https://www.white-force.com/onrole/job-posting-assets/shine.png" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select State</label>
        <div class="col-sm-9">
            <select name="shine_cities_groups_id"
                    class="list-dt form-control js-example-basic-single"
                    id="shine_cities_groups_id" onchange="getShineCity(this.value);" Required>
                    <option value="-1" selected disabled>Select State</option>
                    @php
                        $shine_cities_collection = new Collection(App\Models\ShineCity::orderBy('city_grouping_desc')->cursor());
                        $shine_cities_groups = $shine_cities_collection->unique('city_grouping_desc');

                        @endphp
                        
                    @if (count($shine_cities_groups))
                        @foreach ($shine_cities_groups as $shine_cities_group)
                            <option value="{{ $shine_cities_group->city_grouping_id }}">
                                {{ isset($shine_cities_group->city_grouping_desc) ? $shine_cities_group->city_grouping_desc : '' }}
                            </option>
                        @endforeach
                    @endif
                </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Cities</label>
        <div class="col-sm-9" id="shine_cities_id_div">
        <select name="shine_cities_id[]" class="select-single form-control"
            id="shine_cities_id" required>
            <option value="-1" selected disabled>Select Cities</option>
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Industry</label>
        <div class="col-sm-9">
            <select name="shine_industries_id" class="list-dt form-control"
            id="shine_industries_id" required>
            <option value="-1" selected disabled>Select Industry</option>
            <?php $shine_industries = App\Models\ShineIndustry::orderBy('industry_desc')->cursor(); ?>
            @if (count($shine_industries))
                @foreach ($shine_industries as $shine_industry)
                    <option value="{{ $shine_industry->industry_id }}">
                        {{ isset($shine_industry->industry_desc) ? $shine_industry->industry_desc : '' }}
                    </option>
                @endforeach
            @endif
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Functional</label>
        <div class="col-sm-9">
            <select class="form-control select-single"
            name="shine_functional_areas_id[]" id="shine_functional_areas_id" required>
            <option value="-1" selected disabled>Select Functional Area</option>
            <?php $shine_functional_areas = App\Models\ShineFunctionalArea::cursor(); ?>
            @if (count($shine_functional_areas))
                @foreach ($shine_functional_areas as $shine_functional_area)
                    <option value="{{ $shine_functional_area->codes }}">
                        {{ isset($shine_functional_area->value) ? $shine_functional_area->value : '' }}
                    </option>
                @endforeach
            @endif
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Education</label>
        <div class="col-sm-9">
            <select name="shine_study_field_grouping_id[]"
            class="form-control select-single" id="shine_study_field_grouping_id"
            onchange="getShineEducationStream(this.value);" required>
            <option value="-1" selected disabled>Select Education Level</option>

            <?php
            $shine_degree_levels_collection = new Collection(App\Models\ShineDegreeLevel::orderBy('study_field_grouping_id')->cursor());
            
            $study_field_groupings = $shine_degree_levels_collection->unique('study_field_grouping_id');
            
            ?>
            @if (count($study_field_groupings))
                @foreach ($study_field_groupings as $study_field_group)
                    <option value="{{ $study_field_group->study_field_grouping_id }}">
                        {{ isset($study_field_group->study_field_grouping_desc) ? $study_field_group->study_field_grouping_desc : '' }}
                    </option>
                @endforeach
            @endif
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Education Stream</label>
        <div class="col-sm-9" id="shine_education_stream_div">
            <select name="shine_study_id[]" class="form-control select-single"
                id="shine_study_id" Required >
                <option value="-1" selected disabled>Select Education Stream</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Experience</label>
        <div class="col-sm-5">
            <select name="shine_min_experience_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_min_experience_id" Required>
            <option value="-1" selected disabled>Select Min. Exp.</option>
            <?php $shine_experience_lookups = App\Models\ShineExperienceLookup::cursor(); ?>
            @foreach ($shine_experience_lookups as $shine_experience_lookup)
                <option value="{{ $shine_experience_lookup->id }}">
                    {{ $shine_experience_lookup->display }}
                </option>
            @endforeach
        </select>
        </div>
        <div class="col-sm-4">
            <select name="shine_max_experience_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_max_experience_id" Required>
            <option value="">Select Max. Exp.</option>
            <?php $shine_experience_lookups = App\Models\ShineExperienceLookup::cursor(); ?>
            @foreach ($shine_experience_lookups as $shine_experience_lookup)
                <option value="{{ $shine_experience_lookup->id }}">
                    {{ $shine_experience_lookup->display }}
                </option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Salary</label>
        <div class="col-sm-5">
            <select name="shine_min_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_min_salary_id" id="shine_minYearExp" onchange="setMaxValue()" Required>
                        <option value="">Select Min. Salary</option>
                        <?php $shine_salaries = App\Models\ShineSalary::cursor(); ?>
                        @foreach ($shine_salaries as $shine_salary)
                            <option value="{{ $shine_salary->salary_id }}">
                                {{ $shine_salary->salary }}
                            </option>
                        @endforeach
                    </select>
        </div>
        <div class="col-sm-4">
            <select name="shine_max_salary_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_max_salary_id" Required>
            <option value="">Select Max. Salary</option>
            <?php $shine_salaries = App\Models\ShineSalary::cursor(); ?>
            @foreach ($shine_salaries as $shine_salary)
                <option value="{{ $shine_salary->salary_id }}">
                    {{ $shine_salary->salary }}
                </option>
            @endforeach
        </select>
        </div>
    </div>
</div>

<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>


    function getShineCity(shine_cities_groups_id) {
            $.get("{{ url('getShineCity') }}", {
                shine_cities_groups_id: shine_cities_groups_id,
            }, function(response) {
                // console.log(response);
                $('#shine_cities_id_div').html('');
                $('#shine_cities_id_div').html(response);
            });

        }

        function getShineEducationStream(shine_study_field_grouping_id) {
            if (shine_study_field_grouping_id) {
                $.get("{{ url('getShineEducationStream') }}", {
                    shine_study_field_grouping_id: shine_study_field_grouping_id,
                }, function(response) {
                    // console.log(response);
                    // $('#shine_education_stream_div').html(response);
                    $('#shine_study_id').html(response);
                });
            }
        }

        function setMaxValue() {
        var minValue = $('#shine_min_salary_id').val(); // 10
        minValue++ // 11
        var options = ""
        for (minValue; minValue <= 30; minValue++) {
            options += `<option value="` + minValue + `">` + minValue + `</option>`
        }
        $('#shine_max_salary_id').html('');
        $('#shine_max_salary_id').html(options);

    }
        

       
</script> --}}



<!-- Bootstrap CSS -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
<script src="https://kit.fontawesome.com/aea6f081fa.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
    integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div id="shinetext">
    <div class="mb-3 row mb-4 mt-5">
        <div class="col-sm-12">

                <img  height="25" src="https://www.white-force.com/onrole/job-posting-assets/shine.png" alt="">
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Cities</label>
        <div class="col-sm-9" id="shine_cities_id_div">
        <?php $cities = App\Models\NewShineCities::get() ?>
        <select name="shine_cities_id[]" class=" form-control"
            id="shine_cities_id" multiple >
            @foreach($cities as $city)
            <option value="{{ $city->id }}">{{ $city->Job_Locations }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Industry</label>
        <div class="col-sm-9">
            <?php $industries = App\Models\NewShineIndustries::get() ?>
            <select name="shine_industries_id" class="list-dt form-control"
            id="shine_industries_id" required>
            <option value="-1" selected disabled>Select Industry</option>
            @foreach($industries as $industry)
            <option value="{{ $industry->id }}">{{ $industry->job_industry }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Functional</label>
        <div class="col-sm-9">
            <?php $fields = App\Models\NewShineFunctionalArea::get() ?>
            <select class="form-control select-single"
            name="shine_functional_areas_id[]" id="shine_functional_areas_id" required multiple>
           @foreach($fields as $field)
            <option value="{{ $field->id }}">{{ $field->job_functional_area }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Select Education</label>
        <div class="col-sm-9">
            <?php $educations = App\Models\NewShineEducation::get() ?>
            <select name="shine_study_field_grouping_id[]"
            class="form-control select-single" id="shine_study_field_grouping_id"
             onchange="getShineEducationStream(this.value)" required>
            <option value="-1" selected disabled>Select Education Level</option>
            @foreach($educations as $education)
            <option value="{{ $education->id }}">{{ $education->degree }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Education Stream</label>
        <div class="col-sm-9" id="shine_education_stream_div">
            <?php $streams= App\Models\NewShineEducationStream::get() ?>
            <select name="shine_study_id[]" class="form-control select-single"
                id="shine_study_id" Required multiple>
                @foreach($streams as $stream)
                <option value="{{ $stream->id }}">{{ $stream->specialization }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Experience</label>
        <div class="col-sm-5">
            <?php $experience= App\Models\NewShineExperience::get() ?>
            <select name="shine_min_experience_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_min_experience_id" Required>
            <option value="-1" selected disabled>Select Min. Exp.</option>
            @foreach($experience as $exp)
            <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
            @endforeach
        </select>
        </div>
        <div class="col-sm-4">
            <select name="shine_max_experience_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_max_experience_id" Required>
            <option value="">Select Max. Exp.</option>
            @foreach($experience as $exp)
            <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
            @endforeach
        </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label class="col-sm-3 col-form-label">Salary</label>
        <div class="col-sm-5">
            <?php $salary= App\Models\NewShineSalary::get() ?>
            <select name="shine_min_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_min_salary_id" id="shine_minYearExp" onchange="checkDiffrence()" Required>
                        <option value="0">Select Min. Salary</option>
                        @foreach($salary as $sal)
                        <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
                        @endforeach
                    </select>
        </div>
        <div class="col-sm-4">
            <select name="shine_max_salary_id"
            class="list-dt form-control js-example-basic-single"
            id="shine_max_salary_id" onchange="checkDiffrence()" Required>
            <option value="0">Select Max. Salary</option>
            @foreach($salary as $sal)
            <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
            @endforeach
        </select>
        </div>
    </div>
    {{-- <div class="row mb-3">
        <div class="col-9 offset-3">
            <button type="submit" class="btn btn-primary btn-sm btn-block">Submit button</button>
        </div>
    </div> --}}
</div>

<script>
    $("#shine_cities_id").select2({
       placeholder: "Select Cities",
       tags: true,
       tokenSeparators: [','],
       maximumSelectionLength: 10,
   });
    $("#shine_functional_areas_id").select2({
       placeholder: "Select Functional Areas",
       tags: true,
       tokenSeparators: [','],
       maximumSelectionLength: 2,
   });
    $("#shine_study_id").select2({
       placeholder: "Select Stream",
       tags: true,
       tokenSeparators: [','],
       maximumSelectionLength: 2,
   });


//    function getShineCity(shine_cities_groups_id) {
//            $.get("{{ url('getShineCity') }}", {
//                shine_cities_groups_id: shine_cities_groups_id,
//            }, function(response) {
//                // console.log(response);
//                $('#shine_cities_id_div').html('');
//                $('#shine_cities_id_div').html(response);
//            });

//        }

       function getShineEducationStream(shine_study_field_grouping_id) {
           if (shine_study_field_grouping_id) {
               $.get("{{ url('get-specilization') }}", {
                   shine_study_field_grouping_id: shine_study_field_grouping_id,
               }, function(response) {
                   // console.log(response);
                   $('#shine_study_id').empty();
                   $('#shine_study_id').html(response);
               });
           }
       }

    //    function dynamicOptionCreate(e) {
    //    var option = document.createElement('option');
    //    option.text = e.specialization;
    //    option.value = e.id;
    //    return option;
    //     }

    function checkDiffrence() {
        var minText = $("#shine_min_salary_id option:selected").text();
        var maxText = $("#shine_max_salary_id option:selected").text();

        var min = returnNumber(minText);
        var max = returnNumber(maxText);
        
        if(min != 0 && max !=0){
            if(min > max){
                alert('you cant select Min value greater than max value')
                $('#shine_min_salary_id').val(0);
                $('#shine_max_salary_id').val(0);
            }
            var value = max - min;
            if(value > 5){
                alert('Difference 5 or less than 5')
                $('#shine_min_salary_id').val(0);
                $('#shine_max_salary_id').val(0);
            }
        }
    }

   function returnNumber(inputString){
    const match = inputString.match(/\d+(\.\d+)?/);

    if (match) {
        const number = parseFloat(match[0]);
        return number;
    } else {
        return 0;
    }
   }
</script>



{{-- <!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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

  </head>
  <body>
    <div class="container">
        <form action="{{ url('get-shine-details') }}" method="post">
            @csrf
            @method('POST')
            <div id="shinetext">
                <div class="mb-3 row mb-4 mt-5">
                    <div class="col-sm-12">

                            <img  height="25" src="https://www.white-force.com/onrole/job-posting-assets/shine.png" alt="">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Cities</label>
                    <div class="col-sm-9" id="shine_cities_id_div">
                    <select name="shine_cities_id[]" class=" form-control"
                        id="shine_cities_id" multiple >
                        @foreach($shinecities as $city)
                        <option value="{{ $city->id }}">{{ $city->Job_Locations }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Industry</label>
                    <div class="col-sm-9">
                        <select name="shine_industries_id" class="list-dt form-control"
                        id="shine_industries_id" required>
                        <option value="-1" selected disabled>Select Industry</option>
                        @foreach($industries as $industry)
                        <option value="{{ $industry->id }}">{{ $industry->job_industry }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Functional</label>
                    <div class="col-sm-9">
                        <select class="form-control select-single"
                        name="shine_functional_areas_id[]" id="shine_functional_areas_id" required multiple>
                       @foreach($fields as $field)
                        <option value="{{ $field->id }}">{{ $field->job_functional_area }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Select Education</label>
                    <div class="col-sm-9">
                        <select name="shine_study_field_grouping_id[]"
                        class="form-control select-single" id="shine_study_field_grouping_id"
                         onchange="getShineEducationStream(this.value)" required>
                        <option value="-1" selected disabled>Select Education Level</option>
                        @foreach($educations as $education)
                        <option value="{{ $education->id }}">{{ $education->degree }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Education Stream</label>
                    <div class="col-sm-9" id="shine_education_stream_div">
                        <select name="shine_study_id[]" class="form-control select-single"
                            id="shine_study_id" Required multiple>
                            @foreach($streams as $stream)
                            <option value="{{ $stream->id }}">{{ $stream->specialization }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Experience</label>
                    <div class="col-sm-5">
                        <select name="shine_min_experience_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_min_experience_id" Required>
                        <option value="-1" selected disabled>Select Min. Exp.</option>
                        @foreach($experience as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
                        @endforeach
                    </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="shine_max_experience_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_max_experience_id" Required>
                        <option value="">Select Max. Exp.</option>
                        @foreach($experience as $exp)
                        <option value="{{ $exp->id }}">{{ $exp->experience }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label class="col-sm-3 col-form-label">Salary</label>
                    <div class="col-sm-5">
                        <select name="shine_min_salary_id"
                                    class="list-dt form-control js-example-basic-single"
                                    id="shine_min_salary_id" id="shine_minYearExp" onchange="setMaxValue()" Required>
                                    <option value="">Select Min. Salary</option>
                                    @foreach($salary as $sal)
                                    <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
                                    @endforeach
                                </select>
                    </div>
                    <div class="col-sm-4">
                        <select name="shine_max_salary_id"
                        class="list-dt form-control js-example-basic-single"
                        id="shine_max_salary_id" Required>
                        <option value="">Select Max. Salary</option>
                        @foreach($salary as $sal)
                        <option value="{{ $sal->id }}">{{ $sal->Salary }}</option>
                        @endforeach
                    </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-9 offset-3">
                        <button type="submit" class="btn btn-primary btn-sm btn-block">Submit button</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script>
         $("#shine_cities_id").select2({
            placeholder: "Select Cities",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 10,
        });
         $("#shine_functional_areas_id").select2({
            placeholder: "Select Functional Areas",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 2,
        });
         $("#shine_study_id").select2({
            placeholder: "Select Stream",
            tags: true,
            tokenSeparators: [','],
            maximumSelectionLength: 2,
        });


        function getShineCity(shine_cities_groups_id) {
                $.get("{{ url('getShineCity') }}", {
                    shine_cities_groups_id: shine_cities_groups_id,
                }, function(response) {
                    // console.log(response);
                    $('#shine_cities_id_div').html('');
                    $('#shine_cities_id_div').html(response);
                });

            }

            function getShineEducationStream(shine_study_field_grouping_id) {
                if (shine_study_field_grouping_id) {
                    $.get("{{ url('get-specilization') }}", {
                        shine_study_field_grouping_id: shine_study_field_grouping_id,
                    }, function(response) {
                        // console.log(response);
                        $('#shine_study_id').empty();
                        for(res of response){
                            // console.log(res);
                            document.querySelector('#shine_study_id').appendChild(dynamicOptionCreate(res))
                        }
                    });
                }
            }

            function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e.specialization;
            option.value = e.id;
            return option;
        }

            function setMaxValue() {
            var minValue = $('#shine_min_salary_id').val(); // 10
            minValue++ // 11
            var options = ""
            for (minValue; minValue <= 30; minValue++) {
                options += `<option value="` + minValue + `">` + minValue + `</option>`
            }
            $('#shine_max_salary_id').html('');
            $('#shine_max_salary_id').html(options);

        }
    </script>
  </body>
</html> --}}






