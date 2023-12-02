@extends('master.master')
@section('title', 'Sync Attachments')
@section('content')

<link rel="stylesheet" href="https://static.zohocdn.com/forms/css/formslive.332d3895ccfd965e0862144b8ab7164b.css">
    <link href="/formstatic/fonts?family=Open+Sans:400,700i,700,600i,600,400i,300i,300" rel="stylesheet"
        type="text/css">
        
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
<link href="https://static.zohocdn.com/forms/css/themes/custom.1ff7387abf69cb1dd044d7bd339ab1ff.css"
        rel="stylesheet" type="text/css">
        <style id="CUSTOM_STYLE_TAG">
        /* $Id$ */
        /**
 * IMPORTANT NOTE: This compressed css file includes thirdparty stylesheets
 */

        body {
            background-color: #eee;
        }
        .progress {
            -webkit-transform: rotate(0deg) !important;
            transform: rotate(-0deg) !important;
        }
        .card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border: 1px solid #efe285;
            border-radius: 12px;
            height: calc(100% - 8px);
        }

        .c-details span {
            font-weight: 300;
            font-size: 13px
        }
        .fa-eye{
            margin-top: 6px ;
        }

        .flex-col {
            display: flex;
        }

        .heading {
            font-size: 1rem;
        }

        .pageFotDef .submitColor {
            float: none;
        }

        [type=button]:not(:disabled),
        [type=reset]:not(:disabled),
        [type=submit]:not(:disabled),
        button:not(:disabled) {
            cursor: pointer;
        }

        .pageFotDef,
        .alignNext,
        .saveBtnCont,
        .saveBtn,
        .nextAlign,
        .prevAlign,
        .next_previous,
        .alignSubmit,
        .submitBtnCont,
        .submitColor,
        .reviewBtnCont,
        .reviewBtn {
            width: auto;
        }

        .submitColor {
            background-image: none;
            background-color: #e66025;
        }

        .submitWrapper {
            border-style: none;
            border-color: rgba(73, 112, 69, 1.0);
            border-top-width: 0px;
            border-right-width: 0px;
            border-bottom-width: 0px;
            border-left-width: 0px;
            -webkit-border-top-left-radius: 3px;
            -moz-border-radius-topleft: 3px;
            border-top-left-radius: 3px;
            -webkit-border-top-right-radius: 3px;
            -moz-border-radius-topright: 3px;
            border-top-right-radius: 3px;
            -webkit-border-bottom-right-radius: 3px;
            -moz-border-radius-bottomright: 3px;
            border-bottom-right-radius: 3px;
            -webkit-border-bottom-left-radius: 3px;
            -moz-border-radius-bottomleft: 3px;
            border-bottom-left-radius: 3px;
        }

        .submitColor {
            padding: 12px 40px 12px 40px;
        }

        .submitColor {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 17px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: 400;
        }

        .icon {
            width: 50px;
            height: 50px;
            background-color: #eee;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 39px
        }

        .form-control {
            display: flex;
            position: relative;
            border-color: rgba(14, 66, 140, 0.274);
            border-top-width: 1px !important;
            border-right-width: 1px !important;
            border-bottom-width: 1px !important;
            border-left-width: 1px !important;
            -webkit-border-top-left-radius: 5px !important;
            -moz-border-radius-topleft: 5px !important;
            border-top-left-radius: 5px !important;
            -webkit-border-top-right-radius: 5px !important;
            -moz-border-radius-topright: 5px !important;
            border-top-right-radius: 5px !important;
            -webkit-border-bottom-right-radius: 5px !important;
            -moz-border-radius-bottomright: 5px !important;
            border-bottom-right-radius: 5px !important;
            -webkit-border-bottom-left-radius: 5px !important;
            -moz-border-radius-bottomleft: 5px !important;
            border-bottom-left-radius: 5px !important;
            margin-top: 0px;
            height: 42px;
        }

        .badge-pending span {
            background-color: #fffbec;
            width: 90px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #fed85d;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .badge-green span {
            background-color: #ddffd5;
            width: 90px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #4ecc2e;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .badge-inqueue span {
            background-color: #fde7ff;
            width: 90px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #b903cc;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .badge-failed span {
            background-color: #ffdcdc;
            width: 90px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #ff1414;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .badge-notfound span {
            background-color: #dbfffd;
            width: 120px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            color: #12ded3;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .badge-timeout span {
            background-color: #f1f1ef;
            color: #71706d;
            width: 90px;
            height: 33px;
            padding-bottom: 3px;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 900;
            font-size: 13px;
        }

        .progress {
            height: 10px;
            border-radius: 10px
        }

        .progress div {
            background-color: red
        }

        .text1 {
            font-size: 14px;
            font-weight: 600
        }

        .text2 {
            color: #a5aec0
        }

        .mail{
            font-weight: 600;
        }

        .ds {
            display: flex;
            width: 98%;
            justify-content: space-around;
        }

        input[type="text"] {
            font-size: 18px;

        }

        input[type="password"] {
            font-size: 22px;

        }

        .tempSubfrmWrapper .formSubInfoText {
            margin-top: 0px;
        }

        .tempHeadContBdr .frmTitle {
            font-family: Lato;
            font-size: 42px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: 700
        }

        .tempHeadContBdr .frmDesc {
            font-family: Lato;
            font-size: 14px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: 400
        }

        .formFieldWrapper>.tempFrmWrapper>.labelName,
        .formFieldWrapper>.tempFrmWrapper>.tempContDiv .labelName {
            font-family: 'Poppins', sans-serif;
            font-size: 18px;
            color: #1a1816;
            font-style: normal;
            font-weight: 600
        }

        .tempSubfrmWrapper .labelName {
            font-family: Nunito;
            font-size: 15px;
            color: #222222;
            font-style: normal;
            font-weight: 400
        }


        .formPageHeader h2,
        .pTitle td {
            font-family: Nunito;
            font-size: 22px;
            color: #000000;
            font-style: normal;
            font-weight: 400
        }

        .next_previous {
            font-family: Nunito;
            font-size: 15px;
            color: #222222;
            font-style: normal;
            font-weight: 400
        }

        .sfCardDiv .lableText {
            font-family: Nunito;
            font-size: 13px;
            color: #666666;
            font-style: normal;
            font-weight: 400
        }

        .sfCardDiv .recordVal {
            font-family: Nunito;
            font-size: 13px;
            color: #444444;
            font-style: normal;
            font-weight: 400
        }

        .sfCardDiv .addEntryIconLabel {
            color: #24A68A;
        }

        @font-face {
            font-family: "Lato";
            font-weight: 400;
            font-style: normal;
            src: url("https://webfonts.zohowebstatic.com/latoregular/font.eot");
            src: url("https://webfonts.zohowebstatic.com/latoregular/font.woff2") format("woff2"),
                url("https://webfonts.zohowebstatic.com/latoregular/font.woff") format("woff"),
                url("https://webfonts.zohowebstatic.com/latoregular/font.ttf") format("truetype");
        }

        @font-face {
            font-family: "Nunito";
            font-weight: 400;
            font-style: normal;
            src: url("https://webfonts.zohowebstatic.com/nunitoregular/font.eot");
            src: url("https://webfonts.zohowebstatic.com/nunitoregular/font.woff2") format("woff2"),
                url("https://webfonts.zohowebstatic.com/nunitoregular/font.woff") format("woff"),
                url("https://webfonts.zohowebstatic.com/nunitoregular/font.ttf") format("truetype");
        }

        .formFieldWrapper>.tempFrmWrapper {
            margin: 14px 15px 5px 15px
        }

        .tempHeadContBdr {
            text-align: center
        }

        .tempHeadContBdr {
            background-image: none;
            background-color: #e66025
        }

        .subContWrap {
            background-image: none;
            margin-top: 40px;
            background-color: transparent
        }

        .submitColor {
            background-image: none;
            background-color: #e66025
        }

        .zfCusRadio .customRadioBtn,
        .zfCusCheckbox .customCheckBox {
            position: relative;
            margin: 0 0 0px 0;
            text-align: left;
            width: 40%;
            display: inline-block;
            padding-left: 0 !important;
            padding-right: 0;
            display: flex;
        }

        .modelone.cusMedium .customRadioBtn input[type="radio"]+.cusChoiceLabel:after {
            width: 10px;
            height: 10px;
            margin: 5px 0 0 2px;
            border-radius: 50%;
            border-width: 1px;
            left: 0;
            top: 0;
        }


        .switch {
            position: relative;
            bottom: 5px;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

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

        input:checked+.slider {
            background-color: #e66025;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #e66025;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }

        .submitColor {
            padding: 12px 40px 12px 40px;
        }

        .submitColor {
            font-family: Tahoma, Geneva, sans-serif;
            font-size: 17px;
            color: #FFFFFF;
            font-style: normal;
            font-weight: 400;
        }

        .flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .flex-col {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }
        .stepFont {
            font-weight: 900;
        }
        
    </style>
    <!--Modal-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="exampleModalLabel" style="font-size: 15px;font-weight: 700;color: #fc8d5c;"><b>Steps To Create App Password</b></h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="heading" style="font-weight: 700;">Zoho-</h5></br>
                    <ul>
                        <p>1) Login to your zoho account.</p></br>
                        <p>2) In your mail dashbord from right corner click on <b class="stepFont">Settings</b>.</p></br>
                        <p>3) Now from left sidebar at the last you will found <b class="stepFont">Mail Accounts</b> option.</p></br>
                        <p>4) After clicking it you will find 5 option. Click on <b class="stepFont">IMAP</b>.</p></br>
                        <p>5) Scroll down little after that you will found one checkbox <b class="stepFont">IMAP Access</b>. </p></br>
                        <p>6) Select this checkbox and click on<b class="stepFont">Save</b>.</p></br>
                        <p>7) From top right corener click on <b class="stepFont">My Profile</b>.</p></br>
                        <p>8) Click on <b class="stepFont">My Account</b>.</p></br>
                        <p>9) From Left sidebar click on <b class="stepFont">Security</b> >> <b class="stepFont">App Passwords</b>.</p></br>
                        <p>10) Click on <b class="stepFont">Generate New Password</b>.</p></br>
                        <p>11) Enter any name of your choice (like "Sync attachment" etc).</p></br>
                        <p>12) Now you will find your App password. Just copy it and paste it in <b class="stepFont">App Password</b> feild in the form of software</p></br>
                        
                    </ul>
                    <h5 class="heading" style="font-weight: 700;">Google-</h5></br>
                    <ul>
                        <p>1) Login to your google account.</p></br>
                        <p>2) Go to <b class="stepFont">Manage your Google Account</b>.</p></br>
                        <p>3) Select <b  class="stepFont">Security</b>.</p></br>
                        <p>4) Under <b class="stepFont">How you sign in to Google, </b>click on <b class="stepFont">2-Step Verification. </b>Scroll down to the end, select <b class="stepFont">App Passwords</b>. You may need to <b class="stepFont">Sign In</b>. If you don’t have this option, it might be because:</br>
                        a. 2-Step Verification is not set up for your account.</br>
                        b. 2-Step Verification is only set up for security keys.</br>
                        c. Your account is through work, school, or other organization.</br>
                        d. You turned on Advanced Protection.</p></br>
                        <p>5) At the bottom, choose <b class="stepFont">Select app</b> and choose the app you using and then <b class="stepFont">Select device</b class="stepFont"> and choose the device you’re using and then <b class="stepFont">Generate</b>.</p></br>
                        <p>6) Copy <b class="stepFont">App Password</b> and paste it in <b class="stepFont">App Password</b> feild in the form of software</p></br>
                        <p>7) Tap Done.</p>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<!-- Modal -->
    <div class="content-body" style="min-height: 788px;">
        <div class="container-fluid">
    <section class="templateRtCont" id="formCont"><!-- $Id: $ -->
        <div class="centerContainer ">
            <div class="templateWrapper" id="template-div"><!-- Rendering form UI -->
                <ul class="ulNoStyle tempHeadBdr formRelative">
                    <li class="tempHeadContBdr">
                        <h2 class="frmTitle"><em><i class="fa-solid fa-envelopes-bulk"></i> Email Sync Attachments <i
                                    class="fa-solid fa-link"></i></em></h2>
                        <p class="frmDesc"></p>
                        <div class="clearBoth"></div>
                    </li>
                </ul>

                <div class="row">
                    <div class="col-6">
                        <div class="formRelative">
                            <form action="{{ url('sync_email_attachments') }}" method="post" id="createClient"
                             enctype="multipart/form-data">
                             @csrf
                            <ul class="ulNoStyle subContWrap formFieldWrapper topAlign" id="subContDiv">
                                <div class="ds">
                                    <div for="" class="card__list flex flex-col"
                                        style="width: 48%;position: relative; left: 10px;"> <span class="card__label" style="font-family: 'Poppins', sans-serif;
                                        font-size: 18px;
                                        color: #1a1816;
                                        font-style: normal;
                                        font-weight: 600;
                                        margin: 0.4rem;">Enter Your
                                            Email <em class="important" aria-hidden="true">*</em></span> <label for="" class="relative"> <span class="absolute card__icon">
                                            </span> <input class="form-control" type="email" placeholder="" name="email_address"
                                                id="email_address" value="{{!empty($account_detail->email_address) ? $account_detail->email_address : '' }}" required>

                                        </label> </div>
                                    <div for="" class="card__list flex flex-col" style="width: 46%;"> <span
                                            class="card__label" style="font-family: 'Poppins', sans-serif;
                                        font-size: 18px;
                                        color: #1a1816;
                                        font-style: normal;
                                        font-weight: 600;
                                        margin: 0.4rem;">Enter Your App
                                            Password <em class="important" aria-hidden="true">*</em></span> <label for="" class="relative"> <span
                                                class="absolute card__icon">
                                            </span> <input class="form-control" type="password" placeholder="" id="app_password"
                                                name="app_password" value="{{!empty($account_detail->app_password) ? $account_detail->app_password : '' }}" style="position: relative;" required>
                                            <i class="fa-regular fa-eye" id="togglePassword"
                                                style=" cursor: pointer; position: absolute; right: 7%; top: 11%; z-index: 100;"></i>
                                        </label>
                                        <a href="#" data-toggle="modal" data-target="#exampleModal" style="color: #fa753b;font-weight: 700;"><b>Steps to create App Password</b></a>
                                    </div>
                                </div>
                                <li class="zfradio tempFrmWrapper oneColumns zfCusRadio modelone cusMedium"
                                    elname="livefield-elem" comptype="13" id="Radio-li" needdata="true" compname="Radio"
                                    linkname="" isvisible="true" mandatory="true" page_no="" page_link_name=""
                                    choice_type="radio" counteruid="">
                                    <label id="Radio-arialabel" class="labelName"><span>Select Account Type :</span>
                                        <em class="important" aria-label="Required">*</em>
                                    </label>


                                    <div class="subFrmFieldsHidden subFrmFieldsHiddenCont" style="display:none"
                                        elemname="fieldHiddenDiv"><em><svg class="icon icon-Denied-1-01">
                                                <use xlink:href="#icon-rules-denied-01"></use>
                                            </svg></em>
                                        <span>N/A</span>
                                    </div>
                                    <div class="tempContDiv" elemname="fieldContentDiv">

                                        <div class="overflow customRadioBtn" role="radiogroup"
                                            aria-labelledby="Radio-arialabel">


                                            <span class="multiAttType cusChoiceSpan"> 
                                                <input
                                                    aria-describedby="Radio-arialabel hint-Radio"
                                                    onmousedown="event.preventDefault();" type="radio" id="Radio_1"
                                                    name="account_type" elname="Radio" class="radioBtnType" value="gmail"
                                                    formula_val="" textassign_val=""
                                                    onchange="ZFLive.prefillFieldLabel(this); ZFLive.hideClosestFieldElemErrorDiv(this);"
                                                    {{(!empty($account_detail->account_type) && $account_detail->account_type == 'gmail') ? 'checked' : '' }} required>
                                                <label for="Radio_1" class="radioChoice cusChoiceLabel">

                                                    <div class="checker"></div><em class="cusChoiceEm">Gmail</em>
                                                </label> 
                                            </span>
                                            <span class="multiAttType cusChoiceSpan"> <input
                                                    aria-describedby="Radio-arialabel hint-Radio"
                                                    onmousedown="event.preventDefault();" type="radio" id="Radio_2"
                                                    name="account_type" elname="Radio" class="radioBtnType" value="zoho"
                                                    formula_val="" textassign_val=""
                                                    onchange="ZFLive.prefillFieldLabel(this); ZFLive.hideClosestFieldElemErrorDiv(this);" 
                                                    {{(!empty($account_detail->account_type) && $account_detail->account_type == 'zoho') ? 'checked' : '' }} required>
                                                <label for="Radio_2" class="radioChoice cusChoiceLabel">
                                                    <div class="checker"></div><em class="cusChoiceEm">Zoho</em>
                                                </label> 
                                            </span>

                                            <div class="clearBoth"></div>
                                        </div>
                                        <p class="errorMessage" elname="error" id="error-Radio"></p>
                                    </div>
                                    <div class="clearBoth"></div>
                                </li>
                                <li class="tempFrmWrapper name namelarge" elname="livefield-elem" comptype="7"
                                    needdata="true" id="Name-li" compname="Name" linkname="" isvisible="true"
                                    mandatory="true" page_no="" page_link_name="" regex_type="0" showlabel="true"
                                    counteruid="">
                                    <label class="labelName" for="SingleLine-arialabel">

                                        <span>Want to save password for later use ? </span>

                                        <label class="switch">
                                            <input type="checkbox" name="want_to_save" id="want_to_save" {{!empty($account_detail) ? 'checked' : '' }} value="1">
                                            <span class="slider round"></span>
                                        </label>

                                    </label><br><br><br>
                                    <label class="labelName" id="Name-arialabel">
                                        <span>Select Date Range :</span>
                                        <em class="important" aria-hidden="true">*</em>
                                    </label>
                                    
                                    <div class="subFrmFieldsHidden subFrmFieldsHiddenCont" style="display:none"
                                        elemname="fieldHiddenDiv"><em><svg class="icon icon-Denied-1-01">
                                                <use xlink:href="#icon-rules-denied-01"></use>
                                            </svg></em>
                                        <span>N/A</span>
                                    </div>
                                    <div class="tempContDiv twoType" elemname="fieldContentDiv">
                                        <div class="nameWrapper">
                                            <span elname="compEachElem">
                                                <span class="sr-only" elname="ariaReqSpan" id="ariarequired-Name0">Required</span>
                                                <input type="date" name="from_date" id="from_date" class="form-control"
                                                    placeholder="From date" required>
                                            </span>
                                            <span elname="compEachElem">
                                                <span class="sr-only" elname="ariaReqSpan" id="ariarequired-Name1">Required</span>
                                                <input type="date" name="to_date" id="to_date" class="form-control"
                                                    placeholder="From date" required>
                                            </span>

                                            <div class="clearBoth"></div>
                                        </div>
                                        <p class="errorMessage" elname="error" id="error-Name"></p>
                                    </div>
                                    <div class="clearBoth"></div>
                                </li>
                                <li elname="livefield-elem" comptype="1" id="SingleLine-li" needdata="true"
                                    compname="SingleLine" linkname="" counteruid="" isvisible="true" isunique="false"
                                    class="tempFrmWrapper large" mandatory="false" page_no="" page_link_name=""
                                    showlabel="true">
                                    <div class="subFrmFieldsHidden subFrmFieldsHiddenCont" style="display:none"
                                        elemname="fieldHiddenDiv"><em><svg class="icon icon-Denied-1-01">
                                                <use xlink:href="#icon-rules-denied-01"></use>
                                            </svg></em>
                                        <span>N/A</span>
                                    </div>
                                    <div class="tempContDiv" elemname="fieldContentDiv">
                                        <p class="errorMessage" elname="error" id="error-SingleLine"></p>
                                    </div>
                                    <div class="clearBoth"></div>
                                </li>
                                <ul class="footerWrapper formRelative">
                                    <li style="overflow:visible; position: relative;" class="btnAllign fmFooter">
                                        <div class="pageFotDef">
                                            <div class="alignSubmit">
                                                <div class="formRelative inlineBlock submitBtnCont"><button
                                                        class=" fmSmtButton submitColor  submitWrapper"
                                                        type="submit"><em>Sync Attachments</em></button></div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </ul>
                            </form>
                        </div>

                    </div>

                    <div class="col-6" style="overflow-y: scroll;height: 590px;margin-top: 20px;">

                        <div class="container mt-2 mb-1">
                            <div class="row">
                                @foreach($sync_requests as $sync_request)
                                <div class="col-md-6" style="margin-top:10px">
                                    <div class="card p-3 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex flex-row align-items-center">
                                                <div class="icon"> <i class="bx bxl-mailchimp"></i> </div>
                                                <div class="ms-2 c-details">
                                                    <h6 class="mb-0">Created At</h6> <span>{{ date('M d,Y',strtotime($sync_request->created_at)) }}</span>
                                                </div>
                                            </div>
                                            @if($sync_request->status == 0)
                                            <div class="badge-pending"> <span>Pending</span> </div>
                                            @elseif($sync_request->status == 1)
                                            <div class="badge-green"> <span>Success</span> </div>
                                            @elseif($sync_request->status == 2)
                                            <div class="badge-inqueue"> <span>In Queue</span> </div>
                                            @elseif($sync_request->status == 3)
                                            <div class="badge-failed"> <span>Failed</span> </div>
                                            @elseif($sync_request->status == 4)
                                            <div class="badge-notfound"> <span>Data Not Found</span> </div>
                                            @elseif($sync_request->status == 5)
                                            <div class="badge-timeout"> <span>Time Out</span> </div>
                                            @endif
                                        </div>
                                        <div class="mt-1">
                                            <h3 class="heading"><p class="mail">Email Id -</p> {{ $sync_request->email }}</h3>
                                            <div class="mt-3">
                                                <div class="mt-3"> <span class="text1">Request Date Range: <span
                                                            class="text2">{{ date('M d,Y',strtotime($sync_request->from_date)) }} &nbsp;&nbsp; To &nbsp;&nbsp; {{ date('M d,Y',strtotime($sync_request->to_date)) }}</span></span> </div>
                                            </div>
                                            @if(!empty($sync_request->candidate_ids))
                                            <a class="col-md-12 btn btn-success btn-sm mt-3" style="padding:3px" href="{{ url('candidate?sync_request_id=').$sync_request->id }}" target="_blank">View Candidate</a>
                                            @else
                                            <a class="col-md-12 btn btn-danger btn-sm mt-3" style="padding:3px" href="{{ url('delete_sync_request').'/'.$sync_request->id }}">Delete Request</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br>
            </div>
        </div>
        <div class="btmContainer"></div>
        </div>
        <div class="clearBoth"></div>
        </div>
</div>
</div>

        <script>
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#app_password');

            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('mdi-eye-off');
            });
        </script>
        <script src="https://kit.fontawesome.com/d31220f8d2.js" crossorigin="anonymous"></script>
        </section>
@endsection
