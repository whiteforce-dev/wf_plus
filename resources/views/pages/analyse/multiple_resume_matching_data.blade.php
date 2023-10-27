<style>
    .spaceInWords {
        word-spacing: 2px !important;
        color: #000000ce !important;
        font-weight: 500;
        text-transform: capitalize;
    }

    .missing {
        color: red !important;
        font-weight: 500 !important;
    }

    .matching {
        color: #578f01 !important;
        font-weight: 500 !important;
    }
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
                <div class="col-xl-10 col-lg-10 offset-1">
                    <div class="basic-form">
                    @foreach($resumes as $resume)
                    <div class="row row-grid align-items-center justify-content-between">
                        <div class="col-sm-12 col-sm-12 mx-md-auto order-lg-2">
                            <div class="card rounded-bottom-right">
                                <div class="card-body">

                                    <div class="card card-money border-0"
                                        style="background: linear-gradient(58deg, rgb(255 255 255) 0%, rgb(255 255 255 / 86%) 0%, rgb(235 129 83) 100%);
                                        box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px">

                                        <div class="card-body position-relative zindex-100">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-4"><img
                                                        src="https://white-force.com/offrole/whiteforcelogo_portrait_color.png"
                                                        alt="Image placeholder" class="rounded-sm" style="height:50px"></div>
                                                <div class="col-4" align="center">
                                                    <h3 style="color: white">{{ (!empty($resume->resume_data) && !empty($resume->resume_data[0]) && $resume->resume_data[0]->Name && $resume->resume_data[0]->Name[0]) ? $resume->resume_data[0]->Name[0] : '-' }}</h3>
                                                    
                                                    <h6 class="progress-text mt-2 mb-0 d-block spaceInWords" style="color: white">
                                                    {{ (!empty($resume->resume_data) && !empty($resume->resume_data[0]) && $resume->resume_data[0]->Email && $resume->resume_data[0]->Email[0]) ? $resume->resume_data[0]->Email[0] : '-' }} - {{ (!empty($resume->resume_data) && !empty($resume->resume_data[0]) && $resume->resume_data[0]->Phone && $resume->resume_data[0]->Phone[0]) ? $resume->resume_data[0]->Phone[0] : '-' }}
                                                    </h6>
                                                </div>
                                                <div class="col-4" align="right"><span class="badge badge-warning"
                                                        style="font-size: 30px;"> {{ (!empty($resume->Score) && !empty($resume->Score[0])) ? $resume->Score[0] : 0 }}%</span>
                                                    <h6 class="progress-text mt-2 mb-0 d-block" style="color: white">AI Matching
                                                        Score
                                                    </h6>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="list-group list-group-flush" style="padding: 15px 20px;">
                                        <div class="row">
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0 d-block" style="font-size: 20px;">Categories
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0 d-block" style="font-size: 20px; margin-left: 30px;">
                                                    <span
                                                        style="margin: -6px -34px !important; font-size: 28px; color: #8ccf24; position: absolute;"
                                                        class="mdi mdi-checkbox-marked-circle"></span> <span>Matching
                                                        Keywords</span>
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0 d-block" style="font-size: 20px; margin-left: 30px;">
                                                    <span
                                                        style="margin: -6px -34px !important; font-size: 28px; position: absolute;color:#d11313"
                                                        class="mdi mdi-close-circle"></span>
                                                    Missing Keywords
                                                </h6>
                                            </div>
                                        </div>

                                        <div class="row line">
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0 d-block"> {{ strtoupper('Tools and technologies') }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6 class="progress-text mb-0  spaceInWords matching">
                                                    {{ (!empty($resume->match_keywords) && !empty($resume->match_keywords->$tools_and_technologies)) ? implode(', ', $resume->match_keywords->$tools_and_technologies) : '-' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4">
                                                <h6 class="progress-text mb-0  spaceInWords missing">
                                                {{ (!empty($resume->missing_keywords) && !empty($resume->missing_keywords->$tools_and_technologies)) ? implode(', ', $resume->missing_keywords->$tools_and_technologies) : '-' }}

                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row line">
                                            <div class="col-sm-4 mb-5" align="left">
                                                <h6 class="progress-text mb-0 d-block "> {{ strtoupper('Roles') }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords matching">
                                                {{ (!empty($resume->match_keywords) && !empty($resume->match_keywords->Role)) ? implode(', ', $resume->match_keywords->Role) : '-' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords missing">
                                                {{ (!empty($resume->missing_keywords) && !empty($resume->missing_keywords->Role)) ? implode(', ', $resume->missing_keywords->Role) : '-' }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row line">
                                            <div class="col-sm-4 mb-5" align="left">
                                                <h6 class="progress-text mb-0  d-block "> {{ strtoupper('Skills') }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords matching">
                                                {{ (!empty($resume->match_keywords) && !empty($resume->match_keywords->Concepts)) ? implode(', ', $resume->match_keywords->Concepts) : '-' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords missing">
                                                {{ (!empty($resume->missing_keywords) && !empty($resume->missing_keywords->Concepts)) ? implode(', ', $resume->missing_keywords->Concepts) : '-' }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row line">
                                            <div class="col-sm-4 mb-5" align="left">
                                                <h6 class="progress-text mb-0  d-block ">
                                                    {{ strtoupper('Educations') }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords matching">
                                                {{ (!empty($resume->match_keywords) && !empty($resume->match_keywords->Education)) ? implode(', ', $resume->match_keywords->Education) : '-' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords missing">
                                                {{ (!empty($resume->missing_keywords) && !empty($resume->missing_keywords->Education)) ? implode(', ', $resume->missing_keywords->Education) : '-' }}
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="row line">
                                            <div class="col-sm-4 mb-5" align="left">
                                                <h6 class="progress-text mb-0  d-block ">
                                                    {{ strtoupper('Years Of Experience') }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">
                                                <h6 class="progress-text mb-0  spaceInWords matching">
                                                {{ (!empty($resume->match_keywords) && !empty($resume->match_keywords->Yrs_of_Exp)) ? implode(', ', $resume->match_keywords->Yrs_of_Exp) : '-' }}
                                                </h6>
                                            </div>
                                            <div class="col-sm-4 mb-5">

                                                <h6 class="progress-text mb-0  spaceInWords missing">
                                                {{ (!empty($resume->missing_keywords) && !empty($resume->missing_keywords->Yrs_of_Exp)) ? implode(', ', $resume->missing_keywords->Yrs_of_Exp) : '-' }}
                                                </h6>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

