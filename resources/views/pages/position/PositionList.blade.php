@extends('master.master')
@section('title', 'Position List')
@section('content')

{{--
<link rel="stylesheet" href="{{ url('assets') }}/vendor/select2/css/select2.min.css">
<link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">

<script src="{{ url('/') }}/assets/vendor/select2/js/select2.full.min.js"></script>

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head> --}}
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
        right: 0;
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

        <div class="row">
            <div class="custom-tab-1 col-sm-6">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#position-section"><i class="la la-briefcase me-2"></i> Positions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#shared-position-section" style="position: relative;"><i class="la la-share-square me-2"></i> Shared With Me
                            &nbsp;<span class="badge badge-danger badge-pill" style="position: absolute;
                                top: 7px;">{{ count($shareWithMePositions ?? []) }}</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#shared-position-section-with-me" style="position: relative;"><i class="la la-download me-2"></i> Shared By Me &nbsp;<span class="badge badge-danger badge-pill" style="position: absolute;
                                top: 7px;">{{ count($shareByMePositions ?? []) }}</span> </a>
                    </li>

                </ul>
            </div>
            <div class="custom-tab-1 col-sm-5">
                {{-- <a href="{{ url('position/create') }}"><button class="btn btn-primary pull-right"><span class="fa fa-plus"></span> Post Job</button></a> --}}
                <div class="btn-group pull-right" role="group" aria-label="Basic example">
                    <a href="{{ url('position/create') }}"><button class="btn btn-primary "><span class="fa fa-plus"></span> Post Job</button></a>
                    &nbsp;
                    <a href="{{ url('refresh-cache/position') }}"><button class="btn btn-light"><span class="fa fa-refresh"></span> Refresh</button></a>
                </div>
            </div>
        </div>

        <div class="tab-content">
            <div class="tab-pane fade active show" id="position-section" role="tabpanel">
                <div class="pt-4">


                    @if ($checktype == 0)
                    <div class="row">
                        <div class="col-sm-11">
                            <input type="search" onblur="searchPosition(this);" id="search_query" name="search_query" class="form-control form-control-sm" placeholder="Search positions by enter @Position name or @Client name">
                            <small class="pull-right" style="margin-right: 8px; margin-top: 10px;">Press Enter to show search result</small>
                        </div>
                    </div>
                    <div id="positions" class=" tab-pane active" style="margin-top:0px"><br>
                        @if (count($Positions))
                        @foreach ($Positions as $key => $position)
                        @include(
                        'pages.position.elements.jobListElement',
                        compact('position'))
                        @endforeach
                        <br>
                        <div class="pagination-gutter" style="background: none;">
                            {{ $Positions->appends(request()->except('page'))->links() }}
                        </div>
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
                    @php
                    $hideOptions = 1;
                    @endphp
                    @if (count($shareWithMePositions ?? []))
                    @foreach ($shareWithMePositions as $key => $position)
                    @include(
                    'pages.position.elements.jobListElement',
                    compact('position', 'hideOptions'))
                    @endforeach
                    @else
                    <div class="card">
                        @include('master.404')
                    </div>
                    @endif
                </div>
            </div>
            <div class="tab-pane fade" id="shared-position-section-with-me">
                <div class="pt-4">
                    @php
                    $hideOptions = 0;
                    @endphp
                    @if (count($shareByMePositions ?? []))
                    @foreach ($shareByMePositions as $key => $position)
                    @include(
                    'pages.position.elements.jobListElement',
                    compact('position','hideOptions'))
                    @endforeach
                    @else
                    <div class="card">
                        @include('master.404')
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

    {{-- <div class="col-sm-12" style="margin-top:5px;margin-bottom:15px ;margin-left:760px">
        <div class="row">
            <div class="col-md-3" style="margin-left: 66px">
                <a href="{{ url('position') }}"><button class="btn btn-sm btn-info">Positions</button></a>
</div>
<div class="col-md-3" style="margin-left: -180px">
    <button class="btn btn-sm btn-info">Shared Position</button>
</div>
</div>
</div>
<form action="{{ url('position') }}" method="get">
    <div class="input-group">
        <input type="search" value="{{ $position_name }}" class="form-control rounded" placeholder="Global Position Search" name="global_position_search" aria-label="Search" aria-describedby="search-addon" />
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search"></i>
        </button>
    </div>
</form> --}}
</div>






</div>
</div>
<script src="https://cdn.tiny.cloud/1/zlnvr3c80gy1wujo4auc66vyudk5ioi4wyrdoh106xnorui6/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

    }

    function openManagerlist(position) {

        $.get("{{ url('show-managerlist') }}", {
            position: position
        }, function(response) {
            // alert(1)
            $('#modal-section').html(response);
            $('#rightModal').modal('show');
        });
        // $('#rightModal').modal('show');
        // 
    }

    function searchPosition(dis) {
        var value = $(dis).val();
        var path = "{{ url('assets/loading.gif') }}";
        $('#positions').html(`<div align="center" class="mt-3"><img src="` + path + `"> <br> <h3>lOADING...</h3>  </div>`);
        $.get("{{ url('search-position') }}", {
            value
        }, function(response) {
            console.log(response);
            $('#positions').html(response);
        });
    }


    $('#search_query').on('keydown', function(event) {
        if (event.keyCode === 13) { // Check for Enter key (key code 13)
            event.preventDefault(); // Prevent form submission (if the input is inside a form)
            $('#search_query').blur();
        }
    });


    function AddQuestionAnswer(position) {
        $.get("{{ url('show-question-answer') }}", {
            position: position
        }, function(response) {
            $('#modal-section').html(response);
            $('#rightModal').modal('show');
        })
    }
</script>
@endsection