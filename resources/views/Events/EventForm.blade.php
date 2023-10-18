@extends('master.master')
@section('title', 'Add Events')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Event Information</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ url('store-emp-event') }}" method="post" id="createClient"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Employee Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder=" Enter Name"
                                                name="name">
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Enter Manager Name</label>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" placeholder=" Enter Team"
                                                name="team">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label">Date</label>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="date" class="form-control" placeholder="select date"
                                                name="date">
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Birthday/Anniversary</label>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <div class="input-group ">
                                                <select class="default-select form-control wide" name="event">
                                                    <option value="">Select</option>
                                                    <option value="Happy Birthday">Happy Birthday</option>
                                                    <option value="Happy Anniversary">Happy Anniversary</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Select Image</label>
                                        <div class="col-sm-6">

                                            <div class="input-group ">
                                                <div class="form-file">
                                                    @include('cropper.cropper')
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row my-4">
                                        <div class="col-6 offset-3 d-block">
                                            <button class="btn btn-primary col-12 offset btn-block" type="submit">Submit
                                            </button>
                                        </div>
                                    </div>


                                </form>


                                
                                    <div class="card-header">
                                        <h4 class="card-title">Employees Data</h4>
                                    </div>
                                    <div class="card-body">
                                        @if (count($events))
                                            @foreach ($events as $event)
                                                <div class="tab-content project-list-group" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="navpills-1">
                                                        <div class="card">
                                                            <div class="project-info">
                                                                <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="project-media">
                                                                            <img src="{{ url($event->img) }}" alt="">
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <span>Name</span>
                                                                            <h5 class="mb-0 pt-1 font-w50 text-black">
                                                                                {{ $event->name }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-2 my-2 col-lg-6 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="power-ic">
                                                                            <div class="project-media">
                                                                                {{-- <img src="www.png" alt=""> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <span>Team</span>
                                                                            <h5 class="mb-0 pt-1 font-w500 text-black">
                                                                                {{ $event->team }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="project-media">
                                                                            @if ($event->event == 'Happy Birthday')
                                                                                <img src="{{ url('assets/hbd.avif') }}"
                                                                                    alt="">
                                                                            @else
                                                                                <img src="{{ url('assets/any.avif') }}"
                                                                                    alt="">
                                                                            @endif


                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <span>Event Name</span>
                                                                            <h5 class="mb-0 pt-1 font-w500 text-black">
                                                                                {{ $event->event }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                                                    <h5 class="title font-w600 mb-2"><a
                                                                            href="post-details.html"
                                                                            class="text-black">Date</a></h5>
                                                                    <div class="text-dark"><i class="far fa-calendar me-3"
                                                                            aria-hidden="true"></i>Birth-Date
                                                                        <b>{{ $event->date }}</b>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-1 my-2 col-lg-6 col-sm-6">
                                                                    <div class="d-flex project-status align-items-center">
                                                                        <span> </span>
                                                                        <div class="dropdown">
                                                                            <a href="javascript:void(0);"
                                                                                data-bs-toggle="dropdown"
                                                                                aria-expanded="false">
                                                                                <svg width="24" height="24"
                                                                                    viewBox="0 0 24 24" fill="none"
                                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                                    <path
                                                                                        d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z"
                                                                                        stroke="#575757" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"></path>
                                                                                    <path
                                                                                        d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z"
                                                                                        stroke="#575757" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"></path>
                                                                                    <path
                                                                                        d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z"
                                                                                        stroke="#575757" stroke-width="2"
                                                                                        stroke-linecap="round"
                                                                                        stroke-linejoin="round"></path>
                                                                                </svg>
                                                                            </a>
                                                                            <div class="dropdown-menu dropdown-menu-end">

                                                                                <a class="dropdown-item"
                                                                                    href="delete-event/{{ $event->id }}"><button
                                                                                        class="btn btn-danger">Delete</button></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            @include('master.404')
                                        @endif
                                    </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>

    <script>
        // form validation //
        $(document).ready(function($) {

            $("#createClient").validate({
                rules: {


                    name: 'required',
                    team: 'required',
                    date: 'required',
                    event: 'required'

                },
                messages: {


                    name: '*Please enter name',
                    team: '*Please mention team ',
                    date: '*Please select date ',
                    event: '*Please select any event type'

                },
                errorPlacement: function(error, element) {

                    error.insertBefore(element);

                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });
    </script>

@endsection
