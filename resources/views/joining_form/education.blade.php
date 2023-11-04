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
                <span class="multisteps-form__progress-btn" title="Bank & ID Details"><i
                        class="far fa-user"></i><span>Bank & ID Details</span></span>
                <span class="multisteps-form__progress-btn" title="Experience"><i
                        class="far fa-user"></i><span>Experience</span></span>
                <span class="multisteps-form__progress-btn" title="Skills"><i class="far fa-user"></i><span>Skills
                    </span></span>
            </div>
        </div>
        <form class="multisteps-form__form w-75 order-1" action="{{ url('store-education') }}"
            enctype="multipart/form-data" method="post"id="wizard">
            @csrf
            <div class="form-area position-relative">
                <!-- div 1 -->
                <div class="multisteps-form__panel js-active tab-1" data-animation="slideHorz">
                    <div class="wizard-forms">
                        <div class="inner pb-100 clearfix">
                            <div class="wizard-title text-center">

                                <h3 style="padding-left:134px;margin-top:-69px;"> <i
                                        style="color:#7369b9!important"class="fas fa-graduation-cap text-primary fs-4 mt-n1 me-2 pe-1">
                                    </i> Enter your Educational information</h3>
                                <div class="line line2"></div>

                            </div>



                            <div class="wizard-form-field">
                                <div class="row col-sm-12 a"style="margin-top:-62px;">
                                    <div class="row" style="align:center;padding-bottom: 50px;">
                                        <p
                                            style="background-color:#2b3ca6;color:white;width:100%;text-align:center;font-weight: bold;font-size:20px"class="form-control">
                                            Post Graduation</p>
                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="pgname"
                                                    style="font-size:18px;padding-top: 20px;">Specialization</label>
                                                <select name="pgname" id="pgname" class="form-control"
                                                    style="padding:0px;" value="{{ session('education')['pgname'] ?? ''}}">
                                                    {{-- @php  
                                                    $degrees=\App\degrees::get();
                                                    
                                                    @endphp --}}
                                                    <option value="">Select Education</option>
                                                    @foreach ($degrees as $degree)
                                                        <option value="{{ $degree->degree_name }}"{{( session('education')['pgname'] ?? '') == $degree->degree_name ? 'selected' : '' }} >
                                                            {{ $degree->degree_name}}</option>
                                                    @endforeach
                                                   
                                                </select>
                                            </div>
                                            @error('pgname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="postboard"
                                                    style="font-size:18px;padding-top: 20px;">University/Board</label>
                                                <input type="text" placeholder="University/Board"
                                                    class="form-control" id="postboard"name="postboard"
                                                     value="{{ (session('education')['postboard'] ?? '') }}">
                                            </div>
                                            @error('postboard')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="postyear" style="font-size:18px">Year Of Passing</label>
                                                <input type="text" placeholder="Year Of Passing"
                                                    class="form-control" id="postyear"name="postyear"
                                                    value="{{ (session('education')['postyear']?? '') }}">
                                            </div>
                                            @error('postyear')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="postlocation" style="font-size:18px">Location </label>
                                                <input type="text" class="form-control" id="postlocation"
                                                value="{{ (session('education')['postlocation']) ?? '' }}" placeholder="Enter Location"
                                                    name="postlocation">
                                            </div>
                                            @error('postlocation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <p
                                            style="background-color:#2b3ca6;color:white;border-radius:5px;width:100%;text-align:center;font-weight: bold;font-size:19px"class="form-control">
                                            Graduation</p>

                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="ugname"
                                                    style="font-size:18px;padding-top: 20px;">Specialization</label>
                                                <select name="ugname" id="ugname" class="form-control"
                                                    style="padding:0px;" value="{{ old('ugname') }}">
                                                    <option value="">Select Education</option>
                                                    @foreach ($degrees as $degree)
                                                    <option value="{{ $degree->degree_name }}"{{ (session('education')['ugname'] ?? '')== $degree->degree_name ? 'selected' : '' }} >
                                                        {{ $degree->degree_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('ugname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="ugboard"
                                                    style="font-size:18px;padding-top: 20px;">University /
                                                    Board</label>
                                                <input type="text" placeholder="University/Board"
                                                    class="form-control" id="ugboard"name="ugboard"
                                                    value="{{ session('education')['ugboard'] ?? '' }}">
                                            </div>
                                            @error('ugboard')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="ugyear" style="font-size:18px">Year Of Passing</label>
                                                <input type="text" placeholder="Year Of Passing"
                                                    class="form-control" id="ugyear"name="ugyear"
                                                    value="{{ session('education')['ugyear'] ?? '' }}">
                                            </div>
                                            @error('ugyear')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="uglocation" style="font-size:18px">Location </label>
                                                <input type="text" class="form-control" id="uglocation"
                                                    placeholder="Enter Location"  value="{{ session('education')['uglocation'] ?? ''}}"
                                                    name="uglocation">
                                            </div>
                                            @error('uglocation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <p
                                            style="background-color:#2b3ca6;color:white;width:100%;text-align:center;font-weight: bold;font-size:20px"class="form-control">
                                            XII<sup>th</sup></p>
                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="twelvname"
                                                    style="font-size:18px;padding-top: 20px;">Stream</label>
                                                <input type="text" name="twelvname"
                                                    placeholder="Mathematics/Biology/Arts" class="form-control"
                                                    id="twelvname"  value="{{ session('education')['twelvname'] ?? ''}}">
                                            </div>
                                            @error('twelvname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="twelvboard"
                                                    style="font-size:18px;padding-top: 20px;">University/Board</label>
                                                <input type="text" placeholder="University/Board"
                                                    class="form-control" id="twelvboard"name="twelvboard"
                                                    value="{{ session('education')['twelvboard'] ?? ''}}">
                                            </div>
                                            @error('twelvboard')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="twelvyear" style="font-size:18px">Year Of Passing</label>
                                                <input type="text" placeholder="Enter year of passing"
                                                    class="form-control" id="postyear"name="twelvyear"
                                                    value="{{ session('education')['twelvyear'] ?? '' }}">
                                            </div>
                                            @error('twelvyear')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="twelvlocation" style="font-size:18px">Location </label>
                                                <input type="text" class="form-control" id="twelvlocation"
                                                value="{{ session('education')['twelvlocation'] ?? '' }}"placeholder="Enter Location"
                                                    name="twelvlocation">
                                            </div>
                                            @error('twelvlocation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <p
                                            style="background-color:#2b37a5;color:white;border-radius:5px;width:100%;text-align:center;font-weight: bold;font-size:19px"class="form-control">
                                            X<sup>th</sup></p>

                                        <div class=" col-sm-6">
                                            <div class="form-group">
                                                <label for="tenthname"
                                                    style="font-size:18px;padding-top: 20px;">Specialization</label>
                                                <input type="text" name="tenthname" class="form-control"
                                                    id="tenthname" value="All Subject" >
                                            </div>
                                            @error('tenthname')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tenthboard"
                                                    style="font-size:18px;padding-top: 20px;">University/Board</label>
                                                <input type="text" placeholder="University/Board"
                                                    class="form-control" id="tenthboard"name="tenthboard"
                                                    value="{{ session('education')['tenthboard'] ?? ''}}">
                                            </div>
                                            @error('tenthboard')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="tenthyear" style="font-size:18px">Year Of Passing</label>
                                                <input type="text" placeholder="Enter year of passing"
                                                    class="form-control" id="tenthyear"name="tenthyear"
                                                    value="{{ session('education')['tenthyear'] ?? ''}}">
                                            </div>
                                            @error('tenthyear')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tenthlocation" style="font-size:18px">Location </label>
                                                <input type="text" class="form-control" id="tenthlocation"
                                                    placeholder="Enter Location"  value="{{ session('education')['tenthlocation'] ?? ''}}"
                                                    name="tenthlocation">
                                            </div>
                                            @error('tenthlocation')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="wizard-v3-progress">
                                <span>2 to 5 step</span>
                                <h3>38% to complete</h3>
                                <div class="progress">
                                    <div class="progress-bar" style="width: 38%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.inner -->
                        <div class="actions" style="margin-bottom:20px;">
                            <ul>
                               
                                
                                        <li><button type="submit">SUBMIT <i class="fa fa-arrow-right"></i></button></li>
                            </ul>
                            {{-- joining-form/basic-details --}}
                        </div>
                        <div class="vector-img-one">
                            <img src="{{ url('joiningnew/img/vb2.png') }}"width="68%" alt="">
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
