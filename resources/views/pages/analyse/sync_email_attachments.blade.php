@extends('master.master')
@section('title', 'Sync Attachments')
@section('content')
<style>
    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: inline-block;
        width: 60px;
        height: 34px;
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 26px;
        width: 26px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #eb8153;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }
    form i {
        cursor: pointer;
        color:#eb8153;
        font-weight:bold;
    }
    .stepFont {
        font-weight: 900;
    }
</style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Sync Email Attachments</h4>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ url('sync_email_attachments') }}" method="post" id="createClient"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Select Account Type :</label>
                                        <div class="col-sm-6 row" style="margin-top:8px">
                                            <div class="col-sm-4">
                                                <input type="radio" name="account_type" id="account_type" value="gmail" {{(!empty($account_detail->account_type) && $account_detail->account_type == 'gmail') ? 'checked' : '' }} required><label for="gmail"><h6><b>&nbsp;Gmail</b></h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="radio" name="account_type" id="account_type" value="zoho" {{(!empty($account_detail->account_type) && $account_detail->account_type == 'zoho') ? 'checked' : '' }} required><label for="zoho"><h6><b>&nbsp;Zoho</b></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <label class="col-sm-3 col-form-label">Enter Email Address :</label>
                                        <div class="col-sm-6">
                                            <input type="email" name="email_address" id="email_address" class="form-control" value="{{!empty($account_detail->email_address) ? $account_detail->email_address : '' }}"  required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-sm-3 col-form-label">Enter App Password :</label>
                                        <div class="col-sm-6 mt-2 mt-sm-0">
                                            <input type="password" name="app_password" id="app_password" class="form-control" value="{{!empty($account_detail->app_password) ? $account_detail->app_password : '' }}" required>
                                            <a href="#" data-toggle="modal" data-target="#exampleModal"><b>Steps to create app password</b></a> 
                                            <span id="passwordIconDiv" style="float: right"><i class="fa fa-eye-slash float-right" id="togglePassword"></i></span><br><br>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <label class="col-sm-3 col-form-label">Want to save password for later use ?</label>
                                        <div class="col-sm-6">
                                            <span><b>No&nbsp;&nbsp;</b></span><label class="switch"><input type="checkbox" name="want_to_save" id="want_to_save" {{!empty($account_detail) ? 'checked' : '' }} value="1"><span class="slider"></span></label><span><b>&nbsp;&nbsp;Yes</b></span>
                                        </div>
                                    </div>
                                    <div class="row mt-4">
                                        <label class="col-sm-3 col-form-label">Select Date Range :</label>
                                        <div class="col-sm-3">
                                            <input type="date" name="from_date" id="from_date" class="form-control" placeholder="From date">
                                        </div>
                                        <div class="col-sm-3">
                                        <input type="date" name="to_date" id="to_date" class="form-control" placeholder="T date">
                                        </div>
                                    </div>
                                    <div class="row my-4">
                                        <div class="col-6 offset-3 d-block">
                                            <button class="btn btn-primary col-12 offset btn-block" type="submit">Sync Attachments
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <hr>
                                <div class="card-header">
                                        <h4 class="card-title">Sync Requests -</h4>
                                    </div>
                                    <div class="card-body">
                                        @if (count($sync_requests))
                                            @foreach ($sync_requests as $sync_request)
                                                <div class="tab-content project-list-group" id="myTabContent">
                                                    <div class="tab-pane fade active show" id="navpills-1">
                                                        <div class="card">
                                                            <div class="project-info">
                                                            <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                        <div class="ms-2">
                                                                            <span>Email Id</span>
                                                                            <h5 class="mb-0 pt-1 font-w50 text-black">
                                                                                {{ $sync_request->email }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-3 my-2 col-lg-4 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        
                                                                        <div class="ms-2">
                                                                            <span>Request Date Range</span>
                                                                            <h5 class="mb-0 pt-1 font-w50 text-black">
                                                                                {{ date('M d,Y',strtotime($sync_request->from_date)) }} &nbsp;&nbsp; To &nbsp;&nbsp; {{ date('M d,Y',strtotime($sync_request->to_date)) }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-3 my-2 col-lg-6 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="power-ic">
                                                                            <div class="project-media">
                                                                                {{-- <img src="www.png" alt=""> --}}
                                                                            </div>
                                                                        </div>
                                                                        <div class="ms-2">
                                                                            <span>Created At</span>
                                                                            <h5 class="mb-0 pt-1 font-w500 text-black">
                                                                            {{ date('M d,Y',strtotime($sync_request->created_at)) }}</h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xl-2 my-2 col-lg-4 col-sm-6">
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="ms-2">
                                                                            <span>Status</span>
                                                                            <h5 class="mb-0 pt-1 font-w500 text-black">
                                                                                @if($sync_request->status == 0)
                                                                                <span class="badge badge-info">Pending</span>
                                                                                @elseif($sync_request->status == 1)
                                                                                <span class="badge badge-success">Success</span>
                                                                                @elseif($sync_request->status == 2)
                                                                                <span class="badge badge-primary">In Queue</span>
                                                                                @elseif($sync_request->status == 3)
                                                                                <span class="badge badge-danger">Failed</span>
                                                                                @elseif($sync_request->status == 4)
                                                                                <span class="badge badge-secondary" style="background:#838383">Data Not Found</span>
                                                                                @endif
                                                                            </h5>
                                                                        </div>
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
                                                                                @if(!empty($sync_request->candidate_ids))
                                                                                <a class="dropdown-item"
                                                                                    href="{{ url('candidate?sync_request_id=').$sync_request->id }}" target="_blank">View Candidate</a>
                                                                                @else
                                                                                <a class="dropdown-item"
                                                                                    href="{{ url('delete_sync_request').'/'.$sync_request->id }}">Delete</a>
                                                                                @endif
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
    <!--Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel"><b>Steps To Create App Password</b></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="heading">Zoho-</h5>
                    <ul>
                        <li>Login to your zoho account.</li>
                        <li>In your mail dashbord from right corner click on <b class="stepFont">Settings</b>.</li>
                        <li>Now from left sidebar at the last you will found <b class="stepFont">Mail Accounts</b> option.</li>
                        <li>After clicking it you will find 5 option. Click on <b class="stepFont">IMAP</b>.</li>
                        <li>Scroll down little after that you will found one checkbox <b class="stepFont">IMAP Access</b>. </li>
                        <li>Select this checkbox and click on<b class="stepFont">Save</b>.</li>
                        <li>From top right corener click on <b class="stepFont">My Profile</b>.</li>
                        <li>Click on <b class="stepFont">My Account</b>.</li>
                        <li>From Left sidebar click on <b class="stepFont">Security</b> >> <b class="stepFont">App Passwords</b>.</li>
                        <li>Click on <b class="stepFont">Generate New Password</b>.</li>
                        <li>Enter any name of your choice (like "Sync attachment" etc).</li>
                        <li>Now you will find your App password. Just copy it and paste it in <b class="stepFont">App Password</b> feild in the form of software</li>
                        
                    </ul>
                    <h5 class="heading">Google-</h5>
                    <ul>
                        <li>Login to your google account.</li>
                        <li>Go to <b class="stepFont">Manage your Google Account</b>.</li>
                        <li>Select <b  class="stepFont">Security</b>.</li>
                        <li>Under <b class="stepFont">How you sign in to Google, </b>click on <b class="stepFont">2-Step Verification. </b>Scroll down to the end, select <b class="stepFont">App Passwords</b>. You may need to <b class="stepFont">Sign In</b>. If you don’t have this option, it might be because:
                        a. 2-Step Verification is not set up for your account.
                        b. 2-Step Verification is only set up for security keys.
                        c. Your account is through work, school, or other organization.
                        d. You turned on Advanced Protection.</li>
                        <li>At the bottom, choose <b class="stepFont">Select app</b> and choose the app you using and then <b class="stepFont">Select device</b class="stepFont"> and choose the device you’re using and then <b class="stepFont">Generate</b>.</li>
                        <li>Copy <b class="stepFont">App Password</b> and paste it in <b class="stepFont">App Password</b> feild in the form of software</li>
                        <li>Tap Done.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
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
    
        $(document).on("click","#passwordIconDiv",function(){
            var app_password = document.querySelector('#app_password');

            app_password.getAttribute('type') === 'password' ? app_password.setAttribute('type', 'text') : app_password.setAttribute('type', 'password');

            if (app_password.getAttribute('type') === 'text'){
                passwordIconDiv.innerHTML = '<i class="fa fa-eye-slash float-right"></i>';
            } else{
                passwordIconDiv.innerHTML = '<i class="fa fa-eye fa-fw float-right" aria-hidden="true"></i>';
            }
        })
</script>
@endsection
