@extends('master.master')
@section('title', 'Reports')
@section('content')
<style>
    .fs-18 {
        font-size: 18px !important;
    }





    .box {
        padding: 30px;
        /* margin: 2%; */
        background: white;
        /* width: 30%; */
        border: 1px solid #d6d6d6;
        box-shadow: 0 2px 3px 0px rgba(0, 0, 0, 0.25);
        border-radius: 3px;
        transition: .2s all;
    }

    .box-wrap:hover .box {
        /* filter: blur(3px); */
        opacity: .5;
        transform: scale(.98);
        box-shadow: none;
    }

    .box-wrap:hover .box:hover {
        transform: scale(1);
        /* filter: blur(0px); */
        opacity: 1;
        box-shadow: 0 8px 20px 0px rgba(0, 0, 0, 0.125);
    }

    .icons {
        position: absolute;
        font-size: 100px;
        overflow: hidden;
        right: 0px;
        bottom: 0;
        overflow: hidden;
        color: #c7c7c736;
    }
</style>
<a href="{{ url('https://white-force.com/plus/tutorial/#reportdiv') }}" target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-sm-12 box-wrap">
                <div class="row">
                    <div class="col-sm-4 mb-3">
                        <a target="_blank" href="{{ url('reports/monthly-target-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Monthly Target</h3>
                                <span>Report</span>
                                <span class="fa fa-users icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/month-wise-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Month Wise</h3>
                                <span>Report</span>
                                <span class="fa fa-calendar-check-o icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/daily-lineup-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Daily Lineup</h3>
                                <span>Report</span>
                                <span class="fa fa-clock-o icons"></span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4 mb-3">
                        <a target="_blank" href="{{ url('reports/calling-sheet-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Daily Calling Sheet</h3>
                                <span>Report</span>
                                <span class="fa fa-phone icons"></span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/interview-pannel-report') }}">

                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Interview Panel</h3>
                                <span>Report</span>
                                <span class="fa fa-handshake-o icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/pipeline-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Pipeline Stage</h3>
                                <span>Report</span>
                                <span class="fa fa-pie-chart icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/hr_birthdays') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>HR Birthday</h3>
                                <span>Report</span>
                                <span class="fa fa-birthday-cake icons"></span>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/quarter-wise-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Quarter Wise</h3>
                                <span>Report</span>
                                <span class="fa fa-calendar icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mb-3">
                        <a target="_blank" href="{{ url('reports/leader-board') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Leader Board</h3>
                                <span>Report</span>
                                <span class="fa fa-list-ol icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/chrome-extension-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Chrome Extension</h3>
                                <span>Report</span>
                                <span class="fa fa-chrome icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/joining-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Team Joining</h3>
                                <span>Report</span>
                                <span class="fa fa-inr icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a target="_blank" href="{{ url('reports/joining-consolidate-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Team Consolidate</h3>
                                <span>Report</span>
                                <span class="fa fa-globe icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <a target="_blank" href="{{ url('reports/requirement-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Position Requirement</h3>
                                <span>Report</span>
                                <span class="fa fa-bullhorn icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <a target="_blank" href="{{ url('reports/company-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Company Report</h3>
                                <span>Report</span>
                                <span class="fa fa-building-o icons"></span>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4 mt-3">
                        <a target="_blank" href="{{ url('reports/job-analysis-report') }}">
                            <div class="box" align="center" style="border-left: 15px solid #ffd300; position:relative">
                                <h3>Job Analysis Report</h3>
                                <span>Report</span>
                                <span class="fa fa-bar-chart icons"></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
