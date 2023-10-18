
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
               