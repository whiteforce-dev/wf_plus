<style>
    .deznav .metismenu>li>a svg {
        color: #8c8c8c;

    }

    .deznav .metismenu>li.mm-active>a svg {
        color: var(--primary);

    }

    .liwithmargin {
        margin: 0px 10px;
    }

    .cnav-head{
        color: #eb8153 !important;
    }

</style>
<div class="deznav">
    <div class="deznav-scroll">
        <div class="main-profile">
            <div class="image-bx">
                <img src="" alt="">
                <a href="javascript:void(0);"><i class="fa fa-cog" aria-hidden="true"></i></a>
            </div>
            <h5 class="name"><span class="font-w400">Hello,</span><span style="color:rgb(243, 12, 12);">{{
                    ucwords(Auth::user()->name) }}</span></h5>
            <p class="email"><span style="color:#00ada3;font-weight:600;">{{ ucwords(Auth::user()->email) }}</span>
            </p>
        </div>
        <ul class="metismenu" id="menu" style="margin-top:-22px;">
            <li class="nav-label">Dashboard</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="home"></i>
                    <span class="nav-text">Dashboard</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Home Section </h6>

                    <li class="liwithmargin"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li class="liwithmargin"><a href="{{ url('receiver-list') }}">Joining Form </a></li>
                </ul>
            </li>

            <li class="nav-label">AI Options</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="cast"></i>
                    <span class="nav-text">AI Options</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">AI Section </h6>

                    <li class="liwithmargin"><a href="{{ url('analyse') }}">Job Analyse</a></li>
                    @if(Auth::user()->role == 'admin')
                    <li class="liwithmargin"><a href="{{ url('multiple_resume_matching') }}">Multiple Resume Matching</a></li>
                    <li class="liwithmargin"><a href="{{ url('sync_email_attachments') }}">Sync Email Attachments</a></li>
                    @endif


                </ul>
            </li>

            <!-- Admin Specific -->
            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'general_manager')
            <li class="nav-label">Target</li>
            <li class="{{ Request::is('manager-team-*') ? 'mm-active' : '' }}"><a class="has-arrow ai-icon "
                    href="javascript:void()" aria-expanded="false">
                    <i data-feather="crosshair"></i>
                    <span class="nav-text">Target</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Target Section </h6>
                    <li class="liwithmargin "><a href="{{ url('target') }}"
                            class="{{ Request::is('manager-team-*') ? 'mm-active' : '' }}">Monthly Target</span></a>
                    </li>

                </ul>
            </li>
            @endif


            <li class="nav-label">Users</li>
            <li class="{{ Request::is('user*') ? 'mm-active' : '' }}"><a class="has-arrow ai-icon "
                    href="javascript:void()" aria-expanded="false">
                    <i data-feather="users"></i>
                    <span class="nav-text">Users</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Manage Team Section </h6>
                    <li class="liwithmargin"><a href="{{ route('user.index') }}"
                            class="{{ Request::is('user*') ? 'mm-active' : '' }}">My Teams</a></li>
                    <!-- Admin Specific -->
                    @if(Auth::user()->role == 'admin')
                    <li class="liwithmargin"><a href="{{ route('user.create') }}">Add New User</a></li>
                    @endif
                </ul>
            </li>
            

             @php 
             $showClient = true;

             if(in_array(Auth::user()->software_category, FRANCHISE_CATEGORY())){
                if(in_array(Auth::user()->role,['manager', 'assistant_manager', 'talent_acquisition'])){
                    $showClient = false;
                }
             }
             @endphp


            @if($showClient)
            <li class="nav-label">Client Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="briefcase"></i>
                    <span class="nav-text">Client Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Client Section</h6>
                    <!-- Admin Specific -->
                    <li class="liwithmargin"><a href="{{ route('client.index') }}">Client's List</a></li>
                    <li class="liwithmargin"><a href="{{ route('client.create') }}">Add New Client</a></li>
                    <h6 class="dropdown-header cnav-head">HR Section </h6>
                    <li class="liwithmargin"><a href="{{ route('hr.index') }}">Client's HR List</a></li>
                    <li class="liwithmargin"><a href="{{ route('hr.create') }}">Add New HR</a></li>
                </ul>
            </li>
            @endif
            <li class="nav-label">Positions Section</li>
            <li class="{{ Request::is('position*') ? 'mm-active' : '' }}"><a class="has-arrow ai-icon "
                    href="javascript:void()" aria-expanded="false">
                    <i data-feather="layout"></i>
                    <span class="nav-text">Positions Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Position Section</h6>
                    <li class="liwithmargin"><a href="{{ url('position') }}">Position's List</a></li>
                    <li class="liwithmargin"><a href="{{ route('position.create') }}">Add New Position</a></li>
                    <li class="liwithmargin"><a href="{{ url('position-hold') }}">Hold Positions</a></li>
                    <li class="liwithmargin"><a href="{{ url('position-closed') }}">Closed Positions</a></li>
                    <h6 class="dropdown-header cnav-head">Job Posting Section </h6>
                    <li class="liwithmargin"><a href="{{ url('job-posting-reports') }}">Job Posting Report</span></a>
                    </li>
                    <li class="liwithmargin"><a href="{{ route('job_description.index') }}">Job Template</span></a></li>
                </ul>
            </li>


            <li class="nav-label">Candidate Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="user-plus"></i>

                    <span class="nav-text">Candidate Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Candidate Section</h6>
                    <li class="liwithmargin"><a href="{{ route('candidate.index') }}">Candidate's List</a></li>
                    <li class="liwithmargin"><a href="{{ route('candidate.create') }}">Add Candidate</span></a>
                    </li>
                    <li class="liwithmargin"><a href="{{ url('all_responses/0/all/response') }}">Candidate's Revert</a></li>

                </ul>
            </li>


            <!-- Admin Specific -->
            @if(Auth::user()->role == 'admin')
            <li class="nav-label">Investment Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="dollar-sign"></i>

                    <span class="nav-text">Investment Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">HR Investment Section</h6>
                    <li class="liwithmargin"><a href="{{ route('investment.index') }}">Investment Report</a></li>
                    {{-- <li class="liwithmargin"><a href="{{ url('consolidated-investment') }}">Consolidate Report</a>
                    </li> --}}
                </ul>
            </li>
            @endif

            <li class="nav-label">Sheet Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="phone-call"></i>
                    <span class="nav-text">Sheet Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Calling Report Section</h6>
                    <li class="liwithmargin"><a href="{{ url('sheet_view') }}">Calling Sheet</a></li>
                </ul>
            </li>

            <li class="nav-label">Sheet Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="folder-plus"></i>
                    <span class="nav-text">Report Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Report Section</h6>
                    <li class="liwithmargin"><a href="{{ url('reports') }}">All Reports</a></li>
                </ul>
            </li>
            <!-- Admin Specific -->
            @if(Auth::user()->role == 'admin')
            <li class="nav-label">Events Section</li>
            <li><a class="has-arrow ai-icon " href="javascript:void()" aria-expanded="false">
                    <i data-feather="gift"></i>
                    <span class="nav-text">Events Section</span>
                </a>
                <ul aria-expanded="false">
                    <h6 class="dropdown-header cnav-head">Events Section</h6>
                    <li class="liwithmargin"><a href="{{ url('add-events') }}">Add Events</a></li>
                </ul>
            </li>
            @endif
    </div>
</div>