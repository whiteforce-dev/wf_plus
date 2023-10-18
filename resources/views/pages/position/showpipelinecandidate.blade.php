@extends('master.master')
@section('title', 'Team Section')
@section('content')

    <link href="{{ url('assets/css/jobpoststyle.css') }}" rel="stylesheet">
    <div class="content-body">
        <div class="container">
            <div class="col-xl-11 col-lg-11">
                @foreach ($pipelinecandidate as $key => $pipelinecandidates)
                    <div class="card">
                        <div class="card-header d-sm-flex d-block pb-0 border-0">
                            <div>
                                <h3 class="fs-20 text-black"><img src="{{ url('logo/Indeed.png') }}" />
                                    {{ $pipelinecandidate->name }}</h3>Created
                                Date:<small>{{ \Carbon\Carbon::parse($pipelinecandidate->created_at)->format('j F, Y') }}</small>
                            </div>
                            <div style="font-size:16px;color:#EB8153;font-weight:600;">Creater
                                name:
                                <span style="float: rigth; color:green;">444</span>
                            </div>


                            <div class="dropdown">
                                <button type="button" class="btn btn-success light sharp" data-bs-toggle="dropdown">
                                    <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <circle fill="#000000" cx="5" cy="12" r="2" />
                                            <circle fill="#000000" cx="12" cy="12" r="2" />
                                            <circle fill="#000000" cx="19" cy="12" r="2" />
                                        </g>
                                    </svg>
                                </button>
                                <a href="{{ url('pipeline-bird/' . $pipelinecandidate->id) }}"
                                    class="btn btn-secondary mb-2">+ Pipeline</a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="">Edit</a>
                                    <a class="dropdown-item" href="">Delete</a>
                                </div>
                            </div>
                        </div>
                        <div class="row ms-3" style="font-family: Arial, Helvetica, sans-serif; font-weight:bold;">
                            <div class="col-sm-2" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">Portal</span>-18</div>
                            <div class="col-sm-1" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">X</span>-18</div>
                            <div class="col-sm-2" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">reject</span>-01</div>
                            <div class="col-sm-2" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">Job Code:</span>
                            </div>
                            <div class="col-sm-2" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">Openings:</span>
                            </div>
                            <div class="col-sm-3" style="color:green; font-size:16px;"><span
                                    style="color:#EB8153;font-weight:700; font-size:16px;">
                                    Location:</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <hr style="border:1px solid #EB8153;">
                            <div class="row fs-15 text-black">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;jora</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Google</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Times Jobs</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Whatsjob India</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Shine</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Linkedin</div>
                            </div>
                            <div class="row fs-15 text-black" style="margin-top: 13px">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Career Jet</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Adzuna India</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Jooble</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Monster</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Indeed</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Post Job Free</div>
                            </div>
                            <div class="row fs-15 text-black" style="margin-top: 13px">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Dr Jobs</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Clickindia</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Times Jobs</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Naukri</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Facebook</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Job is Job</div>
                            </div>
                            <div class="row fs-15 text-black" style="margin-top: 16px">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Linkedin ATS</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;White Force</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Happiest</div>
                            </div>
                            <div style="font-size:16px;color:#EB8153;font-weight:600; margin-top:20px;">International
                                portal
                            </div>

                            <div class="row fs-15 text-black">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;CV Libaray</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Tanqeeb</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Job Vertise</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Times Ascent</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;WhatsJob USA</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;My Job Helper</div>
                            </div>
                            <div class="row fs-15 text-black" style="margin-top: 13px">
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Dr Jobs</div>
                                <div class="col-sm-2"><span class="circle">&#x1F5F8;</span>&nbsp;Adzuna USA</div>
                            </div>

                            <hr style="border:1px solid #EB8153;">
                            <div class="row pt-sm-5 pt-3 align-items-center">
                                Close-Date- | Manager- Amrit |
                                Status-

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
