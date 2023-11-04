<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Joining form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('joiningnew/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('joiningnew/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ url('joiningnew/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ url('joiningnew/css/style.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ url('joiningnew/css/colors/switch.css') }}">
    <!-- Color Alternatives -->
    <link href="{{ url('joiningnew/css/colors/color-2.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-2">
    <link href="{{ url('joiningnew/css/colors/color-3.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-3">
    <link href="{{ url('joiningnew/css/colors/color-4.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-4">
    <link href="{{ url('joiningnew/css/colors/color-5.css') }}" rel="alternate stylesheet" type="text/css"
        title="color-5">

    <style>
        @media screen and (max-width: 1500px) {
            .wizard-form-field .wizard-form-input input {
                width: 100% !important;
            }
        }

        .form-group :hover {
            /* background-color: #aecbf0; */
            transform: scale(1.1);
        }

        .form-control {

            border: 2px solid #7186cf;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    {{-- @php
    $clientIP = request()->ip();
dd($clientIP);
@endphp --}}
    <div class="clearfix"></div>
    <div class="wrapper wizard d-flex clearfix multisteps-form position-relative">
        <div class="steps order-2 position-relative w-25">
            <div class="multisteps-form__progress">
                <span class="multisteps-form__progress-btn js-active" title="Personal information"><i
                        class="far fa-user"></i><span>Personal information</span></span>
                <span class="multisteps-form__progress-btn" title="Tax residency"><i
                        class="far fa-user"></i><span>Education Details</span></span>
                <span class="multisteps-form__progress-btn" title="Bank & ID Details"><i
                        class="far fa-user"></i><span>Bank & ID Details</span></span>
                <span class="multisteps-form__progress-btn" title="Experience"><i
                        class="far fa-user"></i><span>Experience</span></span>
                <span class="multisteps-form__progress-btn" title="Skills"><i class="far fa-user"></i><span>Skills
                    </span></span>
            </div>
        </div>
        <form class="multisteps-form__form w-75 order-1" action="{{ url('store-basic-details') }}"
            enctype="multipart/form-data" method="post"id="wizard">
            @csrf
            <div class="form-area position-relative">
                <!-- div 1 -->
                <div class="multisteps-form__panel js-active tab-1" data-animation="slideHorz">
                    <div class="wizard-forms">
                        <div class="inner pb-100 clearfix">
                            <div class="wizard-title text-center">
                                {{-- <h3>Please, enter your personal information</h3> --}}
                                <h3 style="padding-left:134px;margin-top:-60px;"> <i
                                        style="color:#7369b9!important"class="fas fa-info-circle text-primary fs-4 mt-n1 me-2 pe-1">
                                    </i> Enter your personal information</h3>
                                <div class="line line2"></div>
                                {{-- {{ URL::full() }} --}}
                                @php
                                    // dd($URL);
                                    // $decode = base64_decode($email);
                                    // dd( $decode);
                                @endphp
                                {{-- <p>has been a while. I would like to present you the project I work </p> --}}
                            </div>
                            <div class="wizard-photo-area">
                                <div class="wizard-photo-upload position-relative">
                                    <label for="files">Upload Image <span style="color:#ff0000;">*</span></label>
                                    <input name="photo"id="files" type='file' onchange="readURL(this);"
                                        style="display: none;">

                                    <div class="display-img text-center">
                                        @php
                                            $path = session('basic')['profile_url'] ?? 'joiningnew/img/pf1.png';
                                        @endphp
                                        <img id="profile-image" src="{{ url($path) }}" alt="your image" />
                                    </div>

                                </div>

                                {{-- <div class="photo-upload-text">has been a while. I would like to present you the project
                                    I work on a few
                                </div> --}}
                                @error('photo')
                                    <p style="color:#ff0000"> {{ $message }}</p>
                                @enderror
                            </div>

                            <div class="wizard-form-field">

                                <div class="row col-sm-12 a">

                                    <div class="row" style="align:center">
                                        <br>
                                        <div class="col-md-12">


                                            <input type="text" hidden class="form-control" name="type"
                                                value="{{ $type }}">
                                            <input type="text" hidden class="form-control" name="candidate_id"
                                                value="{{ $candidate_id }}">
                                            <input type="text" hidden class="form-control"
                                                name="candidate_recruiter_id" value="{{ $candidate_recruiter_id }}">

                                            <div class="form-group">
                                                <label for="inputComp" style="font-size:18px">Company Name <span
                                                        style="color:#ff0000;">*</span></label>
                                             
                                                <input type="text" name="company"class="form-control"
                                                    value="{{ $clients ?? '' }}" disabled>

                                                <input type="hidden" name="company"class="form-control"
                                                    value={{ $clients->client_id ?? '' }}>

                                            </div>
                                            @error('company')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>



                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputComptype" style="font-size:18px">Company Type <span
                                                        style="color:#ff0000;">*</span></label>
                                                <select name="companytype" value="" id="all_payroll_client_id"
                                                    onchange="payroll(this)"
                                                    class="form-control @error('company_type') is-invalid @enderror"
                                                    style="padding: 0px;">
                                                    <option value=""> Select Your Company Type</option>
                                                    <option value="government"
                                                        {{ $companytype == 'government' ? 'selected' : '' }}>Government
                                                        Company</option>
                                                    <option value="private"
                                                        {{ $companytype == 'private' ? 'selected' : '' }}>Private Company
                                                    </option>
                                                </select>
                                            </div>
                                            @error('companytype')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>




                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="inputtendernumber" hidden style="font-size:18px">Tender
                                                    Number</label>
                                                <input type="text" hidden name="tendernumber"
                                                    placeholder="Enter Tender Number"
                                                    class="form-control @error('tendernumber') is-invalid @enderror"
                                                    id="inputtendernumber"
                                                    value="{{ session('basic')['tendernumber'] ?? ($tendernumber ?? '') }}">
                                            </div>
                                            @error('tendernumber')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="inputtendername" hidden style="font-size:18px">Tender
                                                    Name</label>
                                                <input type="text" hidden name="tendername"
                                                    placeholder="Enter Tender Name"
                                                    class="form-control @error('tendername') is-invalid @enderror"
                                                    id="tendername"
                                                    value="{{ session('basic')['tendername'] ?? ($tendername ?? '') }}">
                                            </div>
                                            @error('tendername')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="inputname" style="font-size:18px">Name<span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" name="name" placeholder="e.g. Sam"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="inputname"
                                                    value="{{ session('basic')['name'] ?? old('name') }}">
                                            </div>
                                            @error('name')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="fname" style="font-size:18px">Father Name<span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="e.g. Smith"
                                                    class="form-control @error('fathername') is-invalid @enderror"
                                                    id="fname"name="fathername"
                                                    value="{{ session('basic')['fathername'] ?? old('fathername') }}">
                                            </div>
                                            @error('fathername')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="mname" style="font-size:18px">Mother Name<span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="e.g. Smith"
                                                    class="form-control @error('mothername') is-invalid @enderror"
                                                    id="mname"name="mothername"
                                                    value="{{ session('basic')['spouse'] ?? old('mothername') }}">
                                            </div>
                                            @error('mothername')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputdob" style="font-size:18px">Date Of Birth<span
                                                        style="color:#ff0000;">*</span> </label>
                                                <input type="date"
                                                    class="form-control @error('dob') is-invalid @enderror"
                                                    id="dob"
                                                    value="{{ session('basic')['dob'] ?? old('dob') }}"
                                                    name="dob">
                                            </div>
                                            @error('dob')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                <label for="gender" style="font-size:18px">Gender<span
                                                        style="color:#ff0000;">*</span></label>
                                                <select type="text"
                                                    class="form-control @error('gender') is-invalid @enderror"
                                                    id="inputLname"name="gender" value="">
                                                    <option value="">--- Select Gender ---</option>
                                                    <option value="Male"
                                                        {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                    <option value="Female"
                                                        {{ old('gender') == 'Female' ? 'selected' : '' }}>Female
                                                    </option>


                                                </select>
                                            </div>
                                            @error('gender')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">

                                                <label for="ms" style="font-size:18px">Marital_status<span
                                                        style="color:#ff0000;">*</span></label>
                                                <select type="text"
                                                    class="form-control @error('marital_status') is-invalid @enderror"
                                                    id="inputLname"name="marital_status" value="">
                                                    <option value="">--- Select Gender ---</option>
                                                    <option value="Unmarried"
                                                        {{ old('marital_status') == 'Unmarried' ? 'selected' : '' }}>
                                                        Unmarried</option>
                                                    <option value="Married"
                                                        {{ old('marital_status') == 'Married' ? 'selected' : '' }}>
                                                        Married</option>
                                                    <option value="Divorced"
                                                        {{ old('marital_status') == 'Divorced' ? 'selected' : '' }}>
                                                        Divorced</option>
                                                    <option value="Widow"
                                                        {{ old('marital_status') == 'Widow' ? 'selected' : '' }}>Widow
                                                    </option>


                                                </select>
                                            </div>
                                            @error('marital_status')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="spousename" style="font-size:18px">Spouse Name</label>
                                                <input type="text" placeholder="e.g. Smith" class="form-control "
                                                    id="spousename"name="spouse" id="spouse"
                                                    value="{{ session('basic')['spouse'] ?? old('spouse') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputEmail" style="font-size:18px">Email Id <span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="email" disabled placeholder="e.g. xyz@gmail.com"
                                                    class="form-control @error('emailid') is-invalid @enderror"
                                                    name="emailid" id="inputEmail"
                                                    value="{{ session('basic')['emailid'] ?? $email }}">
                                                <input type="email" hidden placeholder="e.g. xyz@gmail.com"
                                                    class="form-control @error('emailid') is-invalid @enderror"
                                                    name="emailid" id="inputEmail"
                                                    value="{{ session('basic')['emailid'] ?? $email }}">
                                            </div>
                                            @error('emailid')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="inputaddress" style="font-size:18px">Address <span
                                                        style="color:#ff0000;">*</span></label>
                                                <textarea placeholder="Enter Address" name="address"class="form-control @error('address') is-invalid @enderror"
                                                    id="inputaddress">{{ session('basic')['address'] ?? old('address') }}</textarea>
                                            </div>
                                            @error('address')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputcountry" style="font-size:18px">Country <span
                                                        style="color:#ff0000;">*</span></label>
                                                {{-- <input type="text" placeholder="Enter Country" onChange="getstate(this.value);"  name="country" id="country"class="form-control @error('country') is-invalid @enderror"
                                                     value="{{ (session('basic')['country']) ?? old('country') }}"> --}}
                                                <select type="text"
                                                    class="form-control @error('statelist') is-invalid @enderror"
                                                    onchange="getstate(this.value);" name="country" id="country">

                                                    <option value="">---Select---</option>
                                                    <option value="107">India</option>

                                                </select>
                                            </div>
                                            @error('country')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputstate" style="font-size:18px">State <span
                                                        style="color:#ff0000;">*</span></label>
                                                {{-- <input type="text" placeholder="Enter State" name="statelist" id="statelist" onChange="getcity(this.value);"class="form-control @error('state') is-invalid @enderror"
                                                     value="{{ (session('basic')['state']) ?? old('state') }}"> --}}
                                                <select type="text"
                                                    class="form-control @error('statelist') is-invalid @enderror"
                                                    id="statelist"name="statelist" onchange="getcity(this.value);">
                                                    <option value="">--- Select State ---</option>
                                                </select>
                                            </div>
                                            @error('state')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="inputcity" style="font-size:18px">City <span
                                                        style="color:#ff0000;">*</span></label>
                                                {{-- <input type="text"  placeholder="Enter City"  name="city" id="city"class="form-control @error('city') is-invalid @enderror"
                                                     value="{{ (session('basic')['city']) ?? old('city') }}"> --}}

                                                <select type="text"
                                                    class="form-control @error('city') is-invalid @enderror"
                                                    id="city"name="city" value="">
                                                    <option value="">--- Select City ---</option>
                                                </select>

                                            </div>
                                            @error('city')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputpincode" style="font-size:18px">Pin Code <span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="Enter Pin Code"
                                                    name="pincode"class="form-control @error('pincode') is-invalid @enderror"
                                                    id="inputpincode"
                                                    value="{{ session('basic')['pincode'] ?? old('pincode') }}">
                                            </div>
                                            @error('pincode')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputjoblocation" style="font-size:18px">Job Location
                                                    <span style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="Enter Job Location"
                                                    name="joblocation"class="form-control @error('pincode') is-invalid @enderror"
                                                    id="inputjoblocation"
                                                    value="{{ session('basic')['joblocation'] ?? $joblocation }}">
                                                <input type="hidden" placeholder="Enter Job Location"
                                                    name="joblocation"class="form-control @error('pincode') is-invalid @enderror"
                                                    id="inputjoblocation"
                                                    value="{{ session('basic')['joblocation'] ?? '' }}">
                                            </div>
                                            @error('joblocation')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mobile" style="font-size:18px">Mobile Number <span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="e.g. 9856852144"
                                                    class="form-control @error('mobileno') is-invalid @enderror"
                                                    id="mobile"value="{{ session('basic')['mobileno'] ?? old('mobileno') }}"
                                                    name="mobileno">
                                            </div>
                                            @error('mobileno')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="inputdoj" style="font-size:18px">Date Of Joining <span
                                                        style="color:#ff0000;">*</span></label>
                                                <input
                                                    type="date"class="form-control @error('dateofjoining') is-invalid @enderror"
                                                    id="doj"
                                                    value="{{ session('basic')['dateofjoining'] ?? old('dateofjoining') }}"
                                                    name="dateofjoining">
                                            </div>
                                            @error('dateofjoining')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="designation" style="font-size:18px">Designation <span
                                                        style="color:#ff0000;">*</span></label>
                                                <input type="text" placeholder="e.g. Web Developer"
                                                    class="form-control @error('designation') is-invalid @enderror"
                                                    id="designation"value="{{ session('basic')['designation'] ?? old('designation') }}"
                                                    name="designation">
                                            </div>
                                            @error('designation')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="salary" style="font-size:18px">Salary CTC (P.A) </label>
                                                <input type="text" placeholder="e.g. 800000" class="form-control "
                                                    id="salary"
                                                    value="{{ session('basic')['salary'] ?? old('salary') }}"
                                                    name="salary">
                                            </div>
                                            @error('salary')
                                                <p class="alert alert-danger">{{ $message }}</p>
                                            @enderror
                                        </div>


                                    </div>
                                </div>

                            </div>
                            <div class="wizard-v3-progress">
                                <span>1 to 5 step</span>
                                <h3>0% to complete</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 0%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.inner -->
                        <div class="vector-img-one">
                            <img src="{{ url('joiningnew/img/vb1.png') }}" alt="">
                        </div>
                        <div class="actions">
                            <ul>
                                <li><button type="submit">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
    <script src="{{ url('joiningnew/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ url('joiningnew/js/popper.min.js') }}"></script>
    <script src="{{ url('joiningnew/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('joiningnew/js/slick.min.js') }}"></script>
    <script src="{{ url('joiningnew/js/main.js') }}"></script>
    <script src="{{ url('joiningnew/js/switch.js') }}"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile-image')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        };
        $("#customFile").change(function() {
            filename = this.files[0].name
        });
    </script>
    <script>
        function run(hideTab, showTab) {
            if (hideTab < showTab) {
                var currentTab = 0;
                x = $("#tab-" + hideTab);
                y = $(x).find("input");
                for (i = 0; i < y.length; i++) {
                    if (y[i].value == "") {
                        $(y[i]).css("background", "#ffdddd");
                        return false;
                    }
                }

            }
        }
    </script>
    <script src=https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js></script>
    <script>
        function getstate(val) {
            // alert(val);
            $.ajax({
                type: "get",
                url: "{{ url('getstate') }}" + "/" + val,

                success: function(data) {
                    $("#statelist").html(data);
                }
            });
        }
    </script>
    <script>
        function getcity(val) {




            // alert(val);
            $.ajax({
                type: "get",
                url: "{{ url('getcity') }}" + "/" + val,
                // data:'statecode='+val,
                success: function(data) {
                    $("#city").html(data);
                }
            });
        }
    </script>
</body>

</html>
