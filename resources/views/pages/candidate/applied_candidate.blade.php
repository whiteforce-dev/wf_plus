<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <!-- <link rel="stylesheet" href="https://zenix.dexignzone.com/xht  ml/css/style.css" /> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css">
</head>


<style>
    .header-custom {

        position: sticky;
        width: 100% !important;
        top: 0;
        left: 0;
        right: 0;
        margin: 0 auto;
        padding: 0;
        z-index: 99;
        margin-left: 0 !important;
        margin-right: 0 !important;
        margin-top: 25px !important;
    }

    .jd {

        max-height: 400px;
        overflow-y: scroll;
    }

    .jd::after {}

    .modalCustom {
        margin: 0px 0px;
    }
    .scrollable-content {
    overflow: scroll; /* Enable scrolling */
    scrollbar-width: thin; /* Set the width of the scroll bar */
    scrollbar-color: transparent transparent; /* Set the color of the scroll bar */
    }
    /* Hide the scroll bar */
    .scrollable-content::-webkit-scrollbar {
    width: 0.5em; /* Set the width of the scroll bar */
    }

    .scrollable-content::-webkit-scrollbar-thumb {
    background-color: transparent; /* Set the color of the thumb */
    }

    .scrollable-content::-webkit-scrollbar-track {
    background-color: transparent; /* Set the color of the track */
    }
    .error{
        color:red;
    }
    label{
        font-weight: bold;
        color:rgb(107, 107, 107);
    }
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


</style>
<div id="loader-container" style="display:none;">
    <div id="loader">
        <h5 style="text-align: center;"><img
                src="{{ url('assets/images/agif.gif') }}"height="100px" width="100px"><br>
            <h4
                style="text-align: center;color:#fcfcfc">
                Please Wait...</h4>
        </h5>
    </div>
</div>
<body>
    <div class="form-body">
        <div class="container">
            <div class="card header-custom image-wrapper bg-full bg-image bg-overlay mt-n50p mx-md-5 background-color:"
                style=" background-color:rgb(32, 32, 83) ;">
                <div style="position: relative;"
                    class="card-body p-6 p-md-11 d-lg-flex flex-row align-items-lg-center justify-content-md-between text-center text-lg-start">
                    <div class="widget" style="text-align:left;z-index: 2;">
                        <img class="mb-4 mt-3" style="color:#fff"
                            srcset="https://www.white-force.com/assets/img/white-force-logo.png 1x" alt="">

                    </div>
                    <h4 class="text-white text-center" style=" z-index:2;">Applied Candidate Form</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-7 leftDiv">
                    <div class="left-section">
                        <form action="{{ url('applied_candidate') }}"method="post" id="appliedCandidate"
                        enctype="multipart/form-data">
                        @csrf
                            <section class="bg-bright section-frame ">
                                <div class="container"><br>
                                    <div class="heading">
                                        <div class="floating">
                                            <h4 class="text">Basic Details
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Resume</label>
                                                    <input type="text" id="json_row" name="json_row" hidden>
                                                    <input type="text" id="job_id" name="job_id" value="{{ $jobId }}" hidden>
                                                    <input type="text" id="portal_name" name="portal_name" value="{{ $portalName }}" hidden>
                                                    <input type="text" id="category" name="category" value="{{ $category }}" hidden>
                                                    <input type="file" id="resume"class="form-control"
                                                      accept="application/pdf" name="resume">
                                                </div>
                                            </div>

                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Full Name</label>

                                                    <input type="text" class="form-control" name="name"
                                                    id="name">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="row mb-2">

                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Contact</label>

                                                    <input type="number" class="form-control" name="contact"
                                                    id="contact">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Email</label>

                                                    <input type="email" class="form-control" name="email"
                                                    id="email">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Preffered
                                                        Location</label>
                                                        <input type="text" class="form-control" list="location"
                                                        name="location" id="preffered_location">
                                                    <datalist id="location">
                                                        @foreach ($cities as $city)
                                                            <option value="{{ $city->name }}"></option>
                                                        @endforeach
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Notice Period</label>
                                                    <select class="default-select  form-control wide"
                                                                name="notice_period">
                                                                <option value="">Select one</option>
                                                                <option value="0">Immediate Joiner</option>
                                                                <option value="15">15</option>
                                                                <option value="30">30</option>
                                                                <option value="45">45</option>
                                                                <option value="60">60</option>
                                                            </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="col-form-label">Industry:</label>
                                                        <input type="text" class="form-control" name="industry"
                                                                list="industry" id="industry_type">
                                                            <datalist id="industry">
                                                                @foreach ($industries as $industry)
                                                                    <option>{{ $industry->industry_name }}</option>
                                                                @endforeach
                                                            </datalist>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-outline">
                                                    <label class="col-form-label" style="display:block">Expected
                                                        Salary:
                                                        <small class="text-primary"> in amount</small>
                                                    </label>
                                                    <input type="number" class="form-control"
                                                        name="expected_salary" id="expected_salary">
                                                </div>
                                            </div>
                                        </div>

                                       <div class="row mb-2">

                                            <div class="col">
                                                <div class="form-outline mb-4">
                                                    <label class="form-label" for="form6Example3">Experience</label>
                                                    <select class="default-select  form-control wide"name="experience" id="experience"onchange="getvalue(this.value)">
                                                        <option value="">Select</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                       </div>

                                        <br>
                                        <h4 class="text">Company Details
                                        </h4>
                                        <hr>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Company Name</label>
                                                    <input type="text" class="form-control" id="company_name"
                                                                name="company_name" list="company_list" value="">
                                                    <datalist id="company_list" name="company_name">
                                                                <option value="  " selected>
                                                    </datalist>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Designation</label>
                                                    <input type="text" class="form-control" id="designation"
                                                                name="designation" list="designation_list"
                                                                value="">
                                                            <datalist id="designation_list">
                                                                <option value="  " selected>
                                                            </datalist>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Current Salary<span>
                                                            in
                                                            lakh</span></label>
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
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Current Salary <span>
                                                            in
                                                            thousand</span>
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
                                            </div>
                                        </div>


                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Total Experience
                                                        <span> in
                                                            year</span></label>
                                                            <select class="default-select  form-control wide"
                                                            name="total_experience_year">
                                                            <option value="">Select one</option>
                                                            @for ($i = 0; $i <= 60; $i++)
                                                                <option value="{{ $i }}">{{ $i }}
                                                                </option>
                                                            @endfor
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Total Experience
                                                        <span> in
                                                            month</span> </label>
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

                                        <div class="row mb-4">
                                            <div class="floating mb-2">
                                                <h4 class="text">Education Details
                                                </h4>
                                                <hr>
                                            </div>

                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Education Type</label>
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
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Education Year</label>
                                                    <select class="default-select  form-control "
                                                                name="education_year" id="education_year">
                                                                <option value="">Select year</option>
                                                                @for ($i = 2024; $i > 1950; $i--)
                                                                    <option value="{{ $i }}">
                                                                        {{ $i }}</option>
                                                                @endfor
                                                            </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <label class="form-label" for="form6Example2">Education Name</label>

                                                <div class="form-outline">
                                                    <input type="text" class="form-control"
                                                                id="education_name" name="education_name"
                                                                list="education_list" readonly value="" aria-readonly="true">
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

                                        <br>
                                        <h4 class="text">Personal Details </h4>

                                        <hr>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Gender</label>
                                                    <select class="  form-control wide" name="gender"
                                                                id="gender">
                                                                <option value="">Select one</option>
                                                                <option value="male">Male</option>
                                                                <option value="female">Female</option>
                                                            </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Marital Status</label>
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
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Willing to
                                                        Relocate</label>
                                                        <select class="default-select  form-control wide"
                                                        name="relocate">
                                                        <option value="">Select one</option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Select your
                                                        Language</label>
                                                    <select class="form-control" name="language[]"
                                                        id="languange" multiple >
                                                        @foreach ($languages as $language)
                                                                    <option value="{{ $language->language }}">
                                                                        {{ $language->language }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Communication</label>
                                                    <select name="communication" id="communication"
                                                                class="default-select  form-control wide">
                                                                <option value="">Select One</option>
                                                                <option value="excellent">Excellent</option>
                                                                <option value="good">Good</option>
                                                                <option value="average">Average</option>
                                                                <option value="poor">Poor</option>
                                                            </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Date of Birth</label>

                                                    <input type="date" name="date_of_birth"
                                                                class="form-control" id="date_of_birth">
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Text input -->
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="form6Example3">Skills <span
                                                    style="color: rgba(0, 0, 255, 0.644);font-weight: 500;">(Press
                                                    Comma
                                                    "," or enter after you
                                                    enter
                                                    any
                                                    skill)</span> </label>
                                                    <select id="skills" class="form-control" multiple name="skills[]">

                                                    </select>
                                        </div>

                                        <br>
                                        <h4 class="text">Location Details
                                        </h4>
                                        <hr>
                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Country</label>
                                                    <select class="default form-control wide" name="country"
                                                                id="country" onchange="getStateList();">
                                                                <option value="">Country</option>
                                                                @foreach ($countries as $country)
                                                                    <option value="{{ $country->id }}">
                                                                        {{ $country->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">State</label>
                                                    <select class="form-control" name="state" id="state"
                                                    onchange="getCityList();">
                                                    <option value=""> State</option>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">City</label>
                                                    <select class="form-control wide" name="city"
                                                    id="city">
                                                    <option value=""> City</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example1">Address</label>

                                                    <input type="text" name="address" id="address"
                                                                class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form6Example2">Postal Code</label>

                                                    <input type="text" name="postel_code"
                                                    class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-block mb-4 col-12">Submit</button>
                                    </div>
                                </div>
                            </section>
                        </form>
                    </div>
                </div>
                <div class="col-sm-5 rightDiv" id="stickytypeheader">
                    <div class="right-section" >
                        <section class="bg-bright section-frame ">
                            <div class="container" ><br>
                                <div class="heading scrollable-content" style="height:600px;">
                                    <div class="information">
                                        <div class="floating">
                                            <h4 class="text">Job Information
                                            </h4>
                                        </div>
                                        <hr>
                                        <div class="employee">
                                            <div class="para mb-4">
                                                <i class="fa-solid fa-user" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Employee Type:</span>
                                                <span>{{$position->job_type ?? ""}}</span>
                                            </div>

                                            <div class="para mb-4">
                                                <i class="fa-solid fa-location-dot" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Location:</span>
                                                <span>{{$position->city ?? ""}}</span>
                                            </div>
                                            <div class="para mb-4">
                                                <i class="fa-solid fa-address-card" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Job Position:</span>
                                                <span>{{$position->position_name ?? ""}}</span>
                                            </div>
                                            <div class="para mb-4">
                                                <i class="fa-solid fa-suitcase" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Experience:</span>
                                                <span>{{$position->min_year_exp ?? ""}} to {{ $position->max_year_exp ?? "" }}</span>
                                            </div>

                                            <div class="para mb-4">
                                                <i class="fa-solid fa-graduation-cap " style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Qualifications:</span>
                                                <span>{{ ucwords($position->specification ?? "" )}}</span>
                                            </div>

                                            <div class="para mb-4">
                                                <i class="fa-solid fa-indian-rupee-sign" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Salary:</span>
                                                <span>{{ $position->min_salary ?? "" }} to {{ $position->max_salary ?? "" }} </span>
                                            </div>
                                            <div class="para mb-4">
                                                <i class="fa-regular fa-clock" style="margin-right: 5px; color: rgb(79, 144, 241);"></i>
                                                <span>Date posted:</span>
                                                <span>{{ $position->created_at->format('Y M,d') ?? "" }}</span>
                                            </div>
                                        </div>
                                        <div class="description">
                                            <div class="long-para">
                                                <h4>Job Description:</h4>
                                                <hr>
                                                <div class="first-para">
                                                    <p>{!! strip_tags($position->job_description ?? "") !!}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

    <script>

        window.addEventListener('scroll', function () {
            var leftDiv = document.querySelector('.leftDiv');
            var rightDiv = document.querySelector('.rightDiv');

            var leftDivRect = leftDiv.getBoundingClientRect();
            var rightDivRect = rightDiv.getBoundingClientRect();

            if (leftDivRect.top < 0) {
                rightDiv.style.top = Math.abs(leftDivRect.top) + 'px';
                rightDiv.style.height = (window.innerHeight - Math.abs(leftDivRect.top)) + 'px';
            } else {
                rightDiv.style.top = '0';
                rightDiv.style.height = '100%';
            }
        });

        $(function() {
            var stickyHeaderTop = $('#stickytypeheader').offset().top;
            $(window).scroll(function() {
                if ($(window).scrollTop() > stickyHeaderTop) {
                    $('#stickytypeheader').css({
                        position: 'fixed',
                        top: '100px',
                        right: '12px'
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

            $("#appliedCandidate").validate({
                rules: {
                    name: {
                        required: true,
                        validName:true
                    },
                    contact: {
                        required: true,
                        minlength: 10,
                        maxlength: 10
                    },
                    email: {
                        required: true,
                        email: true,
                    },
                    expected_salary: "required",
                    // "skills[]": {
                    //     required: true
                    // },

                },
                messages: {
                    name:{
                        required: "*Please enter your Name",
                        validName:"Name cannot contain numbers"
                    }
                    ,
                    contact: {
                        required: "*Please enter your phone number",
                        minlength: "*Please enter your valid phone number",
                        maxlength: "*Please enter your valid phone number",
                    },
                    email: {
                        required: "*Please enter your email address",
                        email: "*Please enter your valid email address",
                    },
                    expected_salary: "*Please enter your expected salary ",
                    // "skills[]": "*Please select your skills",
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
            tokenSeparators: [','],
        });

        $("#languange").select2({
        tags: true,
        tokenSeparators: [',', ' ']
        })


        // Experience company //
        // function getvalue(e) {
        //     const experienceCompany = document.querySelector('#experienceCompany');
        //     if (e == "yes") {
        //         experienceCompany.style.display = "block";
        //     } else {
        //         experienceCompany.style.display = "none";
        //     }
        // }

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

        let resume = document.querySelector('#resume');
        resume.addEventListener('change', function(e) {
            var loader=document.querySelector('#loader-container');
                loader.style.display="block";
            e.preventDefault();
            var file = document.querySelector('#resume').files[0];
            const formData = new FormData();
            formData.append('resume', file, 'userFile.pdf');
            var a = new Promise((resolve, reject) => {
                fetch('https://happyhire.co.in/new_resume/api', {
                        method: "POST",
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        var x = data;
                        loader.style.display="none";
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
                        for (details of company) {
                            document.querySelector('#company_list').appendChild(dynamicOptionCreate(
                                details
                                .Work_Organisation));
                            document.querySelector('#designation_list').appendChild(dynamicOptionCreate(
                                details.Work_Desgination));
                        }
                        document.querySelector('#gender').add(dynamicOptionCreate(x.data.Gender[0]));

                    })
                    .catch(err => console.log(err));
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


    </script>
</body>

</html>
