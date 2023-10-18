@extends('master.master')
@section('title', 'Leaderboard')
@section('content')

<style>
    h1 {
        text-align: center
    }

    .progress-title {
        font-size: 16px;
        font-weight: 700;
        color: #333;
        margin: 0 0 20px
    }

    .progress {
        height: 20px;
        background: #333;
        border-radius: 0;
        box-shadow: none;
        /* margin-bottom: 30px; */
        overflow: visible
    }

    .progress .progress-bar {
        position: relative;
        -webkit-animation: animate-positive 2s;
        animation: animate-positive 2s;
        overflow: visible !important;
    }

    .progress .progress-value {
        display: block;
        font-size: 12px;
        font-weight: 500;
        color: black;
        position: absolute;
        top: -26px;
        right: -28px;

    }

    .progress .progress-bar:after {
        content: "";
        display: inline-block;
        width: 10px;
        background: #fff;
        position: absolute;
        top: -10px;
        bottom: -10px;
        right: -5px;
        z-index: 1;
        transform: rotate(35deg)
    }

    .medal-1 {
        border-left: 25px solid gold;
    }

    .medal-2 {
        border-left: 25px solid silver;
    }

    .medal-3 {
        border-left: 25px solid #CD7F32;
    }

    .medal-none {
        border-left: 25px solid #a482e5;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        @foreach ($numbers as $key => $number)
        @php
        ++$key;
        $user = \App\Models\User::find($number['user_id']);
        @endphp
        <div class="card @if( $key < 4) medal-{{ $key }} @else medal-none @endif">
            <div class="project-info">
                <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="power-ic">
                            @if( $key < 4) <img style="height: 70px;"
                                src="{{ url('') }}/assets/{{ $key }}{{ $key }}.png" alt="">
                                @else
                                {{-- <img style="height: 70px;" src="{{ url('') }}/assets/none.png" alt=""> --}}

                                <div style="margin:20px; position: relative;">
                                   <h2>{{ $key }}</h2> 
                                    <small style="position: absolute;top: 0;right: -16px;font-size: inherit;">th</small>
                                </div>
                                @endif

                        </div>
                        <div class="ms-2">
                            <span>{{ ucwords($user->role) }}</span>
                            <h5 class="mb-0 pt-1 font-w500 text-black">{{ $user->name }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                   
                    @if ($user->checkTarget($user->id))
                    @php
                    $target =  (object)  $user->getTargetThisQuarter();
                    $month_target = $target->target;
                    $complete =  $target->completed;
                    $remaining = $target->left;
                    $percentage = 0;
                    if($complete != 0 && !empty($month_target)){
                        $percentage = ($complete / $month_target) * 100;
                    }

                    @endphp

                    <div style="margin-right: 50px;
                    margin-left: 0px;margin-top: 25px;">
                        <div class="progress">
                            <div class="progress-bar" style="width:{{ $percentage }}%; background:#97c513;">
                                <div class="progress-value">{{ round($percentage) }}%</div>
                            </div>
                        </div>
                    </div>
                    @else
                    <h6 style="font-size:12px" class="mb-0" align="center">
                        Target Not Assigned!!
                    </h6>

                    @endif

                </div>
                <div class="col-xl-2 my-2 col-lg-6 col-sm-6">
                    <div class="ms-2">
                        <span>Joined Candidate </span>
                        <h5 class="mb-0 pt-1 font-w500 text-black">{{ $number['candidates'] }}</h5>
                    </div>

                </div>

                <div class="col-xl-2 my-2 col-lg-6 col-sm-6">
                    <div class="ms-2">
                        <span>Joined Amount</span>
                        <h5 class="mb-0 pt-1 font-w500 text-black"><b>₹</b> {{ inc_format($complete ?? 0) }}</h5>
                    </div>
                </div>
                <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                    <div class="d-flex align-items-center">
                        <div class="project-media">
                            <img src="{{ $user->parent->thumb() }}" alt="">
                        </div>
                        <div class="ms-2">
                            <h5 class="mb-0 pt-1 font-w500 text-black">{{ $user->realparent->name ?? 0 }}</h5>
                            <span>Parent</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
      
    </div>
</div>
@endsection