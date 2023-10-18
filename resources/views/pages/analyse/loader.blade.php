{{-- <div id="parseLoader" class="container" style="margin-top: 5rem !important;" align="center"> --}} <style>
        .modal-body {
            padding: 0px !important;
            overflow: hidden !important;
        }

        .progress-title {
            font-size: 16px;
            font-weight: 700;
            color: #333;
            margin: 0 0 20px
        }

        .progress {
            height: 20px !important;
            background: #333;
            border-radius: 0;
            box-shadow: none;
            margin-bottom: 30px;
            overflow: visible
        }

        .progress .progress-bar {
            position: relative;
            -webkit-animation: animate-positive 2s;
            animation: animate-positive 2s
        }

        .progress .progress-value {
            display: block;
            font-size: 18px;
            font-weight: 500;
            color: black;
            position: absolute;
            top: -30px;
            right: -25px
        }

        .progress .progress-bar:after {
            content: "";
            display: inline-block;
            width: 10px;
            /* background: #fff; */
            position: absolute;
            top: -10px;
            bottom: -10px;
            right: -5px;
            z-index: 1;
            /* transform: rotate(35deg) */
        }

        h1 {
            text-align: center
        }
    </style>
    <div id="parseLoader" align="center" style="margin-top: 10px !important; margin-bottom: -90px !important;">
        <div style=" padding-top: 45px; padding-right: 25px; padding-left: 25px; ">
            <h3 style="line-height: 0;">Please Wait</h3>
            <p></p>
            <p style="line-height: 3;">We are working on your profile we will shortly get back to you!!</p>
              <div class="text">
                
            </div> <img class="" height="250" src="{{ url('newll.gif') }}" alt="">
            <p></p>
            <div>
                <div class="progress-value pull-right">
                    <div class="h2 font-weight-bold"> <span id="parse-value" style="color:#c49537"></span><sup
                            class="small">%</sup></div>
                </div>
            </div>
            <div class="progress" role="progressbar" aria-label="Warning example" aria-valuemin="0" aria-valuemax="100">
                <div class="progress-bar bg-warning" style="width: 0%"></div>
            </div>
        </div>
        <div style="min-height: 325px;
        background-color: #9a98f112;
        margin-top: -240px;"></div>
    </div> 