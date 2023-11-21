@extends('master.master')
@section('title', 'Assign Target Section')
@section('content')

    <style>
        th {
            color: black !important;
        }

        .csmall {
            color: #0024cb;
            font-size: 10px;
            font-weight: 500;
        }

        .text-dark {
            color: black !important;
            font-weight: 500;
        }

        .monthlyTarget,
        .totalTarget,
        .complateTarget,
        .leftTarget {
            font-weight: 600;
            font-size: 16px;
            color: #653b3b;
        }

        th,
        tr {
            text-align: center;
        }

        button.btn.btn-danger,
        button.btn.btn-warning,
        button.btn.btn-success,
        button.btn.btn-info {
            font-size: 17px;
            font-weight: 600;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            --bs-table-accent-bg: var(--bs-table-striped-bg);
            color: initial;
        }

        .table-striped>tbody>tr:nth-of-type(even)>* {
            --bs-table-accent-bg: white;
            color: initial;
        }
    </style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color:white">Assign <b style="color:rgb(241, 231, 84)">
                        {{ $team->name }}'s</b> Team Target</h4>
                        <div class="search-area" style="width: 105px">
                            <select name="month" id="month" onchange="getMonthWise();" class="form-control">
                                @foreach (monthsArray() as $key => $monthelm)
                                        <option value="{{ $key }}" {{ $key == $month ? 'selected' : '' }}>{{ $monthelm }}</option>
                                @endforeach
                            </select>
                        </div>


                        {{-- <a href="{{ url('/target') }}"> <button type="button" class="btn  btn-light"><span
                                class="btn-start text-info"><i class="fa fa-angle-double-left"></i>
                            </span> Back</button></a> --}}
                    </div>

                    <div class="card-body">
                        <div class="main-content-wrap d-flex flex-column">
                            <div class="main-header">
                                <div class="d-flex align-items-center">
                                    <!-- Mega menu -->
                                    <div class="dropdown mega-menu d-none d-md-block">

                                        <div class="dropdown-menu text-left" aria-labelledby="dropdownMenuButton">
                                            <div class="row m-0">

                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div style="margin: auto"></div>

                            </div>
                            <div class="main-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <br>
                                    </div>
                                    <div class="mydiv col-sm-12" style="background: white">

                                        <form action="{{ url('save-user-monthly-target') }}" method="POST">
                                            @csrf
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th style="">Image</th>
                                                        <th style="">Team</th>
                                                        <th>Month</th>
                                                        <th>Quarter</th>
                                                        <th>Year</th>
                                                        <th style="">Target</th>
                                                        @if (Auth::user()->role == 'admin')
                                                            <th>Assign Target</th>
                                                        @endif
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @php
                                                        $total_month_target = 0;
                                                        $total_target = 0;
                                                        $total_complete = 0;
                                                        $total_left = 0;
                                                    @endphp

                                                    @include('pages.monthly_target.childrow', [
                                                        'node' => $team,
                                                        'level' => 0,
                                                        'month' => $month
                                                    ])


                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        {{-- <td></td> --}}
                                                        {{-- <td style="width: 160px; text-align:center"><b>Month Total
                                                                Target</b>
                                                            <hr> <button type="button"
                                                                class="btn btn-danger  btn-block totalMonthlyTargetBtn">0</button>
                                                        </td>
                                                        <td style="width: 155px;text-align:center"><b>Total Target</b>
                                                            <hr> <button type="button"
                                                                class="btn btn-warning  btn-block  totalTargetBtn">0</button>
                                                        </td>
                                                        <td style="width: 155px;"><b>Total Complete</b>
                                                            <hr> <button type="button"
                                                                class="btn btn-success btn-block totalCompleteTargetBtn">0</button>
                                                        </td> --}}
                                                        <td style="width: 155px;text-align:center"><b>Total Target</b>
                                                            <hr> <button type="button"
                                                                class="btn btn-info btn-block totalLeftTargetBtn">0</button>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                            @if (Auth::user()->role == 'admin' || Auth::user()->role == 'general_manager')

                                                @if ($month == date('m'))
                                                    <button type="submit"
                                                        class="btn btn-outline-primary btn-lg btn-block">Assign
                                                        Target
                                                        <b>{{ $team['name'] }}</b> Team </button>
                                                @else
                                                    <button type="button" disabled
                                                        class="btn btn-primary  btn-lg btn-block">
                                                        <b>{{ $team['name'] }}</b> Team Target Already Assigned
                                                    </button>
                                                    <script>
                                                        $('.set-target').attr('disabled', true);
                                                    </script>
                                                @endif
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var totalMonthlyTarget = 0;
        $(".monthlyTarget").each(function(index) {
            var value = $(this).text().replace(/,/g, '');
            totalMonthlyTarget += parseInt(value);
            console.log(value);
        });
        $('.totalMonthlyTargetBtn').text(inc_format(totalMonthlyTarget))


        var totalTarget = 0;
        $(".totalTarget").each(function(index) {
            var value = $(this).text().replace(/,/g, '');
            totalTarget += parseInt(value);
        });
        $('.totalTargetBtn').text(inc_format(totalTarget))


        var totalCompleteTarget = 0;
        $(".complateTarget").each(function(index) {
            var value = $(this).text().replace(/,/g, '');
            totalCompleteTarget += parseInt(value);
        });
        $('.totalCompleteTargetBtn').text(inc_format(totalCompleteTarget))


        var totalLeftTarget = 0;
        $(".leftTarget").each(function(index) {
            var value = $(this).text().replace(/,/g, '');
            totalLeftTarget += parseInt(value);
        });
        $('.totalLeftTargetBtn').text(inc_format(totalLeftTarget))


        function getMonthWise(){
            var month = $('#month').val();
            var url = '{{ url('team-target').'/'.$managerId }}'+'?month='+month;
            window.open(url, '_self');
        }
    
    </script>
@endsection
