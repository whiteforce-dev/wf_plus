@if($click_india_candidates->count())
@foreach($click_india_candidates as $key => $candidate)
<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 flip-card" style="margin-bottom: 10px;">
    <div class="card text-center flip-card-inner" style="height: 234px;">
        <div class="flip-card-front" style="background: white;">
            <div class="card-header chakri-front">
                <div class="card-title">
                    {{ $candidate->user_name }}
                </div>
                {{-- {{ ++$key }} --}}
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <label for="" class="job_title">
                        <a href="mailto:{{ $candidate->user_email }}" style="color: #06246a;">
                            <i class="icon-mail"></i>
                            {{ $candidate->user_email }}
                        </a>
                    </label>
                </h5>
                <p class="card-text" style="color: black;font-weight: 500;">
                    <a href="tel:{{ $candidate->user_mobile }}" style="color: white;"
                        class="badge badge-sm badge-primary" target="_blank">
                        <i class="icon-phone"></i>
                        &nbsp;
                        {{ $candidate->user_mobile }}
                    </a>
                </p>
                <p class="card-text" style="color: #06256c !important;">
                    @if(isset($candidate->masterjobposition->job_title))
                    <a href="{{ url('master_jobs/'.$candidate->job_id) }}" title="Click For Job Detail" target="_blank">
                        Job Title:
                        <i class="icon-keyboard_capslock"></i>
                        &nbsp;
                        {{ $candidate->masterjobposition->job_title }}
                    </a>
                    @elseif(isset($candidate->job_id))
                    NA
                    @endif

                    <br>
                  
                </p>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-sm float-left" href="javascript:void(0);" style="font-size: 10px;">
                    <i class="icon-calendar"></i>
                    {{ \Carbon\Carbon::parse($candidate->date)->format('M d,Y h:s A') }}
                </a>
                <a href="#" class="badge badge-danger badge-sm"> {{ $candidate->publish_to }}</a>
            </div>
        </div>
        <div class="flip-card-back" style="background:white;">
            <div class="card-header chakri-back">
                <div class="card-title">
                    {{ $candidate->user_name }}
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">
                    <label for="" class="job_title">
                        <a href="mailto:{{ $candidate->user_email }}" style="color: #06246a;">
                            <i class="icon-mail"></i>
                            {{ $candidate->user_email }}
                        </a>
                    </label>
                </h5>
                <p class="card-text" style="color: black;font-weight: 500;">
                    <a href="tel:{{ $candidate->user_mobile }}" style="color: white;"
                        class="badge badge-sm badge-primary" target="_blank">
                        <i class="icon-phone"></i>
                        &nbsp;
                        {{ $candidate->user_mobile }}
                    </a>
                </p>
                <p class="card-text" style="color: #06256c !important;">
                    @if(isset($candidate->masterjobposition->job_title))
                    <a href="{{ url('master_jobs/'.$candidate->job_id) }}" title="Click For Job Detail" target="_blank">
                        Job Title:
                        <i class="icon-keyboard_capslock"></i>
                        &nbsp;
                        {{ $candidate->masterjobposition->job_title }}
                    </a>
                    @elseif(isset($candidate->job_id))
                    NA
                    @endif

                  
                  
                </p>
            </div>
            <div class="card-footer text-right">
                <a class="btn btn-sm float-left" href="javascript:void(0);" style="font-size: 10px;">
                    <i class="icon-calendar"></i>
                    {{ \Carbon\Carbon::parse($candidate->date)->format('M d,Y h:s A') }}
                </a>
                <a href="#" class="badge badge-danger badge-sm"> {{ $candidate->publish_to }}</a>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif