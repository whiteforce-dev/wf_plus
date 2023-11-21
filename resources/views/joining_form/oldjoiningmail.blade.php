{{-- @extends('master')
@section('title', 'Dashboard')
@section('content') --}}
<head><link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   

</head>
    <div class="main-content-wrap d-flex flex-column">
        <div class="main-header">
            <div class="d-flex align-items-center">
                <!-- Mega menu -->
                <div class="dropdown mega-menu d-none d-md-block">

                    <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
                        <div class="row m-0">

                        </div>
                    </div>
                </div>
                <!-- / Mega menu -->
                <div class="search-bar">
                    <input type="text" placeholder="Search">
                    <i class="search-icon text-muted i-Magnifi-Glass1"></i>
                </div>
                @if (Auth::user()->type == 'admin'|| Auth::user()->type=='tender_admin')
                    <a href="{{ url('adminclosepage') }}" target="_blank"><i class="fa fa-cog" aria-hidden="true"
                            style="right:88px; position: absolute;font-size: 17px;margin-top: -9px;"></i></a>
                           
                {{-- @endif --}}
            </div>
            <div style="margin: auto"></div>
            @include('admin.headmenus')
        </div><!-- ============ Body content start ============= -->
        <div class="main-content">
            {{-- <div class="breadcrumb">
                <h1 class="mr-2"><img style="height:40px;" src="https://happiestresume.com/public/images/company/white_force.png" alt="">hite-Force Hire </h1>
                <ul>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="{{ url('admin/log-reader') }}">Logs</a></li>
                </ul>
            </div> --}}
            {{-- @if (Auth::user()->type == 'admin' || Auth::user()->type == 'tender_admin' )  --}}
            <div>
               
               <a href="{{ url('home') }}"> <h1 class="mr-2" style="float:right !important;margin-top: -50px !important;font-size:20px !important;"><button class="btn btn-primary !important;"> Back</button> </h1></a>
               
            </div>
        {{-- @endif --}}
            <div class="separator-breadcrumb border-top"></div>
            <div class="row">
                <div class="col-sm-12">
                    <br>





                </div>
                <div class="mydiv col-sm-12" style="background: white">

<h3>Send Joining Form</h3><hr style="border:1px solid rgb(218, 120, 8) !important;">

<form action={{ url('sendjoiningform') }} method="post">
    @csrf

                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Email</b><span style="color:red">*</span><small style="font-size:14px">(Add multiple Email Id by pressing enter )</small></label>
                        <select class="form-control js-example-tokenizer"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > 
                        </select>
                        {{-- <input type='email'class='form-control'name='email[]'multiple> --}}
         
    
                    </div>
                    <div>
                        @error('email')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Company Name</b><span style="color:red">*</span></label>
                        {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                        {{-- </select> --}}
                        {{-- <input type='text'class='form-control'name='company'> --}}
                        <select class='form-control'name='company'>
                            <option>-Select Company-</option>
                            @foreach($clients as $client)
                            @if($client->client_name == 'OCTOPOLIS TECHNOLOGIES PRIVATE LIMITED')
                            <option value="{{$client->client_id  }}">Apna Club</option>
                            @else
                            <option value="{{ $client->client_id }}">{{ $client->client_name }}</option>
                            @endif
                            @endforeach
                        </select>
         
    
                    </div>
                    <div>
                        @error('company')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>
                    @if(Auth::user()->type=='tender_admin')
                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Company Type</b><span style="color:red">*</span></label>
                        {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                        {{-- </select> --}}
                        <select type='text'class='form-control'name='companytype'>
                            <option value="government">Government</option>
                            <option value="private">Private</option>
                        </select>
         
    
                    </div>
                    <div>
                        @error('companytype')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>
@endif
                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Job Location</b><span style="color:red">*</span></label>
                        {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                        {{-- </select> --}}
                        <input type='text'class='form-control'name='joblocation' required>
         
    
                    </div>
                    <div>
                        @error('joblocation')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>
                    @if(Auth::user()->type=='tender_admin')
                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Tender Name</b><span style="color:red">*</span></label>
                        {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                        {{-- </select> --}}
                        <input type='text'class='form-control'name='tendername'>
         
    
                    </div>
                    <div>
                        @error('tendername')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>

                    <div class="form-group col-md-12">
                   



                        <label><b style="font-size:16px">Tender Number</b><span style="color:red">*</span></label>
                        {{-- <select class="form-control"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > --}}
                        {{-- </select> --}}
                        <input type='text'class='form-control'name='tendernumber' required>
         
    
                    </div>
                    <div>
                        @error('tendernumber')
                        <span class="alert alert-danger">{{$message}}</span>
                            @enderror
                    </div>
                    @endif
            <br>
            
            
                            <div class='row' data-aos="zoom-in-up">
                                <div class="form-group col-md-12 ">
                                    <button class='btn btn-success' style=float:center>Send</button></a>
                                </div>
                            </div>
            
                        </form>
                </div>

            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
      <script>
        $(document).ready(function() {
            $('#js-example-basic-multiple').select2({
                tags:true
            });
        });
      </script>

      <script>
        $(".js-example-tokenizer").select2({
    tags: true,
    tokenSeparators: [',', ' ']
})
      </script>
      {{-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}

{{-- @endsection --}}

