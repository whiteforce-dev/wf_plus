<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

?>



<div id="shinetext" class="col-sm-12">
    <hr>

    <center>
        <img class="img-logo" src="{{ url('logo/shine.png') }}" width="100">
    </center>
    <br>
    <form action="{{ url('newPositionStore/1') }}" id="shine" method="post">
        @csrf
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
                <select name="shine_cities_id[]" onchange="getCityValue();" class="select-single form-control"
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

</div>
<button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
</form>
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
<link href="{{ url('/assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script>


    function getShineCity(shine_cities_groups_id) {

            $.get("{{ url('getShineCity') }}", {
                shine_cities_groups_id: shine_cities_groups_id,
            }, function(response) {
                $('#shine_cities_id').html(response);
            });

        }

        function getShineEducationStream(shine_study_field_grouping_id) {
            if (shine_study_field_grouping_id) {
                $.get("{{ url('getShineEducationStream') }}", {
                    shine_study_field_grouping_id: shine_study_field_grouping_id,
                }, function(response) {
                    // console.log(response);
                    $('#shine_study_id').html(response);
                });
            }
        }


    let shine_cities_groups_id=document.querySelector('#shine_cities_groups_id');
    let shine_cities_id=document.querySelector('#shine_cities_id');
    let shine_industries_id=document.querySelector('#shine_industries_id');
    let shine_functional_areas_id=document.querySelector('#shine_functional_areas_id');
    let shine_study_field_grouping_id=document.querySelector('#shine_study_field_grouping_id');
    let shine_study_id=document.querySelector('#shine_study_id');
    let shine_min_experience_id=document.querySelector('#shine_min_experience_id');
    let shine_max_experience_id=document.querySelector('#shine_max_experience_id');
    let shine_min_salary_id=document.querySelector('#shine_min_salary_id');
    let shine_max_salary_id=document.querySelector('#shine_max_salary_id');
    let btn=document.querySelector('#submitBtn');
    // btn.addEventListener('click',()=>{
    //     console.log(shine_cities_groups_id.value);
    //     console.log(shine_cities_id.value);
    //     console.log(shine_industries_id.value);
    //     console.log(shine_functional_areas_id.value);
    //     console.log(shine_study_field_grouping_id.value);
    //     console.log(shine_study_id.value);
    //     console.log(shine_min_experience_id.value);
    //     console.log(shine_max_experience_id.value);
    //     console.log(shine_min_salary_id.value);
    //     console.log(shine_max_salary_id.value);
        // $.ajax({
        //     url:"https://recruiter.shine.com/api/v4/job/",
        //     type:"POST",
        //     headers:{
        //         username: "HSO",
        //         password: 'Force@123',
        //     },
        //     data:{
        //         job_id:"1",
        //         jobtitle:"laravel developer",
        //         description:"sdfasdfsdfsfd"
        //     },
        //     beforeSend:()=>{

        //     },
        //     success:(response,status)=>{
        //         console.log(response)
        //     },
        //     error:(error,status)=>{
        //         console.log(error);
        //     },
        // });
    // })


    // $(prefferedLocation).on('click',()=>{
    //     $.ajax({
    //         url:'api/jobLocation',
    //         type:"GET",
    //         beforeSend:()=>{

    //         },
    //         success:(response,status)=>{
    //             if(flag8){
    //                 console.log(response.data);
    //                 for(x of response.data ){
    //                     // console.log(x.city_name);
    //                     var ele=document.createElement('option');
    //                     ele.value=x.city_name;
    //                     locationList.appendChild(ele);
    //                 }
    //             }
    //             flag8=false;

    //         },
    //         error:(error,status)=>{
    //             console.log(error);
    //         },
    //     });
    // });


    function getCityValue(){
        console.log($('#shine_cities_id').val());
    }
</script>
@php

@endphp



