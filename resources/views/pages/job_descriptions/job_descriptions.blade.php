@extends('master.master')
@section('title', 'Job Description Template')
@section('content')
<a href="{{ url('https://white-force.com/plus/tutorial/#jobtemplatediv') }}" target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12">
                    <div class="card col-12">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div class="col-3">
                                <h4>Job Description Template</h4>
                            </div>
                            <div class=" col-4 offset-2 ">
                                <div class="input-group search-area right d-lg-inline-flex d-none col-2">
                                    <input type="text" class="form-control" placeholder="Search job description" id="serch" value="{{ $serch }}">
                                    <span class="input-group-text"><i class="flaticon-381-search-2" id="serchIcon" style="cursor: pointer;"></i></span>
                                </div>
                            </div>
                            <div class="col-4 ">
                                <a href="{{ route('job_description.create') }}"><button class="btn btn-primary">Add Job Description Template</button></a>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach($job_descriptions as $key => $value)
                <div class="col-xl-12 col-lg-12">
                    <div class="card project-card">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="dz-media ">
                                    <h6>S.No</h6>
                                    <h3>{{++$key}}</h3>
                                </div>
                                <div class="me-auto">
                                    <p class="text-primary mb-1">Role</p>
                                    <h5 class="title font-w600 mb-2 text-black">{{$value->role}}</h5>
                                </div>
                                <div class="me-auto">
                                    <p class="text-primary mb-1">Min Experience</p>
                                    <h5 class="title font-w600 mb-2 text-black">{{$value->min_exp}}</h5>
                                </div>
                                <div class="me-auto">
                                    <p class="text-primary mb-1">Max Experience</p>
                                    <h5 class="title font-w600 mb-2 text-black">{{$value->max_exp}}</h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <a href="{{ route('job_description.edit', $value->id) }}"><span class="badge badge-success d-sm-inline-block d-none">Edit</span></a>
                                        @if($currentUser=="Admin")
                                        <form action="{{ route('job_description.show',$value->id) }}" method="post" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="badge badge-danger d-sm-inline-block d-none" type="submit">Delete</button>
                                        </form>
                                        @else
                                        <span class="badge badge-info d-sm-inline-block d-none">Only Admin can delete</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h4>Description</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p>{!! $value->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <script>
       var serch=document.querySelector('#serch');
       var serchIcon=document.querySelector('#serchIcon');
        serchIcon.addEventListener('click',()=>{
            var value=serch.value;
            var url="{{ url('job_description') }}?serch="+value;
            window.open(url,"_self");
        });
    </script>
@endsection
