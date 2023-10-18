@extends('master.master')
@section('title', 'Investment Section')
@section('content')

<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">




            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color:white">HR List</h4>
                    <button class="btn btn-light btn-sm"><a href="{{ url('consolidated-investment') }}"><span
                                class="btn-start text-info">
                            </span>Show Consolidated</a></button>
                </div>
                @if(count($hrs))
                <div class="card-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Company Name</th>
                                <th scope="col">Hr Name</th>
                                <th scope="col">Contact No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                                {{-- <th scope="col">Remark</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $a = 1;
                            @endphp
                            
                            @foreach ($hrs as $hr)
                            <tr class="odd" role="row">
                                <td>{{ $a++ }}. </td>

                                <td>{{ $hr->hr_master->name ?? 'Na' }}</td>
                                <td>{{ $hr->name }}</td>
                                <td>{{ $hr->mobile }}</td>
                                <td>{{ $hr->email }}</td>

                                <td><a href="{{ url('gift-details', $hr->id) }}" style="color:#fff"><button
                                            style="margin-left:-15px" class="btn btn-primary"
                                            style="color:#fff !important">Add Gift</a>
                                    &nbsp;

                                    {{-- <a href="{{ url('gift-details', $hr->id) }}" class="btn btn-primary">Add
                                        Gift</a> --}}
                                    <a href="{{ url('show-investment', $hr->id) }}"><button style="margin-left:2px"
                                            class="btn btn-info">Show Gift </button></a>
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