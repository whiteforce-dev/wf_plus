@foreach ($candidates as $key=> $candidate)
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
                    <!-- <small style="color: #3e2828;
                font-size: 11px;
                margin-left: 4px;">
                        ({{ ucwords($candidate?->publish_to) }})</small> -->
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
                <div class="d-flex align-items-center" style="justify-content: flex-end;">
                    <span class="badge badge-info" style="width: 146px;
                    height: 31px;
                    border-radius: 5px;
                    text-align: center;
                    padding: 4px;
                    color: #f5efef;
                    padding-top: 5px;"> ({{ ucwords($candidate?->publish_to) }})</span>
                </div>
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
                                    role="tab" onclick="showHistory({{ $candidate->candidate->id }})">History</a>
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
                            <div id="history-tab{{ $candidate->id }}" class="tab-pane fade history"
                                role="tabpanel">
                                
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