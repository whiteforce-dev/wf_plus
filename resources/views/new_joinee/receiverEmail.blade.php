@extends('master.master')
@section('title', 'New Joinee List')
@section('content')

<style>
    th {
        color: black !important;
    }

    .csmall {
        color: #0024cb;
        font-size: 10px;
        font-weight: 500;
    }

    .text-dark {
        color: black !important;
        font-weight: 500;
    }

    .monthlyTarget,
    .totalTarget,
    .complateTarget,
    .leftTarget {
        font-weight: 600;
        font-size: 18px;
        color: #653b3b;
    }

    /* th,
    tr {
        text-align: center;
    } */

    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: var(--bs-table-striped-bg);
        color: initial;
    }

    .table-striped>tbody>tr:nth-of-type(even)>* {
        --bs-table-accent-bg: white !important;
        color: initial;
    }

    button.btn.btn-danger,
    button.btn.btn-warning,
    button.btn.btn-success,
    button.btn.btn-info {
        font-size: 17px;
        font-weight: 600;
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="card col-12">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="col-12">
                        <h4>Receiver Email Id List View</h4>
                        @if(Auth::user()->software_category == 'offrole')
                        @php
                        if(Auth::user()->type == 'admin') {
                            $email= App\Models\MailDetail::where('software_category',Auth::user()->software_category)->get();
                            $email_count= $email->count();
                        } else {
                            $uid=Auth::user()->id;
                            $email_count= App\Models\JoiningDetail::where(['sender_id'=> $uid ,'software_category' => Auth::user()->software_category ])->count();
                        }
                        @endphp
                        <div style= "margin-left: 935px;
                        margin-top: -34px;"
                    >
                            <a  href="{{ url('join') }}" style="margin-right:7px!important;"> <button type="button" class="btn btn-primary" style="padding: 7px !important;"><b style="font-size:14px !important;"> Send Joining Form - {{ $email_count ?? '' }}</b></button></a>
                      
                        
                            {{-- <a  href="{{ url('newjoinee') }}" style="margin-right:50px !important;"> <button type="button" class="btn btn-success"><b style="font-size:14px !important;">New Joinee Details -</b>&nbsp;&nbsp;<span style="font-size:14px !important;"><b style="color:rgb(255, 255, 255)">{{ $nj_count }}</b></span></button></a>          --}}
                       </div>
                       @endif
                    </div>
                    {{-- <div class="col-2 offset-1">
                        <span class="btn bgl-info text-dark  status-btn me-3" style="width:100px"><b></b></span>
                    </div> --}}
                    {{-- <div class="col-2  ">
                        <a href="{{ route('hr.create') }}"><button class="btn btn-primary">Add HR </button></a>
                    </div> --}}
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                @if($nj_count==0) 
                <div class="card">
                    @include('master.404')
                </div>
                @else

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                              


                                    <tr align="center">
                                        <th>S.no</th>
    
                                        <th>Email Id</th>
                                        <th>Status</th> 

                                        {{-- <th>Name</th>
                                        <th>Father Name</th>
                                       
                                        <th>dob</th>
                                        <th>Action</th>
                                        <th>Status</th> --}}
                                    </tr>
                                    {{-- <th>S.No.</th>
                                    <th>CLIENT NAME</th>
                                    <th>HR NAME</th>
                                    <th>EMAIL</th>
                                    <th>DATE OF BIRTH</th>
                                    <th>ACTION</th> --}}
                                
                            </thead>
                            <tbody>
                                @foreach ($nj as $key => $pt)
                                <tr align="center">
                                    <td>
                                        <div>
                                            <h6>{{ ++$key }}.</h6>
                                        </div>
                                    </td>
                                    <td>
                                       <h6>{{ $pt->emailid }}</h6>
                                    </td>
                     @php 
                     $joindetails = App\Models\Joiningdetail::where('emailid',$pt->emailid)->first();
  
                    @endphp
                                    <td>
                                        @if($joindetails->name != null)
                                        <div>
                                          <a href= {{ url('newjoinee') }}><button class= 'btn btn-primary'> Show joining details </button></a>
                                        </div>
                                        @else
                                        <div>
                                            <span style ="color:red">No details found</span>
                                        </div>
                                        @endif
                                    </td>

                                    <td>
                                        <div>
                                            {{-- <h6>{{ $pt->fathername }}</h6> --}}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            {{-- <h6 class="text-primary">{{ $pt->dob }}</h6> --}}
                                        </div>
                                    </td>


                                    <td>
                                        {{-- <div class=" action-button">
                                            <a href="{{ url("newjoineefulldetail/$pt->id") }}"><button
                                                class="btn btn-primary btn-sm"><b style="font-size:13px;">View Full
                                                    Detail</b></button></a>
                                          
                                            @if ($pt->is_approved == 0)
                                                <td><button id="{{ $pt->id }}"
                                                            class="btn btn-primary btn-sm"
                                                            style="background-color:rgb(116, 26, 11) !important"
                                                            id='from1'onclick="confirmFun({{ $pt->id }});"><b
                                                                style="font-size:13px;">Approve</b></button></button></td>
                                                </td>
                                            @else
                                                <td><button id="{{ $pt->id }}"
                                                            class="btn btn-primary btn-sm"
                                                            style="background-color:green !important" id='from1'
                                                            onclick="confirmFun({{ $pt->id }});"><b
                                                                style="font-size:13px;">Approved</b></button></button></td>
                                                </td>
                                            @endif
                                        </div> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    function confirmFun(userId) {
        const id = userId;
        const url = `{{ url('candidateapproval/${id}') }}`
        if (confirm("Are you sure to change this?")) {
            location.href = url;
        } else {
            return false;
        }
    }
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
