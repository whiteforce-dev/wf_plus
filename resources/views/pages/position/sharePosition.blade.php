@extends('master.master')
@section('title', 'Team Section')
@section('content')

    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>

    <div class="content-body">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Applied Candidates</h4>
                </div>


                <div class="container-fluid">
                    <!-- Add Project -->
                    <div class="modal fade" id="addProjectSidebar">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Create Project</h5>
                                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Project Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Deadline</label>
                                            <input type="date" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label class="text-black font-w500">Client Name</label>
                                            <input type="text" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-primary">CREATE</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="project-nav">


                    </div>
                    <form action="{{ url('position-shared-to') . '/' . $positionId }}" method="post">
                        @csrf
                        <div class="tab-content project-list-group" id="myTabContent">
                            @foreach ($sharePositionTo as $user)
                                <div class="card">
                                    <div class="project-info">
                                        <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                            <p class="text-primary mb-1">#EP-wf00{{ $user->id }}</p>
                                            <h5 class="title font-w600 mb-2"><a href="post-details.html"
                                                    class="text-black">{{ $user->name }}</a></h5>
                                            <div class="text-dark"><i class="far fa-calendar me-3"
                                                    aria-hidden="true"></i>{{ \Carbon\Carbon::parse($user->created_at)->format('j F, Y') }}
                                            </div>
                                        </div>
                                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="project-media">
                                                    <h5 class="mb-0 pt-1 font-w500 text-black">
                                                        {{ $user->email }}</h5>
                                                </div>
                                                <div class="ms-2">
                                                    <span>{{ $user->mobile }}</span>
                                                    <h5 class="mb-0 pt-1 font-w50 text-black">
                                                        {{ $user->current_title }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                                            <div class="d-flex align-items-center">
                                                <div class="ms-2">
                                                    <span>{{ $user->current_location }}</span>
                                                    <h5 class="mb-0 pt-1 font-w500 text-black">
                                                        {{ $user->gender }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                                            <div class="d-flex align-items-center">

                                                <div class="ms-2">
                                                    <span>select</span>
                                                    <h5 class="mb-0 pt-1 font-w500 text-black">
                                                        <input type="checkbox" name="shareposition[]"
                                                            value="{{ $user->id }}">
                                                        <input type="hidden" name="positionId"
                                                            value="{{ $positionId }}">
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <nav class="mt-5">
                                <ul class="pagination pagination-gutter pagination-primary no-bg">
                                    <li class="page-item page-indicator">
                                        <a class="page-link" href="javascript:void(0)">
                                            <i class="la la-angle-left"></i></a>
                                    </li>
                                    <li class="page-item "><a class="page-link" href="javascript:void(0)">1</a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="javascript:void(0)">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">3</a></li>
                                    <li class="page-item"><a class="page-link" href="javascript:void(0)">4</a></li>
                                    <li class="page-item page-indicator">
                                        <a class="page-link" href="javascript:void(0)">
                                            <i class="la la-angle-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
