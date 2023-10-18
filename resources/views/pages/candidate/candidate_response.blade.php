@extends('master.master')
@section('title', 'Job Portal Revert')
@section('content')
<style>
    .right-Modal {
        background: rgb(98 98 98 / 59%);
    }

    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 642px;
        max-width: 642px;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
    }


    /*Left*/
    .modal.left.fade .modal-dialog {
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog {
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: 0;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    .between {
        justify-content: space-between;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .candidate_Information {
        width: 55%;
    }

    .position_Information {
        width: 100%;
    }

    .custom-modal-header {
        border-bottom-color: #EEEEEE;
        background-color: #F2F7FA;
        height: 114px;
    }

    .custom-modal-header .candidate_img {
        width: 80px;
        height: 80px;
        background: #f2f7fa;
        border-radius: 50%;
    }

    .custom-modal-header .candidate_img img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 50%;
    }

    .custom-btn {
        padding: 4px 18px;
        font-size: 12px;
    }

    .custom-modal-body {
        padding: 0;
    }

    .custom-nav-modal {
        padding: 0.8rem 1.4rem !important;
        color: #858585;
    }

    .custom-tab-content {
        padding: 22px;
    }

    .custom-card {
        border: 1px solid #d2d2d2;
    }

    .card-header h6 {
        color: #555555;
    }

    .candidate_mobile h6,
    .candidate_sourcedPosition h6,
    .candidate_qualification h6,
    .candidate_email h6,
    .candidate_prefLocation h6,
    .candidate_pincode h6 {
        font-size: 14px;
        font-weight: 600;
        color: #3c3c3c;
    }

    .candidate_mobile p,
    .candidate_sourcedPosition p,
    .candidate_qualification p,
    .candidate_email p,
    .candidate_prefLocation p,
    .candidate_pincode p {
        font-size: 12px;
        font-weight: 400;
        color: #353434;
    }

</style>
<style>
    ::-webkit-scrollbar {
        width: 10px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    .card {
        border: 1px dashed rgba(0, 0, 0, 0.125) !important;
    }


    .myCard {
        padding: 10px !important;
        border-radius: 6px !important;
        color: #ec815e !important;
        /* background: #fff; */
        background: #f2f7fa70 !important;

        height: auto !important;
        box-shadow: none;
        position: relative;
        transition: all 0.2s;

        &:hover {
            border-color: #c4d1e1;
            box-shadow: 0 4px 10px -4px rgba(0, 0, 0, 0.15);
            transform: translate(-4px, -4px);
        }
    }

    .card__image {
        border-radius: 0.25em;
        height: 6em;
        min-width: 6em;
    }

    .card__content {
        flex: auto;
        padding: 0 1em;
    }

    .card h2 {
        font-weight: 700;
        margin: 0;
    }

    .card p {
        color: #546e7a;
        margin: 0;
    }

    /* Checkbox Styles */

    .checkbox {
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        background: #e2ebf6;
        border-radius: 50%;
        height: 2em;
        margin: 0;
        margin-left: auto;
        flex: none;
        outline: none;
        position: relative;
        transition: all 0.2s;
        width: 2em;
    }

    .checkbox:after {
        border: 2px solid #fff;
        border-top: 0;
        border-left: 0;
        content: "";
        display: block;
        height: 1em;
        left: 0.625em;
        position: absolute;
        top: 0.25em;
        transform: rotate(45deg);
        width: 0.5em;
    }

    .checkbox:focus {
        box-shadow: 0 0 0 2px rgba(100, 193, 117, 0.6);
    }

    .checkbox:checked {
        background: #64c175;
        border-color: #64c175;
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    /* SVG Styles */

    .nude {
        fill: #f4f0ed;
    }

    .yellow {
        fill: #ffcb65;
    }

    .red {
        fill: #f96149;
    }

    .sunburn {
        fill: #fe9d7d;
    }

    .eggplant {
        fill: #422b42;
    }

    .blue {
        fill: #4473e9;
    }

    .flamingo {
        fill: #ffb3da;
    }

    .violet {
        fill: #4450c7;
    }

    .poppy {
        fill: #ffa128;
    }

    .orange {
        fill: #ff8e56;
    }

    /* label {
        position: absolute;
        right: 20px;
    } */

    .a14 {
        position: fixed;
        bottom: 15px;
        right: 20px;
        cursor: pointer;
        padding: 5px;
        z-index: 999;
    }

    .font-dark {
        color: #000 !important;
    }

</style>
<style>
    .client_logoDiv {
        width: 75px;
        height: 75px;
        background: #f1f1f1;
        border-radius: 10px;
        margin: 0;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px dashed #00000049;
        padding: 8px;
    }

    .client_logoDiv img {
        max-width: 100%;
        max-height: 100%;
        border-radius: 10px;
    }

    .candidate_img {
        width: 96px;
        height: 96px;
    }

    .candidate_img img {
        max-width: 100%;
        max-height: 100%;
    }

    .openModal button i {
        font-size: 20px;
    }

    .footer_details {
        background-color: rgb(228, 230, 230);
        border-radius: 5px;
    }

    .footer_details p {
        font-size: 12px;
    }

    .candidate_details span {
        display: flex;
        justify-content: center;

    }

    .tooltip {
        position: relative;
        display: inline-block;
        border-bottom: 1px dotted black;
    }

    .tooltip .tooltiptext {
        visibility: hidden;
        width: 120px;
        background-color: black;
        color: #fff;
        text-align: center;
        border-radius: 6px;
        padding: 5px 0;

        /* Position the tooltip */
        position: absolute;
        z-index: 1;
        bottom: 100%;
        left: 50%;
        margin-left: -60px;
    }

    .tooltip:hover .tooltiptext {
        visibility: visible;
    }

    .pagination {
        margin-bottom: 0.25rem;
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
    }

    .pagination-gutter {
        background-color: white;
        width: auto;
        padding: 4px;
        border-radius: 5px;
        margin: auto;
    }
    .flex{
            display:flex;
            justify-content: space-between;
            flex-direction: row;
            flex-wrap: wrap;
            padding:1px;
        }

</style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <a href="{{ url('https://white-force.com/plus/tutorial/#revertcandidatediv') }}" target="_blank">
        <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
    </a>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12 ">
                    <div class="card col-10 offset-1 ">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="col-7">
                                <h4>Total Candidate Response  </h4>
                            </div>
                            <div>
                                <span class="badge badge-dark" style="font-size: 15px;padding-right: 20px;padding-left: 20px;">{{ $candidateCount }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-10 offset-1">
                        <div class="row card mx-0">
                            <div class="col-sm-12 p-md-2">
                                <form action="" method="get" id="searchForm">
                                    <div class="flex mt-2">
                                        <div class="col font-w600 text-dark mx-2">
                                            From Date<small>(Response Date)</small>
                                            <input type="date" class="form-control"id="fromDate" name="fromDate">
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            To Date<small>(Response Date)</small>
                                            <input type="date" class="form-control" id="toDate" name="toDate">
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            Min Experience Year
                                            <select name="minExp" id="minExp" class="default-select  form-control wide">
                                                @for ($i = 0; $i <= 60; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            Max Experience
                                            <select name="maxExp" id="maxExp" class="default-select  form-control wide">
                                                @for ($i = 0; $i <= 60; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>
                                    <div class="flex mt-2">
                                        <div class="col font-w600 text-dark mx-2">
                                            Min Current CTC
                                            <input type="number" class="form-control"id="minCtc" name="minCtc">
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            Max Current CTC
                                            <input type="number" class="form-control" id="maxCtc" name="maxCtc">
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            Min Expected CTC
                                            <input type="number" class="form-control" id="minExpectedCtc"
                                                name="minExpectedCtc">
                                        </div>
                                        <div class="col font-w600 text-dark mx-2">
                                            Max Expected CTC
                                            <input type="number" class="form-control" id="maxExpectedCtc"
                                                name="maxExpectedCtc">
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <div class="col-3 font-w600 text-black mt-3">
                                            <button type="submit" class="btn btn-primary col-12 offset btn-block" >Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @if ($candidates->count() == 0)
                        <div class="col-10 card offset-1">
                            @include('master.404')
                        </div>
                    @endif
                    <div class="col-lg-10 offset-1">
                        @foreach ($candidates as $candidate)
                        <div class="card">
                            <div class="d-flex justify-content-between card-header">
                                <div class="d-flex" style="margin-top: 5px;">
                                                            <div class="client_logoDiv" id="client_logoDiv">
                                                                <img class="" id="client_logo_img"
                                                                src="https://static.vecteezy.com/system/resources/previews/000/439/863/original/vector-users-icon.jpg"
                                                                alt="no image" />
                                    </div>

                                    <div class="positionHeading mx-2">
                                        <h5>{{ ucwords($candidate?->user_name) }}
                                            <small style="color: #3e2828;
                                        font-size: 11px;
                                        margin-left: 4px;">
                                                ({{ ucwords($candidate?->publish_to) }})</small>
                                                </h5>


                                        <div class="d-flex align-items-center ">
                                            <h6 class="heading" style="color:#28044d !important;line-height: 16px;">
                                                Mobile:
                                                <span class="text-primary"> {{ $candidate?->user_mobile }}</span> &nbsp;

                                                Email :<span class="text-primary"> {{ $candidate->user_email }}</span>
                                                    &nbsp;
                                            </h6>
                                        </div>
                                        @php
                                                $position_name = App\Models\Position::find($candidate->job_id);
                                         @endphp
                                        <div class="d-flex align-items-center ">
                                            <h6 class="heading" style="color:#28044d !important;line-height: 16px;">
                                                Applied For:&nbsp;
                                                <span class="text-black">{{ $position_name->position_name ?? '' }}</span>
                                            </h6>
                                            &nbsp;
                                            &nbsp;
                                            <h6 class="postedDate">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                Created on -
                                                {{ $candidate?->updated_at->format('M d, Y') }}
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                                <div>

                                    <div class="dropdown">
                                        <!-- <div class="d-flex align-items-center" style="justify-content: flex-end;">
                                            <label class="checkbox-control">
                                                <input type="checkbox" class="checkbox candidateForSearch"
                                                    value="{{ $candidate?->id }}" name="chk" onchange="selectedCandidate(this)">
                                                    <span class="">Card Label</span>
                                            </label>
                                        </div> -->
                                        <a href="javascript:void(0)"><span class="btn px-3 py-1 btn-secondary btn-xs mt-4"
                                            data-toggle="modal"
                                            data-target="#myModal2{{ $candidate->id }}">View</span></a>&nbsp;
                                    <a href="javascript:void(0)"><span class="btn px-3 py-1 btn-success btn-xs mt-4"
                                            data-toggle="modal" data-target="#pipeline{{ $candidate->id }}"
                                            onclick="showPositionList({{ $candidate->candidate->id }})">Pipeline</span></a>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-info me-3">
                                            <strong><i class="flaticon-032-briefcase text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Current Company</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->candidate->current_company ?? ''}} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-danger">

                                            <strong><i class="flaticon-055-cube text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Current Designation</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->candidate->current_title ?? ''}}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-primary me-3">
                                            <strong><i class="flaticon-381-location text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Preffered Location</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">{{ $candidate->candidate->preferred_location ?? ''}}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4  mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-success">

                                            <strong><i class="flaticon-068-pencil text-black"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Total Experience</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">1.1 years
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-secondary me-3">
                                            <strong><i class="flaticon-147-medal text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Education</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ @$candidate->candidate->highest_qualification }} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 d-flex">
                                        <div class="dt-icon bgl-warning me-3">
                                            <strong><i class="flaticon-381-notepad-2 text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Skills</h6>
                                            <p>
                                                @php
                                            $array = explode(',', $candidate->candidate->skills);
                                        @endphp
                                        @if (!empty($array))
                                            @if (count($array) > 3)
                                                @for ($i = 0; $i <= 2; $i++)
                                                    <span class="mb-0 pt-1 font-w500 text-black">
                                                        {{ $array[$i] }}</span>
                                                @endfor
                                            @else
                                                @for ($i = 0; $i < count($array); $i++)
                                                    <span
                                                        class="mb-0 pt-1 font-w500 text-black">{{ $array[$i] }}</span>
                                                @endfor
                                            @endif
                                        @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="modal right fade right-Modal" id="myModal2{{ $candidate->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="myModalLabel2">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header custom-modal-header">
                                            
                                                <div class=" d-flex justify-contant-space-between align-items-center ">
                                                    <div class="client_logoDiv mx-2" id="client_logoDiv">
                                                        <img class="" id="client_logo_img"
                                                            src="https://static.vecteezy.com/system/resources/previews/000/439/863/original/vector-users-icon.jpg"
                                                            alt="no image" />
                                                    </div>
                                                    <div class="candidate_info mx-3">
                                                        <h5 class="m-0">{{ ucwords($candidate?->user_name) }}<span class="text-dark" style="display:inline">&nbsp;({{ ucwords($candidate?->publish_to) }})</span></h5>
                                                        <p class="m-0">{{ $candidate?->candidate->current_title }}</p>
                                                    </div>
                                                    <div>
                                                    @if ($currentUser == 'admin')
                                                        <form action="{{ route('candidate.destroy', $candidate->id) }}"
                                                            method="post" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="submit" class="btn custom-btn btn-danger"
                                                                value="Delete">
                                                        </form>
                                                    @endif
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-body custom-modal-body">
                                            <div class="custom-tab-1">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item" role="presentation"><a
                                                            href="#details-tab{{ $candidate->id }}" data-bs-toggle="tab"
                                                            class="nav-link custom-nav-modal show active"
                                                            aria-selected="true" role="tab"
                                                            tabindex="-1">Details</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation"><a
                                                            href="#resume-tab{{ $candidate->id }}" data-bs-toggle="tab"
                                                            class="nav-link custom-nav-modal" aria-selected="false"
                                                            role="tab" tabindex="-1">Resume</a>
                                                    </li>
                                                    <li class="nav-item" role="presentation"><a
                                                            href="#history-tab{{ $candidate->id }}" data-bs-toggle="tab"
                                                            class="nav-link custom-nav-modal" aria-selected="false"
                                                            role="tab">History</a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content custom-tab-content">
                                                    <div id="details-tab{{ $candidate->id }}"
                                                        class="tab-pane fade active show" role="tabpanel">
                                                        <div class="card custom-card">
                                                            <div class="card-header">
                                                                <h6>Details</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row px-2">
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Mobile</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->mobile }}</h6>
                                                                        </div>
                                                                        <div class="candidate_qualification my-4">
                                                                            <h6 class="m-0">Date of Birth</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->date_of_birth }}
                                                                                </h6>
                                                                        </div>
                                                                        <div class="candidate_sourcedPosition my-4">
                                                                            <h6 class="m-0">Marital Status</h6>
                                                                            <p class="m-0">
                                                                                {{ ucwords($candidate?->candidate->marital_status) }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Email</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->email }}</h6>
                                                                        </div>
                                                                        <div class="candidate_prefLocation my-4">
                                                                            <h6 class="m-0">Gender</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->gender }}</h6>
                                                                        </div>
                                                                        <div class="candidate_pincode my-4">
                                                                            <h6 class="m-0">Pincode</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->pin_code }}</h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Communication</h6>
                                                                            <p class="m-0">
                                                                                {{ ucwords($candidate?->candidate->communication) }}
                                                                                </h6>
                                                                        </div>
                                                                        <div class="candidate_qualification my-4">
                                                                            <h6 class="m-0">Skills</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->skills }}</h6>
                                                                        </div>

                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Languages</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->languages }}
                                                                                </h6>
                                                                        </div>
                                                                        <div class="candidate_prefLocation my-4">
                                                                            <h6 class="m-0">Address</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->address }}</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card custom-card">
                                                            <div class="card-header">
                                                                <h6>Education Details</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row px-2">
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Qualification</h6>
                                                                            <p class="m-0">
                                                                                {{ ucwords($candidate?->candidate->highest_qualification_type) }}
                                                                                In
                                                                                {{ $candidate?->candidate->highest_qualification }}
                                                                                </h6>
                                                                        </div>

                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Qualification Year</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->highest_qualification_year }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card custom-card">
                                                            <div class="card-header">
                                                                <h6>Company Details</h6>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row px-2">
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Current Company</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->current_company }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Current Designation</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->current_title }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Industry</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->industry }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Experience</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->total_experience }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Current Salary</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->current_salary }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Expected Salary</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->expected_salary }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Last Company</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->last_company }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Last CTC</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->last_ctc }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Pay Type</h6>
                                                                            <p class="m-0">
                                                                                {{ ucwords($candidate?->candidate->salary_type) }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Notice Period</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->notice_period }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="left-row col-md-6">
                                                                        <div class="candidate_mobile mb-4">
                                                                            <h6 class="m-0">Current Location</h6>
                                                                            <p class="m-0">
                                                                                {{ ucwords($candidate?->candidate->current_location) }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="right-row col-md-6">
                                                                        <div class="candidate_email mb-4">
                                                                            <h6 class="m-0">Preffered</h6>
                                                                            <p class="m-0">
                                                                                {{ $candidate?->candidate->preferred_location }}
                                                                                </h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="resume-tab{{ $candidate->id }}" class="tab-pane fade"
                                                        role="tabpanel">

                                                        @if ($candidate->resume)
                                                            <iframe src="{{$candidate->resume }}" frameborder="0"
                                                                width="100%" height="500px"></iframe>
                                                        @else
                                                            <p>No resume available</p>
                                                        @endif
                                                    </div>
                                                    <div id="history-tab{{ $candidate->id }}" class="tab-pane fade"
                                                        role="tabpanel">
                                                        setting
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal right fade right-Modal" id="pipeline{{ $candidate->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="myModalLabel2">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header custom-modal-header">
                                            <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                                                <div class="position_Information d-flex flex-wrap align-items-center">
                                                    <input type="text" id="searchQuery"
                                                        placeholder="Serach Position By Name, Client Name or Number Of Position"
                                                        class="form-control" onkeyup="getC()">
                                                    <div class="m-2 d-flex between">
                                                        <small>Checked Position will see you
                                                            after clicking the button</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-body custom-modal-body">
                                            <div class="custom-tab-1">
                                                <div class="tab-content custom-tab-content">
                                                    <div id="details-tab" class="tab-pane fade active show" role="tabpanel">
                                                        <div id="can_search_sec">
                                                            <ul class="grid">

                                                            </ul>

                                                            <div class="a14" onclick="addToPipeline({{ $candidate->candidate->id  }});">
                                                                <span style="font-size:80px; color: coral"
                                                                    class="mdi mdi-checkbox-marked-circle"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                        {{ $candidates->links() }}

                </div>
            </div>
        </div>
    </div>
    <script>
        // let count = 1;
        // var arrayOfIds = new Array();

        // function selectedCandidate(e) {
        //     console.log(e);
        //     if (e.checked == true) {
        //         arrayOfIds.push(e.value);
        //         document.querySelector('#sendMail').classList.remove('collapse');
        //         console.log(arrayOfIds);
        //     } else {
        //         arrayOfIds = arrayOfIds.filter(item => item !== e.value);
        //         console.log(arrayOfIds);
        //     }
        // }

        // function selects() {
        //     var ele = document.getElementsByName('chk');
        //     var btn = document.querySelector('#select_all');
        //     var card = document.getElementsByClassName('candidate_card');
        //     if (count == 1) {
        //         document.querySelector('#select_all').innerHTML = "Deselect All";
        //         document.querySelector('#sendMail').classList.remove('collapse');
        //         btn.classList.remove('btn-success');
        //         btn.classList.add('btn-primary');

        //         for (var i = 0; i < ele.length; i++) {
        //             if (ele[i].type == 'checkbox')
        //                 ele[i].checked = true;
        //             card[i].style.border = "1px solid #EB8153";
        //             arrayOfIds.push(ele[i].value);
        //         }
        //         count = 0;
        //         console.log(arrayOfIds);
        //     } else if (count == 0) {
        //         document.querySelector('#select_all').innerHTML = "Select All";
        //         btn.classList.remove('btn-primary');
        //         document.querySelector('#sendMail').classList.add('collapse');
        //         btn.classList.add('btn-success');
        //         for (var i = 0; i < ele.length; i++) {
        //             if (ele[i].type == 'checkbox')
        //                 ele[i].checked = false;
        //             card[i].style.border = "none";
        //         }
        //         arrayOfIds = [];
        //         count = 1;
        //         console.log(arrayOfIds);
        //     }
        // }

        // function sendMail() {
        //     let uniqueArray = [...new Set(arrayOfIds)];
        //     let form = document.querySelector('#emailForm');
        //     $.ajax({
        //         url: "send_mail_to_candidate",
        //         type: "GET",
        //         data: {
        //             ids: uniqueArray,
        //             subject: form[0].value,
        //             title: form[1].value,
        //             description: form[2].value
        //         },
        //         success: function(response) {
        //             console.log(response);
        //         },
        //         error: function(error) {
        //             console.log(error);
        //         }
        //     })
        //     form.reset();
        //     document.querySelector('#close').click();
        // }

        function showPositionList(candidateId) {
        $.ajax({
            url: "{{ url('get-position-list') }}",
            type: "POST",
            data: {
                _token :"{{ csrf_token() }}",
                id: candidateId,
            },
            success: function (response) {
                if (response) {
                    $('.grid').html("");
                    $('.grid').html(response);
                } else {
                    $('.grid').html(`<div align="center">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                        autoplay></lottie-player>
                    </div>`);
                }

            },
            error: function (error) {
                console.log(error);
            }
        })
    }

    function addToPipeline(id) {
        console.log(id);
        var array = [];
        var a = document.getElementsByClassName('positionId');
        for (var i = 0; i < a.length; i++) {
            if (a[i].checked == true) {
                array.push(a[i].value);
            }
        }
        if (array.length !== 0) {
            console.log("add to pipeline");
            console.log(array);
            $.ajax({
                url: "{{ url('add-candidate-to-multiple-pipeline') }}",
                type: "POST",
                data: {
                    _token :"{{ csrf_token() }}",
                    positionIds: array,
                    candidateId: id
                },
                success: function (response) {
                    console.log(response);
                    location.reload(true);
                        // Swal.fire(
                        // 'Candidate Added to Pipeline',
                        // 'Successfully',
                        // 'success'
                        // );

                },
                error: function (error) {
                    console.log(error);
                    // Swal.fire(
                    //     'Faild to Add ',
                    //     'Error',
                    //     'error'
                    // );
                }
            })
        } else {
            console.log("retry");
        }
    }

    // searching function form action
    var form = document.getElementById('searchForm');
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        var currentURL = window.location.href;
        form.action = currentURL;
    form.submit();
    });

    </script>
@endsection
