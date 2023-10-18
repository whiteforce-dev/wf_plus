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
</style>
<div class="modal-header custom-modal-header">
    <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
        <div class="candidate_Information d-flex align-items-center">
            <div class="client_logoDiv mx-2" id="client_logoDiv">
                <img class="" id="client_logo_img"
                    src="{{ url('assets/user-placeholder.png') }}"
                    alt="no image" />
            </div>
            <div class="candidate_info mx-3">
                <h5 class="m-0">{{ ucwords($candidate?->name) }}</h5>
                <p class="m-0">{{ ucwords($candidate?->current_title ?? "N/A") }}</p>
            </div>
        </div>
        @if(!empty($display_action_button))
            <div class="candidates_button">
                <a href="{{ route('candidate.edit',$candidate->id) }}"
                    class="btn custom-btn btn-secondary">Edit</a>
                @if(Auth::user()->role =='admin')
                <form action="{{ route('candidate.destroy',$candidate->id) }}" method="post"
                    style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn custom-btn btn-danger" value="Delete">
                </form>
                @endif
            </div>
        @endif
    </div>
</div>
<div class="modal-body custom-modal-body">
    <div class="custom-tab-1">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation"><a
                    href="#details-tab{{ $candidate->id }}" data-bs-toggle="tab"
                    class="nav-link custom-nav-modal show active" aria-selected="true"
                    role="tab" tabindex="-1">Details</a>
            </li>
            <li class="nav-item" role="presentation"><a
                    href="#resume-tab{{ $candidate->id }}" data-bs-toggle="tab"
                    class="nav-link custom-nav-modal" aria-selected="false" role="tab"
                    tabindex="-1">Resume</a>
            </li>
            <li class="nav-item" role="presentation"><a
                    href="#history-tab{{ $candidate->id }}" data-bs-toggle="tab"
                    class="nav-link custom-nav-modal" aria-selected="false"
                    role="tab" onclick="showHistory({{ $candidate->id }})">History</a>
            </li>
        </ul>
        <div class="tab-content custom-tab-content">
            <div id="details-tab{{ $candidate->id }}" class="tab-pane fade active show"
                role="tabpanel">
                <div class="card custom-card">
                    <div class="card-header">
                        <h6>Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row px-2">
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Mobile</h6>
                                    <p class="m-0">{{ $candidate?->mobile }}</h6>
                                </div>
                                <div class="candidate_qualification my-4">
                                    <h6 class="m-0">Date of Birth</h6>
                                    <p class="m-0">{{ $candidate?->date_of_birth}}</h6>
                                </div>
                                <div class="candidate_sourcedPosition my-4">
                                    <h6 class="m-0">Marital Status</h6>
                                    <p class="m-0">
                                        {{ucwords($candidate?->marital_status)}}</h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Email</h6>
                                    <p class="m-0">{{ $candidate?->email }}</h6>
                                </div>
                                <div class="candidate_prefLocation my-4">
                                    <h6 class="m-0">Gender</h6>
                                    <p class="m-0">{{ $candidate?->gender }}</h6>
                                </div>
                                <div class="candidate_pincode my-4">
                                    <h6 class="m-0">Pincode</h6>
                                    <p class="m-0">{{ $candidate?->pin_code }}</h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Communication</h6>
                                    <p class="m-0">
                                        {{ ucwords($candidate?->communication) }}</h6>
                                </div>
                                <div class="candidate_qualification my-4">
                                    <h6 class="m-0">Skills</h6>
                                    <p class="m-0">{{ $candidate?->skills}}</h6>
                                </div>

                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Languages</h6>
                                    <p class="m-0">{{ $candidate?->languages }}</h6>
                                </div>
                                <div class="candidate_prefLocation my-4">
                                    <h6 class="m-0">Address</h6>
                                    <p class="m-0">{{ $candidate?->address }}</h6>
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
                                        {{ucwords($candidate?->highest_qualification_type) }}
                                        In {{ $candidate?->highest_qualification }}
                                        </h6>
                                </div>

                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Qualification Year</h6>
                                    <p class="m-0">
                                        {{ $candidate?->highest_qualification_year }}
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
                                    <p class="m-0">{{ $candidate?->current_company }}
                                        </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Current Designation</h6>
                                    <p class="m-0">{{ $candidate?->current_title }}</h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Industry</h6>
                                    <p class="m-0">{{ $candidate?->industry }} </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Experience</h6>
                                    <p class="m-0">{{ $candidate?->total_experience }}
                                        </h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Current Salary</h6>
                                    <p class="m-0">{{ $candidate?->current_salary }}
                                        </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Expected Salary</h6>
                                    <p class="m-0">{{ $candidate?->expected_salary }}
                                        </h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Last Company</h6>
                                    <p class="m-0">{{ $candidate?->last_company }} </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Last CTC</h6>
                                    <p class="m-0">{{ $candidate?->last_ctc }} </h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Pay Type</h6>
                                    <p class="m-0">
                                        {{ ucwords($candidate?->salary_type) }} </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Notice Period</h6>
                                    <p class="m-0">{{ $candidate?->notice_period }}
                                        </h6>
                                </div>
                            </div>
                            <div class="left-row col-md-6">
                                <div class="candidate_mobile mb-4">
                                    <h6 class="m-0">Current Location</h6>
                                    <p class="m-0">
                                        {{ ucwords($candidate?->current_location) }}
                                        </h6>
                                </div>
                            </div>
                            <div class="right-row col-md-6">
                                <div class="candidate_email mb-4">
                                    <h6 class="m-0">Preffered</h6>
                                    <p class="m-0">{{ $candidate?->preferred_location }}
                                        </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="resume-tab{{ $candidate->id }}" class="tab-pane fade"
                role="tabpanel">
                @if ($candidate->resume_file)
                <iframe
                    src="{{ Storage::disk('s3')->temporaryUrl('candidate_resume/'.$candidate->resume_file, now()->addMinutes(5)) }}"
                    frameborder="0" width="100%" height="500px"></iframe>
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
