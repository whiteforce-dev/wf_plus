@if($candidates->count()==0)
                <div class="col-xl-12 col-xxl-12 col-sm-12 card">
                    @include('master.404')
                </div>
                @endif
                <div class="col-lg-12 ">
                    <div class="badge badge-primary ">Total Candidates :{{ $total ?? 0 }}</div>
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