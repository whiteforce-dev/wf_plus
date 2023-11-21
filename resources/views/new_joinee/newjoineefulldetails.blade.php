@extends('master.master')
@section('title', 'New Joinee Full Details')
@section('content')
<style>
    .mydiv {
        background-color: #fff;
        padding: 20px 25px;
    }

    .form-control {
        font-size: 0.9rem;
        font-weight: 500;
        line-height: 1.5;
        display: block;
        width: 100%;
        height: calc(2.1rem + 2px);
        padding: 0.375rem 0.75rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        color: #2e384d;
        border: 1px solid #dce4ec;
        /* border-radius: 0.25rem; */
        background-color: #fff;
        background-clip: padding-box;
    }
</style>
<div class="main-content-wrap d-flex flex-column">
    
    <div class="main-content">
        {{-- <div class="breadcrumb"> --}}
            {{-- <h1 class="mr-2">Happy Hire </h1> --}}
            {{-- <ul>
                <li><a href="#">Dashboard</a></li>
                <li>New Joinee Details</li>
            </ul>
        </div> --}}
         {{-- <div>
            <a href="{{ url('newjoinee') }}"> <h1 class="mr-2" style="float:right !important;margin-top: -50px !important;font-size:20px !important;"><button class="btn btn-primary !important;"> Back</button> </h1></a>
            
        </div> --}}
        <div class="separator-breadcrumb border-top"></div>
        <div class="col-sm-12">
           
            <div class="row">
                <div class="col-sm-2" style="margin-top:90px;margin-left:150px;">
                    
                    <div class="card">
                        <div class="card-header" style="background-color:#ffffff ;color:#fff;text-align:center;">
                        
                    <img class="img-fluid img-circle" src="{{ url($nj->photo) }}" width="170px" height="170px" style="border-radius:0%">
                    <h4></h4>
                    {{-- <h4 style="padding-top:15px;"><u style="color:rgb(17, 17, 17)">{{ ucwords($nj->name) }}</u></h4> --}}
                        </div>
                        <div class="card-body">
            
                           
                                <div class="col-sm-12 ">
                                    <div class="description-block">
                                    <h5 class="description-text" style="font-size:18px;"><b>Birthday</b></h5>
                                        <span class="text-muted"style="font-size:16px;">{{ date('d-m-Y',strtotime($nj->dob))  }} </span>
                                        
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <hr>
                                <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="description-block">
                                    <h5 class="description-text"style="font-size:18px;"><b>Employee</b> </h5>
                                        <span class="text-muted"style="font-size:16px;"> {{ucwords($nj->name) }}</span>
                                        
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <hr>
                                <!-- /.col -->
                                <div class="col-sm-12">
                                    <div class="description-block">
                                    <h5 class="description-text"style="font-size:18px;"><b>Joining</b></h5>
                                        <span class="text-muted"style="font-size:16px;">{{ date('d-m-Y',strtotime($nj->dateofjoining)) }}</span>
                                        
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                           
                        </div>
                       
                    </div>
                    <br>
            
                    <div class="card">
                       
                        <div class="card-header" style="border-top:3px solid #3c8dbc;font-size:20px">About Me</div>
                        <div class="card-body">
                            <strong style="font-size:18px;"><i class="mdi mdi-email " style="color: #14BF71"></i> E-mail</strong>
            
                            <p class="text-muted" style="font-size:18px;">{{ strtolower($nj->emailid) }}</p>
            
                            <hr>
            {{-- 
                            <strong><i class="mdi mdi-map-marker " style="color: red"></i> Location</strong>
            
                            <p class="text-muted">{{ $nj->location ?? '-'}} </p>
            
                            <hr> --}}
            
                            <strong style="font-size:18px;"><i class="mdi mdi-note " style="color: #00C0EF;"></i> Address</strong>
            
                            <p style="font-size:18px;"> {{ ucwords($nj->address) }}</p>
                        </div>
                       
                    </div>
                </div> 
                <div class="col-sm-7" style="margin-top:90px;">
                    <div class="card">
                        <div class="card-header">
                            <h5 style="text-align:center;font-size:18px;"><u><b>Employee Full Details</b></u></h5>
                            @if ($nj->is_approved == 0)
                            {{-- {{ url("candidateapproval/$pt->id") }} --}}
                                <td><button id="{{ $nj->id }}"
                                            class="btn btn-primary btn-sm"
                                            style="background-color:rgb(116, 26, 11) !important"
                                            id='from1'onclick="confirmFun({{ $nj->id }});"><b
                                                style="font-size:13px;">Approve</b></button></button></td>
                                </td>
                            @else
                            {{-- {{ url("candidateapproval/$pt->id") }} --}}
                                <td><button id="{{ $nj->id }}"
                                            class="btn btn-primary btn-sm"
                                            style="background-color:green !important" id='from1'
                                            ><b
                                                style="font-size:13px;">Approved</b></button></td>
                                </td>
                            @endif
                        </div>
                        <div class="card-body">
                              <div class="row">
                                  
                         
                                <div class="table-responsive">
                                <table class="table ">
                                    <tbody>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">Basic Details </b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                             
                                        </tr>
                                        <tr>
                                            <td><b>Name</b></td>
                                            <td>{{ucwords ($nj->name) }}</td>
                                             <td><b>Father Name </b></td>
                                                <td>{{ ucwords($nj->fathername) }}</td>
                                        </tr>
                                        <tr>
                                            
                                           
                                            <td><b>Mother Name</b></td>
                                            <td>{{ ucwords($nj->mothername) }}</td>
                                            <td><b>Date of Birth</b></td>
                                            <td>{{ date('d-m-Y',strtotime($nj->dob)) }}</td>  
                                        </tr>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>{{ucwords ($nj->gender) }}</td>
                                            <td><b>Phone</b></td>
                                             <td>{{ $nj->mobileno }}</td> 
                                            
                                        </tr>
                                        <tr>
                                            
                                            <td><b>Marital Status</b> </td>
                                             <td>{{ ucwords($nj->marital_status) ?? '-'}}</td> 
                                             <td><b>Spouse Name </b></td> 
                                             <td>{{ $nj->spouse ?? '-'}}</td>
                                        </tr>
                                        <tr>
                                            
                                            <td><b>Tender Name</b> </td>
                                             <td>{{ ucwords($nj->tendername) ?? '-'}}</td> 
                                             <td><b>Tender Number </b></td> 
                                             <td>{{ $nj->tendernumber ?? '-'}}</td>
                                        </tr>
                                       
                                           <tr>
                                            <td><b>Company</b> </td>
                                           <td>{{ ucwords($client->client_name ?? '') }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Salary CTC(P.A)</b> </td>
                                            <td>{{ $nj->salary }}</td>
                                        </tr>
                                           <tr>
                                            <td><b>Company Type</b> </td>
                                           <td>{{ ucwords($nj->companytype) }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Job location</b> </td>
                                            <td>{{ $nj->joblocation }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Designation</b> </td>
                                           <td>{{ $nj->designation ?? '-'}}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>ESIC No.</b> </td>
                                            <td>{{ $nj->esic }}</td>
                                        </tr>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">Post Graduation </b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                             
                                        </tr>
                                        <tr>
                                            <td><b>Specialisation</b> </td>
                                           <td>{{ $nj->pgname ?? '-' }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>University</b> </td>
                                            <td>{{ ucwords($nj->postboard ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Year</b> </td>
                                           <td>{{ $nj->postyear ?? '-' }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Location</b> </td>
                                            <td>{{ ucwords($nj->postlocation ?? '-' )}}</td>
                                        </tr>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">Under Graduation </b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                             
                                        </tr>
                                        <tr >
                                            <td style="word-wrap: break-word !important;margin-top:0px;"><b>Specialization</b> </td>
                                           <td style="word-wrap: break-word !important;">
                                           {{ $nj->ugname ?? '-' }}
                                           </td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>University</b> </td>
                                            <td>{{ucwords( $nj->ugboard ?? '-')}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><b>Year</b> </td>
                                           <td>{{ $nj->ugyear ?? '-' }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Location</b> </td>
                                            <td>{{ucwords ($nj->uglocation ?? '-')}}</td>
                                        </tr>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">12<sup>th</sup> </b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                             
                                        </tr>
                                        <tr>
                                            <td><b>Stream</sup></b> </td>
                                           <td>{{ ucwords($nj->twelvname ?? '-') }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>University</b> </td>
                                            <td>{{ ucwords($nj->twelvboard ?? '-')}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><b>Year</b> </td>
                                           <td>{{ $nj->twelvyear ?? '-' }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Location</b> </td>
                                            <td>{{ $nj->twelvlocation ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">10<sup>th</sup> </b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                             
                                        </tr>
                                        <tr>
                                            <td><b>Subject</b> </td>
                                           <td>All</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>University</b> </td>
                                            <td>{{ ucwords($nj->tenthboard ?? '-' )}}</td>
                                        </tr>
                                      
                                        <tr>
                                            <td><b>Year</b> </td>
                                           <td>{{ $nj->tenthyear ?? '-' }}</td>
                                            {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                             <td><b>Location</b> </td>
                                            <td>{{ ucwords($nj->tenthlocation ?? '-') }}</td>
                                        </tr>
                                        <tr>
                                           
                                            <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">Bank & ID Details</b></td>
                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                        </tr>
                                        <tr><td><b>Bank</b> </td>
                                               <td>{{ucwords($nj->bankname  ?? '-')}}</td>
                                                {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                 <td><b>Account Number</b> </td>
                                                <td>{{ $nj->bankaccno ?? '-' }}</td>
                                            </tr> 
                                            <tr>
                                                <td><b>Bank Branch</b> </td>
                                               <td>{{ ucwords($nj->bankbranch  ?? '-') }}</td>
                                                {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                 <td><b>IFSC</b> </td>
                                                <td>{{ $nj->ifsc ?? '-' }}</td>
                                            </tr> 
                                            <tr>
                                                <td><b>Adhar Number</b> </td>
                                               <td>{{ $nj->aadharno ?? '-' }}</td>
                                                {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                 <td><b>PAN Number</b> </td>
                                                <td>{{ $nj->pan ?? '-' }}</td>
                                            </tr>
                                             <tr>
                                                <td><b>Adhar card </b> </td>
                                               <td> <img src="{{ url($nj->aadhar_url) }}" style="border-radius: 0%!important;height:143px; width:167px" height="200px" ></td>
                                                {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                 <td><b>PAN card</b> </td>
                                                 <td> <img src="{{ url($nj->pan_url) }}" style="border-radius: 0%!important;height:143px; width:167px" height="200px" ></td>
                                                </tr>
                                                <tr>
                                           
                                                    <td colspan="12" style="background-color:rgb(245, 244, 244);width:150%;font-size:15px;"><b style="font: 20px !important;">Work Experience</b></td>
                                                                            {{-- <td style="white-space: normal;">{{ $nj->address}}</td> --}}
                                                </tr> 
                                                <tr>
                                                    <td><b>Company </b> </td>
                                                   <td> {{  ucwords($nj->oldcompname ?? '-')}}</td>
                                                    {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                     <td><b>Designation</b> </td>
                                                     <td>{{  $nj->olddesignation ?? '-' }} </td>
                                                    </tr>
                                                <tr>
                                                    <td><b>Start Date </b> </td>
                                                   <td> {{  date('d-m-Y',strtotime( $nj->startdate ?? '-')) }}</td> 
                                                    {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                     <td><b>End Date</b> </td>
                                                     <td>{{  date('d-m-Y',strtotime( $nj->enddate ?? '-' ))}} </td>
                                                    </tr>
                                                <tr>
                                                    <td><b>Job Description </b> </td>
                                                   <td> {{  ucwords($nj->jd ?? '-')  }}</td> 
                                                    {{-- <td style="white-space: normal;">{{ $Details->local_address}}</td> --}}
                                                     <td><b>Skills</b> </td>
                                                     <td>{{  ucwords($nj->skill ?? '-') }} </td>
                                                    </tr>
                                        </tr>
                                    </tbody
                                    ></table>
                                   </div>
                                <!-- /.box-body -->
               
            
                            
                              </div>
                        </div></div>
                       
            
            </div>
        </div>
    </div>
</div>
</div>

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


@endsection