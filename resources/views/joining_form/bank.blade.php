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


    <div class="clearfix"></div>


    <div class="wrapper wizard d-flex clearfix multisteps-form position-relative">
        <div class="steps order-2 position-relative w-25">
            <div class="multisteps-form__progress">
                <span class="multisteps-form__progress-btn js-active" title="Personal information"><i
                        class="far fa-user"></i><span>Personal information</span></span>
                <span class="multisteps-form__progress-btn js-active" title="Tax residency"><i
                        class="far fa-user"></i><span>Education Details</span></span>
                <span class="multisteps-form__progress-btn js-active" title="Bank & ID Details"><i
                        class="far fa-user"></i><span>Bank & ID Details</span></span>
                <span class="multisteps-form__progress-btn" title="Experience"><i
                        class="far fa-user"></i><span>Experience</span></span>
                <span class="multisteps-form__progress-btn" title="Skills"><i class="far fa-user"></i><span>Skills
                    </span></span>
            </div>
        </div>
        <form class="multisteps-form__form w-75 order-1" action="{{ url('store-bank-details') }}"
            enctype="multipart/form-data" method="post"id="wizard">
            @csrf
            <div class="form-area position-relative">
                <!-- div 1 -->
                <div class="multisteps-form__panel js-active tab-1" data-animation="slideHorz">
                    <div class="wizard-forms">
                        <div class="inner pb-100 clearfix">
                            <div class="wizard-title text-center">

                                <h3 style="padding-left:134px;margin-top:-60px;">Enter your Bank and ID information</h3>
                                <div class="line line2"></div>

                            </div>



                            {{-- <div class="wizard-form-field">
                                   
                                      <div class="row col-sm-12 a"style="margin-top:-62px;"> --}}


                            <div class="wizard-form-field">
                                <div class="row col-sm-12 a"style="margin-top:-62px;">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bankname"style="font-size:18px">Bank Name<span
                                                    style="color:#ff0000;">*</span></label>
                                            <input type="text" class="form-control" value="{{session('bank_details')['bankname'] ?? old('bankname')}}"
                                                name="bankname" placeholder="Enter Bank Name">
                                            @error('bankname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bankbranch" style="font-size:18px">Bank Branch <span
                                                    style="color:#ff0000;">*</span></label>
                                            <input type="text" class="form-control" id="bankbranch"
                                                value="{{ session('bank_details')['bankbranch']  ?? old('bankbranch')}}"placeholder="Enter Bank Branch"
                                                name="bankbranch">
                                        </div>
                                        @error('bankbranch')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="bankaccno" style="font-size:18px">Account Number <span
                                                    style="color:#ff0000;">*</span></label>
                                            <input type="text" class="form-control"
                                                placeholder="12-digit number"id="bankaccno"
                                                value="{{ session('bank_details')['bankaccno'] ?? old('bankaccno') }}" name="bankaccno">
                                        </div>
                                        @error('bankaccno')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ifsc" style="font-size:18px">IFSC Code <span
                                                    style="color:#ff0000;">*</span></label>
                                            <input type="text" class="form-control"placeholder="SBIN0070695"
                                                id="ifsc" value="{{session('bank_details')['ifsc'] ?? old('ifsc')}}" name="ifsc">
                                        </div>
                                        @error('ifsc')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aadharno" style="font-size:18px">Aadhar Number <span
                                                    style="color:#ff0000;">*</span></label>
                                            <input type="text"
                                                name="aadharno"class="form-control"placeholder="12-digit number"
                                                id="aadharno" value="{{ session('bank_details')['aadharno'] ?? old('aadharno')}}">
                                        </div>
                                        @error('aadharno')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pan" style="font-size:18px">PAN<span
                                                    style="color:#ff0000;">*</span> </label>
                                            <input type="text" class="form-control" placeholder="BNZAA2318J"
                                                id="pan" value="{{ session('bank_details')['pan'] ?? old('pan')}}" name="pan">
                                        </div>
                                        @error('pan')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="esic" style="font-size:18px">ESIC No. </label>
                                            <input type="text" placeholder="10-digit number" class="form-control"
                                                id="esic" value="{{ session('bank_details')['esic'] ?? old('bankbranch')}}" name="esic">
                                        </div>
                                        @error('esic')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="aadhar_url" style="font-size:18px">Upload Adhar Card<span
                                                    style="color:#ff0000;">*<small>(jpeg/bmp/png/jpg format)</small></span></label>
                                            <input type='file' value="{{ session('bank_details')['aadhar_image'] ?? old('aadhar_image') }}"
                                                placeholder="Enter Aadhar Card" name='aadhar_url' id="files"
                                                class='form-control'onchange="readURL(this);"
                                        >
                                        </div>
                                        @php 
                                        $path= session('bank_details')['aadhar_image']  ?? 'joiningnew/img/adhar.jpeg';
                                        @endphp
                                        <div class="col-md-6">
                                        <img id="profile-image" src="{{ url($path) }}" height="50px" width="300px"
                                        alt="your image" />
                                    </div>
                                        @error('aadhar_url')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror



                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pan_url" style="font-size:18px">Upload PAN Card<span
                                                    style="color:#ff0000;">* <small>(jpeg/bmp/png/jpg format)</small></span> </label>
                                                   
                                            <input type='file' value="{{ session('bank_details')['pan_image'] ?? old('pan_image')}}"
                                                placeholder="Upload Pan card" name='pan_url' id="files"
                                                class='form-control'onchange="readURLs(this);">
                                        </div>
                                        @php 
                                        $path= session('bank_details')['pan_image']  ?? 'joiningnew/img/pan.jpeg';
                                        @endphp
                                     
                                        <img id="profile-imagesss" src="{{ url($path) }}" height="150px" width="150px"
                                        alt="your image" /><br>                                       
                                         
                                        @error('pan_url')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                         @enderror
                                      
                                    </div>
                                   
                                   



                                </div>

                            </div>
                            {{-- </div>
                                              
                                  </div> --}}
                            <div class="wizard-v3-progress" style="margin-bottom: -80px;">
                                <span>3 to 5 step</span>
                                <h3>59% to complete</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 59%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.inner -->
                        <div class="actions" style="margin-bottom:20px;">
                            <ul>
                               {{-- <li><button type="" ><a href="{{ url('joining-form/education') }}"><i class="fa fa-arrow-left"></i> BACK</a> </button></li> --}}
                                        <li><button type="submit">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                        </div>
                        <div class="vector-img-one">
                            <img src="{{ url('joiningnew/img/vb3.png') }}" alt="">
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
        // $("#customFile").change(function() {
        //     filename = this.files[0].name
        // });
    </script>
    
    <script>
        function readURLs(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile-imagesss')
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
    
</body>
</html>
