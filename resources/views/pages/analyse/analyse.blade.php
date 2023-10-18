@extends('master.master')
@section('title', 'Analyse Job')
@section('content')


<style>
    .modal {
        /* position: fixed; top: 30% !important; */
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
        /* top: 30% !important; */
    }

    .welcome-text h1::after {
        background-image: url('https://glasssquid.io/assets/images/home/arrows-1.svg');
    }

    .underline-3.style-2.yellow:after {
        background-image: url('https://glasssquid.io/assets/images/home/arrows-1.svg');
    }

    .underline-3.style-2:after {
        background-image: url('https://glasssquid.io/assets/images/home/arrows-1.svg');
    }

    .underline-3:after {
        content: "";
        position: absolute;
        /* z-index: -1; */
        display: block;
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-position: bottom;
        left: 50%;
        bottom: -0.1em;
        width: 110%;
        height: 0.3em;
        transform: translateX(-50%);
    }

    .progress {
        height: 2rem !important;
        font-size: 1rem !important;
    }

    @keyframes hidePreloader {
        0% {
            width: 100%;
            height: 100%
        }

        100% {
            width: 0;
            height: 0
        }
    }

    /* body>div.preloader {
        position: fixed;
        background: #fff;
        width: 100%;
        height: 100%;
        z-index: 1071;
        opacity: 0;
        transition: opacity .5s ease;
        overflow: hidden;
        pointer-events: none;
        display: flex;
        align-items: center;
        justify-content: center
    }

    body:not(.loaded)>div.preloader {
        opacity: 1
    }

    body:not(.loaded) {
        overflow: hidden
    }

    body.loaded>div.preloader {
        animation: hidePreloader .5s linear .5s forwards
    } */

    .word {
        margin: auto;
        color: white;
        font: 700 normal 50px 'Fugaz One';
        /* font: 700 normal 50px 'Fugaz One'; font: 700 normal 50px 'Luckiest Guy'; */
        /* font: 700 normal 50px 'Kavoon'; */
        text-shadow: 5px 2px #222324, 2px 4px #222324, 3px 5px #222324;
        letter-spacing: 2px;
    }

    .hword {
        margin: auto;
        color: black;
        font: 500 normal 40px 'Secular One';
        /* text-shadow: 5px 2px #22232429, 2px 4px #22232436, 3px 5px #22232454; */
        letter-spacing: 2px;
    }

    .heading {
        margin: auto;
        color: black;
        font: 500 normal 30px 'Secular One';
        word-spacing: 2px;
        /* text-shadow: 5px 2px #22232429, 2px 4px #22232436, 3px 5px #22232454; */
    }

    .heading_custom {
        margin: auto;
        color: black;
        font: 400 normal 40px 'Fugaz One';
        /* text-shadow: 5px 2px #222324, 2px 4px #222324, 3px 5px #222324; */
        /* letter-spacing: 2px; */
    }

    .card {
        /* position: relative !important;
        margin-bottom: 30px !important;
        box-shadow: 0 0 1.25rem rgb(31 45 61 / 5%) !important; */
        /* background: #f5f5f5 !important; */
        /* border: 3px solid #1241ac08 !important; */
    }

    .line {
        border-top: 1px solid #00000012;
        margin-top: 15px;
        padding-top: 12px;
    }

    @-webkit-keyframes Gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @-moz-keyframes Gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    @keyframes Gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }

    .text {
        position: relative;
        top: 40%;
        left: 0;
        color: #000;
        width: 400px;
        margin: auto;
    }

    h1 {
        text-align: center;
    }

    .words-wrapper {
        display: inline-block;
        position: relative;
        text-align: center;
    }

    .words-wrapper b {
        opacity: 0;
        display: inline-block;
        position: absolute;
        white-space: nowrap;
        left: 0;
        top: 0;
        font-weight: 200;
    }

    .words-wrapper .is-visible {
        position: relative;
        opacity: 1;
        -webkit-animation: push-in 0.5s;
        -moz-animation: push-in 0.5s;
        animation: push-in 0.5s;
    }

    .words-wrapper .is-hidden {
        -webkit-animation: push-out 0.5s;
        -moz-animation: push-out 0.5s;
        animation: push-out 0.5s;
    }

    @-webkit-keyframes push-in {
        0% {
            opacity: 0;
            -webkit-transform: translateY(-100%);
        }

        70% {
            opacity: 1;
            -webkit-transform: translateY(10%);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
        }
    }

    @-moz-keyframes push-in {
        0% {
            opacity: 0;
            -moz-transform: translateY(-100%);
        }

        60% {
            opacity: 1;
            -moz-transform: translateY(10%);
        }

        100% {
            opacity: 1;
            -moz-transform: translateY(0);
        }
    }

    @keyframes push-in {
        0% {
            opacity: 0;
            -webkit-transform: translateY(-100%);
            -moz-transform: translateXY(-100%);
            -ms-transform: translateY(-100%);
            -o-transform: translateY(-100%);
            transform: translateY(-100%);
        }

        60% {
            opacity: 1;
            -webkit-transform: translateY(10%);
            -moz-transform: translateY(10%);
            -ms-transform: translateY(10%);
            -o-transform: translateY(10%);
            transform: translateY(10%);
        }

        100% {
            opacity: 1;
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            transform: translateY(0);
        }
    }

    @-webkit-keyframes push-out {
        0% {
            opacity: 1;
            -webkit-transform: translateY(0);
        }

        60% {
            opacity: 0;
            -webkit-transform: translateY(110%);
        }

        100% {
            opacity: 0;
            -webkit-transform: translateY(100%);
        }
    }

    @-moz-keyframes push-out {
        0% {
            opacity: 1;
            -moz-transform: translateY(0);
        }

        60% {
            opacity: 0;
            -moz-transform: translateY(110%);
        }

        100% {
            opacity: 0;
            -moz-transform: translateY(100%);
        }
    }

    @keyframes push-out {
        0% {
            opacity: 1;
            -webkit-transform: translateY(0);
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -o-transform: translateY(0);
            transform: translateY(0);
        }

        60% {
            opacity: 0;
            -webkit-transform: translateX(110%);
            -moz-transform: translateY(110%);
            -ms-transform: translateY(110%);
            -o-transform: translateY(110%);
            transform: translateY(110%);
        }

        100% {
            opacity: 0;
            -webkit-transform: translateY(100%);
            -moz-transform: translateY(100%);
            -ms-transform: translateY(100%);
            -o-transform: translateY(100%);
            transform: translateY(100%);
        }
    }

    .cword {
        font-size: 25px;
        text-transform: capitalize;
        letter-spacing: 1px;
    }

    .cspan {
        font-size: 25px !important;
        color: rgb(155 255 0) !important;
    }

    .navbar-dark .navbar-nav .nav-link {
        color: rgb(21 44 91) !important;
    }

    .footer-dark .footer-link,
    .footer-dark .list-unstyled li a,
    .footer-dark .nav .nav-item .nav-link {
        color: #010407 !important;
        opacity: 0.7 !important;
    }

    .words-wrapper-custom {
        display: inline-block;
        position: relative;
        text-align: center;
    }

    .words-wrapper-custom b {
        opacity: 1;
        display: inline-block;
        /* position: absolute; */
        white-space: nowrap;
        left: 0;
        top: 0;
        font-weight: 200;
    }

    .hero-section {
        padding-top: 70px;
        background-image: url('https://supersourcing.com/home/img/bg-square-grid.svg');
        position: relative;
    }

    .hero-section:before {
        content: '';
        position: absolute;
        width: 800px;
        height: 370px;
        right: -400px;
        top: -250px;
        background: linear-gradient(95.33deg, rgba(210, 107, 84, 0.4) 29.22%, rgba(43, 61, 224, 0.4) 64.92%);
        filter: blur(100px);
        transform: rotate(19.85deg);
    }

    .developer-slider-sec {
        position: relative;
        /* padding-top: 60px; */
    }

    .developer-slider-sec:before {
        /* content: ''; position: absolute; top: 30px; left: 16%; width: 70%; height: 300px; background: linear-gradient(180deg, rgba(46, 114, 255, 0.4) 0%, rgba(124, 241, 120, 0.4) 100%); filter: blur(100px); transform: rotate(2.62deg); */
        content: '';
        position: absolute;
        top: 30px;
        left: 16%;
        width: 70%;
        height: 300px;
        background: linear-gradient(180deg, rgb(46 114 255 / 24%) 0%, rgb(90 190 87 / 11%) 100%);
        filter: blur(100px);
        transform: rotate(2.62deg);
    }

    .hero-feature-points {
        margin-top: 5px;
        display: flex;
        justify-content: center;
        flex-wrap: wrap;
    }

    .hero-feature-points .points {
        margin: 5px 8px 8px 8px;
        display: flex;
        align-items: center;
    }

    .line-height-24 {
        line-height: 24px !important;
    }

    .fw-500 {
        font-weight: 500 !important;
    }

    .fs-16 {
        font-size: 16px !important;
        /* font-size: 20px !important; */
        opacity: 0.8;
    }

    .ms-0 {
        margin-left: 0 !important;
    }

    .d-inline-block {
        display: inline-block !important;
    }
</style>

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-sm-12 box-wrap">
              
                <div class="welcome-text" align="left" style="margin-left: 6%;">
                    <h4>
                        Resume - <b style="color: #a15939;">Job Description Matching</b> 
                        <br>
                        <small style="font-size: 12px;">Matching With AI</a></small>
                    </h4>
                </div>
                <div class="container position-relative">
                    <div class="card shadow-lg floating-sm border-0 zindex-100">
                        <div class="card-body px-5 py-5 text-center text-md-left">
                            <form id="data" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-5">
                                        <div style="border: 1px dashed #ffb9b9;
                                    padding: 30px;">
                                            <h4 class="h5" style="margin-bottom: 0px !important;">Select Resume</h4>
                                            <small>Please choose resume file from your system</small> <input type="file"
                                                style="display: none;" name="resume" id="resume_file" accept=".pdf">
                                            <p></p> <a href="javascript:void(0)" id="resume_button"
                                                class="btn btn-primary btn-icon rounded-pill"> <span
                                                    class="btn-inner--text">Select File</span></a>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div style="border: 1px dashed #ffb9b9;
                                    padding: 30px;">
                                            <h4 class="h5" style="margin-bottom: 0px !important;">Select Job Description
                                            </h4> <small>Please choose job description from your system</small> <input
                                                type="file" style="display: none;" name="jd" id="jd_file" accept=".pdf">
                                            <p></p> <a href="javascript:void(0)" id="jd_button"
                                                class="btn btn-primary btn-icon rounded-pill"> <span
                                                    class="btn-inner--text">Select File</span></a>
                                        </div>
                                        {{-- <div id="jd-file-preview"> </div> --}}
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="#" onclick="clickFromSubmit();">
                                            <div style="background: #eb8153;
                                    color: white;
                                    font-weight: 500;
                                    position: absolute;
                                    width: 130px;
                                    height: 100%;
                                    top: 0px;
                                    right: 0;
                                    border-top-right-radius: 5px;
                                    border-bottom-right-radius: 5px;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    cursor: pointer;
                                    font-size: 22px;
                                    ">
                                    
                                                Match &nbsp;<i data-feather="arrow-right"></i></div>
                                        </a>
                                    </div>
                                </div>
                                <input style="display: none;" type="submit" id="submit_matching_form" value="submit">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div id="resume-matching-result">

        </div>
    </div>
</div>

<div class="modal fade" id="loadingModel" data-keyboard="false" data-backdrop="static" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 12% !important;" >
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body"> 
                @include('pages.analyse.loader')
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
<script>
    
    


     var i = 0; 
    $('#resume_button').click(function() {
    $('#resume_file').click();
    });
    $('#resume_file').change(function() {
        showResumeFile();
    });
    const selectResume = () => {
        $('#resume_file').click();
    }
    $('#jd_button').click(function() {
        $('#jd_file').click();
    });
    const selectJD = () => {
        $('#jd_file').click();
    };
    $('#jd_file').change(function() {
        showJdFile();
    });

    const showResumeFile = () => {
        var name = $('#resume_file').val().split('\\').pop();
        $('#resume_button').removeClass('btn-primary');
        $('#resume_button').addClass('btn-warning');
        $('#resume_button').html(name+' selected');
        $('#resume-file-preview').html(` <div class="col-sm-8 mt-4 p-2" style="background: #fff !important;" align="center"> <img src="https://img.icons8.com/color/48/null/pdf-2--v1.png"/> <br> <span class="h6" id="resume-file-name">` + name + `</span> <a onclick="selectResume()" style="cursor:pointer;"><p class="text-sm text-muted mb-0">click to change</p></a> </div> `);
    };
    const showJdFile = () => {
        var name = $('#jd_file').val().split('\\').pop();
        $('#jd_button').removeClass('btn-primary');
        $('#jd_button').addClass('btn-warning');
        $('#jd_button').html(name+' selected');
        $('#jd-file-preview').html(` <div class="col-sm-8 mt-4 p-2" style="background: #fff !important;" align="center"> <img src="https://img.icons8.com/color/48/null/pdf-2--v1.png"/> <br> <span class="h6" id="jd-file-name">` + name + `</span> <a onclick="selectJD();" style="cursor:pointer;"><p class="text-sm text-muted mb-0">click to change</p></a> </div> `) ;
    }

    function clickFromSubmit() {
        var resume = $('#resume_file').val();
        var jd = $('#jd_file').val();
        if (!resume) return false;
        if (!jd) return false;
    
        $('#loadingModel').modal('show');
        
        $('#submit_matching_form').click();
        // makeProgress(); 
    }

    $("form#data").submit(function(e) {
        
        i = 0; 
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ url('get-match-result') }}",
            type: 'POST',
            data: formData,
            success: function(response) {
                i = 100;
                $("#parse-value").text(Math.round(i));
                $(".progress-bar").css("width", i + "%");
                $('#resume-matching-result').html(response.response);
                $('#loadingModel').modal('hide');
                $('html, body').animate({ scrollTop: $("#resume-matching-result").offset().top }, 1000);
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
    

   
    function makeProgress(){
         if (i < 98) {
             i = i + 0.35; $("#parse-value").text(Math.round(i)); 
             $(".progress-bar").css("width", i + "%"); } 
             setTimeout("makeProgress()", 100); 
    } 
    makeProgress(); 


        $(document).ready(function () {
            $('#loadingModel').modal({
                backdrop: 'static',
                keyboard: false
            })
    });


    </script>

@endsection