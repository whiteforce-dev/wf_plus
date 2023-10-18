@extends('master.master')
@section('title', 'Mail Revert')
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-10 offset-1 ">
                <div class="card col-12">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div class="col-7">
                            <h4>Related Candidate Mail Revert</h4>
                        </div>
                        <div class="col-md-5 row">
                            <div class="col-md-6">
                            <span><b>Total Mail Sent:</b>&nbsp;<span class="badge badge-primary">{{ $total_mail_send_count }}</span></span>
                            </div>
                            <div class="col-md-4">
                            <span><b>Total Revert:</b>&nbsp;<span class="badge badge-primary">{{ $total_revert_count }}</span></span>&nbsp;&nbsp;
                            </div>
                            <div class="col-md-2">
                            <span class="badge badge-success" onclick="showHideFilterDiv()"><b><i class="fa fa-search" aria-hidden="true" ></i></b></span>
                            </div>
                        </div>
                        
                    </div>
                    
                        <div class="col-md-12 row" style="margin-left: 6px;margin-bottom: 4px;display:none" id="filterdiv">
                            <div class="col-md-3">
                                <label for="">Is Experienced</label>
                                <select name="is_exp" id="is_exp" class="form-control">
                                    <option value="">Select</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Experience Range</label>
                                <select name="exp_range" id="exp_range" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0-5">0-5 Years</option>
                                    <option value="5-10">5-10 Years</option>
                                    <option value="10-15">10-15 Years</option>
                                    <option value="15-20">15-20 Years</option>
                                    <option value="20-25">20-25 Years</option>
                                    <option value="25-30">25-30 Years</option>
                                    <option value="30-35">30-35 Years</option>
                                    <option value="35+">35+ Years</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                <label for="">Current CTC</label>
                                <select name="current_ctc" id="current_ctc" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0-5">0-5 LPA</option>
                                    <option value="5-10">5-10 LPA</option>
                                    <option value="10-15">10-15 LPA</option>
                                    <option value="15-20">15-20 LPA</option>
                                    <option value="20-25">20-25 LPA</option>
                                    <option value="25-30">25-30 LPA</option>
                                    <option value="30-35">30-35 LPA</option>
                                    <option value="35+">35+ LPA</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                <label for="">Expected CTC</label>
                                <select name="expected_ctc" id="expected_ctc" class="form-control">
                                    <option value="">Select</option>
                                    <option value="As per company norms">As per company norms</option>
                                    <option value="10-20%">10-20% Hike</option>
                                    <option value="20-30%">20-30% Hike</option>
                                    <option value="30-40%">30-40% Hike</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Notice Period</label>
                                <select name="notice_period" id="notice_period" class="form-control">
                                    <option value="">Select</option>
                                    <option value="10">10 Days</option>
                                    <option value="15">15 Days</option>
                                    <option value="30">30 Days</option>
                                    <option value="45">45 Days</option>
                                    <option value="60">60 Days</option>
                                    <option value="Immidiate Joining">Immidiate Joining</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="">Ready To Relocate</label>
                                <select name="relocate" id="relocate" class="form-control">
                                    <option value="">Select</option>
                                    <option value="yes">yes</option>
                                    <option value="no">no</option>
                                </select>
                            </div>
                            <div class="col-md-3" style="margin-top:26px">
                                <button class="btn btn-info col-md-12" onclick="getSearchData()">Search</button>
                            </div>
                        </div>
                        
                </div>
                
                
                @if(!$total_revert_count)
                <div class="col-xl-12 col-xxl-12 col-sm-12 card">
                    @include('master.404')
                </div>
                @endif

                <div class="col-lg-12" id="datadiv">
                @foreach($candidate_data as $candidate)
                    <div class="col-lg-12 ">
                        <div class="card">
                            <div class="d-flex justify-content-between card-header">
                                <div class="d-flex" style="margin-top: 5px;">
                                    <div class="client_logoDiv" id="client_logoDiv">
                                        <img class="" id="client_logo_img" src="{{ url('assets/user-placeholder.png') }}" alt="no image" />
                                    </div>

                                    <div class="positionHeading mx-2">
                                        <h5>{{ucwords($candidate->candidate->name)}}&nbsp;&nbsp;&nbsp;
                                            @if(!empty($candidate->percentage))
                                                @if($candidate->percentage >= 70)
                                                <span class="dt-icon bgl-success me-3" style="padding: 6px;">
                                                    <strong>{{ $candidate->percentage }}%</strong>
                                                </span>
                                                @elseif($candidate->percentage < 70 && $candidate->percentage >= 50 )
                                                <span class="dt-icon bgl-info me-3" style="padding: 6px;">
                                                    <strong>{{ $candidate->percentage }}%</strong>
                                                </span>
                                                @else
                                                <span class="dt-icon bgl-primary me-3" style="padding: 6px;">
                                                    <strong>{{ $candidate->percentage }}%</strong>
                                                </span>
                                                @endif
                                            @endif
 

                                        <div class="d-flex align-items-center ">
                                            <h6 class="heading" style="color:#28044d !important;line-height: 16px;">
                                                Mobile:
                                                <span class="text-primary"> {{ $candidate->candidate->mobile }}
                                                    @if(!empty($candidate->changed_mobile))
                                                    ({{ $candidate->changed_mobile }})
                                                    @endif
                                                </span> &nbsp;
                                                Email :<span class="text-primary"> {{ $candidate->candidate->email }}
                                                    @if(!empty($candidate->changed_email))
                                                    (<b style="color:black">Changed: </b>{{ $candidate->changed_email }})
                                                    @endif
                                                </span>
                                            </h6>
                                           
                                        </div>
                                       
                                        <div class="d-flex align-items-center ">
                                           
                                            <h6 class="postedDate">
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                Reverted on -
                                                {{ date('M d, Y', strtotime($candidate->revert_date)) }}
                                            </h6>
                                        </div>

                                    </div>
                                </div>
                                <div>

                                    <div class="dropdown">
                                        <!-- <a href="javascript:void(0)"><span class="btn px-3 py-1 btn-secondary btn-xs mt-4"
                                            data-toggle="modal"
                                            data-target="#myModal2{{ $candidate->id }}" onclick="openDetails({{ $candidate->id }})">Edit</span></a>&nbsp; -->
                                        <!-- <a href="javascript:void(0)"><span class="btn px-3 py-1 btn-success btn-xs mt-4"
                                            data-toggle="modal" data-target="#pipeline{{ $candidate->id }}"
                                            onclick="showPositionList({{ $candidate->id }})">Pipeline</span></a> -->

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
                                            <h6 class="text-dark">Is Experienced</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->is_experienced }} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-danger">

                                            <strong><i class="flaticon-055-cube text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Experience</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->experience_range }}
                                            </p>
                                        </div>

                                    </div>
                                    <div class="col-sm-4 mb-sm-0 mb-3 d-flex">
                                        <div class="dt-icon bgl-primary me-3">
                                            <strong><i class="flaticon-381-location text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Want to Relocate</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->relocate }}</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4  mb-3 d-flex">
                                        <div class="dt-icon me-3 bgl-success">

                                            <strong><i class="flaticon-068-pencil text-black"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Current CTC</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->current_ctc }} LPA
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3  d-flex ">
                                        <div class="dt-icon bgl-secondary me-3">
                                            <strong><i class="flaticon-147-medal text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Expected CTC</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->expected_ctc }} </p>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-sm-0 d-flex ">
                                        <div class="dt-icon bgl-warning me-3">
                                            <strong><i class="flaticon-381-notepad-2 text-black"
                                                    style="font-size: larger;"></i></strong>
                                        </div>
                                        <div>
                                            <h6 class="text-dark">Notice Period</h6>
                                            <p class="mb-0 pt-1 font-w500 text-black">
                                                {{ $candidate->expected_ctc }} </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                   
                    @endforeach
                    <div class="col-12 pagination-gutter">
                        {{ $candidate_data->links() }}
                    </div>
                </div>

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

    function showHideFilterDiv(){
        document.getElementById("filterdiv").style.display = "flex";
    }

    getSearchData();
    function getSearchData(){
        $.ajax({
            type : 'POST',
            url : "{{ url('related_candidate/view-mail-revert-search') }}",
            data : {
                '_token':"{{ csrf_token() }}",
                is_exp: $('#is_exp').val(),
                exp_range: $('#exp_range').val(),
                current_ctc: $('#current_ctc').val(),
                expected_ctc: $('#expected_ctc').val(),
                notice_period: $('#notice_period').val(),
                relocate: $('#relocate').val(),
                position_id : "{{ $position_id }}"
            },
            success:function(response){
               $("#datadiv").html(response);
            }
        })
    }
</script>
@endsection
