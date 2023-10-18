@extends('master.master')
@section('title', 'Related Candidate')
@section('content')
<style>
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
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="height:416px;">
                            <div class="card-header">
                                <div class="col-7">
                                    <h4 class="card-title btn bgl-info text-black  status-btn me-3"
                                        style="display:inline">Candidates Found : <strong class="text-danger">{{ $total_candidate_count ?? 0 }}</strong>
                                    </h4>
                                </div>
                                <div class="col-5 offset-1">
                                    <button class="btn btn-outline-success" id="#selectAll" onclick="selectAllCandidate()">Select All</button>
                                    <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    <input type="hidden" name="selectedCandidate[]" id="selectedCandidate">
                                    <input type="hidden" name="positionId" id="positionId" value="{{ $position->id }}">
                                    <button type="button" class="btn btn-outline-dark" onclick="sendBulkMail()">Send Mail</button>
                                    </form>
                                    <a class="btn btn-outline-info" href="{{ url('related_candidate/view-mail-revert/').'/'.$position->id }}" target="_blank">View Mail Revert</a><br><br>
                                    <div id="select_all_option" style="display:none">
                                        &nbsp;&nbsp;&nbsp;<input type="checkbox" class="checkbox" name="select_all_candidates" id="select_all_candidates" onchange="selectCandidateFromALlPages(this)">
                                        <label for="select_all_candidates" style="float: left;"><b>Select all&nbsp;<span class="badge badge-info">{{ count($all_searched_candidate_ids) }}</span> candidates to send mail</b></label>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine111" class="widget-timeline dz-scroll style-1 height400">
                                    <div class="row">
                                        <div class="col-4">
                                            <ul class="timeline col-12">
                                                <li>
                                                    <div class="timeline-badge primary "></div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong class="">Position</strong>
                                                        <h6 class="mb-0">{{ ucwords(strtolower($position->position_name)) }}</h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge success">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Industry</strong>
                                                        <h6 class="mb-0">{{ $position->industry }}</h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge warning">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Education</strong>
                                                        <h6 class="mb-0">{{ $position->edu_qualification }}</h6>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="timeline col-12">
                                                <li>
                                                    <div class="timeline-badge info">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Experience</strong>
                                                        <h6 class="mb-0">{{$position->min_year_exp}} - {{ $position->max_year_exp }} years</h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge danger">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Location</strong>
                                                        <h6 class="mb-0">{{ $position->locations }}</h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge dark">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Skills</strong>
                                                        <h6 class="mb-0">{{ $position->skill_set }}</h6>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-5">
                                            <h6 class="mb-2">For Detailed Search of Candidates </h6>
                                            <form>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="pref_location" name="pref_location" value="1" {{ !empty($request->pref_location) ? 'checked' : ''}}>
                                                        <label class="form-check-label text-black"
                                                            for="pref_location">Preferred Location</label>
                                                    </div>
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="current_location" name="current_location" value="1" {{ !empty($request->current_location) ? 'checked' : ''}}>
                                                        <label class="form-check-label text-black"
                                                            for="current_location">Current Location</label>
                                                    </div>

                                                    <div class=" custom-checkbox mb-3 checkbox-info">

                                                            <div class="col-md-12"><label class="form-check-label text-black"
                                                            for="overall_percentage">Overall Percentage<small>(Greater Than)</small></label></div>
                                                            <div class="col-md-12"><input type="number" name="overall_percentage" class="form-control" value="{{ !empty($request->overall_percentage) ? $request->overall_percentage : '' }}"></div>

                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="education" name="education" value="1" {{ !empty($request->education) ? 'checked' : ''}}>
                                                        <label class="form-check-label text-black"
                                                            for="education">Education</label>
                                                    </div>
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="expected_salary" name="expected_salary" value="1" {{ !empty($request->expected_salary) ? 'checked' : ''}}>
                                                        <label class="form-check-label text-black"
                                                            for="expected_salary">Expected Salary</label>
                                                    </div>
                                                    <div class=" custom-checkbox mb-3 checkbox-info">

                                                            <div class="col-md-12"><label class="form-check-label text-black"
                                                            for="skill_percentage">Skills Percentage<small>(Greater Than)</small></label></div>
                                                            <div class="col-md-12"><input type="number" name="skill_percentage" class="form-control" value="{{ !empty($request->skill_percentage) ? $request->skill_percentage : '' }}"></div>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-primary btn-block">Search</button>
                                                </div>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @foreach($searched_candidate as $candidate)
            <div class="col-xl-12 col-lg-12">
                <div class="card project-card">
                    <div class="card-body">

                        <div class="d-flex mb-4 align-items-start">
                            <div class="dz-media me-3">

                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="me-auto">
                                <h5 class="title font-w600 mb-2"><strong>{{ $candidate['name'] }}</strong></label>&nbsp;&nbsp;&nbsp;
                                    @if($candidate['overall_percentage'] >= 70)
                                    <span class="dt-icon bgl-success me-3" style="padding: 6px;">
                                        <strong>{{ $candidate['overall_percentage'] }}%</strong>
                                    </span>
                                    @elseif($candidate['overall_percentage'] < 70 && $candidate['overall_percentage'] >= 50 )
                                    <span class="dt-icon bgl-info me-3" style="padding: 6px;">
                                        <strong>{{ $candidate['overall_percentage'] }}%</strong>
                                    </span>
                                    @else
                                    <span class="dt-icon bgl-primary me-3" style="padding: 6px;">
                                        <strong>{{ $candidate['overall_percentage'] }}%</strong>
                                    </span>
                                    @endif
                                </h5>
                                <span>{{ ucwords($candidate['current_title']) }}</span>
                            </div>
                            <div class="d-flex align-items-center" style="justify-content: flex-end;margin-right: -171px;">
                                <label class="checkbox-control">
                                    <input type="checkbox" class="checkbox candidateForSearch"
                                        value="{{ $candidate['id'] }}__{{$candidate['overall_percentage']}}" name="checkAllCandidate" onchange="selectedCandidate(this)">
                                    <span class=""></span>
                                </label>
                            </div>
                            <a href="javascript:void(0)" style=" margin-top: 47px;"><span id="addToPipelineLink" class="badge badge-secondary d-sm-inline-block d-none" onclick="addCandidateToPiepeline({{ $candidate['id'] }})">Add To Pipeline</span></a>&nbsp;
                            <a href="javascript:void(0)" style=" margin-top: 47px;" data-toggle="modal" data-target="#candidates" onclick="openDetails({{$candidate['id']}});"><span class="badge badge-primary d-sm-inline-block d-none">Details</span></a>&nbsp;

                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-3 mb-sm-0 mb-3 d-flex">
                                <div class="dt-icon bgl-info me-3">
                                    <strong><i class="flaticon-381-location text-black"
                                            style="font-size: larger;"></i></strong>
                                </div>
                                <div>
                                    <span>Pref. Location</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">{{ $candidate['preferred_location'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <div class="dt-icon me-3 bgl-danger">

                                    <strong><i class="flaticon-381-location-4 text-black"
                                            style="font-size: larger;"></i></strong>
                                </div>
                                <div>
                                    <span>Current Location</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">{{ $candidate['current_location'] }}
                                    </p>
                                </div>

                            </div>
                            <div class="col-3">
                                <h6>Position
                                    <span class="pull-right">{{ $candidate['position_percentage']  }}%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-info progress-animated" style="width: {{ $candidate['position_percentage'] }}%; "
                                        role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Skills
                                    <span class="pull-right">{{ $candidate['skills_percentage'] }}%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-secondary progress-animated"
                                        style="width: {{ $candidate['skills_percentage'] }}%; " role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-sm-0 mb-3 d-flex">
                                <div class="dt-icon bgl-light me-3">

                                    <strong><i class="flaticon-381-send-2 text-black"></i></strong>
                                </div>
                                <div>
                                    <span>Email</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">{{ $candidate['email'] }}</p>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <div class="dt-icon me-3 bgl-success">

                                    <strong><i class="flaticon-381-smartphone-4 text-black"></i></strong>
                                </div>
                                <div>
                                    <span>Mobile No</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">{{ $candidate['mobile'] }}
                                    </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Location
                                    <span class="pull-right">{{ $candidate['location_percentage'] }}%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-warning progress-animated"
                                        style="width: {{ $candidate['location_percentage'] }}%; " role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Experience
                                    <span class="pull-right">{{ $candidate['experience_percentage'] }}%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-success progress-animated"
                                        style="width: {{ $candidate['experience_percentage'] }}%; " role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="pagination-gutter" style="background: none;">
                {{ $searched_candidate->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    function addCandidateToPiepeline(candidateId){
        disableLink();
        var positionIds = ['{{ $position->id }}']
        $.ajax({
            type : 'POST',
            url  : "{{ url('add-candidate-to-multiple-pipeline') }}",
            data : {
                '_token' : "{{ csrf_token() }}",
                candidateId : candidateId,
                positionIds : positionIds
            },
            success : function(response){
                successMsg(response);
            }
        })
    }

    function disableLink() {
        var link = document.getElementById('addToPipelineLink');
        link.onclick = null;
        link.style.pointerEvents = 'none';
        link.style.opacity = '0.5';
        link.textContent = 'Added To Pipeline';
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

    let count = 1;
    var arrayOfIds = new Array();

    function selectedCandidate(e) {
        if (e.checked == true) {
            arrayOfIds.push(e.value);
        } else {
            arrayOfIds = arrayOfIds.filter(item => item !== e.value);
        }
        $('#selectedCandidate').val(arrayOfIds);
    }

    function selectAllCandidate() {
        var candidate = document.getElementsByName('checkAllCandidate');
        if (count == 1) {
            document.getElementById("#selectAll").innerText = "Deselect All";
            document.getElementById("#selectAll").classList.remove('btn-outline-success');
            document.getElementById("#selectAll").classList.add('btn-outline-danger');
            document.getElementById("select_all_option").style.display = "block";
            

            for (var i = 0; i < candidate.length; i++) {
                if (candidate[i].type == 'checkbox')
                candidate[i].checked = true;
                arrayOfIds.push(candidate[i].value);
            }
            count = 0;
        } else if (count == 0) {
            document.getElementById("#selectAll").innerText = "Select All";
            document.getElementById("#selectAll").classList.remove('btn-outline-danger');
            document.getElementById("#selectAll").classList.add('btn-outline-success');
            document.getElementById("select_all_option").style.display = "none";
            for (var i = 0; i < candidate.length; i++) {
                if (candidate[i].type == 'checkbox')
                candidate[i].checked = false;
            }
            arrayOfIds = [];
            count = 1;
        }
        document.getElementsByName('select_all_candidates').checked = false;
        $('#selectedCandidate').val(arrayOfIds);
    }

    function sendBulkMail(){
        var positionId = $('#positionId').val();
        var selectedCandidate = $('#selectedCandidate').val();
        if(selectedCandidate.length <= 0){
            errorMsg("Please select candidate");
            return false;
        }
        $.ajax({
            type : 'POST',
            url : "{{ url('send-related-candidate-mail') }}",
            data : {
                positionId : positionId,
                selectedCandidate : selectedCandidate,
                '_token' : "{{ csrf_token() }}"
            },
            success : function(response){
                if(response == 1){
                    successMsg("Mail Sent Successfuly");
                } else {
                    errorMsg(response);
                }

            }
        })
    }

    function selectCandidateFromALlPages(checkbox){
        if(checkbox.checked == true){
            $('#selectedCandidate').val({{ Js::from($all_searched_candidate_ids) }});
        } else {
            count = 1;
            selectAllCandidate();
        }
    }
</script>
@endsection
