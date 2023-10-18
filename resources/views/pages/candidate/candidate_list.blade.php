@extends('master.master')
@section('title', 'Candidate List')
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
</style>

<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<a href="{{ url('https://white-force.com/plus/tutorial/#candidatelistdiv') }}"
    target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-10 offset-1 ">
                <div class="card col-12">
                    <div
                        class="card-body d-flex justify-content-between align-items-center">
                        <div class="col-7">
                            <h4>Candidate List View</h4>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-3 " style="display: flex;
                        justify-content: flex-end;">
                            <span class="btn custom-btn btn-success"
                                id="select_all" onclick="selects()">Select
                                All</span>
                            &nbsp;
                            <span class="btn custom-btn btn-secondary collapse"
                                data-bs-toggle="modal"
                                data-bs-target="#basicModal" id="sendMail">Send
                                Email</span>
                        </div>
                    </div>
                </div>
                <!-- send email model -->
                <div class="modal fade" id="basicModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Send Email</h5>
                                <button type="button" class="btn-close"
                                    data-bs-dismiss="modal">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="javascript:void(0)" method="get"
                                    id="emailForm">
                                    <strong class="mb-4">Subject</strong>
                                    <input type="text" class="form-control">
                                    <strong class="mb-4">Title</strong>
                                    <input type="text" class="form-control">
                                    <strong class="mb-4">Description</strong>
                                    <textarea class="form-control" name="remark"
                                        id="remark" cols="60"
                                        rows="5"></textarea>
                            </div>
                            <div class="modal-footer">
                                <button type="button"
                                    class="btn btn-danger light"
                                    data-bs-dismiss="modal"
                                    id="close">Close</button>
                                <button type="submit" class="btn btn-primary"
                                    onclick="sendMail()">Send Email</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-12 ">
                    <div class="row page-titles mx-0">
                        <div class="col-sm-12 p-md-0">
                            <form action="{{ route('candidate.index') }}"
                                method="get">
                                <div class="d-flex justify-content-between ">
                                    <div class="col-3 font-w600 text-dark">
                                        Name
                                        <input type="serch" class="form-control"
                                            id="name" name="name" placeholder="By Name">
                                    </div>
                                    <!-- <div class="col-2 font-w600  text-dark">
                                        By Designation
                                        <input type="serch" class="form-control" id="designation" name="designation">
                                    </div> -->
                                    {{-- <div
                                        class="col-2 font-w600  text-dark">
                                        By Preffered Location
                                        <input type="serch" class="form-control"
                                            id="PrefferdLocation"
                                            name="PrefferdLocation">
                                    </div>
                                    <div class="col-2 font-w600  text-dark">
                                        By Current Location
                                        <input type="serch" class="form-control"
                                            id="currentLocation"
                                            name="currentLocation">
                                    </div> --}}
                                    <div class="col-3 font-w600  text-dark">
                                        Email
                                        <input type="serch" class="form-control"
                                            id="email" name="email" placeholder="By Email">
                                    </div>
                                    <div class="col-2 font-w600  text-dark">
                                        Mobile
                                        <input type="serch" class="form-control"
                                            id="mobileNumber"
                                            name="mobileNumber" placeholder="By Mobile Number">
                                    </div>
                                    <div class="col-2 font-w600  text-dark">
                                        Added From
                                        <select name="added_from"
                                            id="added_from"
                                            class="form-control">
                                            <option value="">Select</option>
                                            <option value="extension">Extension
                                            </option>
                                            <option value="email">Email parsing
                                            </option>
                                        </select>
                                    </div>
                                    &nbsp;
                                    <div class="col-1 font-w600 text-black">
                                        <div class="row">
                                            &nbsp;
                                        </div>
                                        <div class="row">
                                            <button class=" btn btn-primary "
                                                type="submit"
                                                id="serch">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @if($candidates->count()==0)
                <div class="col-xl-12 col-xxl-12 col-sm-12 card">
                    @include('master.404')
                </div>
                @endif

                <div class="col-lg-12 ">
                    @foreach($candidates as $candidate)
                    <div class="col-lg-12 ">
                        <div class="card">
                            <div
                                class="d-flex justify-content-between card-header">
                                <div class="d-flex" style="margin-top: 5px;">
                                    <div class="client_logoDiv"
                                        id="client_logoDiv">
                                        <img class="" id="client_logo_img"
                                            src="{{ url('assets/user-placeholder.png') }}"
                                            alt="no image" />
                                    </div>

                                    <div class="positionHeading mx-2">
                                        <h5>{{ucwords($candidate?->name)}}
                                            @if($candidate->added_from ==
                                            'extension')
                                            <small style="color: #3e2828;
                                        font-size: 11px;
                                        margin-left: 4px;"><span
                                                    class="badge badge-success">Extension({{
                                                    $candidate->source
                                                    }})</span></small>
                                            @elseif($candidate->added_from ==
                                            'email')
                                            <small style="color: #3e2828;
                                        font-size: 11px;
                                        margin-left: 4px;"><span
                                                    class="badge badge-info">Email
                                                    Parsing</span></small>
                                            @endif
                                        </h5>


                                        <div class="d-flex align-items-center ">
                                            <h6 class="heading"
                                                style="color:#28044d !important;line-height: 16px;">
                                                Mobile:
                                                <span class="text-primary"> {{
                                                    $candidate?->mobile
                                                    }}</span> &nbsp;

                                                Email :<span
                                                    class="text-primary"> {{
                                                    $candidate?->email }}</span>
                                                &nbsp;
                                            </h6>
                                        </div>
                                        <div class="d-flex align-items-center ">
                                            <h6 class="postedDate">
                                                <i class="fa fa-user-o"
                                                    aria-hidden="true"></i>&nbsp;
                                                {{ $candidate->createdBy?->name
                                                }}
                                            </h6>
                                            &nbsp;
                                            &nbsp;
                                            <h6 class="postedDate">
                                                <i class="fa fa-clock-o"
                                                    aria-hidden="true"></i>
                                                Created on -
                                                {{
                                                $candidate?->updated_at->format('M
                                                d, Y') }}
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                                <div>

                                    <div class="dropdown">
                                        <div class="d-flex align-items-center"
                                            style="justify-content: flex-end;">
                                            <label class="checkbox-control">
                                                <input type="checkbox"
                                                    class="checkbox candidateForSearch"
                                                    value="{{ $candidate?->id }}"
                                                    name="chk"
                                                    onchange="selectedCandidate(this)">
                                                <span class=""></span>
                                            </label>
                                        </div>
                                        <a href="javascript:void(0)"><span
                                                class="btn px-3 py-1 btn-secondary btn-xs mt-4"
                                                data-toggle="modal"
                                                data-target="#myModal2{{ $candidate->id }}"
                                                onclick="openDetails({{ $candidate->id }})">View</span></a>&nbsp;
                                        <a href="javascript:void(0)"><span
                                                class="btn px-3 py-1 btn-success btn-xs mt-4"
                                                data-toggle="modal"
                                                data-target="#pipeline{{ $candidate->id }}"
                                                onclick="showPositionList({{ $candidate->id }})">Pipeline</span></a>

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-info me-3">
                                            <strong><i
                                                    class="flaticon-032-briefcase text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Current
                                                Company</h6>
                                            <p
                                                class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate?->current_company
                                                }} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-danger">

                                            <strong><i
                                                    class="flaticon-055-cube text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Current
                                                Designation</h6>
                                            <p
                                                class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate?->current_title }}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-primary me-3">
                                            <strong><i
                                                    class="flaticon-381-location text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Preffered
                                                Location</h6>
                                            <p
                                                class="mb-0 pt-1 font-w500 text-black">
                                                {{
                                                $candidate?->preferred_location
                                                }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4  mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-success">

                                            <strong><i
                                                    class="flaticon-068-pencil text-black"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Total
                                                Experience</h6>
                                            <p
                                                class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate?->total_experience
                                                }} Years
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3  d-flex ">
                                        <div class="dt-icon bgl-secondary me-3">
                                            <strong><i
                                                    class="flaticon-147-medal text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Education</h6>
                                            <p
                                                class="mb-0 pt-1 font-w500 text-black">
                                                {{
                                                $candidate?->highest_qualification
                                                }} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-sm-0 d-flex ">
                                        <div class="dt-icon bgl-warning me-3">
                                            <strong><i
                                                    class="flaticon-381-notepad-2 text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Skills</h6>
                                            <p>
                                                @php
                                                $array=explode(",",$candidate->skills);
                                                @endphp
                                                @if(!empty($array))
                                                @if(count($array)>3)
                                                @for($i=0;$i<=2;$i++) <span
                                                    class="mb-0 pt-1 font-w500 text-black ">
                                                    {{ ucwords($array[$i])
                                                    }},</span>
                                                    @endfor
                                                    @else
                                                    @for($i=0;$i
                                                    <count($array);$i++) <span
                                                        class="mb-0 pt-1 font-w500 text-black ">
                                                        {{ ucwords($array[$i])
                                                        }},</span>
                                                        @endfor
                                                        @endif
                                                        @endif
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal right fade right-Modal"
                        id="pipeline{{ $candidate->id }}" tabindex="-1"
                        role="dialog" aria-labelledby="myModalLabel2">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header custom-modal-header">
                                    <div
                                        class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                                        <div
                                            class="position_Information d-flex flex-wrap align-items-center">
                                            <input type="search"
                                                id="searchQuery"
                                                placeholder="Serach Position By Name, Client Name or Number Of Position"
                                                class="form-control"
                                                onchange="searchPosition(this.value)">
                                            <div class="m-2 d-flex between">
                                                <small>Checked Position will see
                                                    you
                                                    after clicking the
                                                    button</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-body custom-modal-body">
                                    <div class="custom-tab-1">
                                        <div
                                            class="tab-content custom-tab-content">
                                            <div id="details-tab"
                                                class="tab-pane fade active show"
                                                role="tabpanel">
                                                <div id="can_search_sec">
                                                    <ul class="grid">

                                                    </ul>

                                                    <div class="a14"
                                                        onclick="addToPipeline({{ $candidate->id }});">
                                                        <span
                                                            style="font-size:80px; color: coral"
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
            </div>
            <div class="col-12 pagination-gutter">
                {{ $candidates->links() }}
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let count = 1;
    var arrayOfIds = new Array();

    function selectedCandidate(e) {
        if (e.checked == true) {
            arrayOfIds.push(e.value);
            document.querySelector('#sendMail').classList.remove('collapse');
            console.log(arrayOfIds);
        } else {
            arrayOfIds = arrayOfIds.filter(item => item !== e.value);
            console.log(arrayOfIds);
        }
    }

    function selects() {
        var ele = document.getElementsByName('chk');
        var btn = document.querySelector('#select_all');
        if (count == 1) {
            document.querySelector('#select_all').innerHTML = "Deselect All";
            document.querySelector('#sendMail').classList.remove('collapse');
            btn.classList.remove('btn-success');
            btn.classList.add('btn-primary');

            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = true;
                arrayOfIds.push(ele[i].value);
            }
            count = 0;
            console.log(arrayOfIds);
        } else if (count == 0) {
            document.querySelector('#select_all').innerHTML = "Select All";
            btn.classList.remove('btn-primary');
            document.querySelector('#sendMail').classList.add('collapse');
            btn.classList.add('btn-success');
            for (var i = 0; i < ele.length; i++) {
                if (ele[i].type == 'checkbox')
                    ele[i].checked = false;
            }
            arrayOfIds = [];
            count = 1;
            console.log(arrayOfIds);
        }
    }

    function sendMail() {
        let uniqueArray = [...new Set(arrayOfIds)];
        let form = document.querySelector('#emailForm');
        $.ajax({
            url: "send_mail_to_candidate",
            type: "GET",
            data: {
                ids: uniqueArray,
                subject: form[0].value,
                title: form[1].value,
                description: form[2].value
            },
            success: function (response) {
                console.log(response);
            },
            error: function (error) {
                console.log(error);
            }
        })
        form.reset();
        document.querySelector('#close').click();
    }

    function showPositionList(candidateId) {
        $.ajax({
            url: "{{ url('get-position-list') }}",
            type: "POST",
            data: {
                _token :"{{ csrf_token() }}",
                id: candidateId,
            },
            success: function (response) {
                console.log(response)
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
            location.reload(true);
        } else {
            console.log("retry");
        }
    }

    function showHistory(id){
        $.ajax({
            url:"{{ url('get-candidate-history')  }}",
            type:"POST",
            data:{
                _token :"{{ csrf_token() }}",
                candidateId:id
            },
            success:function(response){
                console.log(response);
                if (response) {
                    $('.history').html("");
                    $('.history').html(response);
                } else {
                    $('.grid').html(`<div align="center">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                        autoplay></lottie-player>
                    </div>`);
                }
            },
            error:function(error){
                console.log(error);
            }
        })
    }

    function openDetails(candidate_id){
        $.ajax({
            type: 'POST',
            url: "{{ url('candidate/details') }}",
            data: {
                _token: "{{ csrf_token() }}",
                candidate_id: candidate_id,
                display_action_button : 1
            },
            success: function (response) {
                $('#modal-section').html(response);
                $('#rightModal').modal('show');
            }
        })
    }
</script>
@endsection