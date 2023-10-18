@extends('master.master')
@section('title', 'Edit Position')
@section('content')

    @include('all_jquery_function')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .select2-selection {
            padding: 15px !important;
        }

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

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: white;
        }

        .col-sm-3 {
            color: #000000e8;
            font-weight: 500;
        }
    </style>
   
    <link href="{{ url('assets/css/jobpoststyle.css') }}" rel="stylesheet">

    <div class="content-body">
        <div class="container-fluid row">
            <div class="col-xl-7 col-lg-7">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color: #fff;">Edit Position</h4>

                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('position.update',[$position->id]) }}" method="post" id='createPosition'>
                                
                                @method('patch')
                                @csrf
                                
                                <div class="mb-3 row mb-4">
                                    <div class="col-sm-12">
                                        <h5>Step 1 - Basic Information</h5>
                                    </div>
                                </div>

                                <div class="collapse" id="loader">
                                                    <h5 style="padding-left:300px;margin-top:-10px"><img src="{{ url('assets/images/agif.gif') }}"height="100px" width="100px"><br><h4 style="padding-left:292px;margin-top: -19px;
                                                             margin-bottom: 73px;color:#EB8153">Please Wait...</h4>
                                                    </h5>
                                                   

                                     </div>
                                    <div class="mb-3 row" style="margin-top:35px">
                                    <div class="col-sm-3">Choose Your JD <small
                                                            style="color:#EB8153">(Select PDF File Only)</small></div>
                                    <div class="col-sm-9 ">
                                        <input type="file" class="form-control" style="padding-top: 16px !important;" value=""
                                                            name="jd" accept="application/pdf" id="jdParser"
                                                            onchange="getJd()">
                                    </div>
                                </div>
                                {{-- </div> --}}




                                                <input type="text" hidden id="jd_json" name="jd_json">




                                <div class="mb-3 row">
                                    <div class="col-sm-3">Select Client*</div>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="client_id" required>
                                            <option value="">Select Client</option>
                                            @foreach ($Clients as $client)
                                            <option
                                            value="{{ $client->id }}"{{ $client->id == $position->client_id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Position Name</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="position_name"
                                            placeholder="Position Name" value="{{ $position->position_name}}"
                                            id="position_name">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Location</div>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="countries" id="country" onchange="getState();">
                                            <option value=""> Country</option>
                                            @foreach ($CountryList as $country)
                                                <option value="{{ $country->id }}"{{ $country->id == $position->countries ? 'selected' : '' }}>
                                                    {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="states" id="state"
                                            onchange="getCity();locChange(this);">
                                            <option value=""> State</option>
                                            <?php
                                            $states = App\Models\State::get();
                                            foreach($states as $state){?>
                                                                    <option value="{{ $state->id }}" <?php if ($position->states == $state->id) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                                        {{ $state->name }}</option>
                                                                    <?php }
                                      
                                        ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="city" id="city">
                                            <option value=""> City</option>
                                            <?php
                                            $cities = App\Models\Cities::get();
                                            foreach($cities as $city){?>
                                                                    <option value="{{ $city->id }}" <?php if ($position->city == $city->id) {
                                                                        echo 'selected';
                                                                    } ?>>
                                                                        {{ $city->name }}</option>
                                                                    <?php }
                                      
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Postal Code</div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control"  name="postal_code"
                                            placeholder="Postal Code" value="{{ $position->postal_code }}">
                                    </div>

                                </div>

                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 2 - Enter Close By Date</h5>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Close By Date*</div>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="close_date"
                                            placeholder="Close Date" value="{{ $position->close_date }}">
                                        @error('closeDate')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">No of openings*</div>
                                    <div class="col-sm-9">
                                        <input type="Number" class="form-control" name="openings" placeholder="Openings"
                                            value="{{ $position->openings}}">
                                        @error('openings')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Is Remote (WFH)*</div>
                                    <div class="col-sm-9">
                                        <select name="is_remote_work" class="default-select  form-control wide">
                                            <option value="0"
                                                            @if ($position->is_remote_work == 0) selected='selected' @endif>No
                                                        </option>
                                                        <option value="1"
                                                            @if ($position->is_remote_work == 1) selected='selected' @endif>Yes
                                                        </option>
                                        </select>
                                        @error('is_remote_work')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 3 - Enter Essential Information</h5>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Qualification</div>
                                    <div class="col-sm-9">
                                        <select name="edu_qualification" class="default-select  form-control wide">
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
                                        @error('edu_qualification')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Education*</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="as_colorpicker form-control asColorPicker-input"
                                            value="" name="specification" placeholder="Specification" value="{{ $position->specification }}">
                                        @error('specification')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">

                                    <div class="col-sm-3">Enter Skills*</div>
                                    <div class="col-sm-9">
                                        @php
                                        $skilldata = $position->skill_set;
                                        $skills = explode(',', $skilldata);
                                    @endphp
                                        <select name="skill_set[]" class="default-select form-control "
                                            placeholder="Enter skills by comma sepration" id="skills"
                                            multiple="multiple">
                                            @foreach ($skills as $item)
                                            <option
                                                value="{{ preg_replace('/[^A-Za-z0-9\-]/', '', $item) }}"
                                                selected>
                                                {{ preg_replace('/[^A-Za-z0-9\-]/', '', $item) }}
                                            </option>
                                        @endforeach
                                        </select>
                                        @error('skill_set')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="mb-3 row">
                                    <div class="col-sm-3">Location*</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="complex-colorpicker form-control asColorPicker-input"
                                            value="" name="locations" id="locations" placeholder="Location"
                                            value={{ old('locations') }}>
                                        @error('locations')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Job
                                        Description*</div>
                                    <div class="col-sm-9">
                                        <textarea placeholder="Enter Job desription" name="job_description" class="form-control" id="textarea"
                                            rows="4" cols="50">{{ $position->job_description }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 4 - Enter Salary Information</h5>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Type*</div>
                                    <div class="col-sm-4">
                                        <select name="salary_type" class="default-select  form-control wide">
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
                                        @error('salary_type')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="pay_type" class="default-select  form-control wide">
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
                                        @error('pay_type')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Salary (INR)*</div>
                                    <div class="col-sm-4">
                                        <select name="min_salary" class="default-select  form-control wide">
                                            @for ($i = 1; $i < 50; $i++)
                                            <option value="{{ $i . '00000' }}"
                                                {{ $position->min_salary == $i . '00000' ? 'selected' : '' }}>
                                                {{ $i }} Lacs
                                            </option>
                                        @endfor
                                        </select>
                                        @error('min_salary')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="max_salary" class="default-select  form-control wide">
                                            @for ($i = 1; $i <= 50; $i++)
                                            <option value="{{ $i . '00000' }}"
                                                {{ $position->max_salary == $i . '00000' ? 'selected' : '' }}>
                                                {{ $i }} Lacs
                                            </option>
                                        @endfor
                                        </select>
                                        @error('max_salary')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Job Type</div>
                                    <div class="col-sm-9">
                                        <select name="job_type" class="default-select  form-control wide">
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
                                        @error('job_type')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Experience</div>
                                    <div class="col-sm-4">
                                        <select name="min_year_exp" id="minYearExp"
                                            class="default-select  form-control wide">
                                            @for ($i = 0; $i <= 15; $i++)
                                                                    <option
                                                                        value="{{ $i }}"{{ $position->min_year_exp == $i ? 'selected' : '' }}>
                                                                        {{ $i }} Year</option>
                                                                @endfor
                                        </select>
                                        @error('min_year_exp')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="max_year_exp" id="maxYearExp"
                                            class="default-select  form-control wide">
                                            @for ($i = 0; $i <= 30; $i++)
                                            <option value="{{ $i }}"
                                                {{ $position->max_year_exp == $i ? 'selected' : '' }}>
                                                {{ $i }} Year</option>
                                        @endfor
                                        </select>
                                        @error('max_year_exp')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 5 - Enter Experience Information</h5>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Select Industry*</div>
                                    <div class="col-sm-9">
                                        <select name="industry" class="default-select  form-control wide">
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
                                </div>
                                {{-- <div class="mb-3 row">
                                    <div class="col-sm-3">Job Address*</div>
                                    <div class="col-sm-9">
                                        <input type="text" class="complex-colorpicker form-control asColorPicker-input"
                                            value="" name="job_address" placeholder="Job Address">
                                        @error('job_address')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Job For*</div>
                                    <div class="col-sm-9">
                                        <select name="gender" class="form-control">
                                            <option value="">Select</option>
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
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Is Local*</div>
                                    <div class="col-sm-9">
                                        <select name="is_local" class="default-select  form-control wide">
                                            <option value="1"
                                                        @if ($position->is_local == 1) selected='selected' @endif>
                                                        National</option>
                                                    <option value="0"
                                                        @if ($position->is_local == 0) selected='selected' @endif>
                                                        International</option>
                                        </select>

                                        @error('is_local')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <hr>

                                <div id="shine_portals_form" class="col-sm-12">

                                </div>
                                <div id="clickindia_portals_form" class="col-sm-12">

                                </div>
                                <div id="monster_portals_form" class="col-sm-12">

                                </div>
                                <div id="jora_portals_form" class="col-sm-12">

                                </div>
                                <div id="naukri_portals_form" class="col-sm-12">

                                </div>
                                <div id="jooble_portals_form" class="col-sm-12">

                                </div>
                                <div id="timesjob_portals_form" class="col-sm-12">

                                </div>
                                <div id="googlejob_portals_form" class="col-sm-12">

                                </div>
                                  <div id="ziprecruiter_portals_form" class="col-sm-12">

                                </div>




                                <center><button type="submit" class="btn btn-primary btn-sm "
                                        name="submit">Update</button></center>
                            {{-- </form> --}}

                        </div>

                    </div>
                </div>
            </div>

           <style>
                .checkbox-group {
                    display: flex;
                    flex-wrap: wrap;
                    justify-content: center;
                    width: 98%;
                    margin: 10px auto;
                    /* max-width: 600px; */
                    user-select: none;

                    &>* {
                        margin: 0.5rem 0.5rem;
                    }
                }

                .bigbox {
                    width: 100%;
                    display: flex;
                    flex-direction: row;
                }

                .checkbox-group-legend {
                    font-size: 1.5rem;
                    font-weight: 700;
                    color: #9c9c9c;
                    text-align: center;
                    line-height: 1.125;
                    margin-bottom: 1.25rem;
                }

                .checkbox-input {
                    // Code to hide the input
                    clip: rect(0 0 0 0);
                    clip-path: inset(100%);
                    height: 1px;
                    overflow: hidden;
                    position: absolute;
                    white-space: nowrap;
                    width: 1px;

                    &:checked+.checkbox-tile {
                        border-color: #2260ff;
                        box-shadow: 0 5px 10px rgba(#000, 0.1);
                        color: #2260ff;

                        &:before {
                            transform: scale(1);
                            opacity: 1;
                            background-color: #2260ff;
                            border-color: #2260ff;
                        }

                        .checkbox-icon,
                        .checkbox-label {
                            color: #2260ff;
                        }
                    }

                    &:focus+.checkbox-tile {
                        border-color: #2260ff;
                        box-shadow: 0 5px 10px rgba(#000, 0.1), 0 0 0 4px #b5c9fc;

                        &:before {
                            transform: scale(1);
                            opacity: 1;
                        }
                    }
                }

                .checkbox-tile {
                    display: flex;
                    flex-direction: row;
                    align-items: center;
                    justify-content: center;
                    width: 102px;
                    margin: 6px;
                    min-height: 102px;
                    border-radius: 0.5rem;
                    border: 2px solid #b5bfd9;
                    background-color: #fff;
                    box-shadow: 0 5px 10px rgba(#000, 0.1);
                    transition: 0.15s ease;
                    cursor: pointer;
                    position: relative;

                    &:before {
                        content: "";
                        position: absolute;
                        display: block;
                        width: 1.25rem;
                        height: 1.25rem;
                        border: 2px solid #b5bfd9;
                        background-color: #fff;
                        border-radius: 50%;
                        top: 0.25rem;
                        left: 0.25rem;
                        opacity: 0;
                        transform: scale(0);
                        transition: 0.25s ease;
                        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
                        background-size: 12px;
                        background-repeat: no-repeat;
                        background-position: 50% 50%;
                    }

                    &:hover {
                        border-color: #2260ff;

                        &:before {
                            transform: scale(1);
                            opacity: 1;
                        }
                    }
                }

                .checkbox-icon {
                    transition: 0.375s ease;
                    color: #494949;
                    padding: 6px;

                    svg {
                        width: 3rem;
                        height: 3rem;
                    }
                }

                .checkbox-label {
                    color: #707070;
                    transition: 0.375s ease;
                    text-align: center;
                }

                .checkbox-icon img {
                    max-width: 100%;
                }

                .alljobPortals {
                    height: auto;
                }

                .switch {
                    position: relative;
                    display: inline-block;
                    width: 42px;
                    height: 22px;
                }

                .switch input {
                    opacity: 0;
                    width: 0;
                    height: 0;
                }

                .slider {
                    position: absolute;
                    cursor: pointer;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    /* background-color: #5200006b; */
                    background-color: #ccc;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                .slider:before {
                    position: absolute;
                    content: "";
                    height: 18px;
                    width: 18px;
                    left: 3px;
                    bottom: 2px;
                    /* background-color: #dd9c26; */
                    background-color: white;
                    -webkit-transition: .4s;
                    transition: .4s;
                }

                input:checked+.slider {
                    background-color: #2196F3;
                }

                input:focus+.slider {
                    box-shadow: 0 0 1px #2196F3;
                }

                input:checked+.slider:before {
                    -webkit-transform: translateX(18px);
                    -ms-transform: translateX(18px);
                    transform: translateX(18px);
                }

                /* Rounded sliders */
                .slider.round {
                    border-radius: 34px;
                }

                .slider.round:before {
                    border-radius: 50%;
                }

                input:checked+.slider {
                    background-color: #1178f2;
                }
            </style>
            <div class="col-xl-5 col-lg-5" id="stickytypeheader">
                <div class="card alljobPortals" style="width: 460px;">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color: #fff;">Job Portals
                        </h4>

                    </div>
                    <div class="card-body"
                        style="
                    max-height: 524px;
                    overflow: auto;
                ">
                        <fieldset class="checkbox-group">
                            <h5>Choose Your National Portal</h5>
                            <div class="pull-right">
                                <label class="switch">
                                    <input type="checkbox" id="toogle_id" name="toggle" onclick="toggleJobProtals();">
                                    <span class="slider round"></span>
                                </label>
                            </div>


                            <div class="d-flex flex-wrap justify-content-center">
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal"
                                            value="linkedin">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/linkedin.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="facebook" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="facebook">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/facebook.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal"
                                            value="jobIsJob">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/jobisjob.jpg"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal"
                                            value="careerJet">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/careerjet.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="indeed" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="indeed">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/Indeed-logo.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="jooble" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="jooble" onchange="showJoobleForm();">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/jooble.jpg"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="drJob"
                                            class="checkbox-input jobportal" value="drJob">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/dr-logo-org.webp') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="adzuna_india"
                                            class="checkbox-input jobportal" value="adzuna_india">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/Adzuna_Logo.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="jora"
                                            onchange="showJoraForm();" class="checkbox-input jobportal" value="jora">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/jora.jpg') }}" alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="google" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="google"
                                            onchange="showGoogleJobForm();">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('logo/google.png') }}" alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal"
                                            value="shine" id="shine" onchange="showShineForm();">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/shine.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="clickIndia"
                                            class="checkbox-input jobportal" value="clickIndia"
                                            onchange="showClickIndiaForm();">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/clickIndia.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>


                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="monster"
                                            class="checkbox-input jobportal" onchange="showMonsterForm();"
                                            value="monster">
                                        <span class="checkbox-tile ">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/monster.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal"
                                            value="postJobFree">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/postJobFree.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="naukri" onchange="showNaukriForm();"
                                            name="jobPortals[]" class="checkbox-input jobportal" value="naukri">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/Naukri.jpg') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="timesjob" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="timesjob"
                                            onchange="showTimesJobForm();">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/TimesJobs-logo.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" id="whatJobs" name="jobPortals[]"
                                            class="checkbox-input jobportal" value="whatJobs">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/whatJobs.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="linkedinATS"
                                            class="checkbox-input jobportal" value="linkedinATS">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/ats.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                            </div>


                        </fieldset>
                        <fieldset class="checkbox-group">
                            <h5>Choose Your International Portal</h5>

                            <div class="d-flex flex-wrap justify-content-center">
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="job_vertise_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('logo/jobvertise.webp') }}" alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="my_job_helper_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/job_helper.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="cv_libaray_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/cv.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="adzuna_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('images/jobpostingportal/Adzuna_Logo.png') }}"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>


                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="whatjobs_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/whatJobs.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" id="ziprecruiter_inter"
                                            onchange="showZiprecruiterForm();" class="checkbox-input jobportal"
                                            value="ziprecruiter_inter">
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/zip.png"
                                                    alt="">
                                            </span>


                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="times_ascent_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/times-ascent.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>

                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" value="tanqeeb_inter" name="jobPortals[]"
                                            class="checkbox-input jobportal" />
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="https://www.white-force.com/onrole/job-posting-assets/tanqeeb.png"
                                                    alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">

                                </div>
                                <div class="checkbox">

                                </div>


                            </div>


                        </fieldset>
                        <hr>
                        <fieldset class="checkbox-group">
                            <div class="d-flex flex-wrap justify-content-center">
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input"
                                            value="happiest" checked>
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('logo/HappiestResume.png') }}" alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                                <div class="checkbox">
                                    <label class="checkbox-wrapper">
                                        <input type="checkbox" name="jobPortals[]" class="checkbox-input"
                                            value="whiteforce" checked>
                                        <span class="checkbox-tile">
                                            <span class="checkbox-icon">
                                                <img src="{{ url('logo/whiteforce.png') }}" alt="">
                                            </span>

                                        </span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
        </form>
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
            placeholder: "Enter Skiils",
        });


        function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e;
            option.value = e;
            option.selected = true;
            return option;
        }


$(document).ready(function($) {

$("#createPosition").validate({
    rules: {
        client_id: "required",
        position_name: "required",
        openings: "required",
        job_description: "required",
        min_year_exp: "required",
        max_year_exp: "required",
        specification: "required",
        salary_type: "required",
        pay_type: "required",
        min_salary: "required",
        max_salary: "required",
        job_Type: "required",
        industry: "required",
        gender: "required",
        is_remote_work: "required",
        countries: "required",
        states: "required",
        city: "required",
        postal_code: "required",
        skill_set: "required",
        edu_qualification: "required",
        close_date: "required",
    },
    messages: {
        client_id: "Select Client",
        position_name: "Enter Position Name",
        openings: "Enter Openings",
        job_description: "Enter Job Description",
        min_year_exp: "Select Minimum Year Experience",
        max_year_exp: "Select Maximum Year Experience",
        specification: "Enter Education Specification",
        salary_type: "Select Salary Type",
        pay_type: "Select Pay Type",
        min_salary: "Select minimum salary",
        max_salary: "Select maximum salary",
        job_Type: "Select Job Type ",
        industry: "Select Industry",
        gender: "Select Job For",
        is_remote_work: "Select Is Remote ",
        countries: "Select Country ",
        states: "Select State ",
        city: "Select city ",
        postal_code: "Enter Postal Code",
        skill_set: "Enter Skills ",
        edu_qualification: "Select Qualification",
        close_date: "Select Close date",
    },
    errorPlacement: function(error, element) {
        error.insertAfter(element);
    },
    submitHandler: function(form) {
        form.submit();
    }

});
});


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


        function showShineForm() {
            var checkBox = document.getElementById("shine");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'shine'
                }, function(response) {
                    $('#shine_portals_form').html(response);
                });
            } else {
                $('#shinetext').remove();
            }
        }

        function showClickIndiaForm() {
            var checkBox = document.getElementById("clickIndia");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'clickIndia'
                }, function(response) {
                    $('#clickindia_portals_form').html(response);
                });
            } else {
                $('#clicktext').remove();
            }
        }

        function showMonsterForm() {
            var checkBox = document.getElementById("monster");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'monster'
                }, function(response) {
                    $('#monster_portals_form').html(response);
                });
            } else {
                $('#monstertext').remove();
            }
        }

        function showJoraForm() {
            var checkBox = document.getElementById("jora");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'jora'
                }, function(response) {
                    $('#jora_portals_form').html(response);
                });
            } else {
                $('#joratext').remove();
            }
        }

        function showNaukriForm() {
            var checkBox = document.getElementById("naukri");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'naukri'
                }, function(response) {
                    $('#naukri_portals_form').html(response);
                });
            } else {
                $('#naukritext').remove();
            }
        }

        function showJoobleForm() {
            var checkBox = document.getElementById("jooble");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'jooble'
                }, function(response) {
                    $('#jooble_portals_form').html(response);
                });
            } else {
                $('#joobletext').remove();
            }
        }

        function showTimesJobForm() {
            var checkBox = document.getElementById("timesjob");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'timesjob'
                }, function(response) {
                    $('#timesjob_portals_form').html(response);
                });
            } else {
                $('#timejobtext').remove();
            }
        }

        function showGoogleJobForm() {
            var checkBox = document.getElementById("google");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'google'
                }, function(response) {
                    $('#googlejob_portals_form').html(response);
                });
            } else {
                $('#googlejobtext').remove();
            }
        }

        function showZiprecruiterForm() {
            var checkBox = document.getElementById("ziprecruiter_inter");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'ziprecruiter_inter'
                }, function(response) {
                    $('#ziprecruiter_portals_form').html(response);
                });
            } else {
                $('#ziprecruitertext').remove();
            }
        }
         function showZiprecruiterForm() {
            var checkBox = document.getElementById("ziprecruiter_inter");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'ziprecruiter_inter'
                }, function(response) {
                    $('#ziprecruiter_portals_form').html(response);
                    document.getElementById("ziprecruiter_portals_form").scrollIntoView();
                });
            } else {
                $('#ziprecruiter_portals_form').children().remove();
            }
        }
    
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
     function toggleJobProtals() {
            var value = $("#toogle_id").is(":checked");
            $(".jobportal").click();
        }
    </script>






    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link href="https://white-force.com/onrole/assets/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
@endsection
