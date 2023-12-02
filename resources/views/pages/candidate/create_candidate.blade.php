@extends('master.master')
@section('title', 'Add Candidate')
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <style>
        #loader-container {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: flex;
            justify-content: center;
            align-items: center;
            backdrop-filter: blur(8px);
        }

        .three-bounce {
            margin: 0;
            width: 100%;
            height: 100%;
            text-align: center;
        }

        .three-bounce .sk-child {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            background-color: var(--primary);
            border-radius: 100%;
            display: inline-block;
            -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
            animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
        }

        .three-bounce .sk-bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }

        .three-bounce .sk-bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
    </style>
    <div id="loader-container" style="display:none;">
        <div class="three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <div class="content-body">
        <div class="container-fluid">
            <div class="">
                <div class="row">
                    <div class="col-7 ">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="col-4">
                                    <h4 class="card-title text-white">Add Candidate</h4>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('candidate.store') }}" method="post" id="createCandidate"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title ">Basic Details</h4>
                                                </div>
                                                <div class="card-body" style="overflow-y: auto;">
                                                    <div class="row" style="overflow-y: auto;">

                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Full
                                                                Name:<span style="color:red">*</span>   </label>
                                                            <input type="text" class="form-control" name="name"
                                                                id="name">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">National/International:<span style="color:red">*</span></label>
                                                            <select class="default-select form-control wide"
                                                                name="nationality">
                                                                <option value="national">National</option>
                                                                <option value="international">International</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label"
                                                                style="display:block">Contact:<span style="color:red">*</span></label>
                                                            <input type="number" class="form-control" name="contact"
                                                                id="contact">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label"
                                                                style="display:block">Email:<span style="color:red">*</span></label>
                                                            <input type="email" class="form-control" name="email"
                                                                id="email">
                                                        </div>

                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Source:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control wide"
                                                                name="source">
                                                                <option value="">Select one</option>
                                                                @foreach ($sources as $source)
                                                                    <option value="{{ $source->source_name }}">
                                                                        {{ $source->source_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Notice Period:<span style="color:red">*</span>
                                                                <small class="text-primary"> select in days</small>
                                                            </label>
                                                            <select class="default-select  form-control wide"
                                                                name="notice_period">
                                                                <option value="">Select one</option>
                                                                <option value="Immediate Joiner">Immediate Joiner</option>
                                                                <option value="15">15</option>
                                                                <option value="30">30</option>
                                                                <option value="45">45</option>
                                                                <option value="60">60</option>
                                                                <option value="90">90</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Preffered Location:<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" list="location"
                                                                name="location" id="preffered_location">
                                                            <datalist id="location">
                                                                @foreach ($cities as $city)
                                                                    <option value="{{ $city->name }}"></option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Salary Type:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control wide"
                                                                name="salary_type">
                                                                <option value="">select</option>
                                                                <option value="Inr">INR</option>
                                                                <option value="usd">USD</option>
                                                                <option value="pound">POUND</option>
                                                                <option value="dirham">DIRHAM</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Industry:<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control" name="industry"
                                                                list="industry" id="industry_type">
                                                            <datalist id="industry">
                                                                @foreach ($industries as $industry)
                                                                    <option>{{ $industry->industry_name }}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Expected
                                                                Salary:<span style="color:red">*</span>
                                                                <small class="text-primary"></small>
                                                            </label>
                                                            <input type="text" class="form-control"
                                                                name="expected_salary" id="expected_salary" placeholder="">
                                                                <small>Enter Amount or X % hike on current salary</small>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Experience:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control wide"
                                                                name="experience" id="experience"
                                                                onchange="getvalue(this.value)">
                                                                <option value="">Select</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row collapse" id="experienceCompany">
                                        <div class="col-12">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h4 class="card-title">Company Details</h4>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">

                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Company
                                                                Name:</label>
                                                            <input type="text" class="form-control" id="company_name"
                                                                name="company_name" list="company_list" value="">
                                                            <datalist id="company_list" name="company_name">
                                                                <option value="  " selected>
                                                            </datalist>

                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Designation:</label>

                                                            <input type="text" class="form-control" id="designation"
                                                                name="designation" list="designation_list"
                                                                value="">
                                                            <datalist id="designation_list">
                                                                <option value="  " selected>
                                                            </datalist>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Current Salary:
                                                                <small class="text-primary"> in lakh</small>
                                                            </label>
                                                            <select name="current_salary_lakh" id="current_salary_lakh"
                                                                class="default-select  form-control wide ">
                                                                <option value="">
                                                                    Select one
                                                                </option>
                                                                @for ($i = 100000; $i <= 9900000; $i = $i + 100000)
                                                                    <option>{{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Current Salary:
                                                                <small class="text-primary"> in thousand</small>
                                                            </label>
                                                            <select class="default-select  form-control wide"
                                                                name="current_salary_thousand">
                                                                <option value="">Select one</option>
                                                                @for ($i = 0; $i <= 99000; $i = $i + 1000)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Last
                                                                Company:</label>
                                                            <input type="text" class="form-control" id="last_company"
                                                                name="last_company" list="last_company_list">
                                                            <datalist id="last_company_list">

                                                                <option value="   " selected>

                                                            </datalist>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Last
                                                                CTC:</label>
                                                            <input type="text" class="form-control" name="last_ctc"
                                                                id="last_ctc">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Total Experience:
                                                                <small class="text-primary"> in years</small>
                                                            </label>
                                                            <select class="default-select  form-control wide"
                                                                name="total_experience_year">
                                                                <option value="">Select one</option>
                                                                @for ($i = 0; $i <= 60; $i++)
                                                                    <option value="{{ $i }}">{{ $i }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Total Experience:
                                                                <small class="text-primary"> in months</small>
                                                            </label>
                                                            <select class="default-select  form-control wide"
                                                                name="total_experience_month">
                                                                <option value="">Select one</option>
                                                                @for ($i = 0; $i <= 11; $i++)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}
                                                                    </option>
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
                                                        <div class="col-md-6 col-4 mb-2">
                                                            <label class="col-form-label">Education Type:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control "
                                                                name="education_type" onchange="getType(this.value)"
                                                                id="education_type">
                                                                <option value="">Select Education</option>
                                                                <option value="Below10th">Below 10th grade</option>
                                                                <option value="10th">10th grade in high school</option>
                                                                <option value="12th">High Secondary 12th</option>
                                                                <option value="diploma">Diploma</option>
                                                                <option value="graduate">Graduated</option>
                                                                <option value="post graduate">Post Graduated</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-4 mb-2">
                                                            <label class="col-form-label" style="display:block">Education
                                                                Year:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control "
                                                                name="education_year" id="education_year">
                                                                <option value="">Select year</option>
                                                                @for ($i = 2024; $i > 1950; $i--)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-4 mb-2">
                                                            <label class="col-form-label" style="display:block">Education
                                                                Name:<span style="color:red">*</span></label>
                                                            <input type="text" class="form-control"
                                                                id="education_name" name="education_name"
                                                                list="education_list" readonly value="">
                                                            <datalist id="education_list">
                                                                <option value="">
                                                                </option>
                                                                @foreach ($degrees as $degree)
                                                                    <option>{{ $degree->degree_name }}</option>
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
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Gender:<span style="color:red">*</span></label>
                                                            <select class="  form-control wide" name="gender"
                                                                id="gender">
                                                                <option value="">Select one</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Marital Status:<span style="color:red">*</span></label>
                                                            <select name="marital_status" id="marital_status"
                                                                class="default-select  form-control wide">
                                                                <option value="">
                                                                    Select One
                                                                </option>
                                                                <option value="married">Married</option>
                                                                <option value="unmarried">Unmarried</option>
                                                                <option value="widowed">Widowed</option>
                                                                <option value="divorced">Divorced</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Aadhar
                                                                Card:</label>
                                                            <input type="text" class="form-control" name="aadhar">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Pan
                                                                Card:</label>
                                                            <input type="text" class="form-control" name="pan">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Willing to Relocate:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control wide"
                                                                name="relocate">
                                                                <option value="">Select one</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Select your Language:<span style="color:red">*</span></label>
                                                            <select class="single-select "
                                                                name="language[]" multiple="multiple" id="languange"
                                                                required>
                                                                @foreach ($languages as $language)
                                                                    <option value="{{ $language->language }}">
                                                                        {{ $language->language }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label">Communication:<span style="color:red">*</span></label>
                                                            <select name="communication" id="communication"
                                                                class="default-select  form-control wide">
                                                                <option value="">Select One</option>
                                                                <option value="excellent">Excellent</option>
                                                                <option value="good">Good</option>
                                                                <option value="average">Average</option>
                                                                <option value="poor">Poor</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Date of
                                                                Birth:<span style="color:red">*</span></label>
                                                            <input type="date" name="date_of_birth"
                                                                class="form-control" id="date_of_birth">
                                                        </div>
                                                        <div class="col-md- col-12 mb-2">
                                                            <label class="col-form-label">Skills:<span style="color:red">*</span></label>
                                                            <select class="default-select  form-control wide "
                                                                name="skills[]" multiple="multiple" id="skills"
                                                                required>
                                                            </select>
                                                            <small class="text-primary">Press Comma "," or enter after you
                                                                enter
                                                                any skill</small>
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
                                                        <div class="col-md-4 col-4 mb-2">
                                                            <label class="col-form-label">Country:<span style="color:red">*</span></label>
                                                            <select class="default form-control wide" name="country"
                                                                id="country" onchange="getStateList();">
                                                                <option value="getStateList" selected>Select Country</option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-4 mb-2">
                                                            <label class="col-form-label">State:<span style="color:red">*</span></label>
                                                            <select class="form-control" name="state" id="state"
                                                                onchange="getCityList();">
                                                                <option value=""> State</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-4 mb-2">
                                                            <label class="col-form-label">City:<span style="color:red">*</span></label>
                                                            <select class="form-control wide" name="city"
                                                                id="city">
                                                                <option value=""> City</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label"
                                                                style="display:block">Address:<span style="color:red">*</span></label>
                                                            <input type="text" name="address" id="address"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2">
                                                            <label class="col-form-label" style="display:block">Postal
                                                                Code:</label>
                                                            <input type="text" name="postel_code"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="text" hidden id="json_row" name="json_row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block disableBtnAfterSubmit">ADD
                                                        CANDIDATE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5" style="height:820px;" id="stickytypeheader">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <div class="card-title text-white">Resume</div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 col-12 mb-2">
                                    <label class="col-form-label" style="display:block">Select your
                                        Resume:<span style="color:red">*</span>
                                        <small class="text-primary"> select pdf file only</small>
                                    </label>
                                    <div class="input-group ">
                                        <div class="form-file">
                                            <input type="file" class="form-file-input form-control" name="resume"
                                                accept="application/pdf" id="resume" required>
                                        </form>
                                        </div>
                                    </div>
                                </div>

                                <div id="resumePreview" align="center">
                                    @include('master.404')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>


        // $('#country').val(101);
        // getStateList();

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
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });
        }
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
                    $('.disableBtnAfterSubmit').prop('disabled', false);
                    error.insertBefore(element);

                },
                submitHandler: function(form) {
                    $('.disableBtnAfterSubmit').prop('disabled', true);
                    form.submit();
                }

            });
        });

        // skills selection jquery //
        $("#skills").select2({
            tags: true,
            tokenSeparators: [','],

        });




        // Experience company //

        function getvalue(e) {
            const experienceCompany = document.querySelector('#experienceCompany');
            if (e == "yes") {
                experienceCompany.style.display = "block";
            } else {
                experienceCompany.style.display = "none";
            }
        }

        //Education Type //

        function getType(e) {
            const education_name = document.querySelector('#education_name');
            if (e == "Below10th") {
                education_name.value = e;
                education_name.readOnly = true;
            } else if (e == "10th") {
                education_name.value = e;
                education_name.readOnly = true;
            } else if (e == "12th") {
                education_name.value = e;
                education_name.readOnly = true;
            } else {
                education_name.value = "";
                education_name.readOnly = false;
            }

        }


        // Resume parser json save function for add candidate//
        const loaderContainer = document.getElementById('loader-container');
        const content = document.getElementById('.content-body');
        const candidate = document.querySelector('#createCandidate');
        const previewContainer = document.getElementById('resumePreview');
        let resume = document.querySelector('#resume');
        let loader = document.querySelector('#loader');
        resume.addEventListener('change', function(e) {
            e.preventDefault();
            var loader = document.querySelector('#loader-container');
            loader.style.display = "block";
            var file = document.querySelector('#resume').files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.createElement('iframe');
                    preview.src = e.target.result;
                    preview.width = '450px';
                    preview.height = '800px';
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
            const formData = new FormData();
            formData.append('resume', file, 'userFile.pdf');
            var a = new Promise((resolve, reject) => {
                fetch('https://happyhire.co.in/new_resume/api', {
                        method: "POST",
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        loader.style.display = "none";
                        var x = data;
                        console.log(x);
                        document.querySelector('#json_row').value = JSON.stringify(x.data);
                        document.querySelector('#name').value = x.data.Name[0];
                        var skills = x.data.Skills;
                        for (skill of skills) {
                            document.querySelector('#skills').add(dynamicOptionCreate(skill));
                        }
                        var phone= x.data.Phone[0];
                            phone=phone.replace("+91", "");
                            phone=parseInt(phone);
                        document.querySelector('#contact').value =phone;
                        document.querySelector('#email').value = x.data.Email;
                        document.querySelector('#address').value = x.data.Address;
                        var company = x.data.work_experience;
                        console.log(document.querySelector('#last_company_list'));
                        console.log(document.querySelector('#designation_list'));
                        console.log(document.querySelector('#company_list'));
                        for (details of company) {
                            document.querySelector('#company_list').appendChild(dynamicOptionCreate(
                                details
                                .Work_Organisation));
                            document.querySelector('#designation_list').appendChild(dynamicOptionCreate(
                                details.Work_Desgination));
                            document.querySelector('#last_company_list').appendChild(
                                dynamicOptionCreate(details
                                    .Work_Organisation));
                        }
                        document.querySelector('#date_of_birth').value = date;
                        document.querySelector('#gender').add(dynamicOptionCreate(x.data.Gender[0]));

                    })
                    .catch(err =>{
                        loader.style.display = "none";

                    } );
            });
        })

        function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            if(e==undefined){
                e="";
            }
            option.text = e;
            option.value = e;
            option.selected = true;
            return option;
        }


        $(function() {
            var stickyHeaderTop = $('#stickytypeheader').offset().top;
            $(window).scroll(function() {
                if ($(window).scrollTop() > stickyHeaderTop) {
                    $('#stickytypeheader').css({
                        position: 'fixed',
                        top: '0px',
                        right: '-12px'
                    });
                    $('#sticky').css('display', 'block');
                } else {
                    $('#stickytypeheader').css({
                        position: 'static',
                        top: '0px'
                    });
                    $('#sticky').css('display', 'none');
                }
            });
        });

        // date of birth validation //
    </script>
@endsection
