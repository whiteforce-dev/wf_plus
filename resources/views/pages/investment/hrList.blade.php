@extends('master.master')
@section('title', 'Investment Section')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">




            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color:white">HR List</h4>
                    <a href="{{ url('consolidated-investment') }}"><span
                                class="btn btn-dark ">
                                Show Consolidated </span></a>
                </div>
                @if(count($hrs))
                <div class="card-body">
                    <table id="example" class="table table-hover table-bordered ">
                        <thead class="bgl bgl-dark">
                            <tr>
                                <th scope="col"><h6>S.No</h6></th>
                                <th scope="col"><h6>Company Name</h6></th>
                                <th scope="col"><h6>Hr Name</h6></th>
                                <th scope="col"><h6>Contact No.</h6></th>
                                <th scope="col"><h6>Email</h6></th>
                                <!-- <th scope="col"><h6>Total Amount</h6></th> -->
                                <th scope="col"><h6>Action</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hrs as $key => $hr)
                            <tr class="" role="row">
                                <td class="text-black">{{ ++$key }}. </td>

                                <td class="text-danger"><h6>{{ ucwords($hr->hr_master->name ?? 'Na') }}</h6></td>
                                <td class="text-black">{{ ucwords($hr->name) }}</td>
                                <td class="text-black">{{ $hr->mobile }}</td>
                                <td ><h6 class="text-primary">{{ $hr->email }}</h6></td>
                                <!-- <td ><h6 class="text-success text-center">5000</h6></td> -->
                                <td class="text-center"><a href="{{ url('gift-details', $hr->id) }}" ><span
                                            class="btn px-3 py-1 btn-info btn-xs "
                                           >Add </span></a> &nbsp;
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="card">
                    @include('master.404')
                </div>
                @endif
            </div>








            @endsection