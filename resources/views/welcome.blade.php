<head>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ url('assets') }}/images/favicon.png">
    <title>Welcome to White Force</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap");

    /**
    * get random number.
    * @param {number} min - min number.
    * @param {number} max - max number.
    */
    /*
    * variable
    */
    html,
    body {
        height: 100vh;
        width: 100vw;
    }

    body {
        font-family: 'Montserrat', sans-serif;
        background: #fff;
        position: relative;
        overflow: hidden;
        font-size: 100%;
        text-align: center;
    }

    .criterion {
        font-size: 1.6rem;
        position: absolute;
        top: 50%;
        left: 50%;
        height: 0;
        width: 0;
        transform: translate(-20px, -20px);
    }

    /*
    * background
    */
    .background {
        position: absolute;
        top: 0;
        height: 100vh;
        width: 0;
        -webkit-animation: background-animation 2s ease-in-out 4s 1 normal forwards;
        animation: background-animation 2s ease-in-out 4s 1 normal forwards;
    }

    .background0 {
        left: 0%;
        height: 100vh;
        background-color: #eb4747;
    }

    .background1 {
        left: 12.5%;
        height: 100vh;
        background-color: #eba047;
    }

    .background2 {
        left: 25%;
        height: 100vh;
        background-color: #dceb47;
    }

    .background3 {
        left: 37.5%;
        height: 100vh;
        background-color: #83eb47;
    }

    .background4 {
        left: 50%;
        height: 100vh;
        background-color: #47eb65;
    }

    .background5 {
        left: 62.5%;
        height: 100vh;
        background-color: #47ebbe;
    }

    .background6 {
        left: 75%;
        height: 100vh;
        background-color: #47beeb;
    }

    .background7 {
        left: 87.5%;
        height: 100vh;
        background-color: #4765eb;
    }

    .background8 {
        left: 100%;
        height: 100vh;
        background-color: #8347eb;
    }

    .background9 {
        left: 112.5%;
        height: 100vh;
        background-color: #dc47eb;
    }

    .background10 {
        left: 125%;
        height: 100vh;
        background-color: #eb47a0;
    }

    .background11 {
        left: 137.5%;
        height: 100vh;
        background-color: #eb4747;
    }

    /*
    * text
    */
    .text {
        position: absolute;
        width: 40px;
        line-height: 40px;
        opacity: 0;
        overflow: hidden;
        font-weight: 900;
        font-size: 35px;
    }

    .text::after {
        z-index: -1;
        content: '';
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        width: 0;
        height: 40px;
    }

    .text0 {
        left: -200px;
        top: 0;
        -webkit-animation: text-animation0 1s ease-in-out 1s 1 normal forwards,
            text2-animation0 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation0 1s ease-in-out 1s 1 normal forwards, text2-animation0 2s ease-in-out 5s 1 normal forwards;
    }

    .text0::after {
        -webkit-animation: text-after-animation0 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation0 2s ease-in-out 3s 1 normal forwards;
    }

    .text1 {
        left: -160px;
        top: 0;
        -webkit-animation: text-animation1 1s ease-in-out 1.2s 1 normal forwards,
            text2-animation1 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation1 1s ease-in-out 1.2s 1 normal forwards,
            text2-animation1 2s ease-in-out 5s 1 normal forwards;
    }

    .text1::after {
        -webkit-animation: text-after-animation1 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation1 2s ease-in-out 3s 1 normal forwards;
    }

    .text2 {
        left: -120px;
        top: 0;
        -webkit-animation: text-animation2 1s ease-in-out 1.4s 1 normal forwards,
            text2-animation2 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation2 1s ease-in-out 1.4s 1 normal forwards,
            text2-animation2 2s ease-in-out 5s 1 normal forwards;
    }

    .text2::after {
        -webkit-animation: text-after-animation2 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation2 2s ease-in-out 3s 1 normal forwards;
    }

    .text3 {
        left: -80px;
        top: 0;
        -webkit-animation: text-animation3 1s ease-in-out 1.6s 1 normal forwards,
            text2-animation3 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation3 1s ease-in-out 1.6s 1 normal forwards,
            text2-animation3 2s ease-in-out 5s 1 normal forwards;
    }

    .text3::after {
        -webkit-animation: text-after-animation3 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation3 2s ease-in-out 3s 1 normal forwards;
    }

    .text4 {
        left: -40px;
        top: 0;
        -webkit-animation: text-animation4 1s ease-in-out 1.8s 1 normal forwards,
            text2-animation4 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation4 1s ease-in-out 1.8s 1 normal forwards,
            text2-animation4 2s ease-in-out 5s 1 normal forwards;
    }

    .text4::after {
        -webkit-animation: text-after-animation4 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation4 2s ease-in-out 3s 1 normal forwards;
    }

    .text5 {
        left: 0px;
        top: 0;
        -webkit-animation: text-animation5 1s ease-in-out 2s 1 normal forwards,
            text2-animation5 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation5 1s ease-in-out 2s 1 normal forwards, text2-animation5 2s ease-in-out 5s 1 normal forwards;
    }

    .text5::after {
        -webkit-animation: text-after-animation5 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation5 2s ease-in-out 3s 1 normal forwards;
    }

    .text6 {
        left: 40px;
        top: 0;
        -webkit-animation: text-animation6 1s ease-in-out 2.2s 1 normal forwards,
            text2-animation6 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation6 1s ease-in-out 2.2s 1 normal forwards,
            text2-animation6 2s ease-in-out 5s 1 normal forwards;
    }

    .text6::after {
        -webkit-animation: text-after-animation6 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation6 2s ease-in-out 3s 1 normal forwards;
    }

    .text7 {
        left: 80px;
        top: 0;
        -webkit-animation: text-animation7 1s ease-in-out 2.4s 1 normal forwards,
            text2-animation7 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation7 1s ease-in-out 2.4s 1 normal forwards,
            text2-animation7 2s ease-in-out 5s 1 normal forwards;
    }

    .text7::after {
        -webkit-animation: text-after-animation7 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation7 2s ease-in-out 3s 1 normal forwards;
    }

    .text8 {
        left: 120px;
        top: 0;
        -webkit-animation: text-animation8 1s ease-in-out 2.6s 1 normal forwards,
            text2-animation8 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation8 1s ease-in-out 2.6s 1 normal forwards,
            text2-animation8 2s ease-in-out 5s 1 normal forwards;
    }

    .text8::after {
        -webkit-animation: text-after-animation8 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation8 2s ease-in-out 3s 1 normal forwards;
    }

    .text9 {
        left: 160px;
        top: 0;
        -webkit-animation: text-animation9 1s ease-in-out 2.8s 1 normal forwards,
            text2-animation9 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation9 1s ease-in-out 2.8s 1 normal forwards,
            text2-animation9 2s ease-in-out 5s 1 normal forwards;
    }

    .text9::after {
        -webkit-animation: text-after-animation9 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation9 2s ease-in-out 3s 1 normal forwards;
    }

    .text10 {
        left: 200px;
        top: 0;
        font-size: 28px;
        -webkit-animation: text-animation10 1s ease-in-out 3s 1 normal forwards,
            text2-animation10 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation10 1s ease-in-out 3s 1 normal forwards,
            text2-animation10 2s ease-in-out 5s 1 normal forwards;
    }

    .text10::after {
        -webkit-animation: text-after-animation10 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation10 2s ease-in-out 3s 1 normal forwards;
    }

    .text11 {
        left: 240px;
        top: 0;
        -webkit-animation: text-animation11 1s ease-in-out 3.2s 1 normal forwards,
            text2-animation11 2s ease-in-out 5s 1 normal forwards;
        animation: text-animation11 1s ease-in-out 3.2s 1 normal forwards,
            text2-animation11 2s ease-in-out 5s 1 normal forwards;
    }

    .text11::after {
        -webkit-animation: text-after-animation11 2s ease-in-out 3s 1 normal forwards;
        animation: text-after-animation11 2s ease-in-out 3s 1 normal forwards;
    }

    @-webkit-keyframes text-animation0 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation0 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation1 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation1 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation2 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation2 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation3 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation3 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation4 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation4 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation5 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation5 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation6 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation6 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation7 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation7 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation8 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation8 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation9 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation9 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation10 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation10 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-animation11 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @keyframes text-animation11 {
        0% {
            transform: scale(0, 0);
            opacity: 0;
        }

        50% {
            transform: scale(3, 3);
        }

        100% {
            transform: scale(1, 1);
            opacity: 1;
        }
    }

    @-webkit-keyframes text-after-animation0 {
        0% {
            width: 0px;
            background-color: #eb4747;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation0 {
        0% {
            width: 0px;
            background-color: #eb4747;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation1 {
        0% {
            width: 0px;
            background-color: #eba047;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation1 {
        0% {
            width: 0px;
            background-color: #eba047;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation2 {
        0% {
            width: 0px;
            background-color: #dceb47;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation2 {
        0% {
            width: 0px;
            background-color: #dceb47;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation3 {
        0% {
            width: 0px;
            background-color: #83eb47;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation3 {
        0% {
            width: 0px;
            background-color: #83eb47;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation4 {
        0% {
            width: 0px;
            background-color: #47eb65;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation4 {
        0% {
            width: 0px;
            background-color: #47eb65;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation5 {
        0% {
            width: 0px;
            background-color: #47ebbe;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation5 {
        0% {
            width: 0px;
            background-color: #47ebbe;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation6 {
        0% {
            width: 0px;
            background-color: #47beeb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation6 {
        0% {
            width: 0px;
            background-color: #47beeb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation7 {
        0% {
            width: 0px;
            background-color: #4765eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation7 {
        0% {
            width: 0px;
            background-color: #4765eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation8 {
        0% {
            width: 0px;
            background-color: #8347eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation8 {
        0% {
            width: 0px;
            background-color: #8347eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation9 {
        0% {
            width: 0px;
            background-color: #dc47eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation9 {
        0% {
            width: 0px;
            background-color: #dc47eb;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation10 {
        0% {
            width: 0px;
            background-color: #eb47a0;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation10 {
        0% {
            width: 0px;
            background-color: #eb47a0;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text-after-animation11 {
        0% {
            width: 0px;
            background-color: #eb4747;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text-after-animation11 {
        0% {
            width: 0px;
            background-color: #eb4747;
            opacity: 1;
        }

        50% {
            width: 40px;
            opacity: 1;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation0 {
        0% {
            left: -200px;
            opacity: 1;
        }

        50% {
            left: -160px;
            opacity: 0;
        }

        100% {
            left: -160px;
            opacity: 0;
        }
    }

    @keyframes text2-animation0 {
        0% {
            left: -200px;
            opacity: 1;
        }

        50% {
            left: -160px;
            opacity: 0;
        }

        100% {
            left: -160px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation1 {
        0% {
            left: -160px;
            opacity: 1;
        }

        50% {
            left: -120px;
            opacity: 0;
        }

        100% {
            left: -120px;
            opacity: 0;
        }
    }

    @keyframes text2-animation1 {
        0% {
            left: -160px;
            opacity: 1;
        }

        50% {
            left: -120px;
            opacity: 0;
        }

        100% {
            left: -120px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation2 {
        0% {
            left: -120px;
            opacity: 1;
        }

        50% {
            left: -80px;
            opacity: 0;
        }

        100% {
            left: -80px;
            opacity: 0;
        }
    }

    @keyframes text2-animation2 {
        0% {
            left: -120px;
            opacity: 1;
        }

        50% {
            left: -80px;
            opacity: 0;
        }

        100% {
            left: -80px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation3 {
        0% {
            left: -80px;
            opacity: 1;
        }

        50% {
            left: -40px;
            opacity: 0;
        }

        100% {
            left: -40px;
            opacity: 0;
        }
    }

    @keyframes text2-animation3 {
        0% {
            left: -80px;
            opacity: 1;
        }

        50% {
            left: -40px;
            opacity: 0;
        }

        100% {
            left: -40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation4 {
        0% {
            left: -40px;
            opacity: 1;
        }

        50% {
            left: 0px;
            opacity: 0;
        }

        100% {
            left: 0px;
            opacity: 0;
        }
    }

    @keyframes text2-animation4 {
        0% {
            left: -40px;
            opacity: 1;
        }

        50% {
            left: 0px;
            opacity: 0;
        }

        100% {
            left: 0px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation5 {
        0% {
            left: 0px;
            opacity: 1;
        }

        50% {
            left: 40px;
            opacity: 0;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @keyframes text2-animation5 {
        0% {
            left: 0px;
            opacity: 1;
        }

        50% {
            left: 40px;
            opacity: 0;
        }

        100% {
            left: 40px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation6 {
        0% {
            left: 40px;
            opacity: 1;
        }

        50% {
            left: 80px;
            opacity: 0;
        }

        100% {
            left: 80px;
            opacity: 0;
        }
    }

    @keyframes text2-animation6 {
        0% {
            left: 40px;
            opacity: 1;
        }

        50% {
            left: 80px;
            opacity: 0;
        }

        100% {
            left: 80px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation7 {
        0% {
            left: 80px;
            opacity: 1;
        }

        50% {
            left: 120px;
            opacity: 0;
        }

        100% {
            left: 120px;
            opacity: 0;
        }
    }

    @keyframes text2-animation7 {
        0% {
            left: 80px;
            opacity: 1;
        }

        50% {
            left: 120px;
            opacity: 0;
        }

        100% {
            left: 120px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation8 {
        0% {
            left: 120px;
            opacity: 1;
        }

        50% {
            left: 160px;
            opacity: 0;
        }

        100% {
            left: 160px;
            opacity: 0;
        }
    }

    @keyframes text2-animation8 {
        0% {
            left: 120px;
            opacity: 1;
        }

        50% {
            left: 160px;
            opacity: 0;
        }

        100% {
            left: 160px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation9 {
        0% {
            left: 160px;
            opacity: 1;
        }

        50% {
            left: 200px;
            opacity: 0;
        }

        100% {
            left: 200px;
            opacity: 0;
        }
    }

    @keyframes text2-animation9 {
        0% {
            left: 160px;
            opacity: 1;
        }

        50% {
            left: 200px;
            opacity: 0;
        }

        100% {
            left: 200px;
            opacity: 0;
        }
    }

    @-webkit-keyframes text2-animation10 {
        0% {
            left: 200px;
            opacity: 1;
            top: 0;
            transform: scale(1, 1);
        }

        50% {
            left: 240px;
            opacity: 1;
            transform: scale(1, 1);
        }

        65% {
            top: 0;
            transform: scale(1, 1);
        }

        70% {
            transform: scale(3, 3) rotate(90deg);
            top: -30px;
        }

        75% {
            left: 240px;
            top: 0;
            opacity: 1;
            transform: scale(2, 2) rotate(90deg);
        }

        85% {
            left: 240px;
        }

        100% {
            left: 1000px;
            opacity: 0;
            transform: scale(2, 2) rotate(90deg);
        }
    }

    @keyframes text2-animation10 {
        0% {
            left: 200px;
            opacity: 1;
            top: 0;
            transform: scale(1, 1);
        }

        50% {
            left: 240px;
            opacity: 1;
            transform: scale(1, 1);
        }

        65% {
            top: 0;
            transform: scale(1, 1);
        }

        70% {
            transform: scale(3, 3) rotate(90deg);
            top: -30px;
        }

        75% {
            left: 240px;
            top: 0;
            opacity: 1;
            transform: scale(2, 2) rotate(90deg);
        }

        85% {
            left: 240px;
        }

        100% {
            left: 1000px;
            opacity: 0;
            transform: scale(2, 2) rotate(90deg);
        }
    }

    @-webkit-keyframes text2-animation11 {
        0% {
            left: 240px;
            opacity: 1;
        }

        50% {
            left: 280px;
            opacity: 0;
        }

        100% {
            left: 280px;
            opacity: 0;
        }
    }

    @keyframes text2-animation11 {
        0% {
            left: 240px;
            opacity: 1;
        }

        50% {
            left: 280px;
            opacity: 0;
        }

        100% {
            left: 280px;
            opacity: 0;
        }
    }

    /*
    * frame
    */
    .frame {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        opacity: 0;
    }

    .frame0 {
        left: -200px;
        top: 0;
        -webkit-animation: frame-animation0 1s ease-in-out 0ms 1 normal forwards;
        animation: frame-animation0 1s ease-in-out 0ms 1 normal forwards;
        background-color: #eb4747;
    }

    .frame1 {
        left: -160px;
        top: 0;
        -webkit-animation: frame-animation1 1s ease-in-out 200ms 1 normal forwards;
        animation: frame-animation1 1s ease-in-out 200ms 1 normal forwards;
        background-color: #eba047;
    }

    .frame2 {
        left: -120px;
        top: 0;
        -webkit-animation: frame-animation2 1s ease-in-out 400ms 1 normal forwards;
        animation: frame-animation2 1s ease-in-out 400ms 1 normal forwards;
        background-color: #dceb47;
    }

    .frame3 {
        left: -80px;
        top: 0;
        -webkit-animation: frame-animation3 1s ease-in-out 600ms 1 normal forwards;
        animation: frame-animation3 1s ease-in-out 600ms 1 normal forwards;
        background-color: #83eb47;
    }

    .frame4 {
        left: -40px;
        top: 0;
        -webkit-animation: frame-animation4 1s ease-in-out 800ms 1 normal forwards;
        animation: frame-animation4 1s ease-in-out 800ms 1 normal forwards;
        background-color: #47eb65;
    }

    .frame5 {
        left: 0px;
        top: 0;
        -webkit-animation: frame-animation5 1s ease-in-out 1000ms 1 normal forwards;
        animation: frame-animation5 1s ease-in-out 1000ms 1 normal forwards;
        background-color: #47ebbe;
    }

    .frame6 {
        left: 40px;
        top: 0;
        -webkit-animation: frame-animation6 1s ease-in-out 1200ms 1 normal forwards;
        animation: frame-animation6 1s ease-in-out 1200ms 1 normal forwards;
        background-color: #47beeb;
    }

    .frame7 {
        left: 80px;
        top: 0;
        -webkit-animation: frame-animation7 1s ease-in-out 1400ms 1 normal forwards;
        animation: frame-animation7 1s ease-in-out 1400ms 1 normal forwards;
        background-color: #4765eb;
    }

    .frame8 {
        left: 120px;
        top: 0;
        -webkit-animation: frame-animation8 1s ease-in-out 1600ms 1 normal forwards;
        animation: frame-animation8 1s ease-in-out 1600ms 1 normal forwards;
        background-color: #8347eb;
    }

    .frame9 {
        left: 160px;
        top: 0;
        -webkit-animation: frame-animation9 1s ease-in-out 1800ms 1 normal forwards;
        animation: frame-animation9 1s ease-in-out 1800ms 1 normal forwards;
        background-color: #dc47eb;
    }

    .frame10 {
        left: 200px;
        top: 0;
        -webkit-animation: frame-animation10 1s ease-in-out 2000ms 1 normal forwards;
        animation: frame-animation10 1s ease-in-out 2000ms 1 normal forwards;
        background-color: #eb47a0;
    }

    .frame11 {
        left: 240px;
        top: 0;
        -webkit-animation: frame-animation11 1s ease-in-out 2200ms 1 normal forwards;
        animation: frame-animation11 1s ease-in-out 2200ms 1 normal forwards;
        background-color: #eb4747;
    }

    @-webkit-keyframes frame-animation0 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation0 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation1 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation1 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation2 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation2 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation3 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation3 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation4 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation4 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation5 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation5 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation6 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation6 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation7 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation7 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation8 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation8 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation9 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation9 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation10 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation10 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @-webkit-keyframes frame-animation11 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    @keyframes frame-animation11 {
        0% {
            transform: translateY(-1000px);
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }

        100% {
            transform: translateY(0);
            opacity: 0;
        }
    }

    /*
    * particle
    */
    .particle {
        position: absolute;
        width: 40px;
        height: 40px;
        border-radius: 50%;
    }

    .particle00 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation00 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation00 1s ease-in-out 1s 1 normal forwards;
    }

    .particle01 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation01 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation01 1s ease-in-out 1s 1 normal forwards;
    }

    .particle02 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation02 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation02 1s ease-in-out 1s 1 normal forwards;
    }

    .particle03 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation03 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation03 1s ease-in-out 1s 1 normal forwards;
    }

    .particle04 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation04 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation04 1s ease-in-out 1s 1 normal forwards;
    }

    .particle05 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation05 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation05 1s ease-in-out 1s 1 normal forwards;
    }

    .particle06 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation06 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation06 1s ease-in-out 1s 1 normal forwards;
    }

    .particle07 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation07 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation07 1s ease-in-out 1s 1 normal forwards;
    }

    .particle08 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation08 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation08 1s ease-in-out 1s 1 normal forwards;
    }

    .particle09 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation09 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation09 1s ease-in-out 1s 1 normal forwards;
    }

    .particle010 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation010 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation010 1s ease-in-out 1s 1 normal forwards;
    }

    .particle011 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation011 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation011 1s ease-in-out 1s 1 normal forwards;
    }

    .particle012 {
        left: -200px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation012 1s ease-in-out 1s 1 normal forwards;
        animation: particle-animation012 1s ease-in-out 1s 1 normal forwards;
    }

    .particle10 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation10 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation10 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle11 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation11 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation11 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle12 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation12 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation12 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle13 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation13 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation13 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle14 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation14 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation14 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle15 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation15 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation15 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle16 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation16 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation16 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle17 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation17 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation17 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle18 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation18 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation18 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle19 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation19 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation19 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle110 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation110 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation110 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle111 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation111 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation111 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle112 {
        left: -160px;
        opacity: 0;
        background-color: #eba047;
        -webkit-animation: particle-animation112 1s ease-in-out 1.2s 1 normal forwards;
        animation: particle-animation112 1s ease-in-out 1.2s 1 normal forwards;
    }

    .particle20 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation20 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation20 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle21 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation21 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation21 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle22 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation22 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation22 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle23 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation23 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation23 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle24 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation24 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation24 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle25 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation25 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation25 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle26 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation26 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation26 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle27 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation27 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation27 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle28 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation28 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation28 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle29 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation29 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation29 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle210 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation210 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation210 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle211 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation211 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation211 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle212 {
        left: -120px;
        opacity: 0;
        background-color: #dceb47;
        -webkit-animation: particle-animation212 1s ease-in-out 1.4s 1 normal forwards;
        animation: particle-animation212 1s ease-in-out 1.4s 1 normal forwards;
    }

    .particle30 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation30 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation30 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle31 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation31 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation31 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle32 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation32 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation32 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle33 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation33 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation33 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle34 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation34 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation34 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle35 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation35 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation35 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle36 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation36 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation36 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle37 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation37 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation37 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle38 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation38 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation38 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle39 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation39 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation39 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle310 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation310 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation310 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle311 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation311 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation311 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle312 {
        left: -80px;
        opacity: 0;
        background-color: #83eb47;
        -webkit-animation: particle-animation312 1s ease-in-out 1.6s 1 normal forwards;
        animation: particle-animation312 1s ease-in-out 1.6s 1 normal forwards;
    }

    .particle40 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation40 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation40 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle41 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation41 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation41 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle42 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation42 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation42 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle43 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation43 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation43 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle44 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation44 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation44 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle45 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation45 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation45 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle46 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation46 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation46 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle47 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation47 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation47 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle48 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation48 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation48 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle49 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation49 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation49 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle410 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation410 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation410 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle411 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation411 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation411 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle412 {
        left: -40px;
        opacity: 0;
        background-color: #47eb65;
        -webkit-animation: particle-animation412 1s ease-in-out 1.8s 1 normal forwards;
        animation: particle-animation412 1s ease-in-out 1.8s 1 normal forwards;
    }

    .particle50 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation50 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation50 1s ease-in-out 2s 1 normal forwards;
    }

    .particle51 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation51 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation51 1s ease-in-out 2s 1 normal forwards;
    }

    .particle52 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation52 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation52 1s ease-in-out 2s 1 normal forwards;
    }

    .particle53 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation53 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation53 1s ease-in-out 2s 1 normal forwards;
    }

    .particle54 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation54 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation54 1s ease-in-out 2s 1 normal forwards;
    }

    .particle55 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation55 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation55 1s ease-in-out 2s 1 normal forwards;
    }

    .particle56 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation56 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation56 1s ease-in-out 2s 1 normal forwards;
    }

    .particle57 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation57 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation57 1s ease-in-out 2s 1 normal forwards;
    }

    .particle58 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation58 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation58 1s ease-in-out 2s 1 normal forwards;
    }

    .particle59 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation59 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation59 1s ease-in-out 2s 1 normal forwards;
    }

    .particle510 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation510 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation510 1s ease-in-out 2s 1 normal forwards;
    }

    .particle511 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation511 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation511 1s ease-in-out 2s 1 normal forwards;
    }

    .particle512 {
        left: 0px;
        opacity: 0;
        background-color: #47ebbe;
        -webkit-animation: particle-animation512 1s ease-in-out 2s 1 normal forwards;
        animation: particle-animation512 1s ease-in-out 2s 1 normal forwards;
    }

    .particle60 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation60 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation60 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle61 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation61 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation61 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle62 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation62 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation62 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle63 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation63 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation63 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle64 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation64 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation64 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle65 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation65 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation65 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle66 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation66 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation66 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle67 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation67 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation67 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle68 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation68 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation68 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle69 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation69 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation69 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle610 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation610 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation610 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle611 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation611 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation611 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle612 {
        left: 40px;
        opacity: 0;
        background-color: #47beeb;
        -webkit-animation: particle-animation612 1s ease-in-out 2.2s 1 normal forwards;
        animation: particle-animation612 1s ease-in-out 2.2s 1 normal forwards;
    }

    .particle70 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation70 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation70 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle71 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation71 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation71 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle72 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation72 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation72 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle73 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation73 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation73 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle74 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation74 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation74 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle75 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation75 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation75 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle76 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation76 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation76 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle77 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation77 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation77 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle78 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation78 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation78 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle79 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation79 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation79 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle710 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation710 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation710 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle711 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation711 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation711 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle712 {
        left: 80px;
        opacity: 0;
        background-color: #4765eb;
        -webkit-animation: particle-animation712 1s ease-in-out 2.4s 1 normal forwards;
        animation: particle-animation712 1s ease-in-out 2.4s 1 normal forwards;
    }

    .particle80 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation80 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation80 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle81 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation81 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation81 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle82 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation82 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation82 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle83 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation83 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation83 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle84 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation84 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation84 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle85 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation85 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation85 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle86 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation86 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation86 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle87 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation87 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation87 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle88 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation88 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation88 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle89 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation89 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation89 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle810 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation810 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation810 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle811 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation811 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation811 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle812 {
        left: 120px;
        opacity: 0;
        background-color: #8347eb;
        -webkit-animation: particle-animation812 1s ease-in-out 2.6s 1 normal forwards;
        animation: particle-animation812 1s ease-in-out 2.6s 1 normal forwards;
    }

    .particle90 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation90 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation90 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle91 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation91 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation91 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle92 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation92 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation92 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle93 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation93 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation93 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle94 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation94 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation94 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle95 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation95 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation95 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle96 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation96 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation96 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle97 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation97 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation97 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle98 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation98 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation98 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle99 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation99 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation99 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle910 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation910 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation910 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle911 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation911 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation911 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle912 {
        left: 160px;
        opacity: 0;
        background-color: #dc47eb;
        -webkit-animation: particle-animation912 1s ease-in-out 2.8s 1 normal forwards;
        animation: particle-animation912 1s ease-in-out 2.8s 1 normal forwards;
    }

    .particle100 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation100 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation100 1s ease-in-out 3s 1 normal forwards;
    }

    .particle101 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation101 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation101 1s ease-in-out 3s 1 normal forwards;
    }

    .particle102 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation102 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation102 1s ease-in-out 3s 1 normal forwards;
    }

    .particle103 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation103 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation103 1s ease-in-out 3s 1 normal forwards;
    }

    .particle104 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation104 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation104 1s ease-in-out 3s 1 normal forwards;
    }

    .particle105 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation105 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation105 1s ease-in-out 3s 1 normal forwards;
    }

    .particle106 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation106 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation106 1s ease-in-out 3s 1 normal forwards;
    }

    .particle107 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation107 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation107 1s ease-in-out 3s 1 normal forwards;
    }

    .particle108 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation108 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation108 1s ease-in-out 3s 1 normal forwards;
    }

    .particle109 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation109 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation109 1s ease-in-out 3s 1 normal forwards;
    }

    .particle1010 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation1010 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation1010 1s ease-in-out 3s 1 normal forwards;
    }

    .particle1011 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation1011 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation1011 1s ease-in-out 3s 1 normal forwards;
    }

    .particle1012 {
        left: 200px;
        opacity: 0;
        background-color: #eb47a0;
        -webkit-animation: particle-animation1012 1s ease-in-out 3s 1 normal forwards;
        animation: particle-animation1012 1s ease-in-out 3s 1 normal forwards;
    }

    .particle110 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation110 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation110 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle111 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation111 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation111 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle112 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation112 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation112 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle113 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation113 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation113 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle114 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation114 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation114 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle115 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation115 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation115 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle116 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation116 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation116 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle117 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation117 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation117 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle118 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation118 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation118 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle119 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation119 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation119 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle1110 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation1110 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation1110 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle1111 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation1111 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation1111 1s ease-in-out 3.2s 1 normal forwards;
    }

    .particle1112 {
        left: 240px;
        opacity: 0;
        background-color: #eb4747;
        -webkit-animation: particle-animation1112 1s ease-in-out 3.2s 1 normal forwards;
        animation: particle-animation1112 1s ease-in-out 3.2s 1 normal forwards;
    }

    @-webkit-keyframes particle-animation00 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation00 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation01 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -113.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation01 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -113.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation02 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -150px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation02 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -150px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation03 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -200px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation03 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -200px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation04 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -250px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation04 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -250px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation05 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -286.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation05 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -286.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation06 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation06 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation07 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -286.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation07 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -286.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation08 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -250px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation08 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -250px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation09 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -200px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation09 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -200px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation010 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -150px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation010 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -150px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation011 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -113.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation011 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -113.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation012 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation012 {
        0% {
            left: -200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation10 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation10 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation11 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -73.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation11 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -73.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation12 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -110px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation12 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -110px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation13 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -160px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation13 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -160px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation14 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -210px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation14 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -210px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation15 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -246.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation15 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -246.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation16 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation16 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation17 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -246.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation17 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -246.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation18 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -210px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation18 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -210px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation19 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -160px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation19 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -160px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation110 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -110px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation110 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -110px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation111 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -73.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation111 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -73.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation112 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation112 {
        0% {
            left: -160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation20 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation20 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation21 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -33.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation21 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -33.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation22 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -70px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation22 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -70px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation23 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -120px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation23 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -120px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation24 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -170px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation24 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -170px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation25 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -206.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation25 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -206.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation26 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation26 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation27 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -206.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation27 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -206.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation28 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -170px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation28 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -170px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation29 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -120px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation29 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -120px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation210 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -70px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation210 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -70px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation211 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -33.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation211 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -33.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation212 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation212 {
        0% {
            left: -120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation30 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation30 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation31 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 6.602540400000009px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation31 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 6.602540400000009px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation32 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -30px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation32 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -30px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation33 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -80px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation33 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -80px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation34 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -130px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation34 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -130px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation35 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -166.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation35 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -166.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation36 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation36 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation37 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -166.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation37 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -166.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation38 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -130px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation38 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -130px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation39 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -80px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation39 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -80px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation310 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -30px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation310 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -30px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation311 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 6.602540400000009px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation311 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 6.602540400000009px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation312 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation312 {
        0% {
            left: -80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation40 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation40 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation41 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 46.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation41 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 46.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation42 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 10px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation42 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 10px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation43 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -40px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation43 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -40px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation44 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -90px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation44 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -90px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation45 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -126.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation45 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -126.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation46 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation46 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation47 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -126.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation47 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -126.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation48 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -90px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation48 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -90px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation49 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -40px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation49 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -40px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation410 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 10px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation410 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 10px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation411 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 46.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation411 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 46.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation412 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation412 {
        0% {
            left: -40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation50 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation50 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation51 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 86.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation51 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 86.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation52 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 50px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation52 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 50px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation53 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 0px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation53 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 0px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation54 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -50px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation54 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -50px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation55 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -86.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation55 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -86.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation56 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation56 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation57 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -86.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation57 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -86.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation58 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -50px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation58 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -50px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation59 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 0px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation59 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 0px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation510 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 50px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation510 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 50px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation511 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 86.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation511 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 86.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation512 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation512 {
        0% {
            left: 0px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation60 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation60 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation61 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 126.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation61 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 126.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation62 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 90px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation62 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 90px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation63 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 40px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation63 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 40px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation64 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -10px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation64 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -10px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation65 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -46.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation65 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -46.60254040000001px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation66 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation66 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation67 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -46.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation67 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -46.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation68 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -10px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation68 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -10px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation69 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 40px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation69 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 40px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation610 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 90px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation610 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 90px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation611 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 126.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation611 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 126.60254040000001px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation612 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation612 {
        0% {
            left: 40px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation70 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation70 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation71 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 166.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation71 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 166.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation72 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 130px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation72 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 130px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation73 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 80px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation73 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 80px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation74 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 30px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation74 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 30px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation75 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -6.602540400000009px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation75 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -6.602540400000009px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation76 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation76 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation77 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -6.602540400000009px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation77 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: -6.602540400000009px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation78 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 30px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation78 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 30px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation79 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 80px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation79 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 80px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation710 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 130px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation710 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 130px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation711 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 166.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation711 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 166.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation712 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation712 {
        0% {
            left: 80px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 180px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation80 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation80 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation81 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 206.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation81 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 206.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation82 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 170px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation82 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 170px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation83 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 120px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation83 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 120px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation84 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 70px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation84 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 70px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation85 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 33.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation85 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 33.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation86 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation86 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 20px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation87 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 33.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation87 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 33.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation88 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 70px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation88 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 70px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation89 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 120px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation89 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 120px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation810 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 170px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation810 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 170px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation811 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 206.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation811 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 206.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation812 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation812 {
        0% {
            left: 120px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 220px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation90 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation90 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation91 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 246.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation91 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 246.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation92 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 210px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation92 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 210px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation93 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 160px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation93 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 160px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation94 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 110px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation94 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 110px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation95 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 73.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation95 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 73.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation96 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation96 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 60px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation97 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 73.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation97 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 73.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation98 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 110px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation98 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 110px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation99 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 160px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation99 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 160px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation910 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 210px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation910 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 210px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation911 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 246.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation911 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 246.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation912 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation912 {
        0% {
            left: 160px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 260px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation100 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation100 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation101 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 286.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation101 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 286.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation102 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 250px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation102 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 250px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation103 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 200px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation103 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 200px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation104 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 150px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation104 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 150px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation105 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 113.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation105 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 113.39745959999999px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation106 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation106 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 100px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation107 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 113.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation107 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 113.39745959999999px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation108 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 150px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation108 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 150px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation109 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 200px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation109 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 200px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1010 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 250px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1010 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 250px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1011 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 286.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1011 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 286.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1012 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1012 {
        0% {
            left: 200px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 300px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation110 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 340px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation110 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 340px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation111 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 326.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation111 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 326.6025404px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation112 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 290px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation112 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 290px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation113 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 240px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation113 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 240px;
            top: 100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation114 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 190px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation114 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 190px;
            top: 86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation115 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 153.3974596px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation115 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 153.3974596px;
            top: 50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation116 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation116 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 140px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation117 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 153.3974596px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation117 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 153.3974596px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation118 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 190px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation118 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 190px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation119 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 240px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation119 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 240px;
            top: -100px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1110 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 290px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1110 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 290px;
            top: -86.60254040000001px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1111 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 326.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1111 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 326.6025404px;
            top: -50px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes particle-animation1112 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 340px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @keyframes particle-animation1112 {
        0% {
            left: 240px;
            top: 0;
            opacity: 0;
            transform: scale(1, 1);
        }

        100% {
            left: 340px;
            top: 0px;
            opacity: 1;
            transform: scale(0, 0);
        }
    }

    @-webkit-keyframes background-animation {
        0% {
            width: 0;
        }

        50% {
            width: 12.5%;
            opacity: 1;
        }

        100% {
            opacity: 0;
            width: 25%;
        }
    }

    @keyframes background-animation {
        0% {
            width: 0;
        }

        50% {
            width: 12.5%;
            opacity: 1;
        }

        100% {
            opacity: 0;
            width: 25%;
        }
    }
</style>
<div class="background background0"></div>
<div class="background background1"></div>
<div class="background background2"></div>
<div class="background background3"></div>
<div class="background background4"></div>
<div class="background background5"></div>
<div class="background background6"></div>
<div class="background background7"></div>
<div class="background background8"></div>
<div class="background background9"></div>
<div class="background background10"></div>
<div class="criterion">
    <div class="text text0">W</div>
    <div class="text text1">H</div>
    <div class="text text2">I</div>
    <div class="text text3">T</div>
    <div class="text text4">E</div>
    <div class="text text5">F</div>
    <div class="text text6">O</div>
    <div class="text text7">R</div>
    <div class="text text8">C</div>
    <div class="text text9">E</div>
    <div class="text text10">:)</div>
    <div class="frame frame0"></div>
    <div class="frame frame1"></div>
    <div class="frame frame2"></div>
    <div class="frame frame3"></div>
    <div class="frame frame4"></div>
    <div class="frame frame5"></div>
    <div class="frame frame6"></div>
    <div class="frame frame7"></div>
    <div class="frame frame8"></div>
    <div class="frame frame9"></div>
    <div class="frame frame10"></div>
    <div class="particle particle00"></div>
    <div class="particle particle01"></div>
    <div class="particle particle02"></div>
    <div class="particle particle03"></div>
    <div class="particle particle04"></div>
    <div class="particle particle05"></div>
    <div class="particle particle06"></div>
    <div class="particle particle07"></div>
    <div class="particle particle08"></div>
    <div class="particle particle09"></div>
    <div class="particle particle010"></div>
    <div class="particle particle011"></div>
    <div class="particle particle10"></div>
    <div class="particle particle11"></div>
    <div class="particle particle12"></div>
    <div class="particle particle13"></div>
    <div class="particle particle14"></div>
    <div class="particle particle15"></div>
    <div class="particle particle16"></div>
    <div class="particle particle17"></div>
    <div class="particle particle18"></div>
    <div class="particle particle19"></div>
    <div class="particle particle110"></div>
    <div class="particle particle111"></div>
    <div class="particle particle20"></div>
    <div class="particle particle21"></div>
    <div class="particle particle22"></div>
    <div class="particle particle23"></div>
    <div class="particle particle24"></div>
    <div class="particle particle25"></div>
    <div class="particle particle26"></div>
    <div class="particle particle27"></div>
    <div class="particle particle28"></div>
    <div class="particle particle29"></div>
    <div class="particle particle210"></div>
    <div class="particle particle211"></div>
    <div class="particle particle30"></div>
    <div class="particle particle31"></div>
    <div class="particle particle32"></div>
    <div class="particle particle33"></div>
    <div class="particle particle34"></div>
    <div class="particle particle35"></div>
    <div class="particle particle36"></div>
    <div class="particle particle37"></div>
    <div class="particle particle38"></div>
    <div class="particle particle39"></div>
    <div class="particle particle310"></div>
    <div class="particle particle311"></div>
    <div class="particle particle40"></div>
    <div class="particle particle41"></div>
    <div class="particle particle42"></div>
    <div class="particle particle43"></div>
    <div class="particle particle44"></div>
    <div class="particle particle45"></div>
    <div class="particle particle46"></div>
    <div class="particle particle47"></div>
    <div class="particle particle48"></div>
    <div class="particle particle49"></div>
    <div class="particle particle410"></div>
    <div class="particle particle411"></div>
    <div class="particle particle50"></div>
    <div class="particle particle51"></div>
    <div class="particle particle52"></div>
    <div class="particle particle53"></div>
    <div class="particle particle54"></div>
    <div class="particle particle55"></div>
    <div class="particle particle56"></div>
    <div class="particle particle57"></div>
    <div class="particle particle58"></div>
    <div class="particle particle59"></div>
    <div class="particle particle510"></div>
    <div class="particle particle511"></div>
    <div class="particle particle60"></div>
    <div class="particle particle61"></div>
    <div class="particle particle62"></div>
    <div class="particle particle63"></div>
    <div class="particle particle64"></div>
    <div class="particle particle65"></div>
    <div class="particle particle66"></div>
    <div class="particle particle67"></div>
    <div class="particle particle68"></div>
    <div class="particle particle69"></div>
    <div class="particle particle610"></div>
    <div class="particle particle611"></div>
    <div class="particle particle70"></div>
    <div class="particle particle71"></div>
    <div class="particle particle72"></div>
    <div class="particle particle73"></div>
    <div class="particle particle74"></div>
    <div class="particle particle75"></div>
    <div class="particle particle76"></div>
    <div class="particle particle77"></div>
    <div class="particle particle78"></div>
    <div class="particle particle79"></div>
    <div class="particle particle710"></div>
    <div class="particle particle711"></div>
    <div class="particle particle80"></div>
    <div class="particle particle81"></div>
    <div class="particle particle82"></div>
    <div class="particle particle83"></div>
    <div class="particle particle84"></div>
    <div class="particle particle85"></div>
    <div class="particle particle86"></div>
    <div class="particle particle87"></div>
    <div class="particle particle88"></div>
    <div class="particle particle89"></div>
    <div class="particle particle810"></div>
    <div class="particle particle811"></div>
    <div class="particle particle90"></div>
    <div class="particle particle91"></div>
    <div class="particle particle92"></div>
    <div class="particle particle93"></div>
    <div class="particle particle94"></div>
    <div class="particle particle95"></div>
    <div class="particle particle96"></div>
    <div class="particle particle97"></div>
    <div class="particle particle98"></div>
    <div class="particle particle99"></div>
    <div class="particle particle910"></div>
    <div class="particle particle911"></div>
    <div class="particle particle100"></div>
    <div class="particle particle101"></div>
    <div class="particle particle102"></div>
    <div class="particle particle103"></div>
    <div class="particle particle104"></div>
    <div class="particle particle105"></div>
    <div class="particle particle106"></div>
    <div class="particle particle107"></div>
    <div class="particle particle108"></div>
    <div class="particle particle109"></div>
    <div class="particle particle1010"></div>
    <div class="particle particle1011"></div>
</div>

<script>
    setTimeout(greet, 7200);

    function greet() {
        window.location = "{{ url('dashboard') }}";
    }
</script>