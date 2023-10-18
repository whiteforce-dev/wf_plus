@extends('master.master')
@section('title', 'Dashboard')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card" style="height:350px;">
                            <div class="card-header">
                                <div class="col-7">
                                    <h4 class="card-title btn bgl-info text-black  status-btn me-3"
                                        style="display:inline">Candidates
                                        Found : <strong class="text-danger">42</strong>
                                    </h4>
                                </div>
                                <div class="col-5">
                                    <button class="btn btn-outline-danger">Uncheck all</button>
                                    <button class="btn btn-outline-success">Select All</button>
                                    <button class="btn btn-outline-dark">Send Mail</button>
                                    <button class="btn btn-outline-info ">View Mail Revert</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="DZ_W_TimeLine111" class="widget-timeline dz-scroll style-1 height400">
                                    <div class="row">
                                        <div class="col-4">
                                            <ul class="timeline col-12">
                                                <li>
                                                    <div class="timeline-badge primary "></div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong class="">Position</strong>
                                                        <h6 class="mb-0">Business Development Manager</h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge success">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Industry</strong>
                                                        <h6 class="mb-0">Education / Teaching / Training </h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge warning">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Education</strong>
                                                        <h6 class="mb-0">AnyGraduate</h6>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-3">
                                            <ul class="timeline col-12">
                                                <li>
                                                    <div class="timeline-badge info">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Experience</strong>
                                                        <h6 class="mb-0">1-4 years</h6>

                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge danger">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Location</strong>
                                                        <h6 class="mb-0">Bikaner Udaipur </h6>
                                                    </a>
                                                </li>
                                                <li>
                                                    <div class="timeline-badge dark">
                                                    </div>
                                                    <a class="timeline-panel text-muted" href="#">
                                                        <strong>Created By</strong>
                                                        <h6 class="mb-0">Admin</h6>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-5">
                                            <h4 class="mb-2">For Detailed Search of Candidates </h4>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required>
                                                        <label class="form-check-label text-black"
                                                            for="customCheckBox2">Preffered Location</label>
                                                    </div>
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required>
                                                        <label class="form-check-label text-black"
                                                            for="customCheckBox2">Current Location</label>
                                                    </div>
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required>
                                                        <label class="form-check-label text-black"
                                                            for="customCheckBox2">Experience</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required>
                                                        <label class="form-check-label text-black"
                                                            for="customCheckBox2">Education</label>
                                                    </div>
                                                    <div class="form-check custom-checkbox mb-3 checkbox-info">
                                                        <input type="checkbox" class="form-check-input"
                                                            id="customCheckBox2" required>
                                                        <label class="form-check-label text-black"
                                                            for="customCheckBox2">Indutry</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <button class="btn btn-primary btn-block">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-12">
                <div class="card project-card">
                    <div class="card-body">
                        <div class="d-flex mb-4 align-items-start">
                            <div class="dz-media me-3">

                                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="img-fluid"
                                    alt="">
                            </div>
                            <div class="me-auto">
                                <p class="text-primary mb-1"><input type="checkbox" name="" id=""
                                        style="display:inline;">&nbsp;<strong>Onrole</strong></p>
                                <h5 class="title font-w600 mb-2"><a href="post-details.html" class="text-black">Ritesh
                                        hooda</a></h5>
                                <span>{{ ucwords('email executive') }}</span>
                            </div>
                            <a href="javascript:void(0)"><span
                                    class="badge badge-secondary d-sm-inline-block d-none">Pipeline</span></a>&nbsp;
                            <a href="javascript:void(0)"><span
                                    class="badge badge-primary d-sm-inline-block d-none">History</span></a>&nbsp;
                            <a href="javascript:void(0)"><span
                                    class="badge badge-success d-sm-inline-block d-none">Details</span></a>&nbsp;
                            <a href="javascript:void(0)"><span class="badge badge-info d-sm-inline-block d-none">View
                                    Resume</span></a>

                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-3 mb-sm-0 mb-3 d-flex">
                                <div class="dt-icon bgl-info me-3">
                                    <strong><i class="flaticon-381-location text-black"
                                            style="font-size: larger;"></i></strong>
                                </div>
                                <div>
                                    <span>Pref. Location</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">Gautam Buddh Nagar</p>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <div class="dt-icon me-3 bgl-danger">

                                    <strong><i class="flaticon-381-location-4 text-black"
                                            style="font-size: larger;"></i></strong>
                                </div>
                                <div>
                                    <span>Current Location</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">Ghaziabad
                                    </p>
                                </div>

                            </div>
                            <div class="col-3">
                                <h6>Position
                                    <span class="pull-right">75%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-info progress-animated" style="width: 75%; height:6px;"
                                        role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Experience
                                    <span class="pull-right">75%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-secondary progress-animated"
                                        style="width: 75%; height:6px;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-sm-3 mb-sm-0 mb-3 d-flex">
                                <div class="dt-icon bgl-light me-3">

                                    <strong><i class="flaticon-381-send-2 text-black"></i></strong>
                                </div>
                                <div>
                                    <span>Email</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">kapil@whiteforce@gmail.com</p>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex">
                                <div class="dt-icon me-3 bgl-success">

                                    <strong><i class="flaticon-381-smartphone-4 text-black"></i></strong>
                                </div>
                                <div>
                                    <span>Mobile No</span>
                                    <p class="mb-0 pt-1 font-w500 text-black">8225911608
                                    </p>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Location
                                    <span class="pull-right">75%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-warning progress-animated"
                                        style="width: 75%; height:6px;" role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <h6>Industry
                                    <span class="pull-right">75%</span>
                                </h6>
                                <div class="progress ">
                                    <div class="progress-bar bg-success progress-animated"
                                        style="width: 75%; height:6px;" role="progressbar"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
