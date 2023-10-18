@extends('master.master')
@section('title', 'HR List')
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
        font-size: 18px;
        color: #653b3b;
    }

    /* th,
    tr {
        text-align: center;
    } */

    .table-striped>tbody>tr:nth-of-type(odd)>* {
        --bs-table-accent-bg: var(--bs-table-striped-bg);
        color: initial;
    }

    .table-striped>tbody>tr:nth-of-type(even)>* {
        --bs-table-accent-bg: white !important;
        color: initial;
    }

    button.btn.btn-danger,
    button.btn.btn-warning,
    button.btn.btn-success,
    button.btn.btn-info {
        font-size: 17px;
        font-weight: 600;
    }
</style>
<a href="{{ url('https://white-force.com/plus/tutorial/#hrdiv') }}" target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="card col-12">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="col-8">
                        <h4>HR List View</h4>

                    </div>
                    <div class="col-2 offset-1">
                        <span class="btn bgl-info text-dark  status-btn me-3" style="width:100px"><b>{{ count($list)
                                }}</b></span>
                    </div>
                    <div class="col-2  ">
                        <a href="{{ route('hr.create') }}"><button class="btn btn-primary">Add HR </button></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-12">
                @if($list->count()==0)
                <div class="card">
                    @include('master.404')
                </div>
                @else

                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>CLIENT NAME</th>
                                    <th>HR NAME</th>
                                    <th>EMAIL</th>
                                    <th>DATE OF BIRTH</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $key => $value)
                                <tr align="left">
                                    <td>
                                        <div>
                                            <h6>{{ ++$key }}.</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <img height="50" src="{{ $value->thumb() }}"
                                            class="rounded-circle me-2 width36 height36" alt="">
                                        <span>{{ ucwords($value->clientName->name ?? '-') }}</span>
                                    </td>

                                    <td>
                                        <div>
                                            <h6>{{ucwords($value->name) }}</h6>
                                        </div>
                                    </td>

                                    <td>
                                        <div>
                                            <h6>{{ $value->email }}</h6>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <h6 class="text-primary">{{ modDate($value->dob, 'Y, d M') }}</h6>
                                        </div>
                                    </td>


                                    <td>
                                        <div class=" action-button">

                                            <a href="{{ route('hr.edit',$value->id) }}"
                                                class="btn btn-info btn-xs light px-2">
                                                <i data-feather="edit-2"></i>
                                            </a>
                                            @if(Auth::user()->role == "admin")
                                            <a class="btn btn-danger btn-xs light px-2"
                                                href="{{ route('hr.destroy',$value->id) }}" onclick='event.preventDefault();
                                                     document.getElementById("hr-delete-{{ $value->id }}").submit();'>
                                                <i data-feather="trash-2"></i>
                                            </a>

                                            <form id="hr-delete-{{ $value->id }}"
                                                action="{{ route('hr.destroy',$value->id) }}" method="POST"
                                                class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
