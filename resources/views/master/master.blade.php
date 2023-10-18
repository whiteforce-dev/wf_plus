<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') | White Force Plus</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets') }}/images/favicon.png">
    <!-- Favicon icon -->

    <!-- Links Section -->
    @include('master.links')
    <!-- Links Section -->
    <style>
        .error {
            color: red;
            margin: 4px;
            font-weight: 400;
        }

        .col-sm-3 {
            color: #000000e8;
            font-weight: 500;
        }

        .deznav .metismenu {

            padding-top: 25px;
            padding-bottom: 15px;
        }

        [data-sidebar-style="full"][data-layout="vertical"] .menu-toggle .deznav .metismenu>li.mm-active>a {

            background: #fdf2ed !important;
        }

        [data-sidebar-style="full"][data-layout="vertical"] .menu-toggle .deznav .metismenu>li:hover>a {
            border-radius: 8px;
            background: #fdf2ed !important;
            color: #fff;
        }

        .img-round {
            border-radius: 50%;
        }

        .ps__rail-y {
            display: none !important;
        }

        .ps__thumb-x {
            display: none !important;
        }
    </style>

    <style>
        .logo-box {
            max-width: none !important;
            animation: rotateY-anim 2s linear infinite;
            height: 15px;
            position: absolute;
            top: -3px;
            left: -2px;
            filter: drop-shadow(1px 0px 0px #ccc);
        }

        @keyframes rotateY-anim {

            0%,
            30% {
                transform: rotateY(0deg);
            }

            100%,
            70% {
                transform: rotateY(360deg);
            }
        }

        .form-check-input {
            clear: left;
        }

        .form-switch.form-switch-sm {
            margin-bottom: 0.5rem;
            /* JUST FOR STYLING PURPOSE */
        }

        .form-switch.form-switch-sm .form-check-input {
            height: 1rem;
            width: calc(1rem + 0.75rem);
            border-radius: 2rem;
        }

        .form-switch.form-switch-md {
            margin-bottom: 1rem;
            /* JUST FOR STYLING PURPOSE */
        }

        .form-switch.form-switch-md .form-check-input {
            height: 1.5rem;
            width: calc(2rem + 0.75rem);
            border-radius: 3rem;
        }

        .form-switch.form-switch-lg {
            margin-bottom: 1.5rem;
            /* JUST FOR STYLING PURPOSE */
        }

        .form-switch.form-switch-lg .form-check-input {
            height: 2rem;
            width: calc(3rem + 0.75rem);
            border-radius: 4rem;
        }

        .form-switch.form-switch-xl {
            margin-bottom: 2rem;
            /* JUST FOR STYLING PURPOSE */
        }

        .form-switch.form-switch-xl .form-check-input {
            height: 2.5rem;
            width: calc(4rem + 0.75rem);
            border-radius: 5rem;
        }

        .page-item.active .page-link {

            background: var(--primary) !important;
            border-color: var(--primary) !important;
        }

        .pagination {
        margin-bottom: 0.25rem;
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
    }

    .pagination-gutter {
        background-color: white;
        width: auto;
        padding: 4px;
        border-radius: 5px;
        margin: auto;
    }


    .pagination-gutter .page-item .page-link {
    border-radius: 0.35rem !important;
    background: white;
}
    </style>
</head>

<body style="background:#edf2f9;font-family: 'Plus Jakarta Sans', sans-serif !important;" data-theme-version="light"
    data-layout="vertical" data-nav-headerbg="color_1" data-headerbg="color_1" data-sidebar-style="full"
    data-sidebarbg="color_1" data-sidebar-position="fixed" data-header-position="fixed" data-container="wide"
    direction="ltr" data-primary="color_1">

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <div id="main-wrapper" class="menu-toggle">
        <div class="nav-header">
            <a href="{{ url('dashboard') }}" class="brand-logo">
                <img height="30" src="https://white-force.com/onrole/whiteforcelogo_portrait_color.png"
                    alt="" />
                <small
                    style="color: #eb8153;
                position: absolute;
                left: 70px;
                top: 10px;
                font-size: 12px;
                font-weight: 500;
            }"><img
                        class="logo-box" src="{{ url('plusLogo.png') }}" alt=""></small>
                <span style="font-family:Arial, Helvetica, sans-serif; font-size:22px; color:#000;"></span>
            </a>
        </div>

        @include('master.nav');
        @include('master.sidebar')


        {{-- content section --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>

        @yield('css')
        @yield('content')

    </div>
    <!--MODAL Start--->
    <div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body" id="commonModalBody">

                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
    <!--MODAL END--->



    <!--RIGHT MODAL CSS AND HTML--->
    <style>
        .right-Modal {
            background: rgb(98 98 98 / 59%);
        }

        .modal.left .modal-dialog,
        .modal.right .modal-dialog {
            position: fixed;
            margin: auto;
            width: 642px;
            max-width: 642px;
            height: 100%;
            -webkit-transform: translate3d(0%, 0, 0);
            -ms-transform: translate3d(0%, 0, 0);
            -o-transform: translate3d(0%, 0, 0);
            transform: translate3d(0%, 0, 0);
        }

        .modal.left .modal-content,
        .modal.right .modal-content {
            height: 100%;
            overflow-y: auto;
        }


        /*Left*/
        .modal.left.fade .modal-dialog {
            left: -320px;
            -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
            -o-transition: opacity 0.3s linear, left 0.3s ease-out;
            transition: opacity 0.3s linear, left 0.3s ease-out;
        }

        .modal.left.fade.in .modal-dialog {
            left: 0;
        }

        /*Right*/
        .modal.right.fade .modal-dialog {
            right: 0;
            -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
            -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
            -o-transition: opacity 0.3s linear, right 0.3s ease-out;
            transition: opacity 0.3s linear, right 0.3s ease-out;
        }

        .modal.right.fade.in .modal-dialog {
            right: 0;
        }

        /* ----- MODAL STYLE ----- */
        .modal-content {
            border-radius: 0;
            border: none;
        }

        .candidate_Information {
            width: 55%;
        }

        .custom-modal-header {
            border-bottom-color: #EEEEEE;
            background-color: #F2F7FA;
            height: 114px;
        }

        .custom-modal-header .candidate_img {
            width: 80px;
            height: 80px;
            background: #f2f7fa;
            border-radius: 50%;
        }

        .custom-modal-header .candidate_img img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 50%;
        }

        .custom-btn {
            padding: 4px 18px;
            font-size: 12px;
        }

        .custom-modal-body {
            padding: 0;
        }

        .custom-nav-modal {
            padding: 0.8rem 1.4rem !important;
            color: #858585;
        }

        .modal-header {
            position: sticky;
            top: 0;
            /* background-color: inherit; [1] */
            z-index: 1055;
            /* [2] */
        }

        .modal-footer {
            position: sticky;
            bottom: 0;
            /* background-color: inherit; [1] */
            z-index: 1055;
            /* [2] */
        }

        #toast-container>div {
            /* top: 70px !important; */
            max-width: 370px !important;
            width: 370px !important;
        }
    </style>
    <div class="modal right fade right-Modal" id="rightModal" tabindex="-1" role="dialog"
        aria-labelledby="rightModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="modal-section">

            </div>
        </div>
    </div>
    <!--RIGHT MODAL CSS AND HTML--->

    <style>
        <style>.select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border-radius: 8px;
            border: 0.0625rem solid #eeeeee;
            height: 3.2rem;
            background: #fff;
        }

        .select2-container--default .select2-selection--single:hover,
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--single.active {
            box-shadow: none;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            border: none !important;
        }


        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 2.5rem;
            color: grey;
            padding-left: 0.9375rem;
            min-height: 2.5rem;
            font-weight: 400;
        }

        .select2-container--default .select2-selection--multiple {
            border-color: #eeeeee;
            border-radius: 0;
        }

        .select2-dropdown {
            border-radius: 0;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary);
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #eeeeee;
            background: white;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            top: 0.375rem;
            right: 0.9375rem;
        }

        .select2-container .select2-selection--multiple {
            min-height: 2.5rem;
            color: grey;
            border-radius: 1px;
            border: 0.0625rem solid #eeeeee;
        }

        .select2-dropdown {
            border-color: #eeeeee;
        }

        .swal2-popup .swal2-content {
            color: #eeeeee;
        }

        .select2-selection--multiple {
            min-height: 50px !important;
            border-radius: 5px !important;
            padding: 12px;
            overflow: hidden;
        }

        .select2-search__field {
            width: 100% !important;
        }

        .tox-notification--warning {
            display: none !important;
        }
    </style>
    @include('master.scripts')
</body>

</html>
