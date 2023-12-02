<style>
    .inner {
        min-height: 110px !important;
        max-height: auto !important;
    }

    .navbar-nav .container {
        margin: 0 auto;
        text-align: center;
    }

    h1 {
        font-weight: normal;
        letter-spacing: .1em;
    }

    .navbar-nav li:not(.nav-item) {
        display: inline-block;
        list-style-type: none;
        font-size: 10px;
        padding: 1em;
    }

    .navbar-nav li.notification_dropdown span {
        display: block;
        font-size: 17px;
        color: #35dc35;
        font-weight: 600;
    }

    .progress:not([data-progress]) {
        height: 1.25em;
        width: 100%;
        background-color: #c9c9c9;
        position: relative;
        color: white
    }

    .progress:not([data-progress])>span {
        position: relative;
    }

    .progress:not([data-progress])>span:before {
        content: attr(data-label);
        font-size: 10px;
        position: absolute;
        top: 0px;
        left: 50%;
        /* right: 0; */
        transform: translateX(-50%);
        font-weight: 600;
        width: max-content;
    }

    .progress:not([data-progress]) .value {
        background-color: #eb8153;
        display: inline-block;
        height: 100%;
    }

    .timer-text {
        position: absolute;
        top: 2px;
        left: 50%;
        font-weight: 600;
        font-size: 10px;
        transform: translateX(-50%);
    }

    .a14 {
        position: fixed;
        bottom: 10px;
        right: 5px;
        cursor: pointer;
        padding: 5px;
        z-index: 999;
    }
    
</style>
<div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
            <div class="collapse navbar-collapse justify-content-between">
                <div class="col-sm-3" align="center">
                    @if(!Request::is('analyse'))
                    @if (Auth::user()->checkTarget(Auth::id()))
                        @php
                                $target =  (object) Auth::user()->getTargetThisQuarter();
                                $month_target = $target->target;
                                $complete =  $target->completed;
                                $remaining = $target->left;
                                $percentage = 0;
                                if($complete != 0 && !empty($month_target)){
                                    $percentage = ($complete / $month_target) * 100;
                                }

                        @endphp

                        <h6 style="font-size:12px" align="center">Target until this month - &nbsp;&nbsp;
                            <span class="pull-end"> {{ inc_format($complete) }} / 
                                {{ inc_format($month_target) }}</span>
                        </h6>
                        <div class="progress">
                            <span class="value" style="width:{{ round($percentage) }}%;"
                                data-label="@if($percentage > 0){{ round($percentage) }}%@endif"></span>
                        </div> 
                    @else
                        <h6 style="font-size:12px" class="mb-0"  align="center">
                            Target Not Assigned!!
                        </h6>
                        <small style="font-size:10px; color:#FF0001">please contact with Authorize person to update Target</small>
                    @endif
                    @endif
                </div>


                <ul class="navbar-nav header-right main-notification">
                    <li class="nav-item dropdown notification_dropdown">
                        <div class="container">
                            <div id="countdown">
                                <small class="timer-text">- QUARTER
                                    2 ENDS IN -</small>
                                <ul style="margin-top: 10px;">
                                    <li><span id="days"></span>DAYS</li>
                                    <li><span id="hours"></span>HOURS</li>
                                    <li><span id="minutes"></span>MINUTES</li>
                                    <li><span id="seconds"></span>SECONDS</li>
                                </ul>
                            </div>
                        </div>

                    </li>

                    {{-- @if (Auth::user()->role == 'admin') --}}
                        <li class="nav-item dropdown notification_dropdown">
                            <select name="admin_role" id="admin_role" class="form-control" onchange="switchRole();"
                                style="height:2.5rem" {{ Auth::user()->role == 'admin' ? '' : 'disabled' }}>
                                @foreach(CATEGORIES() as $category)
                                <option value="{{ $category }}" {{ Auth::user()->software_category == $category ? 'selected' : '' }}>
                                    {{ ucwords($category) }}
                                </option>
                                @endforeach
                              
                            </select>
                        </li>
                    {{-- @endif --}}

                    <li class="nav-item dropdown header-profile">
                        <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->thumb() }}" width="30" alt="" />
                            <div class="header-info">
                                <span>{{ ucfirst(Auth::user()->name) }}</span>
                                <small>{{ getRoleDisplay(Auth::user()->role) }}</small>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            {{-- <a href="{{ url('showcase/v2/sushma/integration') }}" class="dropdown-item ai-icon">
                                <i data-feather="settings"></i>
                                <span class="ms-2">Configration </span>
                            </a> --}}
                            <a href="javascript:" onclick="addEdit('{{ url('profileSetting', [Auth::user()->id]) }}')"
                                class="dropdown-item ai-icon">
                                {{-- <svg id="icon-user1" xmlns="" class="text-primary" width="18" height="18"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg> --}}
                                <i data-feather="user"></i>
                                <span class="ms-2">Profile Setting </span>
                            </a>

                            <a target="_blank" href="https://chrome.google.com/webstore/detail/profile-extractor/clagccmmppeefcolnbmneomfikifnnni?hl=en-GB&authuser=1"
                                class="dropdown-item ai-icon">
                                <i data-feather="chrome"></i>
                                <span class="ms-2">Chrome Extention</span>
                            </a>

                            <a href="{{ url('add-update-popup') }}"
                                class="dropdown-item ai-icon">
                                <i data-feather="plus-square"></i>
                                <span class="ms-2">Update Popup</span>
                            </a>

                            <a href="{{ url('logout') }}" class="dropdown-item ai-icon">
                                {{-- <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger"
                                    width="18" height="18" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12">
                                    </line>
                                </svg> --}}
                                <i data-feather="log-out"></i>
                                <span class="ms-2">Logout </span>
                            </a>
                            
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
@if (session()->has('admin_session'))
    <a href="{{ url('back-to-admin') }}"><button class="a14 btn btn-primary "> <i data-feather="chevron-left"></i> Back
            To Admin &nbsp;</button></a>
@endif


<script>
    function switchRole() {
        var value = $('#admin_role').val();
        $.get("{{ url('change-admin-category') }}", {
            value: value
        }, function(result) {
            if (result == 1) {
                window.location.replace("{{ url('/dashboard') }}");
            }
        });
    }
</script>
<script>
    function addEdit(url, id) {
        $.get(url, id, function(response) {
            $('#modal-section').html(response);
            $('#rightModal').modal('show');
        });
    }
</script>
