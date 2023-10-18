@extends('master.master')
@section('title', 'Position')
@section('content')

    @include('all_jquery_function')

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <style>
        .form-file .form-control {
            margin: 0;
            border-radius: 0;
            border: 0;
            height: 45px;
            line-height: 28px;
            margin-left: -8px;
            margin-top: 7px;
            margin-left: 0px;
        }
    </style>
    
    <link href="{{ url('assets/css/jobpoststyle.css') }}" rel="stylesheet">



    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit Position</h4>

                    </div>

                    <div class="card-body">
                        <!---other Sectionstart -->
                        <form id="positionForm" action="{{ route('position.update', $position->id) }}" method="post">
                            @csrf
                            @method('PATCH');
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Basic Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="collapse" id="loader">
                                                    <h6>please wait</h6>
                                                </div>
                                                <div class="col-md-6 col-xl-3 col-xxl-4 ">
                                                    <label class="col-form-label">Choose Your JD <small
                                                            style="color:#EB8153">(Select PDF File Only)</small></label>
                                                    <div class="form-file">
                                                        <input type="file" class="form-file form-control" value=""
                                                            name="jd" accept="application/pdf" id="jdParser"
                                                            onchange="getJd()">
                                                    </div>
                                                    @error('jd')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <input type="text" hidden id="jd_json" name="jd_json">

                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-4">

                                                    <label class="col-form-label">Client*</label>
                                                    <select class="form-control" name="client_id" required>
                                                        <option value="">--select--</option>
                                                        @foreach ($clients as $client)
                                                            <option
                                                                value="{{ $client->id }}"{{ $client->id == $position->client_id ? 'selected' : '' }}>
                                                                {{ $client->name }}
                                                            </option>
                                                        @endforeach
                                                        {{-- {{ $item->id }}"  --}}
                                                    </select>
                                                </div>
                                                @error('client_id')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">

                                                    <label class="col-form-label">Position Name*</label>
                                                    <input type="text" class="form-control" name="position_name"
                                                        placeholder="Position Name" value="{{ $position->position_name }}"
                                                        id="position_name">


                                                    @error('position_name')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                                @error('position_name')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror

                                                <div class="col-md-6 col-xl-3 col-xxl-4 ">
                                                    <label class="col-form-label">Country*</label>
                                                    <select class="form-control" name="countries" id="country"
                                                        onchange="getState();">
                                                        <option value="">Select Country</option>
                                                        @foreach ($countryList as $country)
                                                            <option value="{{ $country->id }}"<?php if ($position->countries == $country->name) {
                                                                echo 'selected';
                                                            } ?>>
                                                                {{ $country->name }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                @error('countries')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror


                                                <div class="col-md-6 col-xl-3 col-xxl-4">
                                                    <label class="col-form-label">State*</label>

                                                    <select class="form-control" name="states" id="state"
                                                        onchange="getCity();locChange(this);">
                                                        <option value="">Select State</option>
                                                        <?php
                                $states = App\Models\State::get();
                                foreach($states as $state){?>
                                                        <option value="{{ $state->id }}" <?php if ($position->states == $state->name) {
                                                            echo 'selected';
                                                        } ?>>
                                                            {{ $state->name }}</option>
                                                        <?php }
                          
                            ?>
                                                    </select>

                                                </div>
                                                @error('states')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror

                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">
                                                    <label class="col-form-label">Position City</label>
                                                    <select class="form-control" name="city" id="city">
                                                        <option value="">Select City</option>
                                                        {{-- @php 
                                                        $cities=Cities::get();
                                                        @endphp --}}
                                                        {{-- @foreach ($cities as $city)
                                                        <option value="">{{ $city->city_name }}</option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                                @error('city')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror

                                                <div class="col-md-12 ">
                                                    <label class="col-form-label">Postal Code</label>
                                                    <input type="number" class="form-control" name="postal_code"
                                                        placeholder="Postal Code" value="{{ $position->postal_code }}">
                                                </div>
                                                @error('postal_code')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Enter Close By Date </h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row form-material">
                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">

                                                    <label class="col-form-label">Close By Date *</label>
                                                    <input type="date" class="form-control" name="close_date"
                                                        placeholder="Close Date" value="{{ $position->close_date }}">
                                                    @error('closeDate')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">

                                                    <label class="col-form-label">No Of Openings *</label>
                                                    <input type="Number" class="form-control" name="openings"
                                                        placeholder="Openings" value="{{ $position->openings }}">
                                                </div>
                                                @error('openings')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">
                                                    <label class="col-form-label">Work From Home *</label>
                                                    <select name="is_remote_work"
                                                        class="default-select  form-control wide">
                                                        <option value="0"
                                                            @if ($position->is_remote_work == 0) selected='selected' @endif>No
                                                        </option>
                                                        <option value="1"
                                                            @if ($position->is_remote_work == 1) selected='selected' @endif>Yes
                                                        </option>
                                                    </select>
                                                </div>
                                                @error('is_remote_work')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Enter Skills Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 mb-3">
                                                    <div class="example">

                                                        <p class="mb-1" style="color:black">Skill Set*</p>

                                                        @php
                                                            $skilldata = $position->skill_set;
                                                            $skills = explode(',', $skilldata);
                                                        @endphp
                                                        <div class="asColorPicker-wrap">
                                                            <select name="skill_set[]"
                                                                class="default-select form-control "
                                                                placeholder="Enter skills by comma sepration"
                                                                id="skills" multiple="multiple">
                                                                @foreach ($skills as $item)
                                                                    <option
                                                                        value="{{ preg_replace('/[^A-Za-z0-9\-]/', '', $item) }}"
                                                                        selected>
                                                                        {{ preg_replace('/[^A-Za-z0-9\-]/', '', $item) }}
                                                                    </option>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                        @error('skill_set')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Location</p>
                                                        <div class="asColorPicker-wrap"><input type="text"
                                                                class="complex-colorpicker form-control asColorPicker-input"
                                                                value="{{ $position->locations }}" name="locations"
                                                                id="locations" placeholder="Location"
                                                                value={{ old('locations') }}>
                                                        </div>
                                                        @error('locations')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-6 mb-3">
                                                    <div class="example">

                                                        <div class="row">
                                                            <span class="col-2 col-form-label my-auto">Job
                                                                Description*</span>


                                                            {{-- <small class="badge badge-dark d-sm-inline-block d-none col-1 mt-2" data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg" style="width
                                                            :110px;height:25px;"><small>Select Template</small></small> --}}

                                                            <b class="badge badge-dark d-sm-inline-block d-none col-1 my-3"
                                                                data-bs-toggle="modal"
                                                                data-bs-target=".bd-example-modal-lg"
                                                                style="width
                                                            :150px;height:25px;">Select
                                                                Template</b>

                                                            <div class="modal fade bd-example-modal-lg" tabindex="-1"
                                                                role="dialog" aria-hidden="true">
                                                                <div class="modal-dialog modal-lg">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Select Job Description
                                                                            </h5>
                                                                            <button type="button" class="btn-close"
                                                                                data-bs-dismiss="modal">
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">


                                                                            <div class="modal-content">

                                                                                @foreach ($jobDescriptions as $key => $jobs)
                                                                                    <div class="col-xl-12 col-lg-12">
                                                                                        <div class="card project-card">
                                                                                            <div class="card-body">
                                                                                                <div
                                                                                                    class="d-flex align-items-start">
                                                                                                    <div class="dz-media ">
                                                                                                        <span>S.No</span>
                                                                                                        <b>{{ ++$key }}</b>
                                                                                                    </div>
                                                                                                    <div class="me-auto">
                                                                                                        <span
                                                                                                            class="text-primary ">Role</span>
                                                                                                        <h6
                                                                                                            class="title font-w600 mb-2 text-black">
                                                                                                            {{ $jobs->role }}
                                                                                                        </h6>
                                                                                                    </div>
                                                                                                    <div class="row">
                                                                                                        <div
                                                                                                            class="col">
                                                                                                            <a
                                                                                                                onclick="selectDescription({{ $jobs->id }})">
                                                                                                                <span
                                                                                                                    class="badge badge-info d-sm-inline-block d-none pointer"
                                                                                                                    style="cursor: pointer;">Select</span></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="">
                                                                                                    <div class="col">
                                                                                                        <b>Description:</b>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <!-- <div class="row"> -->
                                                                                                <div class="col">
                                                                                                    <p>{{ $jobs->description }}
                                                                                                    </p>
                                                                                                </div>
                                                                                                <!-- </div> -->
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>


                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                class="btn btn-danger light"
                                                                                data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>


                                                        <div class="asColorPicker-wrap">
                                                            <textarea name="job_description" class="form-control" id="textarea" rows="4" cols="50">{{ $position->job_description }}</textarea>
                                                        </div>
                                                        @error('job_description')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title"> Enter Education Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Education specification*</p>
                                                        <div class="asColorPicker-wrap"><input type="text"
                                                                class="as_colorpicker form-control asColorPicker-input"
                                                                value="{{ $position->specification }}"
                                                                name="specification" placeholder="Specification">
                                                        </div>
                                                        @error('specification')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Salary Type</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="salary_type"
                                                                class="default-select  form-control wide">
                                                                <option
                                                                    value="INR"@if ($position->salary_type == 'INR') selected='selected' @endif>
                                                                    INR</option>
                                                                <option
                                                                    value="USD"@if ($position->salary_type == 'USD') selected='selected' @endif>
                                                                    USD</option>
                                                                <option
                                                                    value="POUND"@if ($position->salary_type == 'POUND') selected='selected' @endif>
                                                                    POUND</option>
                                                                <option
                                                                    value="DIRHAM"@if ($position->salary_type == 'DIRHAM') selected='selected' @endif>
                                                                    DIRHAM</option>
                                                            </select>
                                                        </div>
                                                        @error('salary_type')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Pay Type</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="pay_type"
                                                                class="default-select  form-control wide">
                                                                <option value="Annually"
                                                                    @if ($position->pay_type == 'Annually') selected='selected' @endif>
                                                                    Annually</option>
                                                                <option value="monthly"
                                                                    @if ($position->pay_type == 'monthly') selected='selected' @endif>
                                                                    Monthly</option>
                                                                <option value="hourly"
                                                                    @if ($position->pay_type == 'hourly') selected='selected' @endif>
                                                                    Hourly</option>
                                                            </select>
                                                        </div>
                                                        @error('pay_type')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Enter Salary Range</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Min Salary Range(INR)</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="min_salary"
                                                                class="default-select  form-control wide">
                                                                @for ($i = 1; $i < 50; $i++)
                                                                    <option value="{{ $i . '00000' }}"
                                                                        {{ $position->min_salary == $i . '00000' ? 'selected' : '' }}>
                                                                        {{ $i }} Lacs
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('min_salary')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Max Salary Range(INR)</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="max_salary"
                                                                class="default-select  form-control wide">
                                                                @for ($i = 1; $i <= 50; $i++)
                                                                    <option value="{{ $i . '00000' }}"
                                                                        {{ $position->max_salary == $i . '00000' ? 'selected' : '' }}>
                                                                        {{ $i }} Lacs
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('max_salary')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Job Type</p>
                                                        <div class="asColorPicker-wrap"><select name="job_type"
                                                                class="default-select  form-control wide">
                                                                <option value="Full Time"
                                                                    @if ($position->job_type == 'Full Time') selected='selected' @endif>
                                                                    Full Time</option>
                                                                <option
                                                                    value="Part Time"@if ($position->job_type == 'Part Time') selected='selected' @endif>
                                                                    Part Time</option>
                                                                <option
                                                                    value="Temporary"@if ($position->job_type == 'Temporary') selected='selected' @endif>
                                                                    Temporary</option>
                                                                <option
                                                                    value="Contract"@if ($position->job_type == 'Contract') selected='selected' @endif>
                                                                    Contract</option>
                                                                <option
                                                                    value="Internship"@if ($position->job_type == 'Internship') selected='selected' @endif>
                                                                    Internship</option>
                                                            </select>
                                                        </div>
                                                        @error('job_type')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Min Experience</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="min_year_exp" id="minYearExp"
                                                                class="default-select  form-control wide">
                                                                @for ($i = 0; $i <= 15; $i++)
                                                                    <option
                                                                        value="{{ $i }}"{{ $position->min_year_exp == $i ? 'selected' : '' }}>
                                                                        {{ $i }} Year</option>
                                                                @endfor
                                                            </select>

                                                        </div>
                                                        @error('min_year_exp')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Max Experience</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="max_year_exp" id="maxYearExp"
                                                                class="default-select  form-control wide">
                                                                @for ($i = 0; $i <= 30; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $position->max_year_exp == $i ? 'selected' : '' }}>
                                                                        {{ $i }} Year</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('max_year_exp')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="col-form-label mb-1">Qualification</p>
                                                        <div class="asColorPicker-wrap"><select name="edu_qualification"
                                                                class="default-select  form-control wide">
                                                                <option>10th</option>
                                                                <option>12th</option>
                                                                <option>Under Graduate</option>
                                                                <option> Any Graduate</option>
                                                                <option> Bachelor of Agriculture (B.Sc. (Agriculture))
                                                                </option>
                                                                <option> Bachelor of Architecture (B.Arch.)</option>
                                                                <option> Bachelor of Arts (B.A.)</option>
                                                                <option> Bachelor of Ayurvedic Medicine &amp; Surgery
                                                                    (B.A.M.S.)</option>
                                                                <option> Bachelor of Business Administration (B.B.A.)
                                                                </option>
                                                                <option>Bachelor of Commerce (B.Com.)</option>
                                                                <option> Bachelor of Computer Applications (B.C.A.)</option>
                                                                <option> Bachelor of Computer Science (B.Sc. (Computer
                                                                    Science))</option>
                                                                <option> Bachelor of Dental Surgery (B.D.S.)</option>
                                                                <option> Bachelor of Design (B.Des. - B.D.)</option>
                                                                <option> Bachelor of Education (B.Ed.)</option>
                                                                <option> Bachelor of Engineering - Bachelor of Technology
                                                                    (B.E./B.Tech.)</option>
                                                                <option> Bachelor of Fine Arts (BFA - BVA)</option>
                                                                <option> Bachelor of Fisheries Science (B.F.Sc. - B.Sc.
                                                                    (Fisheries))</option>
                                                                <option> Bachelor of Home Science (B.A. - B.Sc. (Home
                                                                    Science))</option>
                                                                <option> Bachelor of Homeopathic Medicine and Surgery
                                                                    (B.H.M.S.)</option>
                                                                <option> Bachelor of Laws (L.L.B.)</option>
                                                                <option> Bachelor of Library Science (B.Lib. - B.Lib.Sc.)
                                                                </option>
                                                                <option> Bachelor of Mass Communications (B.M.C. - B.M.M.)
                                                                </option>
                                                                <option> Bachelor of Medicine and Bachelor of Surgery
                                                                    (M.B.B.S.)</option>
                                                                <option> Bachelor of Nursing (B.Sc. (Nursing))</option>
                                                                <option> Bachelor of Pharmacy (B.Pharm.)</option>
                                                                <option> Bachelor of Physical Education (B.P.Ed.)</option>
                                                                <option> Bachelor of Physiotherapy (B.P.T.)</option>
                                                                <option> Bachelor of Science (B.Sc.)</option>
                                                                <option> Bachelor of Social Work (BSW or B.A. (SW))</option>
                                                                <option> Bachelor of Veterinary Science &amp; Animal
                                                                    Husbandry (B.V.Sc.)
                                                                <option>
                                                                <option>Doctor of Medicine in Homoeopathy (M.D.
                                                                    (Homoeopathy))</option>
                                                                <option>Master in Home Science (M.A. - M.Sc. (Home Science))
                                                                </option>
                                                                <option>Master of Architecture (M.Arch.)</option>
                                                                <option>Master of Arts (M.A.)</option>
                                                                <option>Master of Business Administration (M.B.A.)</option>
                                                                <option>Master of Chirurgiae (M.Ch.)</option>
                                                                <option>Master of Commerce (M.Com.)</option>
                                                                <option>Master of Computer Applications (M.C.A.)</option>
                                                                <option>Master of Dental Surgery (M.D.S.)</option>
                                                                <option>Master of Design (M.Des. - M.Design.)</option>
                                                                <option>Master of Education (M.Ed.)</option>
                                                                <option>Master of Engineering - Master of Technology
                                                                    (M.E./M.Tech.)</option>
                                                                <option>Master of Fine Arts (MFA - MVA)</option>
                                                                <option>Master of Fishery Science (M.F.Sc. - M.Sc.
                                                                    (Fisheries))</option>
                                                                <option>Master of Laws (L.L.M.)</option>
                                                                <option>Master of Library Science (M.Lib. - M.Lib.Sc.)
                                                                </option>
                                                                <option>Master of Mass Communications (M.M.C - M.M.M.)
                                                                </option>
                                                                <option>Master of Pharmacy (M.Pharm)</option>
                                                                <option>Master of Philosophy (M.Phil.)</option>
                                                                <option>Master of Physical Education (M.P.Ed. - M.P.E.)
                                                                </option>
                                                                <option>Master of Physiotherapy (M.P.T.)</option>
                                                                <option>Master of Science (M.Sc.)</option>
                                                                <option>Master of Science in Agriculture (M.Sc.
                                                                    (Agriculture))</option>
                                                                <option>Master of Social Work (M.S.W. or M.A. (SW))</option>
                                                                <option>Master of Surgery (M.S.)</option>
                                                                <option>Master of Veterinary Science (M.V.Sc.)</option>
                                                            </select>
                                                        </div>
                                                        @error('edu_qualification')
                                                            <span style="color:red">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Enter Indusrty Details </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="col-form-label mb-1">Industry</p>
                                                    <div class="asColorPicker-wrap">
                                                        {{-- <select name="industry" class="default-select  form-control wide">
                                                            <option value="IT-Software / Software Services">IT-Software /
                                                                Software Services
                                                            </option>
                                                            <option value="BPO / Call Centre / ITES">BPO / Call Centre /
                                                                ITES
                                                            </option>

                                                            <option value="Automotive / Auto Ancillary / Auto Components">
                                                                Automotive / Auto Ancillary / Auto Components</option>

                                                            <option value="Accounting / Finance">Accounting / Finance
                                                            </option>
                                                            <option value="Advertising / PR / MR / Event Management">
                                                                Advertising / PR / MR / Event Management</option>

                                                            <option value="Agriculture / Diary">Agriculture / Diary
                                                            </option>

                                                            <option value="Airlines">Airlines</option>
                                                            <option value="Animation / Gaming">Animation / Gaming
                                                            </option>

                                                            <option value="Architecture / Interior Design">
                                                                Architecture /
                                                                Interior Design</option>
                                                            <option value="Aviation / Aerospace">Aviation / Aerospace
                                                            </option>
                                                            <option value="Banking / Financial Services / Broking">Banking
                                                                /
                                                                Financial Services / Broking</option>
                                                            <option value="Brewery / Distillery">Brewery / Distillery
                                                            </option>
                                                            <option value="Broadcasting">Broadcasting</option>

                                                            <option value="Ceramics / Sanitary ware">Ceramics /
                                                                Sanitary
                                                                ware</option>
                                                            <option
                                                                value="Chemicals / Petro Chemicals / Plastics / Rubber">
                                                                Chemicals / Petro
                                                                Chemicals
                                                                / Plastics / Rubber</option>
                                                            <option value="Construction / Engineering / Cement / Metals">
                                                                Construction /
                                                                Engineering
                                                                /
                                                                Cement / Metals</option>
                                                            <option value="Consumer Electronics / Appliances / Durables">
                                                                Consumer Electronics /
                                                                Appliances / Durables</option>
                                                            <option
                                                                value="Courier / Transportation / Freight / Warehousing">
                                                                Courier /
                                                                Transportation /
                                                                Freight / Warehousing</option>
                                                            <option value="Education / Teaching / Training">
                                                                Education /
                                                                Teaching / Training</option>
                                                            <option value="Electricals /  Switchgears">
                                                                Electricals /
                                                                Switchgears</option>
                                                            <option value="Export / Import">Export / Import</option>

                                                            <option value="Glass/ Glassware">Glass/ Glassware</option>

                                                            <option value="Facility Management">Facility Management
                                                            </option>

                                                            <option value="Fertilizers / Pesticides">Fertilizers /
                                                                Pesticides</option>
                                                            <option value="FMCG / Food / Beverages">FMCG / Food /
                                                                Beverages
                                                            </option>
                                                            <option value="Food Processing">Food Processing</option>

                                                            <option value="Gems / Jewelry">Gems / Jewelry</option>

                                                            <option value="Government / Defence">Government / Defence
                                                            </option>
                                                            <option value="Heat Ventilation / Air Conditioning">
                                                                Heat
                                                                Ventilation / Air Conditioning</option>
                                                            <option value="Industrial Products / Heavy Machinery">
                                                                Industrial
                                                                Products / Heavy Machinery</option>
                                                            <option value="Insurance">Insurance</option>

                                                            <option value="Iron &amp; Steel">Iron &amp; Steel</option>

                                                            <option value="IT - Hardware &amp; Networking">IT -
                                                                Hardware
                                                                &amp; Networking</option>
                                                            <option value="KPO / Research Analysis">KPO / Research
                                                                Analysis
                                                            </option>
                                                            <option value="Legal">Legal</option>
                                                            <option value="Media / Entertainment / Internet">Media /
                                                                Entertainment / Internet</option>
                                                            <option value="Internet / E-commerce">Internet /
                                                                E-commerce
                                                            </option>
                                                            <option value="Leather / Medical / Hospitals">
                                                                Leather / Medical
                                                                / Hospitals</option>
                                                            <option value="Medical Devices / Equipment">Medical
                                                                Devices /
                                                                Equipment</option>
                                                            <option value="Mining / Quarrying">Mining / Quarrying
                                                            </option>

                                                            <option
                                                                value="NGO / Social Service / Regulators / Industry Associations">
                                                                NGO /
                                                                Social
                                                                Service / Regulators / Industry Associations</option>

                                                            <option value="Office Equipment / Automation">
                                                                Office Equipment /
                                                                Automation</option>
                                                            <option value="Oil &amp; Gas / Energy / Power Infrastructure">
                                                                Oil &amp; Gas / Energy / Power Infrastructure</option>

                                                            <option value="Pulp &amp; Paper">Pulp &amp; Paper</option>

                                                            <option value="Pharma / Biotech / Clinical Research">
                                                                Pharma /
                                                                Biotech / Clinical Research</option>
                                                            <option value="Printing / Packaging">Printing / Packaging
                                                            </option>
                                                            <option value="Publishing">Publishing</option>

                                                            <option value="Real Estate / Property">Real Estate /
                                                                Property
                                                            </option>
                                                            <option value="Recruitment / Staffing">Recruitment /
                                                                Staffing
                                                            </option>
                                                            <option value="Retail/Wholesale">Retail/Wholesale</option>

                                                            <option value="Security / Law Enforcement">Security / Law
                                                                Enforcement</option>
                                                            <option value="Semiconductors/Electronics">
                                                                Semiconductors/Electronics</option>
                                                            <option value="Shipping/Marine">Shipping/Marine</option>

                                                            <option value="Strategy/    Management Consulting">
                                                                Strategy/
                                                                Management Consulting</option>
                                                            <option value="Sugar">Sugar</option>
                                                            <option value="Telecom/ISP">Telecom/ISP</option>

                                                            <option value="Textiles/Garments/Accessories">
                                                                Textiles/Garments/Accessories</option>
                                                            <option value="Travel/Hotels/Restaurants">
                                                                Travel/Hotels/Restaurants</option>
                                                            <option value="Tyres">Tyres</option>
                                                            <option value="Water Treatment / Waste Management">Water
                                                                Treatment / Waste Management</option>
                                                            <option value="Wellness/Fitness/Sports/Beauty">
                                                                Wellness/Fitness/Sports/Beauty</option>
                                                            <option value="Others">Others</option>
                                                        </select> --}}
                                                        <select class="form-control" name="industry" id="industry">

                                                            <option value="IT-Software / Software Services"
                                                                {{ old('industry') == 'IT-Software / Software Services' ? 'selected' : '' }}>
                                                                IT-Software / Software Services
                                                            </option>
                                                            <option value="BPO / Call Centre / ITES"
                                                                {{ old('industry') == 'BPO / Call Centre / ITES' ? 'selected' : '' }}>
                                                                BPO / Call
                                                                Centre / ITES
                                                            </option>

                                                            <option value="Automotive / Auto Ancillary / Auto Components"
                                                                {{ old('industry') == 'Automotive / Auto Ancillary / Auto Components' ? 'selected' : '' }}>
                                                                Automotive / Auto Ancillary / Auto Components</option>

                                                            <option value="Accounting / Finance"
                                                                {{ old('industry') == 'Accounting / Finance' ? 'selected' : '' }}>
                                                                Accounting /
                                                                Finance
                                                            </option>
                                                            <option value="Advertising / PR / MR / Event Management"
                                                                {{ old('industry') == 'Advertising / PR / MR / Event Management' ? 'selected' : '' }}>
                                                                Advertising / PR / MR / Event Management</option>

                                                            <option value="Agriculture / Diary"
                                                                {{ old('industry') == 'Agriculture / Diary' ? 'selected' : '' }}>
                                                                Agriculture /
                                                                Diary
                                                            </option>

                                                            <option value="Airlines"
                                                                {{ old('industry') == 'Airlines' ? 'selected' : '' }}>
                                                                Airlines</option>
                                                            <option value="Animation / Gaming"
                                                                {{ old('industry') == 'Animation / Gaming' ? 'selected' : '' }}>
                                                                Animation /
                                                                Gaming
                                                            </option>

                                                            <option value="Architecture / Interior Design"
                                                                {{ old('industry') == 'Architecture / Interior Design' ? 'selected' : '' }}>
                                                                Architecture /
                                                                Interior Design</option>
                                                            <option value="Aviation / Aerospace"
                                                                {{ old('industry') == 'Aviation / Aerospace' ? 'selected' : '' }}>
                                                                Aviation /
                                                                Aerospace
                                                            </option>
                                                            <option value="Banking / Financial Services / Broking"
                                                                {{ old('industry') == 'Banking / Financial Services / Broking' ? 'selected' : '' }}>
                                                                Banking /
                                                                Financial Services / Broking</option>
                                                            <option value="Brewery / Distillery"
                                                                {{ old('industry') == 'Brewery / Distillery' ? 'selected' : '' }}>
                                                                Brewery /
                                                                Distillery
                                                            </option>
                                                            <option value="Broadcasting"
                                                                {{ old('industry') == 'Broadcasting' ? 'selected' : '' }}>
                                                                Broadcasting</option>

                                                            <option value="Ceramics / Sanitary ware"
                                                                {{ old('industry') == 'Ceramics / Sanitary ware' ? 'selected' : '' }}>
                                                                Ceramics /
                                                                Sanitary
                                                                ware</option>
                                                            <option value="Chemicals / Petro Chemicals / Plastics / Rubber"
                                                                {{ old('industry') == 'Chemicals / Petro Chemicals / Plastics / Rubber' ? 'selected' : '' }}>
                                                                Chemicals / Petro
                                                                Chemicals
                                                                / Plastics / Rubber</option>
                                                            <option value="Construction / Engineering / Cement / Metals"
                                                                {{ old('industry') == 'Construction / Engineering / Cement / Metals' ? 'selected' : '' }}>
                                                                Construction / Engineering
                                                                /
                                                                Cement / Metals</option>
                                                            <option value="Consumer Electronics / Appliances / Durables"
                                                                {{ old('industry') == 'Consumer Electronics / Appliances / Durables' ? 'selected' : '' }}>
                                                                Consumer Electronics /
                                                                Appliances / Durables</option>
                                                            <option
                                                                value="Courier / Transportation / Freight / Warehousing"
                                                                {{ old('industry') == 'Courier / Transportation / Freight / Warehousing' ? 'selected' : '' }}>
                                                                Courier /
                                                                Transportation /
                                                                Freight / Warehousing</option>
                                                            <option value="Education / Teaching / Training"
                                                                {{ old('industry') == 'Education / Teaching / Training' ? 'selected' : '' }}>
                                                                Education /
                                                                Teaching / Training</option>
                                                            <option value="Electricals /  Switchgears"
                                                                {{ old('industry') == 'Electricals /  Switchgears' ? 'selected' : '' }}>
                                                                Electricals /
                                                                Switchgears</option>
                                                            <option value="Export / Import"
                                                                {{ old('industry') == 'Export / Import' ? 'selected' : '' }}>
                                                                Export / Import
                                                            </option>

                                                            <option value="Glass/ Glassware"
                                                                {{ old('industry') == 'Glass/ Glassware' ? 'selected' : '' }}>
                                                                Glass/ Glassware
                                                            </option>

                                                            <option value="Facility Management"
                                                                {{ old('industry') == 'Facility Management' ? 'selected' : '' }}>
                                                                Facility
                                                                Management
                                                            </option>

                                                            <option value="Fertilizers / Pesticides"
                                                                {{ old('industry') == 'Fertilizers / Pesticides' ? 'selected' : '' }}>
                                                                Fertilizers /
                                                                Pesticides</option>
                                                            <option value="FMCG / Food / Beverages"
                                                                {{ old('industry') == 'FMCG / Food / Beverages' ? 'selected' : '' }}>
                                                                FMCG / Food
                                                                /
                                                                Beverages
                                                            </option>
                                                            <option value="Food Processing"
                                                                {{ old('industry') == 'Food Processing' ? 'selected' : '' }}>
                                                                Food Processing
                                                            </option>

                                                            <option value="Gems / Jewelry"
                                                                {{ old('industry') == 'Gems / Jewelry' ? 'selected' : '' }}>
                                                                Gems / Jewelry
                                                            </option>

                                                            <option value="Government / Defence"
                                                                {{ old('industry') == 'Government / Defence' ? 'selected' : '' }}>
                                                                Government /
                                                                Defence
                                                            </option>
                                                            <option value="Heat Ventilation / Air Conditioning"
                                                                {{ old('industry') == 'Heat Ventilation / Air Conditioning' ? 'selected' : '' }}>
                                                                Heat
                                                                Ventilation / Air Conditioning</option>
                                                            <option value="Industrial Products / Heavy Machinery"
                                                                {{ old('industry') == 'Industrial Products / Heavy Machinery' ? 'selected' : '' }}>
                                                                Industrial
                                                                Products / Heavy Machinery</option>
                                                            <option value="Insurance"
                                                                {{ old('industry') == 'Insurance' ? 'selected' : '' }}>
                                                                Insurance</option>

                                                            <option value="Iron &amp; Steel"
                                                                {{ old('industry') == 'Iron &amp; Steel' ? 'selected' : '' }}>
                                                                Iron &amp; Steel
                                                            </option>

                                                            <option value="IT - Hardware &amp; Networking"
                                                                {{ old('industry') == 'IT - Hardware &amp; Networking' ? 'selected' : '' }}>
                                                                IT -
                                                                Hardware
                                                                &amp; Networking</option>
                                                            <option value="KPO / Research Analysis"
                                                                {{ old('industry') == 'KPO / Research Analysis' ? 'selected' : '' }}>
                                                                KPO /
                                                                Research
                                                                Analysis
                                                            </option>
                                                            <option value="Legal"
                                                                {{ old('industry') == 'Legal' ? 'selected' : '' }}>Legal
                                                            </option>
                                                            <option value="Media / Entertainment / Internet"
                                                                {{ old('industry') == 'Media / Entertainment / Internet' ? 'selected' : '' }}>
                                                                Media /
                                                                Entertainment / Internet</option>
                                                            <option value="Internet / E-commerce"
                                                                {{ old('industry') == 'Internet / E-commerce' ? 'selected' : '' }}>
                                                                Internet /
                                                                E-commerce
                                                            </option>
                                                            <option value="Leather / Medical / Hospitals"
                                                                {{ old('industry') == 'Leather / Medical / Hospitals' ? 'selected' : '' }}>
                                                                Leather / Medical
                                                                / Hospitals</option>
                                                            <option value="Medical Devices / Equipment"
                                                                {{ old('industry') == 'Medical Devices / Equipment' ? 'selected' : '' }}>
                                                                Medical
                                                                Devices /
                                                                Equipment</option>
                                                            <option value="Mining / Quarrying"
                                                                {{ old('industry') == 'Mining / Quarrying' ? 'selected' : '' }}>
                                                                Mining /
                                                                Quarrying
                                                            </option>

                                                            <option
                                                                value="NGO / Social Service / Regulators / Industry Associations"
                                                                {{ old('industry') == 'NGO / Social Service / Regulators / Industry Associations' ? 'selected' : '' }}>
                                                                NGO / Social
                                                                Service / Regulators / Industry Associations</option>

                                                            <option value="Office Equipment / Automation"
                                                                {{ old('industry') == 'Office Equipment / Automation' ? 'selected' : '' }}>
                                                                Office Equipment /
                                                                Automation</option>
                                                            <option value="Oil &amp; Gas / Energy / Power Infrastructure"
                                                                {{ old('industry') == 'Oil &amp; Gas / Energy / Power Infrastructure' ? 'selected' : '' }}>
                                                                Oil &amp; Gas / Energy / Power Infrastructure</option>

                                                            <option value="Pulp &amp; Paper"
                                                                {{ old('industry') == 'Pulp &amp; Paper' ? 'selected' : '' }}>
                                                                Pulp &amp; Paper
                                                            </option>

                                                            <option value="Pharma / Biotech / Clinical Research"
                                                                {{ old('industry') == 'Pharma / Biotech / Clinical Research' ? 'selected' : '' }}>
                                                                Pharma /
                                                                Biotech / Clinical Research</option>
                                                            <option value="Printing / Packaging"
                                                                {{ old('industry') == 'Printing / Packaging' ? 'selected' : '' }}>
                                                                Printing /
                                                                Packaging
                                                            </option>
                                                            <option value="Publishing"
                                                                {{ old('industry') == 'Publishing' ? 'selected' : '' }}>
                                                                Publishing</option>

                                                            <option value="Real Estate / Property"
                                                                {{ old('industry') == 'Real Estate / Property' ? 'selected' : '' }}>
                                                                Real Estate
                                                                /
                                                                Property
                                                            </option>
                                                            <option value="Recruitment / Staffing"
                                                                {{ old('industry') == 'Recruitment / Staffing' ? 'selected' : '' }}>
                                                                Recruitment
                                                                /
                                                                Staffing
                                                            </option>
                                                            <option value="Retail/Wholesale"
                                                                {{ old('industry') == 'Retail/Wholesale' ? 'selected' : '' }}>
                                                                Retail/Wholesale
                                                            </option>

                                                            <option value="Security / Law Enforcement"
                                                                {{ old('industry') == 'Security / Law Enforcement' ? 'selected' : '' }}>
                                                                Security
                                                                / Law Enforcement</option>
                                                            <option value="Semiconductors/Electronics"
                                                                {{ old('industry') == 'Semiconductors/Electronics' ? 'selected' : '' }}>
                                                                Semiconductors/Electronics</option>
                                                            <option value="Shipping/Marine"
                                                                {{ old('industry') == 'Shipping/Marine' ? 'selected' : '' }}>
                                                                Shipping/Marine
                                                            </option>

                                                            <option value="Strategy/	Management Consulting"
                                                                {{ old('industry') == 'Strategy/	Management Consulting' ? 'selected' : '' }}>
                                                                Strategy/
                                                                Management Consulting</option>
                                                            <option value="Sugar"
                                                                {{ old('industry') == 'Sugar' ? 'selected' : '' }}>Sugar
                                                            </option>
                                                            <option value="Telecom/ISP"
                                                                {{ old('industry') == 'Telecom/ISP' ? 'selected' : '' }}>
                                                                Telecom/ISP</option>

                                                            <option value="Textiles/Garments/Accessories"
                                                                {{ old('industry') == 'Textiles/Garments/Accessories' ? 'selected' : '' }}>
                                                                Textiles/Garments/Accessories</option>
                                                            <option value="Travel/Hotels/Restaurants"
                                                                {{ old('industry') == 'Travel/Hotels/Restaurants' ? 'selected' : '' }}>
                                                                Travel/Hotels/Restaurants</option>
                                                            <option value="Tyres"
                                                                {{ old('industry') == 'Tyres' ? 'selected' : '' }}>Tyres
                                                            </option>
                                                            <option value="Water Treatment / Waste Management"
                                                                {{ old('industry') == 'Water Treatment / Waste Management' ? 'selected' : '' }}>
                                                                Water
                                                                Treatment / Waste Management</option>
                                                            <option value="Wellness/Fitness/Sports/Beauty"
                                                                {{ old('industry') == 'Wellness/Fitness/Sports/Beauty' ? 'selected' : '' }}>
                                                                Wellness/Fitness/Sports/Beauty</option>
                                                            <option value="Others"
                                                                {{ old('industry') == 'Others' ? 'selected' : '' }}>Others
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @error('industry')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-xl-3 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="col-form-label mb-1">Job Address</p>
                                                    <div class="asColorPicker-wrap">
                                                        <input type="text"
                                                            class="complex-colorpicker form-control asColorPicker-input"
                                                            value="{{ preg_replace('/[^A-Za-z0-9\-]/', '', $position->job_address) }}"
                                                            name="job_address" placeholder="job address">
                                                    </div>
                                                    @error('job_address')
                                                        <span style="color:red">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="col-md-6 col-xl-3 col-xxl-3 mb-3">
                                                <label class="col-form-label">Gender*</label>
                                                <select name="gender" class="form-control">
                                                    <option value="">--select--</option>
                                                    <option value="male&female"
                                                        @if ($position->gender == 'male&female') selected='selected' @endif>Male
                                                        And Female</option>
                                                    <option value="male"
                                                        @if ($position->gender == 'male') selected='selected' @endif>Male
                                                        Only</option>
                                                    <option value="female"
                                                        @if ($position->gender == 'female') selected='selected' @endif>
                                                        Female Only</option>
                                                </select>


                                                @error('gender')
                                                    <span style="color:red">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 col-xl-3 col-xxl-3 mb-3">
                                                <label class="col-form-label">National/International*</label>
                                                <select name="is_local" class="default-select  form-control wide">
                                                    <option value="1"
                                                        @if ($position->is_local == 1) selected='selected' @endif>
                                                        National</option>
                                                    <option value="0"
                                                        @if ($position->is_local == 0) selected='selected' @endif>
                                                        International</option>
                                                </select>
                                            </div>
                                            @error('is_local')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                                <input type="hidden" name="contact_person_name" value="{{ Auth::user()->name }}">
                                <input type="hidden" name="person_contact" value="{{ auth::user()->contact }}">
                                <input type="hidden" name="person_email" value="{{ Auth::user()->email }}">

                                @include('pages.position.old_portal_form.national_portal')
                                @include('pages.position.old_portal_form.international_portal')
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Update</button>



                        </form>
                    </div>
                </div>
                <!---end other section -->
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        //JD parser function // 
        const jd = document.querySelector('#jdParser');

        function getJd() {
            var load = document.querySelector('#loader');
            load.classList.remove('collapse');
            var file = jd.files[0];
            const formData = new FormData();
            formData.append('jd', file, 'userFile.pdf');
            var a = new Promise((resolve, reject) => {
                fetch('http://139.59.14.185/jdparser/upload/api/', {
                        method: "POST",
                        body: formData,
                    })
                    .then(res => res.json())
                    .then(data => {
                        load.classList.add('collapse');
                        var x = data;
                        console.log(x);
                        document.querySelector('#jd_json').value = JSON.stringify(x);
                        document.querySelector('#position_name').value = x.data.Role[0];
                        var skills = x.data.Tools_and_technologies.join(",");
                        document.querySelector('#skills').add(dynamicOptionCreate(skills));
                    })
                    .catch(err => console.log(err));
            });
        }

        $("#skills").select2({
            tags: true,
            tokenSeparators: [',', ' '],
        });


        function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e;
            option.value = e;
            option.selected = true;
            return option;
        }


        $(document).ready(function($) {
            $("#positionForm").validate({
                rules: {
                    jd: 'mimes:pdf',
                    client_id: 'required',
                    position_name: 'required',
                    countries: 'required',
                    states: 'required',
                    close_date: 'required',
                    openings: 'required',
                    city: 'required',
                    postal_code: 'required',
                    skill_set: 'required',
                    job_description: 'required',
                    specification: 'required',
                    salary_type: 'required',
                    pay_type: 'required',
                    min_salary: 'required',
                    max_salary: 'required',
                    job_type: 'required',
                    min_year_exp: 'required',
                    max_year_exp: 'required',
                    edu_qualification: 'required',
                    industry: 'required',
                    job_address: 'required',
                    gender: 'required',
                    is_local: 'required',
                    status: 'required',
                    software_catagory: 'required',
                },
                messages: {
                    jd: 'Select PDF File Only',
                    client_id: '*Please Select Client',
                    position_name: '*Please Enter Your Position',
                    countries: '*Please Select Country',
                    states: '*Please Select Status',
                    close_date: '*Please Select close date',
                    openings: '*Please Enter Your openings',
                    city: '*Please Enter Your Location',
                    postal_code: '*Please Select Postal Code',
                    skill_set: '*Please Enter Your Skill Set',
                    job_description: '*Please Enter Your Job Description',
                    specification: '*Please Enter Your Specification',
                    salary_type: '*Please Select Salary Type',
                    pay_type: '*Please Select pay Type',
                    min_salary: '*Please Select Minimum salary',
                    max_salary: '*Please Select maximum Salary',
                    job_type: '*Please Select Job Type',
                    min_year_exp: '*Please Select Minimum Experience',
                    max_year_exp: '*Please Select Maximum Experience',
                    edu_qualification: '*Please Select Last Qualification',
                    industry: '*Please Select Your Industry Type',
                    job_address: '*Please Select Job Address',
                    gender: '*Please Select Gender',
                    is_local: '*Please Select Local',
                    status: '*Please Select Status',
                    software_catagory: '*Please Select Software Catagories',
                },
                errorPlacement: function(error, elemen) {
                    error.insertAfter(element);

                },
                submitHandler: function(form) {
                    form.submit();
                }

            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('#js-example-basic-multiple').select2();
        });

        $('.select-single').select2();
        $('.select-multiple').select2({
            tags: true,
            tokenSeparators: [',']
        });

        function selectDescription(e) {
            $.ajax({
                url: "position/create/" + e,
                success: function(result) {

                    var textarea = document.querySelector('#textarea');
                    textarea.innerText = result;
                    var a = document.querySelector('.modal-content');

                }
            });
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


        function locChange() {
            var state_id = $('#state').val();

            $.get("{{ url('getCity') }}", {
                state: state_id,
            }, function(response) {
                $('#locations').html(response);
            });
        };
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://white-force.com/onrole/assets/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
@endsection
