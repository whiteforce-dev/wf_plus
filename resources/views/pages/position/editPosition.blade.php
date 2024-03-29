@extends('master.master')
@section('title', 'Edit Position')
@section('content')


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .content-body {
            min-height: 10px !important;
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



        .col-sm-3 {
            color: #000000e8;
            font-weight: 500;
        }

        .ccard-body {
            background: white;

        }

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

        /*----------------------*/
        .checkbox-input {
            clip: rect(0 0 0 0);
            clip-path: inset(100%);
            height: 1px;
            overflow: hidden;
            position: absolute;
            white-space: nowrap;
            width: 1px;
        }

        .checkbox-input:checked+.checkbox-tile {
            border-color: #eb8153;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            color: #eb8153;
        }

        .checkbox-input:checked+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
            background-color: #eb8153;
            border-color: #eb8153;
        }

        .checkbox-input:checked+.checkbox-tile .checkbox-icon,
        .checkbox-input:checked+.checkbox-tile .checkbox-label {
            color: #eb8153;
        }

        .checkbox-input:focus+.checkbox-tile {
            border-color: #eb8153;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4px #eb8153;
        }

        .checkbox-input:focus+.checkbox-tile:before {
            transform: scale(1);
            opacity: 1;
        }

        /*----------------------*/

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
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
            transition: 0.15s ease;
            cursor: pointer;
            position: relative;
        }

        .checkbox-tile:before {
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

        .checkbox-tile:hover {
            border-color: #eb8153;
        }

        .checkbox-tile:hover:before {
            transform: scale(1);
            opacity: 1;
        }

        .checkbox-icon {
            transition: 0.375s ease;
            color: #494949;
            padding: 6px;
        }

        .checkbox-icon svg {
            width: 3rem;
            height: 3rem;
        }

        .checkbox-label {
            color: #707070;
            transition: 0.375s ease;
            text-align: center;
        }

        .checkbox-icon img {
            max-width: 100%;
        }

        /*----------------------*/





        .alljobPortals {
            height: auto;
        }



        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background-color: #ebebeb;
            -webkit-border-radius: 10px;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            -webkit-border-radius: 10px;
            border-radius: 10px;
            background: #eb8153;
        }
    </style>
    <link href="{{ url('assets/css/jobpoststyle.css') }}" rel="stylesheet">
    <div class="content-body" style="padding-top: 4rem">
        <div class="container-fluid row" style="
        max-height: calc(100vh - 100px);
        overflow: auto;
    ">
            <div class="col-xl-7 col-lg-7">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color: #fff;">Edit Position</h4>

                    </div>
                    <div class="card-body ccard-body">
                        <div class="basic-form">
                            <form action="{{ route('position.update',[$position->id]) }}" method="post" id='createPosition'>
                                @method('patch')
                                @csrf
                                <div class="mb-3 row mb-4">
                                    <div class="col-sm-12">
                                        <h5>Step 1 - Basic Information</h5>
                                    </div>
                                </div>


                                <input type="text" hidden id="jd_json" name="jd_json">
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Select Client<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select class="single-select" name='client_id' required>
                                            <option value="" disabled selected>Select Client</option>
                                            @foreach ($Clients as $client)
                                            <option
                                            value="{{ $client->id }}"{{ $client->id == $position->client_id ? 'selected' : '' }}>
                                            {{ $client->name }}
                                        </option>
                                            @endforeach

                                        </select>
                                        @error('client_id')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Management Fees<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select class="single-select" id="management_fee"name='management_fee' onchange="getFlatAmount(this.value)"required >
                                            <option value="" disabled selected>Select Percentage</option>
                                            <option value="0" {{ $position->management_fee == '0' ? 'selected' : '' }}>Flat Amount</option>
                                            <option value="2" {{ $position->management_fee == '2' ? 'selected' : '' }}>2%</option>
                                            <option value="3" {{ $position->management_fee == '3' ? 'selected' : '' }}>3%</option>
                                            <option value="4" {{ $position->management_fee == '4' ? 'selected' : '' }}>4%</option>
                                            <option value="5" {{ $position->management_fee == '5' ? 'selected' : '' }}>5%</option>
                                            <option value="6" {{ $position->management_fee == '6' ? 'selected' : '' }}>6%</option>
                                            <option value="6.5" {{ $position->management_fee == '6.5' ? 'selected' : '' }}>6.5%</option>
                                            <option value="7" {{ $position->management_fee == '7' ? 'selected' : '' }}>7%</option>
                                            <option value="7.5" {{ $position->management_fee == '7.5' ? 'selected' : '' }}>7.5%</option>
                                            <option value="8" {{ $position->management_fee == '8' ? 'selected' : '' }}>8%</option>
                                            <option value="8.33" {{ $position->management_fee == '8.33' ? 'selected' : '' }}>8.33%</option>


                                        </select>
                                        @error('client_id')
                                        <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="mb-3 row" id="flatAmount">
                                    <div class="col-sm-3">Enter Flat Amount</div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name='flat_amount' id="flat_amount" value="{{ $position?->flat_amount }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Position Name<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"  name="position_name"
                                            placeholder="Position Name" value="{{ $position->position_name}}"
                                            id="position_name">
                                        @error('position_name')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Location<span style="color:red">*</span></div>
                                    <div class="col-sm-3">
                                        <select class="default form-control wide" name="countries" id="country"
                                            onchange="getStateList()">
                                            <option value="" disabled selected>Country</option>
                                            @foreach ($CountryList as $country)
                                            <option value="{{ $country->id }}">
                                                {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="default form-control wide" name="states" id="state"
                                            onchange="getCityList();">
                                            <option value="" disabled selected> State</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select class="default form-control wide" name="city" id="city">
                                            <option value="" disabled selected> City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Postal Code<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control"  name="postal_code"
                                            placeholder="Postal Code" value="{{ $position->postal_code }}" data-max="6">
                                    </div>

                                </div>


                                <div class="mb-3 row" style="margin-top:35px">
                                    <div class="col-sm-3">Choose Your JD <small style="color:#EB8153">(Select PDF File
                                            Only)</small></div>
                                    <div class="col-sm-9 ">
                                        <input type="file" class="form-control" style="padding-top: 9px !important;"
                                            value="" name="jd" accept="application/pdf" id="jdParser"
                                            onchange="getJd()">
                                    </div>
                                </div>
                                <div class="collapse" id="loader">
                                    <h5 style="padding-left:300px;margin-top:-10px"><img
                                            src="{{ url('assets/images/agif.gif') }}"height="100px" width="100px"><br>
                                        <h4
                                            style="padding-left:292px;margin-top: -19px;
                                                             margin-bottom: 73px;color:#EB8153">
                                            Please Wait...</h4>
                                    </h5>


                                </div>

                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 2 - Enter General Information</h5>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Close By Date<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" name="close_date"
                                            placeholder="Close Date" value="{{ $position->close_date }}">
                                        @error('close_date')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">No of openings<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="Number" class="form-control" name="openings"
                                            placeholder="Openings" value="{{ $position->openings}}">
                                        @error('openings')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-3">Is Remote (WFH)<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="is_remote_work" class="single-select">
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
                                    <div class="col-sm-3">Qualification<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="edu_qualification" class="single-select" id="select2Multiple">

                                            <option value="" disabled selected>Select Qualification</option>
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
                                    <div class="col-sm-3">Education<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <input type="text" class="as_colorpicker form-control asColorPicker-input"
                                        value="{{ $position->specification }}" name="specification" placeholder="Specification">
                                        @error('specification')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">

                                    <div class="col-sm-3">Enter Skills<span style="color:red">*</span></div>
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
                                        <small class="p-2">Enter multiple skills with (,) comma separated </small>
                                        <p></p>
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
                                        Description<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <textarea placeholder="&nbsp;&nbsp;&nbsp;&nbsp;Enter Job desription" name="job_description"
                                            class="form-control tinymce-editor" id="textarea" rows="4" cols="50">{{ $position->job_description }}</textarea>
                                        @error('job_description')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row mb-4 mt-5">
                                    <div class="col-sm-12">
                                        <h5>Step 4 - Enter Salary Information</h5>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Type<span style="color:red">*</span></div>
                                    <div class="col-sm-4">
                                        <select name="salary_type" class="single-select">
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
                                        <select name="pay_type" class="single-select">
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
                                    <div class="col-sm-3">Salary (INR)<span style="color:red">*</span></div>
                                    <div class="col-sm-4">
                                        <select name="min_salary" class="single-select">
                                            {{-- <option value="" disabled selected>Select Min Salary</option> --}}
                                            @for ($i = 1; $i < 50; $i++)
                                            <option
                                            value="{{ $i . '00000' }}"{{ $position->min_salary == $i . '00000' ?  'selected' : '' }}>
                                            {{ $i }} Lacs</option>
                                            {{-- <option value="{{ $i . '00000' }}"
                                                {{ $position->min_salary == $i . '00000' ? 'selected' : '' }}>
                                                {{ $i }} Lacs
                                            </option> --}}
                                        @endfor
                                            {{-- <option value="5000">05 Thousand</option>
                                            <option value="10000">10 Thousand</option>
                                            <option value="20000">20 Thousand</option>
                                            <option value="30000">30 Thousand</option>
                                            <option value="30000">50 Thousand</option>
                                            @for ($i = 1; $i < 50; $i++)
                                                <option value="{{ $i . '00000' }}">
                                                    {{ $i }} Lacs
                                                </option>
                                            @endfor --}}
                                        </select>
                                        @error('min_salary')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-5">
                                        <select name="max_salary" class="single-select" required>
                                            {{-- <option value="" disabled selected>Select Max Salary</option> --}}
                                            @for ($i = 1; $i <= 50; $i++)
                                            <option value="{{ $i . '00000' }}"
                                                {{ $position->max_salary == $i . '00000' ? 'selected' : '' }}>
                                                {{ $i }} Lacs
                                            </option>
                                        @endfor
                                            {{-- <option value="10000">10 Thousand</option>
                                            <option value="20000">20 Thousand</option>
                                            <option value="30000">30 Thousand</option>
                                            <option value="30000">50 Thousand</option>
                                            @for ($i = 1; $i <= 50; $i++)
                                                <option value="{{ $i . '00000' }}">
                                                    {{ $i }} Lacs
                                                </option>
                                            @endfor --}}
                                        </select>
                                        @error('max_salary')
                                            <span style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-3">Job Type<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="job_type" class="single-select">
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
                                    <div class="col-sm-3">Experience<span style="color:red">*</span></div>
                                    <div class="col-sm-4">
                                        <select name="min_year_exp" id="minYearExp" class="single-select">
                                            <option value="" selected disabled>Select Min Experience</option>
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
                                        <select name="max_year_exp" id="maxYearExp" class="single-select">
                                            <option value="" selected disabled>Select Max Experience</option>
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
                                    <div class="col-sm-3">Select Industry<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="industry" class="single-select">
                                            <option value="IT-Software / Software Services"
                                            {{ $position->industry == 'IT-Software / Software Services' ? 'selected' : '' }}>
                                            IT-Software / Software Services
                                        </option>
                                        <option value="BPO / Call Centre / ITES"
                                            {{$position->industry == 'BPO / Call Centre / ITES' ? 'selected' : '' }}>
                                            BPO / Call
                                            Centre / ITES
                                        </option>

                                        <option value="Automotive / Auto Ancillary / Auto Components"
                                            {{$position->industry == 'Automotive / Auto Ancillary / Auto Components' ? 'selected' : '' }}>
                                            Automotive / Auto Ancillary / Auto Components</option>

                                        <option value="Accounting / Finance"
                                            {{$position->industry == 'Accounting / Finance' ? 'selected' : '' }}>
                                            Accounting /
                                            Finance
                                        </option>
                                        <option value="Advertising / PR / MR / Event Management"
                                            {{$position->industry == 'Advertising / PR / MR / Event Management' ? 'selected' : '' }}>
                                            Advertising / PR / MR / Event Management</option>

                                        <option value="Agriculture / Diary"
                                            {{$position->industry == 'Agriculture / Diary' ? 'selected' : '' }}>
                                            Agriculture /
                                            Diary
                                        </option>

                                        <option value="Airlines"
                                            {{$position->industry == 'Airlines' ? 'selected' : '' }}>
                                            Airlines</option>
                                        <option value="Animation / Gaming"
                                            {{$position->industry == 'Animation / Gaming' ? 'selected' : '' }}>
                                            Animation /
                                            Gaming
                                        </option>

                                        <option value="Architecture / Interior Design"
                                            {{$position->industry == 'Architecture / Interior Design' ? 'selected' : '' }}>
                                            Architecture /
                                            Interior Design</option>
                                        <option value="Aviation / Aerospace"
                                            {{$position->industry == 'Aviation / Aerospace' ? 'selected' : '' }}>
                                            Aviation /
                                            Aerospace
                                        </option>
                                        <option value="Banking / Financial Services / Broking"
                                            {{$position->industry == 'Banking / Financial Services / Broking' ? 'selected' : '' }}>
                                            Banking /
                                            Financial Services / Broking</option>
                                        <option value="Brewery / Distillery"
                                            {{$position->industry == 'Brewery / Distillery' ? 'selected' : '' }}>
                                            Brewery /
                                            Distillery
                                        </option>
                                        <option value="Broadcasting"
                                            {{$position->industry == 'Broadcasting' ? 'selected' : '' }}>
                                            Broadcasting</option>

                                        <option value="Ceramics / Sanitary ware"
                                            {{$position->industry == 'Ceramics / Sanitary ware' ? 'selected' : '' }}>
                                            Ceramics /
                                            Sanitary
                                            ware</option>
                                        <option value="Chemicals / Petro Chemicals / Plastics / Rubber"
                                            {{$position->industry == 'Chemicals / Petro Chemicals / Plastics / Rubber' ? 'selected' : '' }}>
                                            Chemicals / Petro
                                            Chemicals
                                            / Plastics / Rubber</option>
                                        <option value="Construction / Engineering / Cement / Metals"
                                            {{$position->industry == 'Construction / Engineering / Cement / Metals' ? 'selected' : '' }}>
                                            Construction / Engineering
                                            /
                                            Cement / Metals</option>
                                        <option value="Consumer Electronics / Appliances / Durables"
                                            {{$position->industry == 'Consumer Electronics / Appliances / Durables' ? 'selected' : '' }}>
                                            Consumer Electronics /
                                            Appliances / Durables</option>
                                        <option
                                            value="Courier / Transportation / Freight / Warehousing"
                                            {{$position->industry == 'Courier / Transportation / Freight / Warehousing' ? 'selected' : '' }}>
                                            Courier /
                                            Transportation /
                                            Freight / Warehousing</option>
                                        <option value="Education / Teaching / Training"
                                            {{$position->industry == 'Education / Teaching / Training' ? 'selected' : '' }}>
                                            Education /
                                            Teaching / Training</option>
                                        <option value="Electricals /  Switchgears"
                                            {{$position->industry == 'Electricals /  Switchgears' ? 'selected' : '' }}>
                                            Electricals /
                                            Switchgears</option>
                                        <option value="Export / Import"
                                            {{$position->industry == 'Export / Import' ? 'selected' : '' }}>
                                            Export / Import
                                        </option>

                                        <option value="Glass/ Glassware"
                                            {{$position->industry == 'Glass/ Glassware' ? 'selected' : '' }}>
                                            Glass/ Glassware
                                        </option>

                                        <option value="Facility Management"
                                            {{$position->industry == 'Facility Management' ? 'selected' : '' }}>
                                            Facility
                                            Management
                                        </option>

                                        <option value="Fertilizers / Pesticides"
                                            {{$position->industry == 'Fertilizers / Pesticides' ? 'selected' : '' }}>
                                            Fertilizers /
                                            Pesticides</option>
                                        <option value="FMCG / Food / Beverages"
                                            {{$position->industry == 'FMCG / Food / Beverages' ? 'selected' : '' }}>
                                            FMCG / Food
                                            /
                                            Beverages
                                        </option>
                                        <option value="Food Processing"
                                            {{$position->industry == 'Food Processing' ? 'selected' : '' }}>
                                            Food Processing
                                        </option>

                                        <option value="Gems / Jewelry"
                                            {{$position->industry == 'Gems / Jewelry' ? 'selected' : '' }}>
                                            Gems / Jewelry
                                        </option>

                                        <option value="Government / Defence"
                                            {{$position->industry == 'Government / Defence' ? 'selected' : '' }}>
                                            Government /
                                            Defence
                                        </option>
                                        <option value="Heat Ventilation / Air Conditioning"
                                            {{$position->industry == 'Heat Ventilation / Air Conditioning' ? 'selected' : '' }}>
                                            Heat
                                            Ventilation / Air Conditioning</option>
                                        <option value="Industrial Products / Heavy Machinery"
                                            {{$position->industry == 'Industrial Products / Heavy Machinery' ? 'selected' : '' }}>
                                            Industrial
                                            Products / Heavy Machinery</option>
                                        <option value="Insurance"
                                            {{$position->industry == 'Insurance' ? 'selected' : '' }}>
                                            Insurance</option>

                                        <option value="Iron &amp; Steel"
                                            {{$position->industry == 'Iron &amp; Steel' ? 'selected' : '' }}>
                                            Iron &amp; Steel
                                        </option>

                                        <option value="IT - Hardware &amp; Networking"
                                            {{$position->industry == 'IT - Hardware &amp; Networking' ? 'selected' : '' }}>
                                            IT -
                                            Hardware
                                            &amp; Networking</option>
                                        <option value="KPO / Research Analysis"
                                            {{$position->industry == 'KPO / Research Analysis' ? 'selected' : '' }}>
                                            KPO /
                                            Research
                                            Analysis
                                        </option>
                                        <option value="Legal"
                                            {{$position->industry == 'Legal' ? 'selected' : '' }}>Legal
                                        </option>
                                        <option value="Media / Entertainment / Internet"
                                            {{$position->industry == 'Media / Entertainment / Internet' ? 'selected' : '' }}>
                                            Media /
                                            Entertainment / Internet</option>
                                        <option value="Internet / E-commerce"
                                            {{$position->industry == 'Internet / E-commerce' ? 'selected' : '' }}>
                                            Internet /
                                            E-commerce
                                        </option>
                                        <option value="Leather / Medical / Hospitals"
                                            {{$position->industry == 'Leather / Medical / Hospitals' ? 'selected' : '' }}>
                                            Leather / Medical
                                            / Hospitals</option>
                                        <option value="Medical Devices / Equipment"
                                            {{$position->industry == 'Medical Devices / Equipment' ? 'selected' : '' }}>
                                            Medical
                                            Devices /
                                            Equipment</option>
                                        <option value="Mining / Quarrying"
                                            {{$position->industry == 'Mining / Quarrying' ? 'selected' : '' }}>
                                            Mining /
                                            Quarrying
                                        </option>

                                        <option
                                            value="NGO / Social Service / Regulators / Industry Associations"
                                            {{$position->industry == 'NGO / Social Service / Regulators / Industry Associations' ? 'selected' : '' }}>
                                            NGO / Social
                                            Service / Regulators / Industry Associations</option>

                                        <option value="Office Equipment / Automation"
                                            {{$position->industry == 'Office Equipment / Automation' ? 'selected' : '' }}>
                                            Office Equipment /
                                            Automation</option>
                                        <option value="Oil &amp; Gas / Energy / Power Infrastructure"
                                            {{$position->industry == 'Oil &amp; Gas / Energy / Power Infrastructure' ? 'selected' : '' }}>
                                            Oil &amp; Gas / Energy / Power Infrastructure</option>

                                        <option value="Pulp &amp; Paper"
                                            {{$position->industry == 'Pulp &amp; Paper' ? 'selected' : '' }}>
                                            Pulp &amp; Paper
                                        </option>

                                        <option value="Pharma / Biotech / Clinical Research"
                                            {{$position->industry == 'Pharma / Biotech / Clinical Research' ? 'selected' : '' }}>
                                            Pharma /
                                            Biotech / Clinical Research</option>
                                        <option value="Printing / Packaging"
                                            {{$position->industry == 'Printing / Packaging' ? 'selected' : '' }}>
                                            Printing /
                                            Packaging
                                        </option>
                                        <option value="Publishing"
                                            {{$position->industry == 'Publishing' ? 'selected' : '' }}>
                                            Publishing</option>

                                        <option value="Real Estate / Property"
                                            {{$position->industry == 'Real Estate / Property' ? 'selected' : '' }}>
                                            Real Estate
                                            /
                                            Property
                                        </option>
                                        <option value="Recruitment / Staffing"
                                            {{$position->industry == 'Recruitment / Staffing' ? 'selected' : '' }}>
                                            Recruitment
                                            /
                                            Staffing
                                        </option>
                                        <option value="Retail/Wholesale"
                                            {{$position->industry == 'Retail/Wholesale' ? 'selected' : '' }}>
                                            Retail/Wholesale
                                        </option>

                                        <option value="Security / Law Enforcement"
                                            {{$position->industry == 'Security / Law Enforcement' ? 'selected' : '' }}>
                                            Security
                                            / Law Enforcement</option>
                                        <option value="Semiconductors/Electronics"
                                            {{$position->industry == 'Semiconductors/Electronics' ? 'selected' : '' }}>
                                            Semiconductors/Electronics</option>
                                        <option value="Shipping/Marine"
                                            {{$position->industry == 'Shipping/Marine' ? 'selected' : '' }}>
                                            Shipping/Marine
                                        </option>

                                        <option value="Strategy/	Management Consulting"
                                            {{$position->industry == 'Strategy/	Management Consulting' ? 'selected' : '' }}>
                                            Strategy/
                                            Management Consulting</option>
                                        <option value="Sugar"
                                            {{$position->industry == 'Sugar' ? 'selected' : '' }}>Sugar
                                        </option>
                                        <option value="Telecom/ISP"
                                            {{$position->industry == 'Telecom/ISP' ? 'selected' : '' }}>
                                            Telecom/ISP</option>

                                        <option value="Textiles/Garments/Accessories"
                                            {{$position->industry == 'Textiles/Garments/Accessories' ? 'selected' : '' }}>
                                            Textiles/Garments/Accessories</option>
                                        <option value="Travel/Hotels/Restaurants"
                                            {{$position->industry == 'Travel/Hotels/Restaurants' ? 'selected' : '' }}>
                                            Travel/Hotels/Restaurants</option>
                                        <option value="Tyres"
                                            {{$position->industry == 'Tyres' ? 'selected' : '' }}>Tyres
                                        </option>
                                        <option value="Water Treatment / Waste Management"
                                            {{$position->industry == 'Water Treatment / Waste Management' ? 'selected' : '' }}>
                                            Water
                                            Treatment / Waste Management</option>
                                        <option value="Wellness/Fitness/Sports/Beauty"
                                            {{$position->industry == 'Wellness/Fitness/Sports/Beauty' ? 'selected' : '' }}>
                                            Wellness/Fitness/Sports/Beauty</option>
                                        <option value="Others"
                                            {{$position->industry == 'Others' ? 'selected' : '' }}>Others
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
                                    <div class="col-sm-3">Job For<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="gender" class="single-select">
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
                                    <div class="col-sm-3">Job Location<span style="color:red">*</span></div>
                                    <div class="col-sm-9">
                                        <select name="is_local" class="single-select">
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
                                <div id="reed_portal_form" class="col-sm-12">

                                </div>





                                <center><button type="submit" id="createPositionButton"
                                        class="btn btn-primary btn-sm w-100" name="submit"> <span
                                            class="fa fa-plus"></span>&nbsp; Update Job Position</button></center>


                        </div>

                    </div>
                </div>
            </div>


            {{-- id="stickytypeheader" --}}
            <div class="col-xl-5 col-lg-5" style="
            position: sticky;
            bottom: 0;
            height: max-content;
            align-self: flex-end;
        ">
                <fieldset class="checkbox-group">
                    <h5>Choose Your National Portal</h5>

                    <div class="form-check form-switch form-switch-sm">
                        <input class="form-check-input" type="checkbox" onclick="toggleJobProtals();" id="toogle_id">
                        <label class="form-check-label" for="flexSwitchCheckDefault">This toogle only for <b>National
                                Job</b> portals.</label>
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
                                        <img src="{{ url('images/jobpostingportal/careerjet.png') }}" alt="">
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
                                        <img src="{{ url('images/jobpostingportal/Indeed-logo.png') }}" alt="">
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
                                        <img src="{{ url('images/jobpostingportal/dr-logo-org.webp') }}" alt="">
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
                                        <img src="{{ url('images/jobpostingportal/Adzuna_Logo.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="jobPortals[]" id="jora" onchange="showJoraForm();"
                                    class="checkbox-input jobportal" value="jora">
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
                                    class="checkbox-input jobportal" value="google" onchange="showGoogleJobForm();">
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
                                    class="checkbox-input jobportal" value="clickIndia" onchange="showClickIndiaForm();">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('images/jobpostingportal/clickIndia.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="jobPortals[]" id="monster"
                                    class="checkbox-input jobportal" onchange="showMonsterForm();" value="monster">
                                <span class="checkbox-tile ">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('images/jobpostingportal/monster.png') }}" alt="">
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
                                        <img src="{{ url('images/jobpostingportal/postJobFree.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" id="naukri" onchange="showNaukriForm();" name="jobPortals[]"
                                    class="checkbox-input jobportal" value="naukri">
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('images/jobpostingportal/Naukri.jpg') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>

                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" id="timesjob" name="jobPortals[]"
                                    class="checkbox-input jobportal" value="timesjob" onchange="showTimesJobForm();">
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
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="jobPortals[]" class="checkbox-input jobportal" value="jobsora"
                                   >
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/jobsora.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="learn4good" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="learn4good" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/learn4good.jpg') }}" alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="jobgrin" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="jobgrin" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/jobgrin.png') }}" alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="careerbliss" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="careerbliss" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/careerbliss.png') }}" alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="theindiajobs" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="theindiajobs" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/theIndiaJobs.png') }}" width="300px"alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="jobrapido" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="jobrapido" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/jobrapido.webp') }}" width="300px"alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="jobisite" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="jobisite" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/jobisite.jpg') }}" width="300px"alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="talent" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="talent" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/talent.png') }}" width="300px"alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="econjobs" name="jobPortals[]"
                                    class="checkbox-input jobportal" id="econjobs" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/econjobs.jpg') }}" width="300px"alt="">
                                    </span>
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="jobPortals[]" class="checkbox-input" value="happiest"
                                    checked>
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/HappiestResume.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" name="jobPortals[]" class="checkbox-input" value="whiteforce"
                                    checked>
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/whiteforce.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                    </div>


                </fieldset>
                <br>
                <fieldset class="checkbox-group">
                    <h5>Choose Your International Portal</h5>
                    <div class="form-check form-switch form-switch-sm">
                        <input class="form-check-input" type="checkbox" onclick="toggleInternationalJobProtals();"
                            id="toogle_international_id">
                        <label class="form-check-label" for="flexSwitchCheckDefault">This toogle only for <b>International
                                Job</b> portals.</label>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center">
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="job_vertise_inter" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
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
                                    class="checkbox-input in_jobportal" />
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
                                    class="checkbox-input in_jobportal" />
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
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('images/jobpostingportal/Adzuna_Logo.png') }}" alt="">
                                    </span>

                                </span>
                            </label>
                        </div>


                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="whatjobs_inter" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
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
                                    onchange="showZiprecruiterForm();" class="checkbox-input in_jobportal"
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
                                    class="checkbox-input in_jobportal" />
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
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="https://www.white-force.com/onrole/job-posting-assets/tanqeeb.png"
                                            alt="">
                                    </span>

                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="reed" name="jobPortals[]"
                                    class="checkbox-input in_jobportal"  onchange="showReedForm();" id="reed" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/reed.png') }}" alt="">
                                    </span>
    
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="eluta" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/eluta.png') }}" alt="">
                                    </span>
    
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="jobswype" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/jobswype.png') }}" alt="">
                                    </span>
    
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="workcircle" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/workcircle.png') }}" alt="">
                                    </span>
    
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">
                            <label class="checkbox-wrapper">
                                <input type="checkbox" value="juju" name="jobPortals[]"
                                    class="checkbox-input in_jobportal" />
                                <span class="checkbox-tile">
                                    <span class="checkbox-icon">
                                        <img src="{{ url('logo/juju.jpg') }}" alt="">
                                    </span>
    
                                </span>
                            </label>
                        </div>
                        <div class="checkbox">

                        </div>


                    </div>


                </fieldset>

                {{-- <fieldset class="checkbox-group">
                    <div class="d-flex flex-wrap justify-content-center">

                    </div>
                </fieldset> --}}

            </div>

        </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link href="https://white-force.com/onrole/assets/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <script>
         function showDiv(){
            var fee=$("#management_fee").val();
            var flat=document.querySelector('#flatAmount');
            if(fee!=0){
                flat.classList.add('collapse');
            }
        }

        showDiv();

        var countries = {{ Js::from($position->countries) }}
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

                    var state = {{ Js::from($position->states) }}
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

                    var city = {{ Js::from($position->city) }}
                    $('#city option:contains("' + city + '")').prop('selected', true);
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });
        }


        $.validator.addMethod(
             "customFlatAmountRequired",
            function(value, element) {
      // Get the value of managment_fee field
            var managment_fee = parseFloat($("#management_fee").val());

      // Check if managment_fee is equal to 0
             if (managment_fee === 0) {
        // If managment_fee is 0, then flat_amount is required
             return value.trim() !== "";
         }

      // If managment_fee is not 0, then flat_amount is not required
             return true;
             },
        "Amount is required when Management Fee is Flat Amount."
        );


        $(document).ready(function($) {

            $("#createPosition").validate({
                rules: {
                    client_id: "required",
                    position_name: "required",
                    openings: {
                        required: true,
                        min: 1,
                    },
                    job_description: "required",
                    management_fee:"required",
                    flat_amount: {
                        customFlatAmountRequired: true,
                    },
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
                    postal_code: {

                        required: true,
                        min: 1,
                        minlength: 6,
                        maxlength: 6,
                    },
                    "skill_set[]": "required",
                    edu_qualification: "required",
                    close_date: "required",
                },
                messages: {
                    client_id: "Select Client",
                    position_name: "Enter Position Name",
                    openings: {
                        required: "Enter Openings",
                        min: "Enter Positive value",
                    },
                    job_description: "Enter Job Description",
                    management_fee:"Select Management Fees ",
                    min_year_exp: "Select Minimum Experience",
                    max_year_exp: "Select Maximum Experience",
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
                    postal_code: {
                        required: "Enter Postal Code",
                        min: "Enter Positive value",
                       
                    },
                    "skill_set[]": "Enter Skills ",
                    edu_qualification: "Select Qualification",
                    close_date: "Select Close date",
                },
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    $('#createPositionButton').prop('disabled', true);
                    form.submit();
                }

            });
        });


        $("#skills").select2({
            tags: true,
            tokenSeparators: [','],
            placeholder: "Enter Skiils",
        });


        function dynamicOptionCreate(e) {
            var option = document.createElement('option');
            option.text = e;
            option.value = e;
            option.selected = true;
            return option;
        }




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



        function showShineForm() {
            var checkBox = document.getElementById("shine");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'shine'
                }, function(response) {
                    $('#shine_portals_form').html(response);
                    // document.getElementById("shine_portals_form").scrollIntoView();

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
                    // document.getElementById("clickindia_portals_form").scrollIntoView();
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
                    // document.getElementById("monster_portals_form").scrollIntoView();
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
                    // document.getElementById("jora_portals_form").scrollIntoView();
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
                    // document.getElementById("naukri_portals_form").scrollIntoView();
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
                    // document.getElementById("jooble_portals_form").scrollIntoView();
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
                    // document.getElementById("timesjob_portals_form").scrollIntoView();
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
                    // document.getElementById("googlejob_portals_form").scrollIntoView();
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
                    // document.getElementById("ziprecruiter_portals_form").scrollIntoView();
                });
            } else {
                $('#ziprecruiter_portals_form').children().remove();
            }
        }

        function showReedForm() {
            var checkBox = document.getElementById("reed");
            if (checkBox.checked) {
                $.get("{{ url('get-portal-form') }}", {
                    portal: 'reed'
                }, function(response) {
                    $('#reed_portal_form').html(response);
                    // document.getElementById("ziprecruiter_portals_form").scrollIntoView();
                });
            } else { $('#reed_portal_form').children().remove();
            }
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


        function toggleJobProtals() {
            var value = $("#toogle_id").is(":checked");
            $(".jobportal").click();
        }

        function toggleInternationalJobProtals() {
            var value = $("#toogle_international_id").is(":checked");
            $(".in_jobportal").click();
        }

        $(document).ready(function() {
            // Select2 Multiple
            $('.select2-multiple').select2({
                placeholder: "Select",
                allowClear: true
            });

        });

        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 300,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount', 'image'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });

        const jd = $('#jdParser')[0];

        function getJd() {
            var load = $('#loader');
            load.removeClass('collapse');
            var file = jd.files[0];
            var formData = new FormData();
            formData.append('jd', file, 'userFile.pdf');

            $.ajax({
                url: 'https://happyhire.co.in/jdparser/upload/api/',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    load.addClass('collapse');
                    var x = data;
                    console.log(x);
                    $('#jd_json').val(JSON.stringify(x.data));
                    // $('#position_name').val(x.data.Role[0]);
                    var skills = x.data.Tools_and_technologies;
                    for (var i = 0; i < skills.length; i++) {
                        $('#skills').append(dynamicOptionCreate(skills[i]));
                    }
                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        function getFlatAmount(e){
            var flat=document.querySelector('#flatAmount');
            var amount=document.querySelector('#flat_amount');
            if(e==="0"){
                console.log(e);
                flat.classList.remove('collapse');
                amount.value=null;
            }
            else{
                flat.classList.add('collapse');
                amount.value=0;
            }
        }



    </script>

@endsection



































































