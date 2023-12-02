<div
    class="divrow containtg for {{ $position->is_close == 1 ? 'mwrapper' : '' }} {{ $position->is_hold == 1 ? 'mwrapper' : '' }}" style="width: 90%">
    <div class="containtgfor">
        <div data-posname="GM Exports" class="divCsearch divrow" style="position: relative;">
            @if(($hideOptions ?? 0) == 0)
            <div class="slide " align="left">
                <ul>
                    <li><a onclick='openLink("{{ url("position-details", $position->id) }}")' href="javascript::void(0);" style="color:#e66025">View Details
                    </li>

                        <li><a href="{{ url('position-hold', [$position->id]) }}" style="color:#e66025">Hold Position</a>
                        </li>
                        <li><a href="{{ url('position-close', [$position->id]) }}" style="color:#e66025">Close
                                Position</a></li>
                        <li><a href="{{ route('position.edit', [$position->id]) }}" style="color:#e66025">Edit
                                Position</a></li>
                        @if(Auth::user()->role == 'admin')
                        <li><a href="{{ route('position.destroy', [$position->id]) }}" style="color:#e66025">Delete
                                Position</a></li>
                        @endif

                </ul>


                <div class="col-sm-12 mt-2 mb-2" style="border-bottom: 1px dashed #00377130; ">

                </div>

                <ul>
                    @php
                    $appliedCount = \App\Models\CandidateResponse::where('job_id', $position->id)->count();
                    @endphp
                    
                    <li ><a href="{{ url('all_responses', ['job_id' => $position->id, 'portal' => 'all', 'data' => 'response']) }}
                        " target="_blank" style="color:#e66025">Applied Candidate</a>
                    <span class="badge badge-danger badge-pill">{{ $appliedCount ?? 0 }}</span></li>
                    @if(Auth::user()->id == $position->created_by)
                    <li onclick="openManagerlist({{ $position->id }});">Share Position</li>
                    @endif
                    {{-- @if(Auth::user()->role == 'admin') --}}
                    <li><a href="{{ route('related_candidate', [$position->id]) }}"  target="_blank" style="color:#e66025">Related Candidate</a>
                    </li>
                    {{-- @endif --}}
                    <li onclick="openJobPostingReport({{ $position->id }});">Job Posting Report</li>
                    <li onclick="AddQuestionAnswer({{ $position->id }});">Add Interview Q&A</li>
                </ul>

                {{-- <div class="col-sm-12 mt-2 mb-2" style="border-bottom: 1px dashed #00377130; ">

                </div>

                <div align="center">
                    <span style="font-size: 18px; color:#8ccf24;" class="mdi mdi-checkbox-marked-circle"><b></b>10
                        &nbsp;</span>
                    <span style="font-size: 18px; color:#d11313" class="mdi mdi-close-circle">1 &nbsp;</span>
                    <span style="font-size: 18px; color:#b0bcaa" class="mdi mdi-alert-circle">10</span>
                </div> --}}


            </div>
            @endif


            <div class="parent c-position-div" style="position:relative;z-index: 3">
                @if ($position->is_close == 1)
                    <div class="overlay">
                    </div>
                    <div class="col-sm-12 hold" align="center">

                        <h2 > <b>This Position is
                                  <span style="color:#ff451b;">Closed</span> </b>
                        </h2>
                    </div>
                @endif
                @if ($position->is_hold == 1)
                    <div class="overlay">
                    </div>
                    <div class="col-sm-12 hold" align="center">

                        <h2 > <b>This Position is
                                on  <span style="color:#8ccf24;">Hold</span> </b>
                        </h2>
                    </div>
                @endif
                <div class="d-flex justify-content-between card-header" style="z-index: 999;">

                    <div class="d-flex" style="margin-top: 10px;" >
                        @php
                            $img_data = \App\Models\Client::where('id', $position->client_id)->first();
                        @endphp
                        <div class="client_logoDiv" id="client_logoDiv">
                            <img class="" id="client_logo_img" src="{{ Storage::disk('s3')->temporaryUrl('company/images/'.$img_data->image, now()->addMinutes(5)) }}"
                                alt="" />
                        </div>

                        <div class="positionHeading">
                            <h5>{{ ucwords($position->position_name) }}
                                <small
                                    style="color: #3e2828;
                            font-size: 11px;
                            margin-left: 4px;">
                                    {{-- ({{ ucwords($img_data->name ?? '') }}) --}}
                                    ({{ ucwords($position->clientname) }})
                                </small>
                                 </h5>
                            {{-- <h6>{{ \App\Models\User::where('id', $position->client_id)->value('name') }} --}}
                            </h6>
                            <div class="d-flex align-items-center ">
                                <h6 class="heading" style="color:#28044d !important;line-height: 16px;">
                                    Position Code :
                                    WFJOB_{{ $position->id }} &nbsp;

                                    Opening :
                                    {{ $position->openings }} &nbsp;

                                    Job Location :
                                    {{ $position->city }}
                                </h6>
                            </div>
                            <div class="d-flex align-items-center ">
                                <h6 class="postedDate">
                                    <i class="fa fa-user-o" aria-hidden="true"></i>&nbsp;
                                    {{ \App\Models\User::where('id', $position->created_by)->value('name') }}
                                </h6>
                                &nbsp;
                                &nbsp;
                                <h6 class="postedDate">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    Created on -
                                    {{ $position->created_at->format('M d, Y') }}
                                </h6>
                            </div>

                        </div>
                    </div>
                    <div>

                        <div class="dropdown">
                            <button onclick='openLink("{{ url("position-details", $position->id) }}")' class="btn btn-outline-primary btn-sm">Details</button>
                            <a href="{{ url('position/pipeline', [$position->id]) }}"><button class="btn btn-primary btn-sm">Pipeline &nbsp; <span class="badge badge-light badge-pill">{{ $position->PipelineCount }}</span></button></a>
                        </div>

                    </div>
                </div>

                <h5 class="heading"></h5>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="newJobDetailsBox">
                            <div class="row" style="margin-top: 15px;">
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => 1 ?? 0,
                                        ])
                                        White Force
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => 1?? 0,
                                        ])
                                        Happiest
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php

                                            $status = $position->portalResponse->where('portal', 'jora')->first();

                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jora
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('google');
                                            $status = $position->portalResponse->where('portal', 'google')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Google
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('timesjob');
                                            $status = $position->portalResponse->where('portal', 'timesjob')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Times Jobs
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('whatsjob india');
                                            $status = $position->portalResponse->where('portal', 'whatsjob india')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Whatjobs India
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('shine');
                                            $status = $position->portalResponse->where('portal', 'shine')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Shine
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('linkedin');
                                            $status = $position->portalResponse->where('portal', 'linkedin')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Linkedin
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('careerJet');
                                            $status = $position->portalResponse->where('portal', 'careerJet')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Career Jet
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('Adzuna india');
                                            $status = $position->portalResponse->where('portal', 'Adzuna india')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Adzuna India
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('jooble');
                                            $status = $position->portalResponse->where('portal', 'jooble')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jooble
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('monster');
                                            $status = $position->portalResponse->where('portal', 'monster')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Monster
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('indeed');
                                            $status = $position->portalResponse->where('portal', 'indeed')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Indeed
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('post_job_free');
                                            $status = $position->portalResponse->where('portal', 'post_job_free')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Post Job Free
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('Drjobs india');
                                            $status = $position->portalResponse->where('portal', 'Drjobs india')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Dr Jobs
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'clickindia')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Clickindia
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('naukri');
                                            $status = $position->portalResponse->where('portal', 'naukri')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Naukri
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('facebook');
                                            $status = $position->portalResponse->where('portal', 'facebook')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Facebook
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('jobIsJob');
                                            $status = $position->portalResponse->where('portal', 'jobIsJob')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Job is Job
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            // $status = $position->getJobPortalResponse('Linkedin Ats');
                                            $status = $position->portalResponse->where('portal', 'Linkedin Ats')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Linkedin ATS
                                    </h4>
                                </div>
                               
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php

                                            $status = $position->portalResponse->where('portal', 'Jobsora')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jobsora
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php

                                            $status = $position->portalResponse->where('portal', 'learn4good')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Learn 4 Good
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php

                                            $status = $position->portalResponse->where('portal', 'jobgrin')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                       Jobgrin
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'careerbliss')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Careerbliss
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'indiajob')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        The india Job
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'jobrapido')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Job Rapido
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'jobisite')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jobisite
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'econ')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Econjobs
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'cari')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Carijobs
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'bebee')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Bebeejobs
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="ps">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'jobinventory')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jobinventory
                                    </h4>
                                </div>
                                <div class="col-sm-12"
                                    style="border-bottom: 1px dashed #00377130; margin: 12px 0px; margin-left:-24px;">
                                </div>

                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('jora');
                                            $status = $position->portalResponse->where('portal', 'Cv Library')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        CV Library
                                    </h4>
                                </div>

                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('jora');
                                            $status = $position->portalResponse->where('portal', 'Tanqeeb UAE')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Tanqeeb
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('jora');
                                            $status = $position->portalResponse->where('portal', 'job_vertise')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Job Vertise
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'Times Ascent USA')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Times Ascent
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            // $status = $position->getJobPortalResponse('jora');
                                            $status = $position->portalResponse->where('portal', 'whatsjob USA')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        WhatsJob USA
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php

                                            $status = $position->portalResponse->where('portal', 'my_job_helper')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        My Job Helper
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'ziprecruiter')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Zip Recruiter
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'adzuna usa')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Adzuna USA
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'adzuna usa')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Adzuna USA
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'reed')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                       Reed
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'eluta')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                       Eluta
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'workcircle')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Workcircle
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'jobswype')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Jobswype
                                    </h4>
                                </div>
                                <div class="col-sm-3">
                                    <h4 class="blur">
                                        @php
                                            $status = $position->portalResponse->where('portal', 'juju')->first();
                                        @endphp
                                        @include('pages.position.elements.portalStatus', [
                                            'status' => $status->is_success ?? 0,
                                        ])
                                        Juju Jobs
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12" style="border-bottom: 1px dashed #00377130; margin: 12px 0px;">
                    </div>
                </div>
                <div class="d-flex justify-content-around" align="center">
                    <p>
                        Parent <br> 
                        <span style="font-weight: 500; font-size: 14px;"
                            class="ps"></span>
                    </p>
                    <p>
                        Alloted To <br> <span style="font-weight: 500; font-size: 14px;" class="ps">{{ $position->findUserData->name ?? $position->findUserData->name }}
                        </span>
                    </p>
                    <p>
                        Date Created <br> <span style="font-weight: 500; font-size: 14px;" class="ps">{{ modDate($position->created_at, 'Y, d M') }}</span>
                    </p>
                    <p>
                        Position Closed Date <br> <span style="font-weight: 500; font-size: 14px;" class="ps">{{ modDate($position->close_date, 'Y, d M') }}</span>
                    </p>
                    <p>
                        Timeline <br> <span style="font-weight: 500; font-size: 14px;" class="ps">{{ diffWithDate($position->created_at) }}</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function relatedCount(e){
        return e;
    }
</script>

