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

    <!-- This code is use for color chooser, you can delete -->
    {{-- <div id="switch-color" class="color-switcher">
        <div class="open"><i class="fas fa-cog"></i></div>
        <h4>COLOR OPTION</h4>
        <ul>
            <li><a class="color-2" onclick="setActiveStyleSheet('color-2'); return false;" href="#"><i
                        class="fas fa-cog"></i></a> </li>
            <li><a class="color-3" onclick="setActiveStyleSheet('color-3'); return false;" href="#"><i
                        class="fas fa-cog"></i></a> </li>
            <li><a class="color-4" onclick="setActiveStyleSheet('color-4'); return false;" href="#"><i
                        class="fas fa-cog"></i></a> </li>
            <li><a class="color-5" onclick="setActiveStyleSheet('color-5'); return false;" href="#"><i
                        class="fas fa-cog"></i></a> </li>
        </ul>
    </div> --}}
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
                <span class="multisteps-form__progress-btn js-active" title="Experience"><i
                        class="far fa-user"></i><span>Experience</span></span>
                <span class="multisteps-form__progress-btn" title="Skills"><i class="far fa-user"></i><span>Skills
                    </span></span>
            </div>
        </div>

        {{-- /////////////////////////////////////////////////////////////// --}}

        <form class="multisteps-form__form w-75 order-1" action="{{ url('store-work-experience') }}"
            enctype="multipart/form-data" method="post"id="wizard">
            @csrf
            <div class="form-area position-relative">
                <!-- div 1 -->
                <div class="multisteps-form__panel js-active tab-1" data-animation="slideHorz">
                    <div class="wizard-forms">
                        <div class="inner pb-100 clearfix">
                            <div class="wizard-title text-center">

                                <h3 style="padding-left:134px;margin-top:-60px;">Tell us about your work experience</h3>
                                <div class="line line2"></div>

                            </div>
                            <div class="wizard-form-field">
                                <div class="row col-sm-12 a"style="margin-top:-62px;">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="oldcompname"style="font-size:18px"> Company Name</label>
                                            <input type="text" class="form-control" value="{{ session('work_experience')['oldcompname'] ?? old('olddesignation') }}"
                                                name="oldcompname" placeholder="Enter Company Name">
                                        </div>
                                        @error('oldcompname')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror


                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="olddesignation" style="font-size:18px">Designation </label>
                                            <input type="text" class="form-control" id="olddesignation"
                                                value="{{session('work_experience')['olddesignation'] ?? old('olddesignation') }}"placeholder="Enter Designation"
                                                name="olddesignation">
                                        </div>
                                        @error('olddesignation')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="startdate" style="font-size:18px">Start Date </label>
                                            <input type="date" class="form-control"
                                                placeholder="12-digit number"id="startdate"
                                                value="{{session('work_experience')['startdate'] ?? old('startdate')}}" name="startdate">
                                        </div>
                                        @error('startdate')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="enddate" style="font-size:18px">End Date </label>
                                            <input type="date" class="form-control"
                                                placeholder="12-digit number"id="enddate"
                                                value="{{session('work_experience')['enddate'] ?? old('enddate')}}" name="enddate">
                                        </div>
                                        @error('enddate')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="jd" style="font-size:18px">Job Description </label>
                                            <textarea class="form-control"placeholder=" Enter Job Description" id="jd" value="{{ old('jd') }}"
                                                name="jd">{{(session('work_experience')['jd']) ?? old('jd')}}</textarea>
                                        </div>
                                        @error('jd')
                                            <span class="alert alert-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>



                                <div class="wizard-form-input mb-60 mt-60">
                                    <div class="line line2"></div>
                                </div>



                                <div class="wizard-v3-progress" style="margin-bottom: -112px;">
                                    <span>4 to 5 step</span>
                                    <h3>79% to complete</h3>
                                    <div class="progress">
                                        <div class="progress-bar" style="width: 79%">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!-- /.inner -->
                            <div class="actions" style="margin-bottom:20px;">
                                <ul>
                                    {{-- <li><button type="" ><a href="{{ url('joining-form/bank-details') }}"><i class="fa fa-arrow-left"></i> BACK</a> </button></li> --}}
                                            <li><button type="submit">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                                </ul>
                            </div>
                            <div class="vector-img-one">
                                <img style="margin-left: -35px !important;margin-bottom:10px !important;"src="{{ url('joiningnew/img/vb5.png') }}"
                                    alt="">
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
</body>
</html>
