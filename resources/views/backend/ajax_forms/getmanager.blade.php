

@if($data->count())
@foreach($data as $key => $candidate)

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 abc" style="">
    <div class="card">
        <div class="card-header">
            <div class="card-title">
                
                {{ $candidate->name }}   
                @php
         
                @endphp

              {{--   @if(isset($jobPosition->company->image) and
                file_exists($jobPosition->company->image))
                <a href="{{ $url }}" target="_blank"
                    title="{{ isset($jobPosition->company->name)?'('.$jobPosition->company->name.')':'' }}">
                    <img src="{{ url($jobPosition->company->image) }}" style="max-height: 20px;"
                        class="float-right"
                        alt="{{ isset($jobPosition->company->name)?'('.$jobPosition->company->name.')':'' }}" />
                </a>
                @else
                <img src="{{ url('logo.png') }}" style="max-height: 20px;" class="float-right"
                    alt="{{ isset($jobPosition->company->name)?'('.$jobPosition->company->name.')':'' }}" />
                @endif --}}
            </div>
        </div>
        <div class="card-body">
            <p class="card-text">
                {{ $candidate->login_email }}
            </p>
        </div>
        <div class="card-footer text-right">
       

            <a href="javascript: void(0);" class="btn btn-danger btn-sm"
             >{{ $candidate->count }}
            </a>
           
        </div>
    </div>
</div>
@endforeach
@endif