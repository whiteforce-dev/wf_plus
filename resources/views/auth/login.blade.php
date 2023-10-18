<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&amp;display=swap"
        rel="stylesheet">
    <title>Login to White Force Plus</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets') }}/images/favicon.png">

    <style>
        * {
            box-sizing: border-box;

        }

        html,
        body {
            background-color: #fff;
            padding: 0;
            margin: 0;
            width: 100%;
        }

        .f-container {
            width: 100%;
            margin-top: 40px;
        }

        .inner-box {
            width: 90%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 20px auto;
        }

        .heading h1 {
            color: #3e4348;
            font-family: "Lato", sans-serif;
            width: 57%;
            font-size: 1.45rem;
            margin-bottom: -40px;
            z-index: 100;
        }

        .heading {
            width: 45%;
            height: 600px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .r-images {
            width: 55%;
            height: 570px;
            position: relative;
        }

        .inner-img {
            height: 570px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-image {
            height: 570px;
            width: 25%;
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-wrap: nowrap;
            overflow-x: hidden;
            overflow-y: hidden;
        }

        .top-image img {
            margin: 20px 10px;
            /*border-radius: 50%; */
            /* object-fit: contain; */
            width: 100%;
            position: relative;
            /* animation-name: example; */
            animation: verticalSlide 85s linear infinite;
            /* animation-duration: 15s; */
            /* animation-timing-function: linear; */
            /* animation-delay: 2s; */
            /* animation-iteration-count: infinite; */
            /* animation-direction: alternate; */
        }

        @keyframes verticalSlide {

            100% {
                transform: translate3d(0, -400%, 0);
            }

        }

        .dark-one {
            position: absolute;
            width: 100%;
            height: 10%;
            left: 0;
            bottom: -10px;
            content: "";
            background: linear-gradient(to bottom, rgba(255, 251, 251, 0) 5%, #ffffff 95%);
            z-index: 1;
            pointer-events: none;
        }

        .dark-two {
            position: absolute;
            width: 100%;
            height: 10%;
            left: 0;
            top: -10px;
            content: "";
            background: linear-gradient(to top, rgba(12, 12, 33, 0) 5%, #ffffff 95%);
            z-index: 1;
            pointer-events: none;
        }

        .dark-three {
            position: absolute;
            width: 10%;
            height: 100%;
            left: 0;
            /* top: -10px; */
            content: "";
            background: linear-gradient(to left, rgba(0, 0, 0, 0) 5%, #ffffff 95%);
            z-index: 1;
            pointer-events: none;
        }

        .dark-four {
            position: absolute;
            width: 10%;
            height: 100%;
            right: 0;
            /* top: -10px; */
            content: "";
            background: linear-gradient(to right, rgba(12, 12, 33, 0) 5%, #ffffff 95%);
            z-index: 1;
            pointer-events: none;
        }

        .login-box {
            margin: auto;
            width: 100%;
            padding: 40px;
            box-sizing: border-box;

        }

        .login-box .user-box {
            position: relative;
            margin: 10px 0;
            width: 90%;
        }

        .email-pass {
            display: flex;
            align-items: start;
            justify-content: start;
            width: 80%;
            background-color: rgb(255, 255, 255);
        }

        .login-box .user-box input {
            width: 90%;
            padding: 10px 0;
            font-size: 1.1rem;
            color: #212529;
            margin-bottom: 30px;
            border: none;
            border-bottom: 1px solid #212529;
            outline: none;
            font-family: "Lato", sans-serif;
            background: transparent;
        }

        .login-box .user-box label {
            position: absolute;
            top: 0;
            left: 0;
            font-family: "Lato", sans-serif;
            padding: 10px 0;
            font-size: 1rem;
            color: #212529;
            pointer-events: none;
            transition: .5s;
        }

        .login-box .user-box input:focus~label,
        .login-box .user-box input:valid~label {
            top: -20px;
            left: 0;
            color: #212529;
            font-family: "Lato", sans-serif;
            font-size: 1rem;
        }


        .login-box .user-box textarea:valid~label {
            top: -20px;
            left: 0;
            color: #212529;
            font-family: "Lato", sans-serif;
            font-size: 1rem;
        }

        .login-box form a {
            position: relative;
            display: inline-block;
            padding: 10px 20px;
            /* width: 35%; */
            text-align: center;
            background: linear-gradient(90deg, #1ba005 0, #0ec851);
            text-decoration: none;
            /* text-transform: uppercase; */
            overflow: hidden;
            font-family: "Lato", sans-serif;
            transition: .5s;
            margin-top: 30px;
            font-weight: 600;
            letter-spacing: 4px;
            border: none;
            border-radius: 24px;
            -webkit-box-shadow: 0 2px 4px 0 rgba(27, 160, 5, .2);
            box-shadow: 0 2px 4px 0 rgba(27, 160, 5, .2);
            color: #fff;
            font-size: 1.125rem;
            font-weight: 600;
            margin: 1rem auto;
            max-width: 320px;
            outline: none;
            padding: 0.8rem 3rem;
            text-align: center;
            -webkit-transition: .3s;
            transition: .3s;
            width: 80%;
        }

        .login-box a:hover {
            background: linear-gradient(90deg, #1ba005 0, #0ec851);
            color: #ffffff;
            border-radius: 5px;
        }

        .white-froce {
            width: 32%;
            display: flex;
            position: relative;
        }

        .white-froce img {
            width: 90px;
        }

        .logo-box {
            max-width: none !important;
            animation: rotateY-anim 2s linear infinite;
            position: absolute;
            top: -40%;
            right: 20%;
            width: 55px !important;
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

        .lower-box {
            display: flex;
            justify-content: start;
            width: 105%;
            margin-top: -30px;
            margin-left: 40px;
        }

        .first-lower {
            width: 15%;
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .first-lower p {
            color: #212529;
            font-family: "Lato", sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
        }

        .first-lower img {
            background: #fff;
            border-radius: 4px;
            -webkit-box-shadow: 0 2px 10px 0 rgba(0, 0, 0, .15);
            /* box-shadow: 0 2px 10px 10px rgba(0,0,0,.15); */

            margin-right: 10px;
            width: 15px;
        }






        .login-mangools__card {
            -webkit-animation: fadein .6s ease-in;
            animation: fadeIn .6s ease-in;
            /* background: #fff; */
            border-radius: 4px;
            /* -webkit-box-shadow: 0 10px 30px 0 rgba(0, 0, 0, .1); */
            /* box-shadow: 0 10px 30px 0 rgba(0, 0, 0, .1); */
            margin: 2rem;
            max-width: 456px;
            padding: 1.8rem 2rem;
            width: 100%;
        }

        .flex-col {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
        }

        .flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
        }

        .card__list {
            margin-bottom: 1rem;
        }

        .card__label {
            color: #7c7d80;
            font-size: .875rem;
            margin: 0.5rem 0;
        }

        .relative {
            position: relative;
        }

        .absolute {
            position: absolute;
        }

        .card__icon {
            padding: 0.75rem 1rem 1rem;
        }

        .card__input {
            border: 1px solid #acacad;
            font-size: 1.125rem;
            font-weight: 500;
            line-height: 28px;
            outline: none;
            padding: 0.5rem 1rem 0.5rem 3rem;
            width: 100%;
        }

        .card__label {
            color: #7c7d80;
            font-size: .875rem;
            margin: 0.5rem 0;
        }


        .card__sign-in {
            background: -webkit-gradient(linear, left top, right top, color-stop(0, #1ba005), to(#0ec851));
            background: linear-gradient(90deg, #1ba005 0, #0ec851);
            border: none;
            border-radius: 24px;
            -webkit-box-shadow: 0 2px 4px 0 rgba(27, 160, 5, .2);
            box-shadow: 0 2px 4px 0 rgba(27, 160, 5, .2);
            color: #fff;
            font-size: 1.125rem;
            font-weight: 600;
            margin: 1rem auto;
            max-width: 320px;
            outline: none;
            padding: 0.8rem 3rem;
            text-align: center;
            -webkit-transition: .3s;
            transition: .3s;
            width: 100%;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.css"
        integrity="sha512-arPZ7r4v4xEkxAQngubdkUNXFBVO8NFFRg1IszNv2AMaaZ9cDiCVRFGSZSjF7o5GHpm826QTqtNdOFNSnHbOYQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
         <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>

<body style="font-family: 'Questrial', sans-serif !important;">
    <section class="f-container">
        <div class="inner-box">
            <div class="heading animate__animated animate__fadeInBottomLeft">
                <div class="white-froce">
                    <img src="{{ url('login_page') }}/images/whiteforcelogo_portrait_color.png" alt="">

                    <img class="logo-box" src="{{ url('login_page') }}/images/plusLogo.png" alt="">

                </div>
                <h1><b>Good to see you again</b></h1>
                <div class="login-mangools__card" style="margin-right:19%;">

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

                        <div align="center">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="color:red">{{ $message }}
                            </span>
                            @enderror

                        </div>




                        <button style="cursor: pointer;" class="card__sign-in">Sign
                            In</button>
                        {{-- <div class="flex justify-evenly"> <a href="#" class="card__url">Don't have an
                                account?</a>
                            <a href="#" class="card__url">Forgot
                                password?</a>
                        </div> --}}
                    </form>
                </div>
                {{-- <div class="email-pass">
                    <div class="email-box login-box">
                        <form style="width: 100%; margin-top: 55px;">
                            <div class="user-box">
                                <input type="text" name="" required="">
                                <label>Your Email</label>
                            </div>
                            <div class="user-box">
                                <input type="password" name="" required="">
                                <label>Your Password</label>
                            </div>

                            <a href="#">
                                Sign In
                            </a>
                        </form>
                    </div>
                </div> --}}
                <br>

                <div class="lower-box">
                    <div class="first-lower">
                        <img src="{{ url('login_page') }}/images/logo-1.51d6f935.svg" alt="">
                        <p>Onrole</p>
                    </div>
                    <div class="first-lower">
                        <img src="{{ url('login_page') }}/images/logo-2.4a0a00ae.svg" alt="">
                        <p>Offrole</p>
                    </div>
                    <div class="first-lower" style="width: 36.8%;">
                        <img src="{{ url('login_page') }}/images/logo-3.5847dc0b.svg" alt="">
                        <p> Franchise Onrole / Offrole</p>
                    </div>

                    <div class="first-lower">
                        <img src="{{ url('login_page') }}/images/logo-5.9a5bd140.svg" alt="">
                        <p>Training</p>
                    </div>
                </div>
            </div>
            <div class="r-images">
                <div class="dark-one"></div>
                <div class="dark-two"></div>
                <div class="dark-three"></div>
                <div class="dark-four"></div>
                <div class="inner-img">
                    <div class="top-image">
                        <img src="{{ url('login_page') }}/images/1img.png" alt="">
                        <img src="{{ url('login_page') }}/images/2img.png" alt="">
                        <img src="{{ url('login_page') }}/images/3img.png" alt="">
                        <img src="{{ url('login_page') }}/images/4img.png" alt="">
                    </div>
                    <div class="top-image">
                        <img src="{{ url('login_page') }}/images/2img.png" alt="">
                        <img src="{{ url('login_page') }}/images/3img.png" alt="">
                        <img src="{{ url('login_page') }}/images/4img.png" alt="">
                        <img src="{{ url('login_page') }}/images/1img.png" alt="">
                    </div>
                    <div class="top-image">
                        <img src="{{ url('login_page') }}/images/3img.png" alt="">
                        <img src="{{ url('login_page') }}/images/4img.png" alt="">
                        <img src="{{ url('login_page') }}/images/1img.png" alt="">
                        <img src="{{ url('login_page') }}/images/2img.png" alt="">
                    </div>
                    <div class="top-image">
                        <img src="{{ url('login_page') }}/images/4img.png" alt="">
                        <img src="{{ url('login_page') }}/images/1img.png" alt="">
                        <img src="{{ url('login_page') }}/images/2img.png" alt="">
                        <img src="{{ url('login_page') }}/images/3img.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
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
