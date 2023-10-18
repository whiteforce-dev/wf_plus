@extends('master.master')
@section('title', 'Edit Candidate')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="row">
                <div class="col-xl-7 col-lg-12">
                    <div class="card ">
                        <div class="card-header bg-primary ">
                            <h4 class="card-title text-white">Edit Candidate</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('candidate.update',$candidate->id) }}" method="post" id="createCandidate" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Basic Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Full Name:</label>
                                                        <input type="text" class="form-control" name="name"
                                                        value="{{ $candidate->name }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">National/International:</label>
                                                        <select class="default-select  form-control wide" name="nationality"
                                                            >
                                                            <option value="1">National</option>
                                                            <option value="2">International</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Contact:</label>
                                                        <input type="text" class="form-control"
                                                        name="contact"
                                                        value="{{ $candidate->mobile }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Email:</label>
                                                        <input type="email" class="form-control"
                                                        name="email"
                                                        value="{{ $candidate->email }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Source:</label>
                                                        <select class="default-select  form-control wide" name="source"
                                                            >
                                                            <option value="{{ $candidate->source }}">{{ $candidate->source }}</option>
                                                            @foreach($sources as $source)
                                                            <option >{{ $source->source_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Notice Period:
                                                            <small class="text-primary"> select in days</small>
                                                        </label>
                                                        <select class="default-select  form-control wide" name="notice_period"
                                                            >
                                                            <option value="{{ $candidate->notice_period }}">{{ $candidate->notice_period }}</option>
                                                            <option value="Immediate Joiner">Immediate Joiner</option>
                                                            <option value="15">15</option>
                                                            <option value="30">30</option>
                                                            <option value="45">45</option>
                                                            <option value="60">60</option>
                                                            <option value="90">90</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Preffered Location:</label>
                                                        <input type="text"class="form-control"list="location"name="location"
                                                        value="{{ $candidate->preferred_location }}">
                                                        <datalist  id="location">
                                                            @foreach($cities as $city)
                                                            <option value="{{ $city->name }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Experience:</label>
                                                        <select class="default-select  form-control wide" name="experience"
                                                        id="experience"
                                                        onchange="getvalue(this.value)">
                                                            <option value="{{ $candidate->experience }}">Select</option>
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Salary Type:</label>
                                                        <select class="default-select  form-control wide" name="salary_type">

                                                            <option value="Inr" {{ $candidate->salary_type == '-' ? 'selected' : '' }}>INR</option>
                                                            <option value="Usd" {{ $candidate->salary_type == '-' ? 'selected' : '' }}>USD</option>
                                                            <option value="pound" {{ $candidate->salary_type == '-' ? 'selected' : '' }}>POUND</option>
                                                            <option value="dirham" {{ $candidate->salary_type == '-' ? 'selected' : '' }}>DIRHAM</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label" style="display:block">Expected Salary:
                                                            <small class="text-primary"> </small>
                                                        </label>
                                                        <input type="text"class="form-control"name="expected_salary" value="{{ $candidate->expected_salary }}" placeholder="">
                                                        <small>Enter Amount or X % hike on current salary</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row " id="experienceCompany">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Company Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <!-- <div class="col-6">
                                                        <label class="col-form-label">Industry:</label>
                                                        <input type="text" class="form-control"
                                                        name="industry" list="industry"
                                                        value="{{ $candidate->industry }}">
                                                        <datalist id="industry">
                                                            @foreach($industries as $industry)
                                                            <option >{{ $industry->industry_name }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div> -->
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Company Name:</label>
                                                        <input type="text" class="form-control"
                                                        name="company_name"
                                                        value="{{ $candidate->current_company }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Designation:</label>
                                                        <input type="text" class="form-control"
                                                        name="designation"
                                                        list="designation"
                                                        value="{{ $candidate->current_title}}">
                                                        <datalist id="designation">
                                                            @foreach($positions as $position)
                                                            <option value="{{ $position->position_name }}"></option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Current Salary:
                                                            <small class="text-primary"> in lakh</small>
                                                        </label>
                                                        <select name="current_salary_lakh" id="current_salary_lakh" class="default-select  form-control wide ">
                                                            <option value="{{ $salaryInLakh }}">
                                                                {{ $salaryInLakh}}
                                                            </option>
                                                            @for($i=100000;$i<=9900000;$i=$i+100000)
                                                            <option>{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Current Salary:
                                                            <small class="text-primary"> in thousand</small>
                                                        </label>
                                                        <select class="default-select  form-control wide" name="current_salary_thousand"
                                                            >
                                                            <option value="{{ $salaryInThousand }}">{{ $salaryInThousand }}</option>
                                                            @for($i=0;$i<=99000;$i=$i+1000)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Last Company:</label>
                                                        <input type="text" name="last_company"
                                                        class="form-control"
                                                        value="{{ $candidate->last_company }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label" style="display:block">Last CTC:</label>
                                                        <input type="text"class="form-control" name="last_ctc"
                                                        value="{{$candidate->last_ctc  }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Total Experience:
                                                            <small class="text-primary"> in years</small>
                                                        </label>
                                                        <select class="default-select  form-control wide" name="total_experience_year">
                                                            <option value="{{ substr($candidate->total_experience,0,1) }}">{{ substr($candidate->total_experience,0,1) }}</option>
                                                            @for($i=0;$i<=60;$i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Total Experience:
                                                            <small class="text-primary"> in months</small>
                                                        </label>
                                                        <select class="default-select  form-control wide" name="total_experience_month">
                                                            <option value="{{ substr($candidate->total_experience,2) }}">{{ substr($candidate->total_experience,2) }}</option>
                                                            @for($i=0;$i<=11;$i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Education Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="col-form-label">Education Type:</label>
                                                        <select class="default-select  form-control wide" name="education_type"onchange="getType(this.value)" id="education_type"
                                                        >
                                                        <option value="{{ $candidate->highest_qualification_type }}">{{ $candidate->highest_qualification_type }}</option>
                                                        <option value="Below10th">Below 10th grade</option>
                                                        <option value="10th"> 10th grade in high school</option>
                                                        <option value="12th">High Secondary 12th</option>
                                                        <option value="diploma">Diploma</option>
                                                        <option value="graduate">Graduated:You hold a college degree</option>
                                                        <option value="post graduate">Post Graduated: You recived a master's degree or phD</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Education Year:</label>
                                                        <select class="default-select  form-control wide"
                                                        name="education_year"
                                                        id="education_year">
                                                        <option value="{{ $candidate->highest_qualification_year }}">{{ $candidate->highest_qualification_year }}</option>
                                                        @for($i=1942;$i<=2024;$i++)
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endfor
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Education Name:</label>
                                                        <input type="text" class="form-control"
                                                        id="education_name" name="education_name" list="education_list"
                                                        value="{{ $candidate->highest_qualification }}" readonly>
                                                        <datalist id="education_list">
                                                            @foreach($degrees as $degree)
                                                            <option >{{ $degree->degree_name }}</option>
                                                            @endforeach
                                                        </datalist>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Personal Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label class="col-form-label">Gender:</label>
                                                        <select class="default-select  form-control wide" name="gender"
                                                            >
                                                            <option value="male" {{ $candidate->gender == '-' ? 'selected' : '' }}>Male</option>
                                                            <option value="female" {{ $candidate->gender == '-' ? 'selected' : '' }}>Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Marital Status:</label>
                                                        <select name="marital_status" id="marital_status"
                                                        class="default-select  form-control wide">

                                                            <option value="married" {{ $candidate->marital_status == '-' ? 'selected' : '' }}>Married</option>
                                                            <option value="unmarried" {{ $candidate->marital_status == '-' ? 'selected' : '' }}>Unmarried</option>
                                                            <option value="widowed" {{ $candidate->marital_status == '-' ? 'selected' : '' }}>Widowed</option>
                                                            <option value="divorced" {{ $candidate->marital_status == '-' ? 'selected' : '' }}>Divorced</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Aadhar Card:</label>
                                                        <input type="text" class="form-control"
                                                        name="aadhar" value="{{ $candidate->aadhar_card }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Pan Card:</label>
                                                        <input type="text" class="form-control"
                                                        name="pan" value="{{ $candidate->pan_card }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Willing to Relocate:</label>
                                                        <select class="default-select  form-control wide" name="relocate"
                                                            >
                                                            <option value="yes" {{ $candidate->is_relocate == '-' ? 'selected' : '' }}>Yes</option>
                                                            <option value="no" {{ $candidate->is_relocate == '-' ? 'selected' : '' }}>No</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">Select your Language:</label>
                                                        <select class="single-select" name="language[]"
                                                        multiple="multiple"
                                                        id="languange"
                                                        required
                                                           >
                                                            @php
                                                            $lang = explode(",", $candidate->languages);
                                                            @endphp

                                                            @foreach($languages as $language)
                                                                @foreach($lang as $l)
                                                                    @if($l==$language->language)
                                                                    <option value="{{ $language->language }}"{{$language->language == $l ? 'selected' : '' }}>{{ $language->language}}</option>
                                                                    @endif
                                                                @endforeach
                                                                    <option value="{{ $language->language }}">{{ $language->language}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label">Communication:</label>
                                                        <select name="communication" id="communication"
                                                        class="default-select  form-control wide">

                                                            <option value="excellent" {{ $candidate->communication  == '-' ? 'selected' : '' }}>Excellent</option>
                                                            <option value="good" {{ $candidate->communication  == '-' ? 'selected' : '' }}>Good</option>
                                                            <option value="average" {{ $candidate->communication  == '-' ? 'selected' : '' }}>Average</option>
                                                            <option value="poor" {{ $candidate->communication  == '-' ? 'selected' : '' }}>Poor</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label" style="display:block">Date of Birth:</label>
                                                        <input type="date" name="date_of_birth" class="form-control" value="{{ $candidate->date_of_birth }}">
                                                    </div>
                                                    <div class="col-12">
                                                        <label  class="col-form-label">Skills:</label>
                                                        <select class="default-select  form-control wide " name="skills[]" multiple="multiple"
                                                        id="skills" required>
                                                        @php
                                                        $skills = explode(",", $candidate->skills);
                                                        @endphp
                                                        @foreach($skills as $skill)
                                                                <option value="{{ $skill }}" selected>{{$skill}}</option>
                                                        @endforeach
                                                        </select>
                                                        <small class="text-primary">Press Comma "," or enter after you enter any skill</small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Location Details</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    {{-- <div class="col-6">
                                                        <label class="col-form-label">Country:</label>
                                                        <select class="default form-control wide" name="country" id="country" onchange="getState();">
                                                            <option  value="{{ $countryId }}">{{ $candidate->country }}</option>
                                                            @foreach($countries as $country)
                                                            <option  value="{{ $country->id }}">{{ $country->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">State:</label>
                                                        <select class="form-control" name="state" id="state"
                                                        onchange="getCity();locChange(this);">
                                                        <option value="{{ $stateId }}"> {{ $candidate->state }}</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label">City:</label>
                                                        <select class="form-control wide" name="city" id="city">
                                                            <option value="{{ $cityId }}">{{ $candidate->city }}</option>
                                                        </select>
                                                    </div> --}}


                                                    <div class="col-md-4 col-4 mb-2">
                                                        <label class="col-form-label">Country:</label>
                                                        <select class="default form-control wide" name="country"
                                                            id="country" onchange="getStateList();">
                                                            <option value="getStateList">Country</option>
                                                            @foreach ($countries as $country)
                                                                <option value="{{ $country->id }}">
                                                                    {{ $country->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-4 mb-2">
                                                        <label class="col-form-label">State:</label>
                                                        <select class="form-control" name="state" id="state"
                                                            onchange="getCityList();">
                                                            <option value=""> State</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4 col-4 mb-2">
                                                        <label class="col-form-label">City:</label>
                                                        <select class="form-control wide" name="city"
                                                            id="city">
                                                            <option value=""> City</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-6">
                                                        <label class="col-form-label" style="display:block">Address:</label>
                                                        <input type="text" name="address" id="address" class="form-control"
                                                        value="{{ $candidate->address }}">
                                                    </div>
                                                    <div class="col-6">
                                                        <label  class="col-form-label" style="display:block">Postal Code:</label>
                                                        <input type="text" name="postel_code" class="form-control"
                                                    value="{{ $candidate->pin_code }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary btn-block" >EDIT CANDIDATE</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
                <div class="col-5" id="stickytypeheader">
                    <div class="card" style="height:1200px;">
                        <div class="card-header bg-primary">
                            <h4 class="card-title text-white">Resume</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                <label  class="col-form-label" style="display:block">Uploaded Resume:

                                </label>
                                <div class="input-group ">
                                    <div class="" id="addClass" >
                                        <input type="file" class="form-file-input form-control collapse"
                                        name="resume"
                                        value="{{ $candidate->resume_file }}"
                                        id="changed_resume_file" accept="application/pdf" onchange="changeResume()">
                                    </div>
                                    @php
                                    $resume=substr($candidate->resume_file,18);
                                    @endphp
                                    <input type="text" class="form-file-input form-control"
                                        name="resume"
                                        value="{{ $resume }}" id="previousFile"
                                        disabled>
                                        <button class="btn btn-primary" id="change_resume" type="button">change</button>
                                </div>
                            </div>
                            <div id="resumePreview" class="mt-4" >
                                <iframe id="file-viewer" class="col-12" style="height:700px;" src="{{ $candidate->resume_file }}"></iframe>
                            </div>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>


        var countries = {{ Js::from( $candidate->country) }}
        $('#country option:contains("' + countries + '")').prop('selected', true);
        getStateList();




        function getStateList(){
            const countryId = $('#country').val(); // Replace with the desired country ID

            $.ajax({
                url: "{{ url('get-state') }}" +"/"+ countryId,
                type: 'GET',
                success: function(response) {
                    // Handle the response containing the state list
                    console.log(response);
                    // Handle the response containing the state list
                    const selectElement = $('#state');

                    // Clear previous options
                    selectElement.empty();

                    // Append new options
                    const option = $('<option>').val('').text('Select State');
                    selectElement.append(option);
                    $.each(response, function(id, name) {
                        const option = $('<option>').val(id).text(name);
                        selectElement.append(option);
                    });

                    var state = {{ Js::from($candidate->state) }}
                    $('#state option:contains("' + state + '")').prop('selected', true);

                    getCityList();
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });

        }
        function getCityList(){
            const stateId = $('#state').val(); // Replace with the desired country ID
            $.ajax({
                url: "{{ url('get-city') }}" +"/"+ stateId,
                type: 'GET',
                success: function(response) {
                    // Handle the response containing the state list
                    console.log(response);
                    // Handle the response containing the state list
                    const selectElement = $('#city');

                    // Clear previous options
                    selectElement.empty();

                    // Append new options
                    const option = $('<option>').val('').text('Select City');
                    selectElement.append(option);
                    $.each(response, function(id, name) {
                        const option = $('<option>').val(id).text(name);
                        selectElement.append(option);
                    });

                    var city = {{ Js::from($candidate->city) }}
                    $("#city option").filter(function() {
                            return $(this).text() === city;
                            }).prop("selected", true);
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });
        }






    // form validation //
    var element = document.querySelector('#date_of_birth');
        let value;
        $.validator.addMethod("isTrue", function(value, element1) {

            var currentDate = new Date();
            var currentYear = currentDate.getFullYear();
            var userDate = new Date(value);
            var userYear = userDate.getFullYear();
            var res = currentYear - userYear;

            if (res >= 15) {
                return true;
            } else {
                return false;
            }

        }, "Please enter a valid date of birth.");

        function containsNumericCharacter(str) {
            return /\d/.test(str);
        }
        $.validator.addMethod("validName", function(value, el) {
            if(containsNumericCharacter(value)){
                return false;
            }
            else{
                return true;
            }
             }, "Name cannot contain numbers.");

        function validateDateOfBirth(dateOfBirth) {

        }

        // form validation //
        $(document).ready(function($) {

            $("#createCandidate").validate({
                rules: {
                    submit_as: "required",
                    name: {
                        required: true,
                        validName:true
                    },
                    nationality: "required",
                    contact: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    apply_for: "required",
                    source: "required",
                    notice_period: "required",
                    location: "required",
                    experience: "required",
                    salary_type: "required",
                    expected_salary: "required",
                    resume: "required",
                    "skills[]": {
                        required: true
                    },
                    // industry:"required",
                    // company_name:"required",
                    // designation:"required",
                    // current_salary_lakh:"required",
                    // current_salary_thousand:"required",
                    // last_company:"required",
                    // last_ctc:"required",
                    // total_experience_year:"required",
                    // total_experience_month:"required",
                    education_type: "required",
                    education_year: "required",
                    gender: "required",
                    marital_status: "required",
                    relocate: "required",
                    communication: "required",
                    date_of_birth: {
                        isTrue: true
                    },
                    country: 'required',
                    state: 'required',
                    city: 'required',
                    address: 'required',

                },
                messages: {
                    submit_as: "*Please select any one field",
                    name:{
                        required: "*Please enter your Name",
                        validName:"Name cannot contain numbers"
                    }
                    ,
                    nationality: "*Please select nationality",
                    contact: {
                        required: "*Please enter your phone number",
                        minlength: "*Please enter your valid phone number",
                        maxlength: "*Please enter your valid phone number",
                    },
                    email: {
                        required: "*Please enter your email address",
                        email: "*Please enter your valid email address",
                    },
                    apply_for: "*Please select any one field",
                    source: "*Please select any one field",
                    notice_period: "*Please select any one field",
                    location: "*Please select any one field",
                    experience: "*Please select any one field",
                    salary_type: "*Please select any one field",
                    expected_salary: "*Please enter your expected salary ",
                    resume: "*Please select your resume file",
                    "skills[]": "*Please select your skills",
                    // industry:"required",
                    // company_name:"required",
                    // designation:"required",
                    // current_salary_lakh:"required",
                    // current_salary_thousand:"required",
                    // last_company:"required",
                    // last_ctc:"required",
                    // total_experience_year:"required",
                    // total_experience_month:"required",
                    education_type: "*Please select any one field",
                    education_year: "*Please select any one field",
                    gender: "*Please select any one field",
                    marital_status: "*Please select any one field",
                    relocate: "*Please select any one field",
                    communication: "*Please select any one field",
                    date_of_birth: {
                        isTrue: "Please enter a valid date of birth."
                    },
                    country: "*Please select any one field",
                    state: "*Please select any one field",
                    city: "*Please select any one field",
                    address: '*Please enter your address',

                },
                errorPlacement: function(error, element) {

                    error.insertBefore(element);

                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });
            // skills selection jquery //
            $("#skills").select2({
                    tags: true,
                    tokenSeparators: [',', ' '],

                });


        $(function(){
        var stickyHeaderTop = $('#stickytypeheader').offset().top;

        $(window).scroll(function(){
                if( $(window).scrollTop() > stickyHeaderTop ) {
                        $('#stickytypeheader').css({position: 'fixed', top: '0px', right: '-12px'});
                        $('#sticky').css('display', 'block');
                } else {
                        $('#stickytypeheader').css({position: 'static', top: '0px'});
                        $('#sticky').css('display', 'none');
                }
        });
    });

     //change candidate resume  function //
     const btn=document.querySelector('#change_resume');
     var resume=document.querySelector('#changed_resume_file');
        function changeResume(){
        var file = resume.files[0];
        console.log(file);
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                const preview = document.querySelector('#file-viewer');
                preview.src = e.target.result;
                preview.width = '450px';
                preview.height = '1200px';
                previewContainer.innerHTML = '';
                previewContainer.appendChild(preview);
            }
            reader.readAsDataURL(file);
        }
     }
    btn.addEventListener('click',()=>{
        resume.click();
        resume.classList.remove('collapse');
        var design="form-file";
        document.querySelector('#addClass').classList.add(design);
        document.querySelector('#previousFile').classList.add('collapse');
        btn.classList.add('collapse');
    });

 // language selection jquery //
    $('#languange').select2({
                tags: true,
                tokenSeparators: [','],
                aria:hidden,
            });

    // Experience company //

    function getvalue(e){
        const experienceCompany=document.querySelector('#experienceCompany');
        if(e=="yes"){
            experienceCompany.style.display="block";
        }
        else{
            experienceCompany.style.display="none";
        }
    }

    //Education Type //

    function getType(e){
        const education_name=document.querySelector('#education_name');
            if(e=="Below10th"){
                education_name.value=e;
                education_name.readOnly=true;
            }
            else if(e=="10th"){
                education_name.value=e;
                education_name.readOnly=true;
            }
            else if(e=="12th"){
                education_name.value=e;
                education_name.readOnly=true;
            }
            else{
                education_name.value="";
                education_name.readOnly=false;
            }

    }


    function getState() {

        var country_id = $('#country').val();
            $.get("{{ url('getState') }}", {
            country: country_id,
            }, function(response) {
            console.log(response);
            $('#state').html(response);
            });
            };

    function getCity() {
        var state_id = $('#state').val();
            $.get("{{ url('getCity') }}", {
                state: state_id,
            }, function(response) {
                // console.log(response);
                $('#city').html(response);
            });
            };


</script>
@endsection
