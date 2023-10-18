@extends('master.master')
@section('title', 'Position')
@section('content')
    @include('all_jquery_function')

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
                        <form id="PositionEditForm" action="{{ route('position.update', $id) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Basic Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">
                                                    <label class="form-label">Client*</label>
                                                    <select class="  form-control wide" name="client_id" required>
                                                        <option value="">--Select--</option>
                                                        @foreach ($client as $client)
                                                            <option
                                                                value="{{ $client->id }}"{{ $client->id == $position->client_id ? 'selected' : '' }}>
                                                                {{ $client->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error('client_id')
                                                    <span class="text-denger">{{ $message }}</span>
                                                @enderror
                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">
                                                    <label class="form-label">Position name</label>
                                                    <div class="input-group clockpicker" data-placement="bottom">
                                                        <input type="text" class="form-control" name="position_name"
                                                            value="{{ $position->position_name }}">
                                                    </div>
                                                    @error('position_name')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">
                                                    <label class="form-label">Country</label>
                                                    <div class="input-group">
                                                        <select class="form-control" name="countries"
                                                            onchange="findstate();" id="country">
                                                            @foreach ($country as $country)
                                                                <option value="{{ $country->id }}"<?php if ($position->countries == $country->country_name) {
                                                                    echo 'selected';
                                                                } ?>>
                                                                    {{ $country->country_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('countries')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 col-xl-3 col-xxl-4">
                                                    <label class="form-label">Select state</label>
                                                    <div class="input-group clockpicker">
                                                        <select class="form-control" name="states" id="state"
                                                            onchange="findcity();">
                                                            @php $states = \App\Models\State::get();  @endphp
                                                            @foreach ($states as $state)
                                                                <option
                                                                    value="{{ $state->id }}"{{ $state->state_name == $position->states ? 'selected' : '' }}>
                                                                    {{ $state->state_name }}</option>
                                                            @endforeach
                                                        </select>



                                                    </div>
                                                    @error('states')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 col-xl-3 col-xxl-4 mb-3">
                                                    <label class="form-label">Position city</label>
                                                    <div class="input-group">
                                                        <select class="form-control" name="city"
                                                            value="{{ $position->locations }}" id="city">
                                                            @php $cities = \App\Models\cities::get();  @endphp
                                                            @foreach ($cities as $cities)
                                                                <option
                                                                    value="{{ $cities->id }}"{{ $cities->city_name == $position->city ? 'selected' : '' }}>
                                                                    {{ $cities->city_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    @error('locations')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="col-md-6 col-xl-3 col-xxl-4">
                                                    <label class="form-label">Postal code</label>
                                                    <div class="input-group clockpicker">
                                                        <input type="text" class="form-control" name="postal_code"
                                                            value="{{ $position->postal_code }}">
                                                    </div>
                                                    @error('postal_code')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Enter Close By Date / No Of Openings / Work From
                                                Home
                                                Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row form-material">
                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">
                                                    <label class="form-label">Close By Date *</label>
                                                    <input type="date" class="form-control" name="closeDate"
                                                        value="{{ $position->close_date }}">
                                                    @error('closeDate')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">
                                                    <label class="form-label">No Of Openings *</label>
                                                    <input type="number" class="form-control" name="openings"
                                                        value="{{ $position->openings }}">
                                                </div>
                                                @error('openings')
                                                    <span class="text-denger">{{ $message }}</span>
                                                @enderror
                                                <div class="col-xl-4 col-xxl-4 col-md-6 mb-3">
                                                    <label class="form-label">Work From Home *</label>
                                                    <select name="is_remote_work" class="  form-control wide">
                                                        <option value="0"
                                                            {{ '0' == $position->is_remote_work ? 'selected' : '' }}>
                                                            No</option>

                                                        <option value="1"
                                                            {{ '1' == $position->is_remote_work ? 'selected' : '' }}>
                                                            Yes</option>
                                                    </select>
                                                </div>
                                                @error('is_remote_work')
                                                    <span class="text-denger">{{ $message }}</span>
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
                                                        <p class="mb-1">Skill set*</p>
                                                        <div class="asColorPicker-wrap">
                                                            <input name="skill_set"
                                                                class="complex-colorpicker form-control asColorPicker-input"
                                                                value="{{ $position->skill_set }}">
                                                        </div>
                                                        @error('skill_set')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Location</p>
                                                        <div class="asColorPicker-wrap"><input type="text"
                                                                class="complex-colorpicker form-control asColorPicker-input"
                                                                value="" name="localtion"
                                                                value="{{ $position->localtion }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-xl-12 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Job Description*</p>
                                                        <div class="asColorPicker-wrap">
                                                            <textarea name="job_description" class="form-control" id="textarea" rows="4" cols="50">{{ $position->job_description }}</textarea>
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
                                            <h4 class="card-title"> Enter Education Details</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Education specification*</p>
                                                        <div class="asColorPicker-wrap"><input type="text"
                                                                class="as_colorpicker form-control asColorPicker-input"
                                                                name="specification"
                                                                value="{{ $position->specification }}">
                                                        </div>
                                                        @error('specification')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Salary Type</p>
                                                        <div class="asColorPicker-wrap"><select name="salary_type"
                                                                class="  form-control wide">
                                                                <option
                                                                    value="INR"{{ 'INR' == $position->salary_type ? 'selected' : '' }}>
                                                                    INR</option>
                                                                <option
                                                                    value="USD"{{ 'USD' == $position->salary_type ? 'selected' : '' }}>
                                                                    USD</option>
                                                                <option value="POUND"
                                                                    {{ 'POUND' == $position->salary_type ? 'selected' : '' }}>
                                                                    POUND</option>
                                                                <option
                                                                    value="DIRHAM"{{ 'DIRHAM' == $position->salary_type ? 'selected' : '' }}>
                                                                    DIRHAM</option>
                                                            </select>
                                                        </div>
                                                        @error('postal_code')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Pay Type</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="pay_type" class="  form-control wide">
                                                                <option value="Annually"
                                                                    {{ 'Annually' == $position->pay_type ? 'selected' : '' }}>
                                                                    Annually</option>
                                                                <option value="monthly"
                                                                    {{ 'monthly' == $position->pay_type ? 'selected' : '' }}>
                                                                    Monthly</option>
                                                                <option value="hourly"
                                                                    {{ 'hourly' == $position->pay_type ? 'selected' : '' }}>
                                                                    Hourly</option>
                                                            </select>
                                                        </div>
                                                        @error('pay_type')
                                                            <span class="text-denger">{{ $message }}</span>
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
                                                        <p class="mb-1">Min Salary Range(INR)</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="min_salary" class="  form-control wide">
                                                                <option value="5000"
                                                                    {{ '5000' == $position->min_salary ? 'selected' : '' }}>
                                                                    05 Thousand</option>
                                                                <option value="10000"
                                                                    {{ '10000' == $position->min_salary ? 'selected' : '' }}>
                                                                    10 Thousand</option>
                                                                <option value="20000"
                                                                    {{ '20000' == $position->min_salary ? 'selected' : '' }}>
                                                                    20 Thousand</option>
                                                                <option
                                                                    value="30000"{{ '30000' == $position->min_salary ? 'selected' : '' }}>
                                                                    30 Thousand</option>
                                                                <option value="40000"
                                                                    {{ '40000' == $position->min_salary ? 'selected' : '' }}>
                                                                    40 Thousand</option>
                                                                @for ($i = 1; $i < 50; $i++)
                                                                    <option value="{{ $i . '00000' }}">
                                                                        {{ $i }} Lacs
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('min_salary')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Max Salary Range(INR)</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="max_salary" class="  form-control wide">
                                                                <option value="10000"
                                                                    {{ '10000' == $position->max_salary ? 'selected' : '' }}>
                                                                    10 Thousand</option>
                                                                <option value="20000"
                                                                    {{ '20000' == $position->max_salary ? 'selected' : '' }}>
                                                                    20 Thousand</option>
                                                                <option value="30000"
                                                                    {{ '30000' == $position->max_salary ? 'selected' : '' }}>
                                                                    30 Thousand</option>
                                                                <option value="40000"
                                                                    {{ '40000' == $position->max_salary ? 'selected' : '' }}>
                                                                    50 Thousand</option>
                                                                @for ($i = 1; $i <= 50; $i++)
                                                                    <option value="{{ $i . '00000' }}">
                                                                        {{ $i }} Lacs
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('max_salary')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Job Type</p>
                                                        <div class="asColorPicker-wrap"><select name="job_type"
                                                                class="  form-control wide">
                                                                <option value="Full Time"
                                                                    {{ 'Full Time' == $position->job_type ? 'selected' : '' }}>
                                                                    Full Time</option>
                                                                <option value="Part Time"
                                                                    {{ 'Part Time' == $position->job_type ? 'selected' : '' }}>
                                                                    Part Time</option>
                                                                <option value="Temporary"
                                                                    {{ 'Temporary' == $position->job_type ? 'selected' : '' }}>
                                                                    Temporary</option>
                                                                <option value="Contract"
                                                                    {{ 'Contract' == $position->job_type ? 'selected' : '' }}>
                                                                    Contract</option>
                                                                <option
                                                                    value="Internship"{{ 'Internship' == $position->job_type ? 'selected' : '' }}>
                                                                    Internship</option>
                                                            </select>
                                                        </div>
                                                        @error('job_type')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Min Eperience</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="min_year_exp" id="minYearExp"
                                                                class="  form-control wide">
                                                                @for ($i = 0; $i <= 15; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $position->min_year_exp == $i ? 'selected' : '' }}>
                                                                        {{ $i }} Year</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('min_year_exp')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Max Eperience</p>
                                                        <div class="asColorPicker-wrap">
                                                            <select name="max_year_exp" id="maxYearExp"
                                                                class="  form-control wide">
                                                                @for ($i = 0; $i <= 30; $i++)
                                                                    <option value="{{ $i }}"
                                                                        {{ $position->max_year_exp == $i ? 'selected' : '' }}>
                                                                        {{ $i }} Year</option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                        @error('max_year_exp')
                                                            <span class="text-denger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-6 mb-3">
                                                    <div class="example">
                                                        <p class="mb-1">Qualification</p>
                                                        <div class="asColorPicker-wrap"><select name="edu_qualification"
                                                                class="  form-control wide">
                                                                <option value="10th"
                                                                    {{ '10th' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    10th</option>
                                                                <option value="12th"
                                                                    {{ '12th' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    12th</option>
                                                                <option value="under_grduate"
                                                                    {{ 'under_grduate' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Under Graduate</option>
                                                                <option value="any_graduate"
                                                                    {{ 'any_graduate' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Any Graduate</option>
                                                                <option value="B.Sc_Agriculture"
                                                                    {{ 'B.Sc_Agriculture' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Agriculture (B.Sc. (Agriculture))
                                                                </option>
                                                                <option value="B.Arch"
                                                                    {{ 'B.Arch' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Architecture (B.Arch.)</option>
                                                                <option value="B.Arts"
                                                                    {{ 'B.Arts' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Arts (B.A.)</option>
                                                                <option value="B.Ayur"
                                                                    {{ 'B.Ayur' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Ayurvedic Medicine &amp; Surgery
                                                                    (B.A.M.S.)</option>
                                                                <option value="B.B.A"
                                                                    {{ 'B.B.A' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Business Administration (B.B.A.)
                                                                </option>
                                                                <option value="B.Com"
                                                                    {{ 'B.Com' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Commerce (B.Com.)</option>
                                                                <option value="B.C.A"
                                                                    {{ 'B.C.A' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Computer Applications (B.C.A.)</option>
                                                                <option value="B.Sc(Comp)"
                                                                    {{ 'B.Sc(Comp)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Computer Science (B.Sc. (Computer
                                                                    Science))</option>
                                                                <option value="B.D.S"
                                                                    {{ 'B.D.S' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Dental Surgery (B.D.S.)</option>
                                                                <option value="B.Des(Des)"
                                                                    {{ 'B.Des(Des)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Design (B.Des. - B.D.)</option>
                                                                <option value="B.Ed"
                                                                    {{ 'B.Ed' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Education (B.Ed.)</option>
                                                                <option value="B.Ed"
                                                                    {{ 'B.Ed' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Engineering - Bachelor of Technology
                                                                    (B.E./B.Tech.)</option>
                                                                <option value="BFA"
                                                                    {{ 'BFA' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Fine Arts (BFA - BVA)</option>
                                                                <option value="BF.Sc"
                                                                    {{ 'BF.Sc' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Fisheries Science (B.F.Sc. - B.Sc.
                                                                    (Fisheries))</option>
                                                                <option value="B.Sc(Home)"
                                                                    {{ 'BF.Sc' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Home Science (B.A. - B.Sc. (Home
                                                                    Science))</option>
                                                                <option> Bachelor of Homeopathic Medicine and Surgery
                                                                    (B.H.M.S.)</option>
                                                                <option value="L.L.B"
                                                                    {{ 'L.L.B' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Laws (L.L.B.)</option>
                                                                <option value="B.Lib"
                                                                    {{ 'B.Lib' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Library Science (B.Lib. - B.Lib.Sc.)
                                                                </option>
                                                                <option value="B.M.C"
                                                                    {{ 'B.M.C' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Mass Communications (B.M.C. - B.M.M.)
                                                                </option>
                                                                <option value="M.B.B.S"
                                                                    {{ 'M.B.B.S' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Medicine and Bachelor of Surgery
                                                                    (M.B.B.S.)</option>
                                                                <option
                                                                    value="BSc(Nursing)"{{ 'BSc(Nursing)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Nursing (B.Sc. (Nursing))</option>
                                                                <option
                                                                    value="B.Pharm"{{ 'B.Pharm' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Pharmacy (B.Pharm.)</option>
                                                                <option
                                                                    value="B.P.Ed"{{ 'B.P.Ed' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Physical Education (B.P.Ed.)</option>
                                                                <option
                                                                    value="B.P.T"{{ 'B.P.T' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Physiotherapy (B.P.T.)</option>
                                                                <option
                                                                    value="Bsc"{{ 'Bsc' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Science (B.Sc.)</option>
                                                                <option
                                                                    value="BSW"{{ 'BSW' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Social Work (BSW or B.A. (SW))</option>
                                                                <option
                                                                    value="B.Vet.Sc"{{ 'B.Vet.Sc' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Bachelor of Veterinary Science &amp; Animal
                                                                    Husbandry (B.V.Sc.)
                                                                <option
                                                                    value="M.D(Home)"{{ 'M.D(Home)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                <option
                                                                    value="D.M(Home)"{{ 'D.M(Home)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Doctor of Medicine in Homoeopathy (M.D.
                                                                    (Homoeopathy))</option>
                                                                <option
                                                                    value="M.sc(Sc)"{{ 'M.sc(Sc)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master in Home Science (M.A. - M.Sc. (Home Science))
                                                                </option>
                                                                <option
                                                                    value="M.Arch"{{ 'M.Arch' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Architecture (M.Arch.)</option>
                                                                <option
                                                                    value="M.A(Arts)"{{ 'M.A(Arts)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Arts (M.A.)</option>
                                                                <option
                                                                    value="M.B.A"{{ 'M.B.A' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Business Administration (M.B.A.)</option>
                                                                <option
                                                                    value="M.Ch"{{ 'M.Ch' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Chirurgiae (M.Ch.)</option>
                                                                <option
                                                                    value="M.Com"{{ 'M.Com' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Commerce (M.Com.)</option>
                                                                <option
                                                                    value="MCA"{{ 'MCA' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Computer Applications (M.C.A.)</option>
                                                                <option
                                                                    value="MDS"{{ 'MDS' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Dental Surgery (M.D.S.)</option>
                                                                <option
                                                                    value="MDes"{{ 'MDes' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Design (M.Des. - M.Design.)</option>
                                                                <option
                                                                    value="M.Ed"{{ 'M.Ed' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Education (M.Ed.)</option>
                                                                <option
                                                                    value="M.Tech"{{ 'M.Tech' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Engineering - Master of Technology
                                                                    (M.E./M.Tech.)</option>
                                                                <option
                                                                    value="MFA"{{ 'MFA' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Fine Arts (MFA - MVA)</option>
                                                                <option
                                                                    value="MFSc"{{ 'MFSc' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Fishery Science (M.F.Sc. - M.Sc.
                                                                    (Fisheries))</option>
                                                                <option
                                                                    value="LLM"{{ 'LLM' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Laws (L.L.M.)</option>
                                                                <option
                                                                    value="M.Lib"{{ 'M.Lib' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Library Science (M.Lib. - M.Lib.Sc.)
                                                                </option>
                                                                <option
                                                                    value="M.M.C"{{ 'M.M.C' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Mass Communications (M.M.C - M.M.M.)
                                                                </option>
                                                                <option
                                                                    value="M.Pharm"{{ 'M.Pharm' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Pharmacy (M.Pharm)</option>
                                                                <option
                                                                    value="M.Phil"{{ 'M.Phil' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Philosophy (M.Phil.)</option>
                                                                <option
                                                                    value="M.P.Ed"{{ 'M.P.Ed' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Physical Education (M.P.Ed. - M.P.E.)
                                                                </option>
                                                                <option
                                                                    value="M.P.T"{{ 'M.P.T' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Physiotherapy (M.P.T.)</option>
                                                                <option
                                                                    value="M.Sc."{{ 'M.Sc.' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Science (M.Sc.)</option>
                                                                <option
                                                                    value="M.Sc(Agri)"{{ 'M.Sc(Agri)' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Science in Agriculture (M.Sc.
                                                                    (Agriculture))</option>
                                                                <option
                                                                    value="M.S.W"{{ 'M.S.W' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Social Work (M.S.W. or M.A. (SW))</option>
                                                                <option
                                                                    value="M.S."{{ 'M.S.' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Surgery (M.S.)</option>
                                                                <option
                                                                    value="M.V.Sc."{{ 'M.V.Sc.' == $position->edu_qualification ? 'selected' : '' }}>
                                                                    Master of Veterinary Science (M.V.Sc.)</option>
                                                            </select>
                                                        </div>
                                                        @error('edu_qualification')
                                                            <span class="text-denger">{{ $message }}</span>
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
                                            <div class="col-xl-4 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="mb-1">Industry</p>
                                                    <div class="asColorPicker-wrap">
                                                        <select name="industry" class="  form-control wide">
                                                            <option value="IT-Software / Software Services"
                                                                {{ 'IT-Software / Software Services' == $position->industry ? 'selected' : '' }}>
                                                                IT-Software /
                                                                Software Services
                                                            </option>
                                                            <option value="BPO / Call Centre / ITES"
                                                                {{ 'BPO / Call Centre / ITES' == $position->industry ? 'selected' : '' }}>
                                                                BPO / Call Centre /
                                                                ITES
                                                            </option>

                                                            <option value="Automotive / Auto Ancillary / Auto Components"
                                                                {{ 'Automotive / Auto Ancillary / Auto Components' == $position->industry ? 'selected' : '' }}>
                                                                Automotive / Auto Ancillary / Auto Components</option>

                                                            <option value="Accounting / Finance"
                                                                {{ 'Accounting / Finance' == $position->industry ? 'selected' : '' }}>
                                                                Accounting / Finance
                                                            </option>
                                                            <option value="Advertising / PR / MR / Event Management"
                                                                {{ 'Advertising / PR / MR / Event Management' == $position->industry ? 'selected' : '' }}>
                                                                Advertising / PR / MR / Event Management</option>

                                                            <option value="Agriculture / Diary"
                                                                {{ 'Agriculture / Diary' == $position->industry ? 'selected' : '' }}>
                                                                Agriculture / Diary
                                                            </option>

                                                            <option value="Airlines"
                                                                {{ 'Airlines' == $position->industry ? 'selected' : '' }}>
                                                                Airlines</option>
                                                            <option value="Animation / Gaming"
                                                                {{ 'Animation / Gaming' == $position->industry ? 'selected' : '' }}>
                                                                Animation / Gaming
                                                            </option>

                                                            <option value="Architecture / Interior Design"
                                                                {{ 'Architecture / Interior Design' == $position->industry ? 'selected' : '' }}>
                                                                Architecture /
                                                                Interior Design</option>
                                                            <option value="Aviation / Aerospace"
                                                                {{ 'Aviation / Aerospace' == $position->industry ? 'selected' : '' }}>
                                                                Aviation / Aerospace
                                                            </option>
                                                            <option value="Banking / Financial Services / Broking"
                                                                {{ 'Banking / Financial Services / Broking' == $position->industry ? 'selected' : '' }}>
                                                                Banking
                                                                /
                                                                Financial Services / Broking</option>
                                                            <option value="Brewery / Distillery"
                                                                {{ 'Brewery / Distillery' == $position->industry ? 'selected' : '' }}>
                                                                Brewery / Distillery
                                                            </option>
                                                            <option value="Broadcasting"
                                                                {{ 'Broadcasting' == $position->industry ? 'selected' : '' }}>
                                                                Broadcasting</option>

                                                            <option value="Ceramics / Sanitary ware"
                                                                {{ 'Ceramics / Sanitary ware' == $position->industry ? 'selected' : '' }}>
                                                                Ceramics /
                                                                Sanitary
                                                                ware</option>
                                                            <option value="Chemicals / Petro Chemicals / Plastics / Rubber"
                                                                {{ 'Chemicals / Petro Chemicals / Plastics / Rubber' == $position->industry ? 'selected' : '' }}>
                                                                Chemicals / Petro
                                                                Chemicals
                                                                / Plastics / Rubber</option>
                                                            <option value="Construction / Engineering / Cement / Metals"
                                                                {{ 'Construction / Engineering / Cement / Metals' == $position->industry ? 'selected' : '' }}>
                                                                Construction /
                                                                Engineering
                                                                /
                                                                Cement / Metals</option>
                                                            <option value="Consumer Electronics / Appliances / Durables"
                                                                {{ 'Consumer Electronics / Appliances / Durables' == $position->industry ? 'selected' : '' }}>
                                                                Consumer Electronics /
                                                                Appliances / Durables</option>
                                                            <option
                                                                value="Courier / Transportation / Freight / Warehousing"
                                                                {{ 'Courier / Transportation / Freight / Warehousing' == $position->industry ? 'selected' : '' }}>
                                                                Courier /
                                                                Transportation /
                                                                Freight / Warehousing</option>
                                                            <option value="Education / Teaching / Training"
                                                                {{ 'Education / Teaching / Training' == $position->industry ? 'selected' : '' }}>
                                                                Education /
                                                                Teaching / Training</option>
                                                            <option value="Electricals /  Switchgears"
                                                                {{ 'Electricals /  Switchgears' == $position->industry ? 'selected' : '' }}>
                                                                Electricals /
                                                                Switchgears</option>
                                                            <option value="Export / Import"
                                                                {{ 'Export / Import' == $position->industry ? 'selected' : '' }}>
                                                                Export / Import</option>

                                                            <option value="Glass/ Glassware"
                                                                {{ 'Glass/ Glassware' == $position->industry ? 'selected' : '' }}>
                                                                Glass/ Glassware</option>

                                                            <option value="Facility Management"
                                                                {{ 'Facility Management' == $position->industry ? 'selected' : '' }}>
                                                                Facility Management
                                                            </option>

                                                            <option value="Fertilizers / Pesticides"
                                                                {{ 'Fertilizers / Pesticides' == $position->industry ? 'selected' : '' }}>
                                                                Fertilizers /
                                                                Pesticides</option>
                                                            <option value="FMCG / Food / Beverages"
                                                                {{ 'FMCG / Food / Beverages' == $position->industry ? 'selected' : '' }}>
                                                                FMCG / Food /
                                                                Beverages
                                                            </option>
                                                            <option value="Food Processing"
                                                                {{ 'Food Processing' == $position->industry ? 'selected' : '' }}>
                                                                Food Processing</option>

                                                            <option value="Gems / Jewelry"
                                                                {{ 'Gems / Jewelry' == $position->industry ? 'selected' : '' }}>
                                                                Gems / Jewelry</option>

                                                            <option value="Government / Defence"
                                                                {{ 'Government / Defence' == $position->industry ? 'selected' : '' }}>
                                                                Government / Defence
                                                            </option>
                                                            <option value="Heat Ventilation / Air Conditioning"
                                                                {{ 'Heat Ventilation / Air Conditioning' == $position->industry ? 'selected' : '' }}>
                                                                Heat
                                                                Ventilation / Air Conditioning</option>
                                                            <option value="Industrial Products / Heavy Machinery"
                                                                {{ 'Industrial Products / Heavy Machinery' == $position->industry ? 'selected' : '' }}>
                                                                Industrial
                                                                Products / Heavy Machinery</option>
                                                            <option value="Insurance"
                                                                {{ 'Insurance' == $position->industry ? 'selected' : '' }}>
                                                                Insurance</option>

                                                            <option value="Iron &amp; Steel"
                                                                {{ 'Iron &amp; Steel' == $position->industry ? 'selected' : '' }}>
                                                                Iron &amp; Steel</option>

                                                            <option
                                                                value="IT - Hardware &amp; Networking"{{ 'IT - Hardware &amp; Networking' == $position->industry ? 'selected' : '' }}>
                                                                IT -
                                                                Hardware
                                                                &amp; Networking</option>
                                                            <option value="KPO / Research Analysis"
                                                                {{ 'KPO / Research Analysis' == $position->industry ? 'selected' : '' }}>
                                                                KPO / Research
                                                                Analysis
                                                            </option>
                                                            <option value="Legal"
                                                                {{ 'Legal' == $position->industry ? 'selected' : '' }}>
                                                                Legal</option>
                                                            <option value="Media / Entertainment / Internet"
                                                                {{ 'Media / Entertainment / Internet' == $position->industry ? 'selected' : '' }}>
                                                                Media /
                                                                Entertainment / Internet</option>
                                                            <option value="Internet / E-commerce"
                                                                {{ 'Internet / E-commerce' == $position->industry ? 'selected' : '' }}>
                                                                Internet /
                                                                E-commerce
                                                            </option>
                                                            <option value="Leather / Medical / Hospitals"
                                                                {{ 'Leather / Medical / Hospitals' == $position->industry ? 'selected' : '' }}>
                                                                Leather / Medical
                                                                / Hospitals</option>
                                                            <option value="Medical Devices / Equipment"
                                                                {{ 'Medical Devices / Equipment' == $position->industry ? 'selected' : '' }}>
                                                                Medical
                                                                Devices /
                                                                Equipment</option>
                                                            <option value="Mining / Quarrying"
                                                                {{ 'Mining / Quarrying' == $position->industry ? 'selected' : '' }}>
                                                                Mining / Quarrying
                                                            </option>

                                                            <option
                                                                value="NGO / Social Service / Regulators / Industry Associations"
                                                                {{ 'NGO / Social Service / Regulators / Industry Associations' == $position->industry ? 'selected' : '' }}>
                                                                NGO /
                                                                Social
                                                                Service / Regulators / Industry Associations</option>

                                                            <option value="Office Equipment / Automation"
                                                                {{ 'Office Equipment / Automation' == $position->industry ? 'selected' : '' }}>
                                                                Office Equipment /
                                                                Automation</option>
                                                            <option value="Oil &amp; Gas / Energy / Power Infrastructure"
                                                                {{ 'Oil &amp; Gas / Energy / Power Infrastructure' == $position->industry ? 'selected' : '' }}>
                                                                Oil &amp; Gas / Energy / Power Infrastructure</option>

                                                            <option value="Pulp &amp; Paper"
                                                                {{ 'Pulp &amp; Paper' == $position->industry ? 'selected' : '' }}>
                                                                Pulp &amp; Paper</option>

                                                            <option value="Pharma / Biotech / Clinical Research"
                                                                {{ 'Pharma / Biotech / Clinical Research' == $position->industry ? 'selected' : '' }}>
                                                                Pharma /
                                                                Biotech / Clinical Research</option>
                                                            <option value="Printing / Packaging"
                                                                {{ 'Printing / Packaging' == $position->industry ? 'selected' : '' }}>
                                                                Printing / Packaging
                                                            </option>
                                                            <option value="Publishing"
                                                                {{ 'Publishing' == $position->industry ? 'selected' : '' }}>
                                                                Publishing</option>

                                                            <option value="Real Estate / Property"
                                                                {{ 'Real Estate / Property' == $position->industry ? 'selected' : '' }}>
                                                                Real Estate /
                                                                Property
                                                            </option>
                                                            <option value="Recruitment / Staffing"
                                                                {{ 'Recruitment / Staffing' == $position->industry ? 'selected' : '' }}>
                                                                Recruitment /
                                                                Staffing
                                                            </option>
                                                            <option value="Retail/Wholesale"
                                                                {{ 'Retail/Wholesale' == $position->industry ? 'selected' : '' }}>
                                                                Retail/Wholesale</option>

                                                            <option value="Security / Law Enforcement"
                                                                {{ 'Security / Law Enforcement' == $position->industry ? 'selected' : '' }}>
                                                                Security / Law
                                                                Enforcement</option>
                                                            <option value="Semiconductors/Electronics"
                                                                {{ 'Semiconductors/Electronics' == $position->industry ? 'selected' : '' }}>
                                                                Semiconductors/Electronics</option>
                                                            <option value="Shipping/Marine"
                                                                {{ 'Shipping/Marine' == $position->industry ? 'selected' : '' }}>
                                                                Shipping/Marine</option>

                                                            <option value="Strategy/Management Consulting"
                                                                {{ 'Strategy/Management Consulting' == $position->industry ? 'selected' : '' }}>
                                                                Strategy/
                                                                Management Consulting</option>
                                                            <option value="Sugar"
                                                                {{ 'Sugar' == $position->industry ? 'selected' : '' }}>
                                                                Sugar</option>
                                                            <option value="Telecom/ISP"
                                                                {{ 'Telecom/ISP' == $position->industry ? 'selected' : '' }}>
                                                                Telecom/ISP</option>

                                                            <option value="Textiles/Garments/Accessories"
                                                                {{ 'Textiles/Garments/Accessories' == $position->industry ? 'selected' : '' }}>
                                                                Textiles/Garments/Accessories</option>
                                                            <option value="Travel/Hotels/Restaurants"
                                                                {{ 'Travel/Hotels/Restaurants' == $position->industry ? 'selected' : '' }}>
                                                                Travel/Hotels/Restaurants</option>
                                                            <option value="Tyres"
                                                                {{ 'Tyres' == $position->industry ? 'selected' : '' }}>
                                                                Tyres</option>
                                                            <option value="Water Treatment / Waste Management"
                                                                {{ 'Water Treatment / Waste Management' == $position->industry ? 'selected' : '' }}>
                                                                Water
                                                                Treatment / Waste Management</option>
                                                            <option value="Wellness/Fitness/Sports/Beauty"
                                                                {{ 'Wellness/Fitness/Sports/Beauty' == $position->industry ? 'selected' : '' }}>
                                                                Wellness/Fitness/Sports/Beauty</option>
                                                            <option value="Others"
                                                                {{ 'Others' == $position->industry ? 'selected' : '' }}>
                                                                Others</option>
                                                        </select>
                                                    </div>
                                                    @error('industry')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="mb-1">Job Address</p>
                                                    <div class="asColorPicker-wrap">
                                                        <input type="text"
                                                            class="complex-colorpicker form-control asColorPicker-input"
                                                            name="job_address" value="{{ $position->job_address }}">
                                                    </div>
                                                    @error('job_address')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="mb-1">Gender*</p>
                                                    <div class="asColorPicker-wrap">
                                                        <select name="gender" class="  form-control wide">
                                                            <option value="null">--select--</option>
                                                            <option value="male&female" <?php if ($position->gender == 'male&female') {
                                                                echo 'selected';
                                                            } ?>>
                                                                Male And Female</option>
                                                            <option value="male" <?php if ($position->gender == 'male') {
                                                                echo 'selected';
                                                            } ?>>Male
                                                                Only
                                                            </option>
                                                            <option value="female" <?php if ($position->gender == 'female') {
                                                                echo 'selected';
                                                            } ?>>
                                                                Female Only</option>
                                                        </select>
                                                    </div>
                                                    @error('gender')
                                                        <span class="text-denger">{{ $message }}</span>
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
                                        <h4 class="card-title">Enter Position Details </h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-4 col-lg-6 mb-3">
                                                <div class="example">
                                                    <p class="mb-1">National / Internation</p>
                                                    <div class="asColorPicker-wrap">
                                                        <select name="is_local" class="  form-control wide">
                                                            <option value="1" <?php if ($position->is_local == '1') {
                                                                echo 'selected';
                                                            } ?>>naional</option>
                                                            <option value="0" <?php if ($position->is_local == '0') {
                                                                echo 'selected';
                                                            } ?>>International
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @error('is_local')
                                                        <span class="text-denger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                            <input type="hidden" name="contact_person_name" value="{{ Auth::user()->name }}">
                            <input type="hidden" name="person_contact" value="{{ auth::user()->contact }}">
                            <input type="hidden" name="person_email" value="{{ Auth::user()->email }}">

                            @include('pages.position.portal_form.national_portal')
                            @include('pages.position.portal_form.international_portal')

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block" value="submit">SUBMIT</button>

                            </div>

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
    <script>
        $(document).ready(function($) {
            $("#PositionEditForm").validate({
                rules: {
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
                },
                messages: {

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
                },
                errorPlacement: function(error, element) {

                    error.insertBefore(element);

                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });
    </script>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://white-force.com/onrole/assets/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
@endsection
