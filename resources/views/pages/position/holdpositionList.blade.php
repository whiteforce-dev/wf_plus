@extends('master.master')
@section('title', 'Position List')
@section('content')

<link rel="stylesheet" href="{{ url('assets') }}/vendor/select2/css/select2.min.css">
<link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">



<script src="{{ url('/') }}/assets/vendor/select2/js/select2.full.min.js"></script>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<style>
    .mwrapper {
        /* opacity: 0.6;*/
        /* border: 1px solid #ccc; */
        pointer-events: none;
    }

    .newJobDetailsBox {
        /* padding: 15px 0px; */
        /* border-top: 1px solid #00000012; */
        position: relative;
        left: 24px;
        /* border-bottom: 1px solid #00000012; */
        /* margin: 5px 0px; */
    }

    .page-item.active .page-link {
        background-color: #663399 !important;
        border-color: #663399 !important;
    }

    .blur {
        opacity: 1;
        font-size: 16px;
    }

    .ps {
        color: #110150;
        font-size: 16px;
    }

    .grpButton {
        /* width: 165px; */
        border-radius: 0;
    }

    .btn-group.special {
        display: flex;
    }

    .special .btn {
        flex: 1
    }

    .positionHeading {
        text-align: left;
        /* padding: 10px 18px; */
    }

    .c-position-div {
        padding: 28px 25px;
        background-color: white;
        margin-top: 20px;
        border-radius: 20px;
        height: auto;
        border: 6px solid #2161fb1c;
    }

    .btn {
        border-radius: 4px !important;
    }

    .btn-sm {
        padding: 6px 15px;
    }

    h1,
    .h1,
    h2,
    .h2,
    h3,
    .h3,
    h4,
    .h4,
    h5,
    .h5,
    h6,
    .h6 {
        color: #000;
        font-weight: 500;
    }

    .divCsearch .slide {
        position: absolute;
        right: 10%;
        top: 50%;
        width: max-content;
        border-radius: 8px;
        padding: 10px 7px;
        height: max-content;
        z-index: 1;
        transform: translateY(-50%);
        transition: all 0.3s ease-in-out;
        opacity: 0;
        box-shadow: 3px 3px 14px -7px #aaa;
        background: #ffffff;
        overflow: hidden;
    }

    .divCsearch .slide li {
        color: #e66025;
        padding: 7.5px 20px;
        cursor: pointer;
        outline: 1px dashed transparent;
        transition: all 0.3s ease-in-out;
        border-radius: 3px
    }

    .divCsearch .slide li:hover {
        outline: 1px dashed orange;
    }

    .divCsearch:hover .slide {
        opacity: 1;
        transform: translateY(-50%) translateX(calc(100% + 10px))
    }

    .posted {
        font-size: 22px;
        color: #8ccf24;
    }

    .not-posted {
        font-size: 22px;
        color: #d11313
    }

    .card-header {
        padding: 15px;
        background: #f5f5f4;
        border-radius: 15px;
        margin-top: 0px;
    }

    .hold {
        /* background: #fff; */
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 999;
        width: calc(100% - 50px);
    }

    .overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.6);
        z-index: 100;
        backdrop-filter: blur(5px);
        pointer-events: none;

    }

    .nav-tabs {
        border-bottom: none;
    }

    .nav-tabs .nav-item.show .nav-link {
        background-color: #f7f7f700 !important;
    }

    .custom-tab-1 .nav-link:focus,
    .custom-tab-1 .nav-link:hover,
    .custom-tab-1 .nav-link.active {
        background-color: #ffffff00;
    }
</style>





<link href="{{ url('assets/css/positionstyle.css') }}" rel="stylesheet">
<div class="content-body">
    <div class="container mt-0">
        @php
        $checktype = $type ?? 0;
        @endphp


        <div class="tab-content">
            <div class="tab-pane fade active show" id="position-section" role="tabpanel">
                <div class="pt-4">
                    <h3>&nbsp; <b style="color: #eb8153;
                        font-weight: 600;"><span>Hold</span> Positions -</b> </h3>
                    @if ($checktype == 0)
                    <div id="positions" class=" tab-pane active" style="margin-top:2px"><br>
                        @if (count($Positions))
                        @foreach ($Positions as $key => $position)
                        @include('pages.position.elements.holdjobListElement',
                        compact('position'))
                        @endforeach
                        @else
                        <div class="card">
                            @include('master.404')
                        </div>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="shared-position-section">
                <div class="pt-4">
                    <div class="card">
                        @include('master.404')
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
<script>
    const cards = document.querySelectorAll("#customCard");
        const dropdown = document.querySelectorAll(".customDropDown");

        for (let i = 0; i < cards.length; i++) {
            cards[i].addEventListener("mousemove", function() {
                dropdown[i].style.display = "inline";
            });

            cards[i].addEventListener("mouseleave", function() {
                dropdown[i].style.display = "none";
            });

            cards[i].onmousemove = (e) => {
                for (const card of document.getElementsByClassName(
                        cards[i].classList[0]
                    )) {
                    const rect = card.getBoundingClientRect(),
                        x = e.clientX - rect.left,
                        y = e.clientY - rect.top;

                    card.style.setProperty("--mouse-x", `${x}px`);
                    card.style.setProperty("--mouse-y", `${y}px`);
                }
            };
        }

        function openLink(link) {

            let params =
                `scrollbars=no,resizable=no,status=no,location=no,toolbar=no,menubar=no,width=500,height=800,left=0,top=0`;

            open(link, 'test', params);
        }

        function openJobPostingReport(id) {
            $.get("{{ url('show-job-posting-full-report') }}", {
                positionId: id
            }, function(response) {
                // alert(1)
                $('#modal-section').html(response);
                $('#rightModal').modal('show');
            });
            // $('#rightModal').modal('show');
            // 
        }
</script>
@endsection