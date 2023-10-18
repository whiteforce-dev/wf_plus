@extends('master.master')
@section('title', 'Dashboard')
@section('content')
    <link rel="stylesheet" href="{{ url('assets/css/dashboard-res.css') }}">

    <style>
        .card-body-custom {
            height: auto;
        }

        .card-custom {
            height: auto;
            margin-top: 5px;
            margin-bottom: 10px;
        }

        .blue {
            color: #32325D;
        }

        .card-header-custom {
            height: 50px;
            border-radius: 5px;
            padding: 1rem 0.5rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, 0.03);
            border-bottom: 1px solid rgba(0, 0, 0, 0.125);
        }

        .card-footer-custom {
            height: 50px;
            border-radius: 5px;
            padding: 1rem 0.5rem;
        }

        .alert-danger {
            background: #ffffff;
            border-color: #ffefee;
            color: #FF4C41;
        }

        .card {
            padding: 10px 2px;
        }

        h2,
        h5,
        .h2,
        .h5 {
            font-family: inherit;
            font-weight: 600;
            line-height: 1.5;
            margin-bottom: .5rem;
            color: #32325d;
        }

        h5,
        .h5 {
            font-size: .8125rem;
        }

        @media (min-width: 992px) {

            .col-lg-6 {
                max-width: 50%;
                flex: 0 0 50%;
            }
        }

        @media (min-width: 1200px) {

            .col-xl-3 {
                max-width: 25%;
                flex: 0 0 25%;
            }

            .col-xl-6 {
                max-width: 50%;
                flex: 0 0 50%;
            }
        }


        .bg-danger {
            background-color: #f5365c !important;
        }



        @media (min-width: 1200px) {

            .justify-content-xl-between {
                justify-content: space-between !important;
            }
        }


        .pt-5 {
            padding-top: 3rem !important;
        }

        .pb-8 {
            padding-bottom: 8rem !important;
        }

        @media (min-width: 768px) {

            .pt-md-8 {
                padding-top: 8rem !important;
            }
        }

        @media (min-width: 1200px) {

            .mb-xl-0 {
                margin-bottom: 0 !important;
            }
        }




        .font-weight-bold {
            font-weight: 600 !important;
        }


        a.text-success:hover,
        a.text-success:focus {
            color: #24a46d !important;
        }

        .text-warning {
            color: #fb6340 !important;
        }

        a.text-warning:hover,
        a.text-warning:focus {
            color: #fa3a0e !important;
        }

        .text-danger {
            color: #f5365c !important;
        }

        a.text-danger:hover,
        a.text-danger:focus {
            color: #ec0c38 !important;
        }

        .text-white {
            color: #fff !important;
        }

        a.text-white:hover,
        a.text-white:focus {
            color: #e6e6e6 !important;
        }

        .text-muted {
            color: #8898aa !important;
        }

        @media print {

            *,
            *::before,
            *::after {
                box-shadow: none !important;
                text-shadow: none !important;
            }

            a:not(.btn) {
                text-decoration: underline;
            }

            p,
            h2 {
                orphans: 3;
                widows: 3;
            }

            h2 {
                page-break-after: avoid;
            }

            @ page {
                size: a3;
            }

            body {
                min-width: 992px !important;
            }
        }

        figcaption,
        main {
            display: block;
        }

        main {
            overflow: hidden;
        }

        .bg-yellow {
            background-color: #ffd600 !important;
        }






        .icon {
            width: 3rem;
            height: 3rem;
        }

        .icon i {
            font-size: 2.25rem;
        }

        .icon-shape {
            display: inline-flex;
            padding: 12px;
            text-align: center;
            border-radius: 50%;
            align-items: center;
            justify-content: center;
        }

        .imageBox {
            width: 100%;
            height: 345px;
        }

        .cimg {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .carousel-caption {
            z-index: 1;
            background: #0000004f;
            /* border-radius: 150px; */
            padding: 2px;
            -webkit-clip-path: ellipse(60% 80px at bottom center);
            clip-path: ellipse(60% 80px at bottom center);
        }

        .carousel-caption {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 86px;
            padding-top: 1.25rem;
            padding-bottom: 1.25rem;
            color: #fff;
            text-align: center;
        }

        .border-right {
            border-right: 1px solid #00000045;
        }

        .report-heading {
            padding: 6px 0px;
            color: #32325d;
        }

        .text-15 {
            font-size: 15px;
        }

        .search-area {
            width: 25%;
        }

        .blink_me {
            animation: blinker 1s linear infinite;
        }

        @keyframes blinker {
            50% {
                opacity: 0;
            }
        }

    </style>
    <a href="{{ url('https://white-force.com/plus/tutorial/#dashdiv') }}" target="_blank">
        <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
    </a>
    <div class="content-body">
        <div class="container-fluid first-section">
            <div class="row">
                <div class="col-sm-9">
                    <div>
                        <div
                            class="d-flex justify-content-between align-items-center col-sm-12 alert alert-danger left-icon-big alert-dismissible fade show">

                            <div class="media">
                                <div class="alert-left-icon-big">
                                    <span><i class="mdi mdi-check-circle-outline"></i></span>
                                </div>
                                <div class="media-body">
                                    <h5 class="mt-1 mb-2">Hi <b>{{ Auth::user()->name }}</b>, Welcome back!!</h5>
                                    <p class="mb-0"><b>{{ $greeting }}</b>
                                </div>
                            </div>
                            <style>
                                .setting:hover {
                                    background: rgba(0, 0, 0, 0.04)
                                }

                                .setting {
                                    background: rgba(255, 255, 255, 0) padding: 7px;
                                    border-radius: 5px;
                                }
                            </style>
                            <div class="d-flex justify-content-end">
                                <div class="setting p-2" style="cursor: pointer;background-color:#e4e6e78f" >
                                    <a href="{{ url('refresh-cache/dashboard') }}"><i data-feather="refresh-cw"></i>&nbsp; &nbsp; Refresh</a>
                                </div>
                                <div class="setting p-2" style="cursor: pointer">
                                    <a href="{{ url('edit-profile') }}"><i data-feather="settings"></i>&nbsp; &nbsp; Settings</a>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row clients-call">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">CLIENTS</h5>
                                                <span class="h2 font-weight-bold mb-0" id="company-count">-</span>
                                                {{-- <br> --}}
                                                {{-- <a href="javascript::void(0)"><small class="pull-right">Click to refresh</small></a> --}}
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                                    <i class="fas fa-chart-pie"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">POSITION</h5>
                                                <span class="h2 font-weight-bold mb-0" id="position-count">-</span>
                                                {{-- <br> --}}
                                                {{-- <a href="javascript::void(0)"><small class="pull-right">Click to refresh</small></a> --}}
                                            </div>

                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i>
                                                1.10%</span>
                                            <span class="text-nowrap">Since yesterday</span>
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card card-stats mb-4 mb-xl-0">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h5 class="card-title text-uppercase text-muted mb-0">CANDIDATES</h5>
                                                <span class="h2 font-weight-bold mb-0" id="candidate-count">-</span>
                                                {{-- <br> --}}
                                                {{-- <a href="javascript::void(0)"><small class="pull-right">Click to refresh</small></a> --}}
                                            </div>
                                            <div class="col-auto">
                                                <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                    <i class="fas fa-percent"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <p class="mt-3 mb-0 text-muted text-sm">
                                            <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                            <span class="text-nowrap">Since last month</span>
                                        </p> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row open-width">
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white"><i
                                        class="i-Big-Data text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Open Positions - <small>{{ $currentMonth }}
                                                Month</small><span
                                                style="font-weight: 700;
                                font-size: 45px;
                                position: absolute;
                                padding: 0px 54px;
                                margin-top: -15px;" id="open-position-count">-</span>
                                        </h4><span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 mb-4">
                                <div class="p-4 rounded d-flex align-items-center bg-primary text-white"><i
                                        class="i-Big-Data text-32 mr-3"></i>
                                    <div>
                                        <h4 class="text-18 mb-1 text-white">Closed Positions - <small>{{ $currentMonth }}
                                                Month</small><span
                                                style="font-weight: 700;
                                font-size: 45px;
                                position: absolute;
                                padding: 0px 54px;
                                margin-top: -15px;" id="close-position-count">-</span>
                                        </h4><span></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-3 card p-2" style="height: 331px;">
                    <div class="boss-img" style="width: 100%">
                        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                @if (count($events))
                                    @foreach ($events as $key => $event)
                                        <div class="carousel-item imageBox {{ $key == 0 ? 'active' : '' }}">
                                            <img class="cimg" src="{{ url($event->img) }}" class="d-block w-100"
                                                alt="...">
                                            <div class="carousel-caption d-none d-md-block">

                                                <small>{{ $event->event }}</small>
                                                <h6 style="color: #b3ff59; margin: 0px;">{{ $event->name }}</h6>
                                                <small>{{ $event->team }}</small>

                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="carousel-item imageBox active">
                                        <img class="cimg" src="{{ Auth::user()->avtar() }}" class="d-block w-100"
                                            alt="...">
                                        {{-- <div class="carousel-caption d-none d-md-block">

                                    <small>{{ $event->event }}</small>
                                <h6 style="color: #b3ff59; margin: 0px;">{{ Auth::user()->name }}</h6>
                                <small> {{ Auth::user()->role }} </small>

                            </div> --}}
                                    </div>
                                @endif

                            </div>
                            @if (count($events) > 1)
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="card p-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <i class="flaticon-381-user-4 text-dark" style="font-size:40px;"></i>
                                </div>
                                <div class="col-10 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-20 text-dark">Candidate Approach</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mmonth">
                                            <strong class="text-primary">{{ $currentMonth }} Month </strong>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="" style="color:#32325D" id="candidate-approch-count"> -
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card p-0">
                        <div class="card-body  ">
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <i class="flaticon-381-star text-dark" style="font-size:40px;"></i>
                                </div>
                                <div class="col-10 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-20 text-dark">Candidate Offered {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? 'CTC' : 'Count' }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mmonth">
                                            <strong class="text-primary">{{ $currentMonth }} Month  </strong>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="" style="color:#32325D"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                                <span id="candidate-offered-count">-</span>
                                                </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card p-0">
                        <div class="card-body  ">
                            <div class="row">
                                <div class="col-2 mt-2">
                                    <i class="flaticon-381-success-2 text-dark" style="font-size:40px;"></i>
                                </div>
                                <div class="col-10 mt-3">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-20 text-dark">Candidate Joined  {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? 'CTC' : 'Count' }}</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6 mmonth">
                                            <a href="{{ url('reports/month-joining-report') }}" id="rep" data-toggle="tooltip" data-placement="top" title="View Report"><strong class="text-primary">&nbsp;{{ $currentMonth }} Month
                                            </strong></a>
                                        </div>
                                        <div class="col-6">
                                            <h4 class="" style="color:#32325D">
                                                 {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                                 <span id="candidate-joined-count">
                                                    -
                                                 </span>

                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @if ($currentUser->role != 'admin')
                <div class="row" id="user-target-details">
                    <div class="col-12">
                        <div class="col-sm-12">
                            <div class="card p-3">
                                <div class="row">
                                    <div class="col-sm-3 ">
                                        <h4 class="text-15 mb-1 text-dark">Type
                                        </h4>
                                        <div class="mt-2">
                                            <strong class="" style="color:#32325D">Quarter Target</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="" style="color:#32325D">Quarter Achieved</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="" style="color:#32325D">Quarter Pending</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 border-right" align="center">
                                        <h4 class="text-15 mb-1 text-dark">Quarter 1
                                        </h4>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-secondary"> -</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-secondary">-</strong>
                                        </div>
                                        <div class="mt-2">

                                            <strong class="h4 font-weight-bold mb-0  text-secondary">-</strong>

                                        </div>

                                    </div>
                                    <div class="col-sm-2 border-right" align="center">
                                        <h4 class="text-15 mb-1 text-dark">Quarter 2
                                        </h4>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-primary">-</strong>

                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-primary"> -</strong>
                                        </div>
                                        <div class="mt-2">

                                            <strong class="h4 font-weight-bold mb-0  text-primary">-</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-2 border-right" align="center">
                                        <h4 class="text-15 mb-1 text-dark">Quarter 3
                                        </h4>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-success"> -</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-success">-</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-success">-</strong>
                                        </div>
                                    </div>
                                    <div class="col-sm-2" align="center">
                                        <h4 class="text-15 mb-1 text-dark">Quarter 4
                                        </h4>
                                        <div class="mt-2">

                                            <strong class="h4 font-weight-bold mb-0  text-info"> -</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-info">-</strong>
                                        </div>
                                        <div class="mt-2">
                                            <strong class="h4 font-weight-bold mb-0  text-info">-</strong>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-sm-12">
                    <h4 class="report-heading">Quarter Joined Achieved</h4>
                    <div class="card">
                        <div class="row p-2">
                            <div class="col-sm-3 border-right" align="center">
                                <h4 class="text-15 mb-1 text-dark">Quarter 1
                                </h4>
                                <span class="h2 font-weight-bold mb-0"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                    <span id="joined-q1">
                                        -
                                    </span>
                                    </span>
                            </div>
                            <div class="col-sm-3 border-right" align="center">
                                <h4 class="text-15 mb-1 text-dark">Quarter 2
                                </h4>
                                <span class="h2 font-weight-bold mb-0"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                    <span id="joined-q2">
                                        -
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-3 border-right" align="center">
                                <h4 class="text-15 mb-1 text-dark">Quarter 3
                                </h4>
                                <span class="h2 font-weight-bold mb-0"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                    <span id="joined-q3">
                                        -
                                    </span>
                                </span>
                            </div>
                            <div class="col-sm-3" align="center">
                                <h4 class="text-15 mb-1 text-dark">Quarter 4
                                </h4>
                                <span class="h2 font-weight-bold mb-0"> {{ in_array(Auth::user()->software_category, ONROLE_CATEGORY()) ? '₹' : '' }}
                                    <span id="joined-q4">
                                        -
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

            @endif
            <div class="row res-flex">
                <div class="col-sm-8 position-com">
                    <div class="col-sm-12">
                        <h4 class="report-heading">Position Report</h4>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $pastDate }}" id="position_start_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $currentDate }}" id="position_end_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <select class="form-control" id="manager">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary w-100" style="padding: 7px;"
                                        onclick="positionReport()">
                                        <span class="fa fa-search"></span> &nbsp; Search</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row p-2">
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Total
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 "
                                        id="totalPosition">0</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Open
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0  text-secondary"
                                        id="openPosition">0</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Close
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-success"
                                        id="closePosition">0</span>
                                </div>
                                <div class="col-sm-3" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Hold
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-warning"
                                        id="holdPosition">0</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="report-heading">Company Report</h4>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $pastDate }}" id="company_start_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $currentDate }}" id="company_end_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <select class="form-control" id="companyManagerId">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary w-100" style="padding: 7px;"
                                        onclick="companyReport()"><span class="fa fa-search"></span> &nbsp;
                                        Search</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row p-2">
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Total
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 "
                                        id="totalCompany">{{ $totalCompany ?? 0 }}</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Hot
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0  text-secondary"
                                        id="hot">{{ $hotCompany ?? 0 }}</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Cold
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-success"
                                        id="cold">{{ $coldCompany ?? 0 }}</span>
                                </div>
                                <div class="col-sm-3" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Dead
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-warning"
                                        id="dead">{{ $deadCompany ?? 0 }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="upcoming-candidate 700plus" style="display: none;">
                    <div class="col-sm-4 upcoming-off">
                        <h4 class="report-heading">Upcoming Interviews</h4>

                        <div class="card p-3 mb-5 laravel-height" style="height: 398px;">
                            <div class="row mb-2" style="margin-top: -17px">
                                <div class="col-2">
                                    <span class="badge badge-dark countOfInterview my-3" style="height:30px;"
                                        id="">{{ count($upcoming_interview) }}</span>
                                </div>
                                <div class="col-10">
                                    <select class="form-control my-3" onchange="getInterview(this.value)"
                                        style="height:35px;">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="dataContainer" style="height: 400px; overflow:auto">
                                @if (count($upcoming_interview) == 0)
                                    <div align="center">

                                        <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                            background="transparent" speed="1" style="width: 300px; height: 300px;"
                                            autoplay>
                                        </lottie-player>
                                    </div>

                                @endif
                                @foreach ($upcoming_interview as $person)
                                    <div
                                        style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                                        <div class="project-info">
                                            <div class="col-sm-8 left-laravel">
                                                <p class="text-primary mb-1">#
                                                    {{ ucwords($person->position->position_name) }}
                                                </p>
                                                <h4 class="title font-w600 mb-1"><a
                                                        href="{{ url('position/pipeline', $person?->position_id) }}"
                                                        class="text-black">{{ ucwords($person?->candidate->name) }}</a>
                                                </h4>
                                                <p class="text-dark mb-1">Stage -{{ ucwords($person?->stage) }}</p>
                                                <p class="text-dark mb-1">Interview Date -
                                                    {{ ucwords($person?->interview_date) }}
                                                </p>
                                                <p class="text-dark mb-1">Time -
                                                    {{ ucwords($person?->interview_time_from) }}
                                                    -
                                                    {{ ucwords($person?->interview_time_to) }}</p>
                                                <p class="text-dark mb-1">Venue - {{ ucwords($person?->interview_venue) }}
                                                </p>

                                            </div>
                                            <div class="col-sm-4 right-laravel">

                                                <span>Manager</span>
                                                <h5 class="mb-2 pt-1 font-w50 text-black">
                                                    {{ ucwords($person->pco->parent == null ? '-' : $person->pco->realparent->name) }}
                                                </h5>
                                                <span>Recruiter</span>
                                                <h5 class="mb-0 pt-1 font-w50 text-black">
                                                    {{ ucwords($person?->pco->name) }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 can-right">
                        <h4 class="report-heading">Offered Candidate</h4>
                        <div class="card p-3 mb-5" style="height: 390px;">
                            <div class="row mb-2">
                                <div class="col-2">
                                    <span class="badge badge-dark  my-3" style="height:30px;"
                                        id="countOfOffered">{{ count($offered_candidate) }}</span>

                                </div>
                                <div class="col-10">
                                    <select class="form-control my-3" onchange=" getoffered(this.value)"
                                        style="height:35px;">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="offeredContainer" style="height: 446px; overflow:auto">
                                @if (count($offered_candidate) == 0)
                                    <div align="center">

                                        <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                            background="transparent" speed="1" style="width: 300px; height: 300px;"
                                            autoplay>
                                        </lottie-player>
                                    </div>
                                @endif
                                @foreach ($offered_candidate as $person)
                                    <div
                                        style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                                        <div class="project-info">
                                            <div class="col-sm-8">
                                                <span class=" mb-1 text-primary">
                                                    #{{ ucwords($person->position->position_name) }}</span>
                                                <h4 class="title font-w600 mb-1"><a
                                                        href="{{ url('position/pipeline', $person?->position_id) }}"
                                                        class="text-black">{{ ucwords($person?->candidate->name) }} </a>
                                                </h4>
                                                <p class="text-dark mb-1">Stage - {{ ucwords($person?->stage) }}</p>
                                                <p class="text-dark mb-1">Joining Date -
                                                    {{ ucwords($person?->joining_date) }}
                                                </p>
                                                <p class="text-dark mb-1">Time - 10:30 AM - 12:00 PM</p>
                                            </div>
                                            <div class="col-sm-4">
                                                <span>Manager</span>
                                                <h5 class="mb-2 pt-1 font-w50 text-black">
                                                    {{ ucwords($person->pco->parent == null ? '-' : $person->pco->realparent->name) }}
                                                </h5>
                                                <span>Recruiter</span>
                                                <h5 class="mb-0 pt-1 font-w50 text-black">
                                                    {{ ucwords($person?->pco->name) }}
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-sm-4 upcoming-off 1200plus" style="display: none;">
                    <h4 class="report-heading">Upcoming Interviews</h4>

                    <div class="card p-3 mb-5 laravel-height" style="height: 434px;">
                        <div class="row mb-2" style="margin-top: -17px">
                            <div class="col-2">
                                <span class="badge badge-dark countOfInterview my-3" style="height:30px;"
                                    id="">{{ count($upcoming_interview) }}</span>
                            </div>
                            <div class="col-10">
                                <select class="form-control my-3" onchange="getInterview(this.value)"
                                    style="height:35px;">
                                    <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="dataContainer" style="height: 400px; overflow:auto">
                            @if (count($upcoming_interview) == 0)
                                <div align="center">

                                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                                        autoplay>
                                    </lottie-player>
                                </div>

                            @endif
                            @foreach ($upcoming_interview as $person)
                                <div
                                    style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                                    <div class="project-info">
                                        <div class="col-sm-8 left-laravel">
                                            <p class="text-primary mb-1"># {{ ucwords($person->position->position_name) }}
                                            </p>
                                            <h4 class="title font-w600 mb-1"><a
                                                    href="{{ url('position/pipeline', $person?->position_id) }}"
                                                    class="text-black">{{ ucwords($person?->candidate->name) }}</a> </h4>
                                            <p class="text-dark mb-1">Stage -{{ ucwords($person?->stage) }}</p>
                                            <p class="text-dark mb-1">Interview Date -
                                                {{ ucwords($person?->interview_date) }}
                                            </p>
                                            <p class="text-dark mb-1">Time - {{ ucwords($person?->interview_time_from) }}
                                                -
                                                {{ ucwords($person?->interview_time_to) }}</p>
                                            <p class="text-dark mb-1">Venue - {{ ucwords($person?->interview_venue) }}
                                            </p>

                                        </div>
                                        <div class="col-sm-4 right-laravel">

                                            <span>Manager</span>
                                            <h5 class="mb-2 pt-1 font-w50 text-black"> {{ ucwords($person->pco->parent == null ? '-' : $person->pco->realparent->name) }}
                                            </h5>
                                            <span>Recruiter</span>
                                            <h5 class="mb-0 pt-1 font-w50 text-black">{{ ucwords($person?->pco->name) }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>


            </div>
            <div class="row offered-can">
                <div class="col-sm-8 off-report">
                    <div class="col-sm-12">
                        <h4 class="report-heading">Offered Report</h4>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $pastDate }}" id="offered_start_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $currentDate }}" id="offered_end_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <select class="form-control" id="offeredManagerId">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary w-100" style="padding: 7px;"
                                        onclick="offeredReport()"><span class="fa fa-search"></span> &nbsp;
                                        Search</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row p-2 joined-off">
                                <div class="col-sm-4 border-right border-long" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Offered
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 "
                                        id="offered_candidate">-</span>
                                </div>
                                <div class="col-sm-4 border-right border-long" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Joined
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0  text-secondary"
                                        id="joined_candidate">-</span>
                                </div>
                                <div class="col-sm-4" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Not Joined
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-success"
                                        id="rejected_candidate">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <h4 class="report-heading">Interview Report</h4>
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $pastDate }}" id="interview_start_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <input type="date" placeholder="Enter Date" class="form-control"
                                        value="{{ $currentDate }}" id="interview_end_date">
                                </div>
                                <div class="col-sm-3 search-area">
                                    <select class="form-control" id="interviewManagerId">
                                        <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}
                                        </option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3">
                                    <button class="btn btn-primary w-100" style="padding: 7px;"
                                        onclick="interviewReport()"><span class="fa fa-search"></span> &nbsp;
                                        Search</button>
                                </div>
                            </div>
                            <hr>
                            <div class="row p-2">
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Total
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 "
                                        id="total_interview">-</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark">Selected
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0  text-secondary"
                                        id="total_selected">-</span>
                                </div>
                                <div class="col-sm-3 border-right" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Rejected
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-success"
                                        id="total_rejected">-</span>
                                </div>
                                <div class="col-sm-3" align="center">
                                    <h4 class="text-15 mb-1 text-dark ">Not Attended
                                    </h4>
                                    <span class="h1 font-weight-bold mb-0 text-warning"
                                        id="not_attended">-</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 off-right">
                    <h4 class="report-heading">Offered Candidate</h4>
                    <div class="card p-3 mb-5" style="height: 435px;">
                        <div class="row mb-2">
                            <div class="col-2">
                                <span class="badge badge-dark  my-3" style="height:30px;"
                                    id="countOfOffered">{{ count($offered_candidate) }}</span>

                            </div>
                            <div class="col-10">
                                <select class="form-control my-3" onchange=" getoffered(this.value)"
                                    style="height:35px;">
                                    <option value="{{ $currentUser->id }}" selected>{{ $currentUser->name }}</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="offeredContainer" style="height: 446px; overflow:auto">
                            @if (count($offered_candidate) == 0)
                                <div align="center">

                                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                                        autoplay>
                                    </lottie-player>
                                </div>
                            @endif
                            @foreach ($offered_candidate as $person)
                                <div
                                    style="border: 2px dashed #eb815378;border-radius: 10px; padding: 10px 10px; margin-bottom: 10px;">
                                    <div class="project-info">
                                        <div class="col-sm-8">
                                            <span class=" mb-1 text-primary">
                                                #{{ ucwords($person->position->position_name) }}</span>
                                            <h4 class="title font-w600 mb-1"><a
                                                    href="{{ url('position/pipeline', $person?->position_id) }}"
                                                    class="text-black">{{ ucwords($person?->candidate->name) }} </a></h4>
                                            <p class="text-dark mb-1">Stage - {{ ucwords($person?->stage) }}</p>
                                            <p class="text-dark mb-1">Joining Date -
                                                {{ ucwords($person?->joining_date) }}
                                            </p>
                                            <p class="text-dark mb-1">Time - 10:30 AM - 12:00 PM</p>
                                        </div>
                                        <div class="col-sm-4">
                                            <span>Manager</span>
                                            <h5 class="mb-2 pt-1 font-w50 text-black">
                                                {{ ucwords($person->pco->parent == null ? '-' : $person->pco->realparent->name) }}
                                            </h5>
                                            <span>Recruiter</span>
                                            <h5 class="mb-0 pt-1 font-w50 text-black">{{ ucwords($person?->pco->name) }}
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script>


        $( document ).ready(async function() {
            var user = "{{ $currentUser->id }}";
            await companyCount();
            await positionCount();
            await candidateCount();
            await openClosePositionCount();
            await joinedStats();
            await targetStats();
            await getInterview(user);
            await getoffered(user);
            await companyReport();
            await positionReport();
            await offeredReport();
            await interviewReport();
            await candidateStats();
        });

        async function companyCount(){
            await $.get("{{ url('dashboard/company-count') }}", function(response){
                $('#company-count').text(response);
            })
        }
        async function positionCount(){
            await $.get("{{ url('dashboard/position-count') }}", function(response){
                $('#position-count').text(response);
            })
        }
        async function candidateCount(){
            await $.get("{{ url('dashboard/candidate-count') }}", function(response){
                $('#candidate-count').text(response);
            })
        }

        async function openClosePositionCount(){
            await $.get("{{ url('dashboard/open-close-position') }}", function(response){
                $('#open-position-count').text(response.openPositionCurrentMonth);
                $('#close-position-count').text(response.closePositionCurrentMonth);
            })
        }
        async function candidateStats(){
            await $.get("{{ url('dashboard/candidate-stats') }}", function(response){
                $('#candidate-approch-count').text(response.candidateApproachCurrentMonth);
                $('#candidate-offered-count').text(response.candidateOfferedCtcCurrentMonth);
                $('#candidate-joined-count').text(response.candidateJoinedAchivedCurrentMonth);
            })
        }
        async function joinedStats(){
            await $.get("{{ url('dashboard/joined-stats') }}", function(response){
                $('#joined-q1').text(response.q1);
                $('#joined-q2').text(response.q2);
                $('#joined-q3').text(response.q3);
                $('#joined-q4').text(response.q4);
            })
        }
        async function targetStats(){
            await $.get("{{ url('dashboard/target-stats') }}", function(response){
                $('#user-target-details').html(response);
            })
        }



        //position report ajax function //
        async function positionReport() {
            let startDate = document.querySelector('#position_start_date').value;
            let endDate = document.querySelector('#position_end_date').value;
            let manager = document.querySelector('#manager').value;
            await $.ajax({
                url: "position_report",
                type: "GET",
                data: {
                    fromDate: startDate,
                    toDate: endDate,
                    id: manager
                },
                success: function(response) {
                    console.log(response);
                    document.querySelector('#totalPosition').innerHTML = response.total;
                    document.querySelector('#openPosition').innerHTML = response.opened;
                    document.querySelector('#closePosition').innerHTML = response.closed;
                    document.querySelector('#holdPosition').innerHTML = response.hold;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        //company report ajax function //
        async function companyReport() {
            let startDate = document.querySelector('#company_start_date').value;
            let endDate = document.querySelector('#company_end_date').value;
            let manager = document.querySelector('#companyManagerId').value;
            await $.ajax({
                url: "company_report",
                type: "GET",
                data: {
                    fromDate: startDate,
                    toDate: endDate,
                    id: manager
                },
                success: function(response) {
                    console.log(response);
                    document.querySelector('#totalCompany').innerHTML = response.totalCompany;
                    document.querySelector('#hot').innerHTML = response.hot;
                    document.querySelector('#cold').innerHTML = response.cold;
                    document.querySelector('#dead').innerHTML = response.dead;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        //offered report ajax function //
        async function offeredReport() {
            let startDate = document.querySelector('#offered_start_date').value;
            let endDate = document.querySelector('#offered_end_date').value;
            let manager = document.querySelector('#offeredManagerId').value;
            await $.ajax({
                url: "offered_report",
                type: "GET",
                data: {
                    fromDate: startDate,
                    toDate: endDate,
                    id: manager
                },
                success: function(response) {
                    console.log(response);
                    document.querySelector('#offered_candidate').innerHTML = response.offered;
                    document.querySelector('#joined_candidate').innerHTML = response.joined;
                    document.querySelector('#rejected_candidate').innerHTML = response.notJoined;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        //interview report ajax function //
        async function interviewReport() {
            let startDate = document.querySelector('#interview_start_date').value;
            let endDate = document.querySelector('#interview_end_date').value;
            let manager = document.querySelector('#interviewManagerId').value;
            await $.ajax({
                url: "interview_report",
                type: "GET",
                data: {
                    fromDate: startDate,
                    toDate: endDate,
                    id: manager
                },
                success: function(response) {
                    console.log(response);
                    document.querySelector('#total_interview').innerHTML = response.total;
                    document.querySelector('#total_selected').innerHTML = response.selected;
                    document.querySelector('#total_rejected').innerHTML = response.rejected;
                    document.querySelector('#not_attended').innerHTML = response.notAttend;
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        async function getInterview(managerId) {
            var todayDate = "<?php echo $currentDate; ?>";
            var lastDate = "<?php echo $pastDate; ?>";
            await $.ajax({
                url: "manager_vise_interview",
                type: "GET",
                data: {
                    id: managerId,
                    present: todayDate,
                    last: lastDate
                },
                success: function(response) {
                    var countLength = $(response).find(".countInterview");
                    console.log(countLength);
                    document.querySelector('.countOfInterview').innerHTML = countLength.length;
                    console.log(response);
                    if (response) {
                        $('.dataContainer').html(response);
                    } else {
                        $('.dataContainer').html(`<div align="center">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                        autoplay></lottie-player>
                    </div>`);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        async function getoffered(managerId) {
            var todayDate = "<?php echo $currentDate; ?>";
            var lastDate = "<?php echo $pastDate; ?>";
            await $.ajax({
                url: "manager_vise_offered",
                type: "GET",
                data: {
                    id: managerId,
                    present: todayDate,
                    last: lastDate
                },
                success: function(response) {
                    var countLength = $(response).find(".countOffered");
                    document.querySelector('#countOfOffered').innerHTML = countLength.length;
                    if (response) {
                        $('.offeredContainer').html(response);
                    } else {
                        $('.offeredContainer').html(`<div align="center">
                    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json"
                        background="transparent" speed="1" style="width: 300px; height: 300px;"
                        autoplay></lottie-player>
                    </div>`);
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }

        $(window).resize(function() {
            checkSize();
        });

        $(document).ready(function() {
            checkSize();
        })

        function checkSize() {
            var windowWidth = $(window).width();
            if (windowWidth >= 700 && windowWidth <= 1200) {

                $('.700plus').show();
                $('.1200plus').hide();
            } else {

                $('.700plus').hide();
                $('.1200plus').show();
            }
        }

        $('#rep').tooltip();
    </script>
@endsection
