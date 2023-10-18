@extends('master.master')
@section('title', 'Job Posting Reports')
@section('content')

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Spline+Sans:wght@300;400;500;600;700&display=swap");



        :root {
            --c-white: #fff;
            --c-black: #000;
            --c-ash: #eaeef6;
            --c-charcoal: #a0a0a0;
            --c-void: #141b22;
            --c-fair-pink: #FFEDEC;
            --c-apricot: #FBC8BE;
            --c-coffee: #754D42;
            --c-del-rio: #917072;
            --c-java: #1FCAC5;
            --c-titan-white: #f1eeff;
            --c-cold-purple: #a69fd6;
            --c-indigo: #6558d3;
            --c-governor: #4133B7;
        }



        /* .cards {
                    display: flex;
                    flex-wrap: wrap;
                    align-items: flex-start;
                    flex-wrap: wrap;
                    justify-content: center;
                    gap: 2.5rem;
                    width: 90%;
                    max-width: 1000px;
                    margin: 10vh auto;
                }

                .card {
                    border-radius: 16px;
                    box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
                    max-width: 300px;
                } */

        .information {
            background-color: var(--c-white);
            padding: 1.5rem;
        }

        .information .tag {
            display: inline-block;
            background-color: var(--c-titan-white);
            color: var(--c-indigo);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5em 0.75em;
            line-height: 1;
            border-radius: 6px;
        }

        .information .tag+* {
            margin-top: 1rem;
        }

        .information .title {
            font-size: 1.5rem;
            color: var(--c-void);
            line-height: 1.25;
        }

        .information .title+* {
            margin-top: 1rem;
        }

        .information .info {
            color: var(--c-charcoal);
        }

        .information .info+* {
            margin-top: 1.25rem;
        }

        .information .button {
            font: inherit;
            line-height: 1;
            background-color: var(--c-white);
            border: 2px solid var(--c-indigo);
            color: var(--c-indigo);
            padding: 0.5em 1em;
            border-radius: 6px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.5rem;
        }

        .information .button:hover,
        .information .button:focus {
            background-color: var(--c-indigo);
            color: var(--c-white);
        }

        .information .details {
            display: flex;
            gap: 1rem;
        }

        .information .details div {
            padding: 0.75em 1em;
            background-color: var(--c-titan-white);
            border-radius: 8px;
            display: flex;
            flex-direction: column-reverse;
            gap: 0.125em;
            flex-basis: 50%;
        }

        .information .details dt {
            font-size: 0.875rem;
            font-weight: 400;
            color: var(--c-cold-purple);
        }

        .information .details dd {
            color: var(--c-indigo);
            font-weight: 600;
            font-size: 1.25rem;
        }

        .plan {
            padding: 10px;
            background-color: var(--c-white);
            color: var(--c-del-rio);
        }

        .plan strong {
            font-weight: 600;
            color: var(--c-coffee);
        }

        .plan .inner {
            padding: 20px;
            padding-top: 40px;
            background-color: var(--c-fair-pink);
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .plan .pricing {
            position: absolute;
            top: 0;
            right: 0;
            background-color: var(--c-apricot);
            border-radius: 99em 0 0 99em;
            display: flex;
            align-items: center;
            padding: 0.625em 0.75em;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--c-coffee);
        }

        .plan .pricing small {
            color: var(--c-del-rio);
            font-size: 0.75em;
            margin-left: 0.25em;
        }

        .plan .title {
            font-weight: 600;
            font-size: 1.25rem;
            color: var(--c-coffee);
        }

        .plan .title+* {
            margin-top: 0.75rem;
        }

        .plan .info+* {
            margin-top: 1rem;
        }

        .plan .features {
            display: flex;
            flex-direction: column;
        }

        .plan .features li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .plan .features li+* {
            margin-top: 0.75rem;
        }

        .plan .features .icon {
            background-color: var(--c-java);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--c-white);
            border-radius: 50%;
            width: 20px;
            height: 20px;
        }

        .plan .features .icon svg {
            width: 14px;
            height: 14px;
        }

        .plan .features+* {
            margin-top: 1.25rem;
        }

        .plan button {
            font: inherit;
            background-color: var(--c-indigo);
            border-radius: 6px;
            color: var(--c-white);
            font-weight: 500;
            font-size: 1.125rem;
            width: 100%;
            border: 0;
            padding: 1em;
        }

        .plan button:hover,
        .plan button:focus {
            background-color: var(--c-governor);
        }

        .img-fluid {
            max-width: 50%;
            height: auto;
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            align-items: flex-start;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2.5rem;
            width: 90%;
            max-width: 1000px;
            margin: 10vh auto;
        }

        .custom-card {
            border-radius: 16px;
            box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
            max-width: 300px;
        }
        .point{
            cursor: pointer;
        }
    </style>
    <a href="{{ url('https://white-force.com/plus/tutorial/#jobpostdiv') }}" target="_blank">
        <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
    </a>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12">
                    <div class="card col-12">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="col-2">
                                <h4>All Posted Jobs</h4>
                            </div>
                            <div class="col-3">
                                <div class="input-group ">
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="input-group ">
                                    <input type="date" class="form-control">
                                </div>
                            </div>
                            <div class=" col-3">
                                <select class="default-select form-control wide" name="created_by" id="created_by"
                                    onchange="">
                                    <option selected value="0">All Managers</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                @foreach($jobPortals as $portal)
                <div class="col-sm-3 p-2">
                    <div class="custom-card">
                        <article class="information [ card ]" align="center">
                            <h2 class="title"><img
                                    src="{{ $portal['logo'] }}"
                                    alt="" class="img-fluid rounded-squre"></h2>

                            <dl class="details">
                                <div>
                                    <dt>Positions</dt>
                                    <dd>{{ $portal['positions'] }}</dd>
                                </div>
                                <div class="point" onclick='getName("0","{{ $portal["name"] }}")'>
                                    <dt>Candidates</dt>
                                    <dd>{{ $portal['candidates'] }}</dd>
                                </div>
                            </dl>
                        </article>
                    </div>
                </div>
                @endforeach





                {{-- <div class="col-xl-6 col-xxl-6 col-lg-6">
                <div class="card mx-2">
                    <div class="card-body">
                        <div id="DZ_W_Todo1" class="widget-media height850">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/Clickindia40.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1 ">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3"onclick="getName('0','clickindia')"; ><b>Number Of Candidates : {{ $candidate_count["clickindia"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/shine90.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3"onclick="getName('0','shine')";><b>Number Of Candidates : {{ $candidate_count["shine"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/monster39.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','monster')";><b>Number Of Candidates : {{ $candidate_count["monster"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/naukri109.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','naukri')";><b>Number Of Candidates : {{ $candidate_count["naukri"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Indeed.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','indeed')";><b>Number Of Candidates : {{ $candidate_count["indeed"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/timesjob30.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','timesjob')";><b>Number Of Candidates : {{ $candidate_count["timesjob"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Linkedin1.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','linkedin')";><b>Number Of Candidates : {{ $candidate_count["linkedin"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="	http://127.0.0.1:8000/logo/Facebook.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','facebook')";><b>Number Of Candidates : {{ $candidate_count["facebook"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/JobIsJob.png
                                            " alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','job_is_job')";><b>Number Of Candidates :{{ $candidate_count["job_is_job"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Jora.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','jora')";><b>Number Of Candidates : {{ $candidate_count["jora"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-lg-6">
                <div class="card mx-2">
                    <div class="card-body">
                        <div id="DZ_W_Todo1" class="widget-media height850">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/PostJobFree.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','post_job_free')";><b>Number Of Candidates :{{ $candidate_count["post_job_free"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Careerjet.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','Careerjet')";><b>Number Of Candidates : {{ $candidate_count["Careerjet"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Jooble1.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','jooble')";><b>Number Of Candidates : {{ $candidate_count["jooble"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/Google5.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','google')";><b>Number Of Candidates : {{ $candidate_count["google"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/WhatJobs.png
                                            " alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','whatjobs')";><b>Number Of Candidates : {{ $candidate_count["whatjobs"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Dr1.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','dr_jobs')";><b>Number Of Candidates : {{ $candidate_count["dr_jobs"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Adzuna.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','adzuna')";><b>Number Of Candidates : {{ $candidate_count["adzuna"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/HappiestResume.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','happiest')";><b>Number Of Candidates : {{ $candidate_count["happiest"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/logo/whiteforce.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','whiteforce')";><b>Number Of Candidates : {{ $candidate_count["whiteforce"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/logo/logolinkedin1.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','linkedin_ats')";><b>Number Of Candidates : {{ $candidate_count["linkedin_ats"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="row page-titles mx-0">
                    <div class="col-sm-12 p-md-0">
                        <div class="text-center">
                            <h4 class="text-dark">Jobs In International Portals</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-lg-6">
                <div class="card mx-2">
                    <div class="card-body">
                        <div id="DZ_W_Todo1" class="widget-media height850">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/job_vertise2.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','job_vertise')";><b>Number Of Candidates : {{ $candidate_count["job_vertise"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="https://www.white-force.com/onrole/assets/img/logos/myjobhelper56.jpg" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','my_job_helper')";><b>Number Of Candidates : {{ $candidate_count["my_job_helper"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/WhatJobs.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','my_job_helper')";><b>Number Of Candidates :  not found</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Adzuna.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','my_job_helper')";><b>Number Of Candidates :  not found</b> </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-xxl-6 col-lg-6">
                <div class="card mx-2">
                    <div class="card-body">
                        <div id="DZ_W_Todo1" class="widget-media height850">
                            <ul class="timeline">
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/CVLibrary.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','my_job_helper')";><b>Number Of Candidates :  not found</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/ZipRecruiter.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','zip_recruiter')";><b>Number Of Candidates : {{ $candidate_count["zip_recruiter"] }}</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/TimeAscent.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','zip_recruiter')";><b>Number Of Candidates :  not found</b> </span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="timeline-panel">
                                        <div class=" me-3 media-success">
                                            <img src="http://127.0.0.1:8000/logo/Tanqeeb.png" alt="" class="img-fluid rounded-squre" width="100px">
                                        </div>
                                        <div class="media-body">
                                            <h5 class="mb-1">Number Of Posted Job : 5</h5>
                                            <span class="d-block btn bgl-primary text-dark  status-btn me-3" onclick="getName('0','zip_recruiter')";><b>Number Of Candidates : not found</b> </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div> --}}
            </div>
        </div>
    </div>
    <script>
        function getName(id, portal) {
            var url = 'all_responses/' + id + '/' + portal;
            window.open(url, "_self");
        }
    </script>
@endsection
