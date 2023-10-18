{{-- <style>
    body {
        padding: 0;
        margin: 0;
        font-family: Arial, sans-serif;
        background-image: url('https://www.white-force.com/onrole/back_three.jpg');
        background-size: cover;
    }

    .box {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
    }

    .title-box {
        width: 500px;
    }

    .title-box img {
        width: 235px;
        margin-bottom: -10px;
    }

    .title-box p {
        color: #000;
        font-size: 26px;
        font-weight: normal;
        line-height: 32px;
    }

    .form-box {
        width: 350px;
        padding: 15px;
        text-align: center;
        border-radius: 5px;
        background: #fff;
        margin-left: 60px;
        box-shadow: 0px 2px 10px 1px rgba(71, 71, 71, 0.52);
    }

    .form-box input {
        width: 100%;
        margin-bottom: 15px;
        padding: 15px;
        font-size: 18px;
        box-sizing: border-box;
        border: 1px solid #eeebeb;
        border-radius: 5px;
        outline: none;
    }

    .form-box input:focus {
        box-shadow: 0px 0px 1px 1px rgb(22, 111, 229);
    }

    .form-box button {
        width: 100%;
        margin-bottom: 15px;
        color: #fff;
        font-size: 20px;
        font-weight: 600;
        border-radius: 5px;
        border: none;
        padding: 13px 0;
        cursor: pointer;
        background: #166fe5;
    }

    .form-box button:hover {
        background: #1877f2;
    }

    .form-box a {
        color: #166fe5;
        font-size: 14px;
        text-decoration: none;
        margin-top: 5px;
        margin-bottom: 20px;
        display: block;
    }

    .form-box a:hover {
        text-decoration: underline;
    }

    .form-box hr {
        border: 1px solid #dadde1;
        margin-bottom: 15px;
    }

    .form-box .create-btn a {
        color: #fff;
        font-size: 16px;
        text-decoration: none;
        padding: 15px 20px;
        border-radius: 5px;
        background: #36a420;
        font-weight: 600;
        display: inline-block;
        margin-bottom: 5px;
    }

    .form-box .create-btn a:hover {
        background: #42b72a;
    }

    .floating {
        animation-name: floating;
        animation-duration: 3s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-in-out;
        /* margin-left: 30px;
        margin-top: 5px; */
    }

    @keyframes floating {
        from {
            transform: translate(0, 0px);
        }

        65% {
            transform: translate(0, 15px);
        }

        to {
            transform: translate(0, -0px);
        }
    }
</style>
<div class="box">
    <div class="title-box floating">
        <img src="https://www.white-force.com/onrole/whiteforcelogo_portrait_color.png" alt="White_force"
            class="floating" style="height:90px; width:auto;">
        <br>
        <br>
        <p style="font-size: 22px;"><b><span style="color: #4ce625;">White</span> <span
                    style="color: #ff0001;">Force</span> <span style="color: #166fe5;">Plus</span></b> helps you to
            track Positions along with Candidates.</p>
    </div>
    <div class="form-box ">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="text" name="email" id="email" placeholder="Please Enter Username">

            <input type="password" id="password" name="password" placeholder="Password">

            <button type="submit">Log In</button>
            @error('email')
            <span class="invalid-feedback" role="alert" style="color:red">{{ $message }}
            </span>
            @enderror
            <a href="{{ url('password/reset') }}">Forgotten Password ?</a>
        </form>

    </div>
</div> --}}








<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=utf-8" />


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login to White Force Plus</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets') }}/images/favicon.png">

    <meta name="msapplication-TileColor" content="#fdcb04">
    <meta name="theme-color" content="#fdcb04">
    <link rel="stylesheet" href="{{ url('assets/login/index.9c8df4b3.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.css"
        integrity="sha512-arPZ7r4v4xEkxAQngubdkUNXFBVO8NFFRg1IszNv2AMaaZ9cDiCVRFGSZSjF7o5GHpm826QTqtNdOFNSnHbOYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .shape-bottom {
            bottom: -71px;
            left: 12%;
            margin-bottom: 5%;
            margin-left: 2%;
            position: absolute;
            z-index: -1;
        }

        .logo-box {
            max-width: none !important;
            animation: rotateY-anim 2s linear infinite;
            height: 25px;
            position: absolute;
            top: -30px;
            left: 395px;
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
    </style>
</head>


<body>
    <div class="flex login-screen">
        <div class="login-mangools">
            <div class="flex flex-col items-center login-mangools__bg--small relative">
                <div class="flex shape-top"> <svg class="shape-top__big" width="100%" id="blobSvg"
                        viewBox="0 0 500 500">
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#ff5f6d" />
                                <stop offset="100%" style="stop-color:#ffc371" />
                            </linearGradient>
                        </defs>
                        <path id="blob"
                            d="M429.5 291.5q-65.5 41.5-88 107t-92.5 68Q179 469 116.5 431T71 321.5Q88 250 98.5 199t44-114.5Q176 21 246 34t106.5 64Q389 149 442 199.5t-12.5 92Z"
                            fill="url(#gradient)" />
                    </svg> </div>
                <div class="login-mangools__logo"> <img
                        src="https://www.white-force.com/onrole/whiteforcelogo_portrait_color.png" style="height:60px;"
                        alt="">

                    <small style="color: #eb8153;
                position: absolute;
                left: 70px;
                top: 10px;
                font-size: 12px;
                font-weight: 500;
            }"><img class="logo-box" src="https://white-force.com/plus/plusLogo.png" alt=""></small>
                </div>
                <h2>Good to see you again</h2>
                <div class="login-mangools__card">

                    <form method="POST" action="{{ route('login') }}" class="flex flex-col">
                        @csrf
                        <div for="" class="card__list flex flex-col"> <span class="card__label">Your
                                email</span> <label for="" class="relative"> <span class="absolute card__icon">
                                    <svg aria-hidden="true" width="1em" height="1em"
                                        style="-webkit-transform:rotate(1turn);transform:rotate(1turn)"
                                        viewBox="0 0 36 36">
                                        <path
                                            d="M30.61 24.52a17.16 17.16 0 0 0-25.22 0 1.51 1.51 0 0 0-.39 1v6A1.5 1.5 0 0 0 6.5 33h23a1.5 1.5 0 0 0 1.5-1.5v-6a1.51 1.51 0 0 0-.39-.98z"
                                            class="clr-i-solid clr-i-solid-path-1" fill="#626262" />
                                        <circle cx="18" cy="10" r="7" class="clr-i-solid clr-i-solid-path-2"
                                            fill="#626262" />
                                        <rect width="36" height="36" fill="rgba(0, 0, 0, 0)" />
                                    </svg> </span> <input class="card__input" type="text"
                                    placeholder="eg. user@white-force.in" name="email" id="email"
                                    value="{{ old('email') }}">

                            </label> </div>
                        <div for="" class="card__list flex flex-col"> <span class="card__label">Your
                                Password</span> <label for="" class="relative"> <span class="absolute card__icon">
                                    <svg aria-hidden="true" width="1em" height="1em"
                                        style="-webkit-transform:rotate(1turn);transform:rotate(1turn)"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M20 12c0-1.103-.897-2-2-2h-1V7c0-2.757-2.243-5-5-5S7 4.243 7 7v3H6c-1.103 0-2 .897-2 2v8c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-8zM9 7c0-1.654 1.346-3 3-3s3 1.346 3 3v3H9V7z"
                                            fill="#626262" />
                                    </svg> </span> <input class="card__input" type="password"
                                    placeholder="eg. iloveyoutoo" id="password" name="password">
                                <i class="mdi mdi-eye" id="togglePassword"
                                    style="margin-left: -30px; cursor: pointer;"></i>
                            </label>
                        </div>

                        @error('email')
                        <span class="invalid-feedback" role="alert" style="color:red">{{ $message }}
                        </span>
                        @enderror




                        <button style="cursor: pointer;" class="card__sign-in">Sign
                            In</button>
                        {{-- <div class="flex justify-evenly"> <a href="#" class="card__url">Don't have an
                                account?</a>
                            <a href="#" class="card__url">Forgot
                                password?</a>
                        </div> --}}
                    </form>
                </div>
                <div class="flex shape-bottom"> <svg class="shape-bottom__small" width="100%" id="blobSvg"
                        viewBox="0 0 500 500">
                        <defs>
                            <linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:#ff5f6d" />
                                <stop offset="100%" style="stop-color:#ffc371" />
                            </linearGradient>
                        </defs>
                        <path id="blob"
                            d="M408 303q-12 53-53.5 97t-97 21Q202 398 149 380t-84-74q-31-56-10-119t69.5-119q48.5-56 113-17T355 112.5q53 22.5 59 80T408 303Z"
                            fill="url(#gradient)" />
                    </svg> </div>
            </div>
            <div class="flex items-start justify-between login-mangools__footer w-full">
                <a href="#" class="flex footer__link items-center">
                    <div class="flex footer__box items-center justify-center">
                        <img src="https://mazipan.github.io/login-page-css/logo-1.51d6f935.svg" class="footer__logo"
                            alt="">
                    </div>
                    <p class="footer__text">Onrole</p>
                </a> <a href="#" class="flex footer__link items-center">
                    <div class="flex footer__box items-center justify-center">
                        <img src="https://mazipan.github.io/login-page-css/logo-2.4a0a00ae.svg" class="footer__logo"
                            alt="">
                    </div>
                    <p class="footer__text">Offrole</p>
                </a> <a href="#" class="flex footer__link items-center">
                    <div class="flex footer__box items-center justify-center">
                        <img src="https://mazipan.github.io/login-page-css/logo-3.5847dc0b.svg" class="footer__logo"
                            alt="">
                    </div>
                    <p class="footer__text">Franchise Onrole</p>
                </a> <a href="#" class="flex footer__link items-center">
                    <div class="flex footer__box items-center justify-center">
                        <img src="https://mazipan.github.io/login-page-css/logo-4.1428eef5.svg" class="footer__logo"
                            alt="">
                    </div>
                    <p class="footer__text">Franchise Offrole</p>
                </a> <a href="#" class="flex footer__link items-center">
                    <div class="flex footer__box items-center justify-center">
                        <img src="https://mazipan.github.io/login-page-css/logo-5.9a5bd140.svg" class="footer__logo"
                            alt="">
                    </div>
                    <p class="footer__text">Training</p>
                </a>
            </div>

        </div>
    </div>

</body>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('mdi-eye-off');
    });
</script>


</html>