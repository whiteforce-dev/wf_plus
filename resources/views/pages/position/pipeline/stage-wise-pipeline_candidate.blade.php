@if (count($candidates))

    @foreach ($candidates as $key => $pipeCandidate)

        <label class="pipeCan {{ 'pco-user'.$pipeCandidate->pco->id }} allCandidate" for="pipeline_{{ $pipeCandidate->id }}" style="">
            <div class="card-dropdown col-md-2">
                <div class="dropdown">
                    <button type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots" aria-hidden="true"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <h6 class="dropdown-header">Change Stage</h6>

                        <li class="li {{ 'sourcing' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "sourcing", "{{ $currentStage }}")'>-
                                {{ ucwords('sourcing') }}</a>
                        </li>
                        <li class="li {{ 'telephonic' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "telephonic", "{{ $currentStage }}")'>-
                                {{ ucwords('telephonic') }}</a>
                        </li>
                        <li class="li {{ 'f2f' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "f2f", "{{ $currentStage }}")'>-
                                {{ ucwords('f2f') }}</a>
                        </li>
                        <li class="li {{ 'not_attend' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "not_attend", "{{ $currentStage }}")'>-
                                {{ ucwords('not_attend') }}</a>
                        </li>
                        <li class="li {{ 'rejected' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "rejected", "{{ $currentStage }}")'>-
                                {{ ucwords('rejected') }}</a>
                        </li>
                        <li class="li {{ 'hot' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "hot", "{{ $currentStage }}")'>-
                                {{ ucwords('hot') }}</a>
                        </li>
                        <li class="li {{ 'hold' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='changeStatus({{ $pipeCandidate->id }}, "hold", "{{ $currentStage }}")'>-
                                {{ ucwords('hold') }}</a>
                        </li>
                        @if ($pipeCandidate->interview_date !== null)
                            <li class="li {{ 'selected' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                    onclick='changeStatus({{ $pipeCandidate->id }}, "selected", "{{ $currentStage }}")'>-
                                    {{ ucwords('selected') }}</a>
                            </li>
                            <li class="li {{ 'backout' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                    onclick='changeStatus({{ $pipeCandidate->id }}, "backout", "{{ $currentStage }}")'>-
                                    {{ ucwords('backout') }}</a>
                            </li>
                            @if($currentStage != 'joined')
                            <li class="li {{ 'offered' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                    onclick='changeStatus({{ $pipeCandidate->id }}, "offered", "{{ $currentStage }}")'>-
                                    {{ ucwords('offered') }}</a>
                            </li>
                            @endif
                            
                            @if($currentStage == 'offered')
                            <li class="li {{ 'joined' == $currentStage ? 'd-none' : '' }}"><a class="dropdown-item" href="javascript:void(0)"
                                    onclick='changeStatus({{ $pipeCandidate->id }}, "joined", "{{ $currentStage }}")'>-
                                    {{ ucwords('joined') }}</a>
                            </li>
                            @endif
                        @endif


                        <h6 class="dropdown-header">For Interview</h6>
                        <li class="li"><a class="dropdown-item" href="javascript:void(0)"
                                onclick='scheduleInterview({{ $pipeCandidate->id }})'>
                                - Set Interview</a></li>

                        <h6 class="dropdown-header">For Candidate</h6>
                        <li class="li">
                            @if(!empty($pipeCandidate->batch_header_file))
                            <a class="dropdown-item"  href="{{ url('download-single-batch-header/').'/'.$pipeCandidate->batch_header_file }}">- Download Batch Header</a></li>
                            @else
                            <a class="dropdown-item" href="javascript:void(0)" onclick='generateBatchHeader({{ $pipeCandidate->id }},{{ $pipeCandidate->position_id }},{{$pipeCandidate->candidate_id}})'>- Generate Batch Header</a>
                            @endif
                        </li>

                    </ul>

                </div>
            </div>
            <div  class="card1 candidateCard" draggable="true">
                <div class="card-head row">
                    <div class="candidate-name col-md-10 d-flex align-items-top">
                        <div class="form-check custom-checkbox mb-3 check-xs pipelineChkBox">
                            <input type="checkbox" value="{{ $pipeCandidate->id }}"
                                class="form-check-input sourceCheckBox allcanididates"
                                id="pipeline_{{ $pipeCandidate->id }}" {{ $currentStage == 'joined' ? 'disabled' : '' }}>
                            {{-- <label class="form-check-label" for="pipeline_{{ $pipeCandidate->id }}"></label> --}}
                        </div>
                        <div>
                            <div style="margin-left: 15px;">
                                @if (strlen($pipeCandidate->candidate->name) > 12)
                                    <h6 title="{{ $pipeCandidate->candidate->name }}">
                                        {{ substr($pipeCandidate->candidate->name, 0, 12) . '...' }}
                                    </h6>
                                @else
                                    <h6>{{ $pipeCandidate->candidate->name }}</h6>
                                @endif

                                @if($pipeCandidate->joining_date)
                                    @php
                                        $joinedDate = modDate($pipeCandidate->joining_date, 'M d, Y');
                                        $ctc = ucwords($pipeCandidate->offerd_ctc);
                                        $string = "Date of Joining - $joinedDate, CTC - ".inc_format($ctc ?? 0);
                                    @endphp
                                    <p style="color: #eb8153;">
                                        <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3.5">
                                            {{ $string }}
                                        </marquee>
                                    </p>
                                @elseif ($pipeCandidate->interview_date)
                                    @php
                                        $date = modDate($pipeCandidate->interview_date, 'M d, Y');
                                        $place = ucwords($pipeCandidate->interview_venue);
                                        $string = "Interview Date - $date, Venue - $place, Time -
                                        $pipeCandidate->interview_time_from -
                                        $pipeCandidate->interview_time_to";
                                    @endphp

                                    <p style="color:green">
                                        <marquee onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3.5">
                                            {{ $string }}
                                        </marquee>
                                    </p>
                                @else
                                    <p style="color:rgb(255, 0, 0)">Interview not scheduled
                                    </p>
                                @endif


                            </div>
                        </div>
                    </div>

                </div>

                <div class="inside">
                    <div class="card-content">
                        <div class="candidate-details">
                            <div class="details-title">
                                <i class="bi bi-telephone" aria-hidden="true"></i>
                                {{ $pipeCandidate->candidate->mobile ?? '00000-00000' }}
                            </div>
                        </div>
                        <div class="candidate-details">
                            <div class="details-title">
                                <i class="bi bi-envelope" aria-hidden="true"></i>
                                {{ $pipeCandidate->candidate->email ?? 'Email Not Found' }}
                            </div>
                        </div>
                        <div class="candidate-details">
                            <div class="details-title">
                                <i class="bi bi-stopwatch" aria-hidden="true"></i>
                                {{ modDate($pipeCandidate->created_at, 'M d , Y H:i A') }}
                            </div>
                        </div>
                        @php
                            $percent = $pipeCandidate->matching_percentage ?? 0;
                        @endphp
                        <div class="percentage-score">
                            <svg class="progress" data-progress="{{ $percent }}" x="0px" y="0px"
                                viewBox="0 0 80 80">
                                <path class="track" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                <path class="fill" d="M5,40a35,35 0 1,0 70,0a35,35 0 1,0 -70,0" />
                                <text class="value" x="50%" y="57%">{{ $percent }}%</text>
                            </svg>
                        </div>
                    </div>
                    <div class="score-status">

                        <p class="badge bg-badge-danger" style=" padding: 4px;
                    ">
                            {{ modDate($pipeCandidate->candidate->created_at, 'M, d Y H:i A') }}
                        </p>

                    </div>
                    <div class="pipeline-Added">
                        <div class="details-title justify-content-between">
                            {{ ucwords($pipeCandidate->candidate->createdBy->name ?? 'user') }}
                            |
                            {{ ucwords($pipeCandidate->pco->name ?? 'User') }}
                            <div class="d-flex">
                                <div class="added-co" style="position: relative;">
                                    <img src="{{ (!empty($pipeCandidate->candidate) && !empty($pipeCandidate->candidate->createdBy) && !empty($pipeCandidate->candidate->createdBy->thumb())) ? $pipeCandidate->candidate->createdBy->thumb() : '' }}" alt="">
                                </div>
                                <div class="added-pco" style="position: relative;right:0px">

                                    <img src="{{ (!empty($pipeCandidate->pco) && !empty($pipeCandidate->pco->thumb())) ? $pipeCandidate->pco->thumb() : '' }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </label>
    @endforeach
@else
    <div align="center">
        <img style="width: 180px; opacity: 1; margin: 45px;"
            src="https://i.pinimg.com/originals/6b/60/14/6b6014a6ea8d146062de5714bb1b2666.png" alt="">
            <hr>
            <small style=" opacity:0.6;">No Candidate available</small>
    </div>
@endif

<script>
    var currentStage = "{{ ucfirst($currentStage) }}";
    var counts = "{{ count($candidates) }}";
    $('#' + currentStage + '_count').html(counts);
</script>
