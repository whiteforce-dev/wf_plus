@extends('master.master')
@section('title', 'HR HBD Report')
@section('content')

    <style>
        .client_logoDiv {
            width: 85px;
            height: 85px;
            background: #f1f1f1;
            border-radius: 10px;
            margin: 0;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            border: 1px dashed #00000049;
            padding: 8px;
        }

        .client_logoDiv img {
            max-width: 100%;
            max-height: 100%;
            border-radius: 10px;
        }

        th {
            text-align: center;
            padding: 10px;
            font-weight: 700 !important;
            font-size: 16px !important;
        }

        td {
            text-align: center;
            font-weight: 600 !important;
            font-size: 15px !important;
        }

        thead {
            position: sticky;
            top: 0;
            background-color: #fcfcfc;
        }


        tfoot {
            position: sticky;
            bottom: 0;
            background-color: #f2f2f2;
        }
    </style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card alljobPortals">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color: #fff;">HR Birthday Report</h4>
                        <button class="btn btn-light btn-sm"><a href="{{ url('reports') }}"><span
                                    class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                                </span>Back</a></button>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('reports/hr_birthdays') }}" method="post">
                            @csrf
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label for="">Select Days</label>
                                    <select name="days" id="days" class="form-control">
                                        <option value="7" selected>07 Days</option>
                                        <option value="15">15 Days</option>
                                        <option value="30" selected>30 Days</option>
                                        <option value="60">60 Days</option>
                                        <option value="90">90 Days</option>
                                        <option value="120">120 Days</option>
                                    </select>

                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for=""></label>
                                    <button type="submit" class="btn btn-info col-md-12"
                                        onclick="getReport()">Search</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper">
                                <table id="example" class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr role="row">
                                            <th>Manager</th>
                                            <th>Company</th>
                                            <th>Name</th>
                                            <th>Birthday</th>
                                            <th>Designation</th>
                                            <th>days</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (count($hrdata))
                                            @foreach ($hrdata as $k => $item)
                                                @php
                                                    $year = date('Y');
                                                    
                                                    if (isset($item)) {
                                                        $clients = \App\Models\Client::find($item->client_id);
                                                    }
                                                    // dd($clients);
                                                    if (isset($clients)) {
                                                        $manager = \App\Models\User::find($item->hr_master->created_by);
                                                    }
                                                    // dd($manager);
                                                    $cur_date = \Carbon\carbon::now()->format('d-m-Y');
                                                    $birth = \Carbon\carbon::parse($item->dob)->format('d-m');
                                                    $today = \Carbon\carbon::now()->format('d-m');
                                                    $total_Days = \Carbon\Carbon::parse($cur_date)->daysInYear; //for year
                                                    $date1 = date_create($today . '-' . $year);
                                                    $date2 = date_create($birth . '-' . $year);
                                                    $diff = date_diff($date1, $date2);
                                                    
                                                    $diffrence = $diff->format('%a days Left');
                                                    $diffrence_one = $diff->format('%a');
                                                    
                                                @endphp
                                                @if ($birth == $today)
                                                    <tr>
                                                        <td><b>{{ isset($manager->name) ? $manager->name : 'N/A' }}</b></td>

                                                        <td><b><a target="_blank"
                                                                    href="{{ url('position/client', $clients->id) }}">{{ ucwords($clients->name) }}</a></b>
                                                        </td>

                                                        <td><b>{{ ucwords($item->name ?? '-') }}</b></td>
                                                        <td><b>{{ \Carbon\carbon::parse($item->dob)->format('d F') }}</b>
                                                        </td>
                                                        <td><b>{{ ucwords($item->designation ?? '-') }}</b></td>
                                                        <td><b>0</b></td>


                                                        <td><a href="{{ url('sendbirthday', $item->id) }}"><button
                                                                    class="btn btn-success btn-block">Send
                                                                    Wishes</button></a></td>
                                                    </tr>
                                                @else
                                                    <tr>
                                                        {{-- <td style="max-width: 11%"><b>{{ $k+1 }}</b></td> --}}
                                                        <td><b>{{ isset($manager->name) ? $manager->name : 'N/A' }}</b></td>
                                                        @if (isset($clients))
                                                            <td><b><a target="_blank"
                                                                        href="{{ url('position/client', $clients->id) }}">{{ ucwords($clients->name ?? 'N/A') }}</a></b>
                                                            </td>
                                                        @else
                                                            <td>N/A</td>
                                                        @endif

                                                        <td style="max-width: 16%"><b>{{ ucwords($item->name ?? '-') }}</b>
                                                        </td>
                                                        <td style="max-width: 11%">
                                                            <b>{{ \Carbon\carbon::parse($item->dob)->format('d F') }}</b>
                                                        </td>
                                                        <td style="max-width: 11%">
                                                            <b>{{ ucwords($item->designation ?? '-') }}</b></td>
                                                        <td style="max-width: 11%"><b>{{ $diffrence_one }}</b></td>
                                                        <td style="max-width: 11%"><button class="btn btn-danger btn-block"
                                                                disabled>{{ $diffrence }}</button></td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @else
                                            <tr style="background: white !important;">
                                                <td colspan="12"
                                                    style="width:100% !important; background: white !important;">
                                                    <style>
                                                        .table-striped>tbody>tr:nth-of-type(odd)>* {
                                                            --bs-table-accent-bg: white;
                                                            color: var(--bs-table-striped-color);
                                                        }
                                                    </style>
                                                    @include('master.404')
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @if (Auth::user()->type == 'admin')
        <script>
            $(document).ready(function() {
                $('#example2').DataTable({
                    "lengthMenu": [
                        [-1],
                        ["All"]
                    ],
                    "order": [
                        [5, "asc"]
                    ]
                });
            });
        </script>
    @else
        <script>
            $(document).ready(function() {
                var nameman = "{{ Auth::user()->manager_name }}";
                $('#example2').dataTable({
                    "oSearch": {
                        "sSearch": nameman
                    },
                    "lengthMenu": [
                        [-1],
                        ["All"]
                    ],
                    "order": [
                        [5, "asc"]
                    ]
                });
            });
        </script>
    @endif
    <script src="{{ url('assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins-init/datatables.init.js"></script>
    <script src="{{ url('assets') }}/js/custom.js"></script>
    <script src="{{ url('assets') }}/js/deznav-init.js"></script>
    <script src="{{ url('assets') }}/js/demo.js"></script>
    <script src="{{ url('assets') }}/js/styleSwitcher.js"></script>
@endsection
