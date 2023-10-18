@extends('master.master')
@section('title', 'Investment Section')
@section('content')

    <link href="{{ url('assets') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/css/style.css" rel="stylesheet">
    <div class="content-body">
        <div class="container-fluid">
            {{-- <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Hr List</h4>
                    </div>


                    <div class="card-body"> --}}
                        <div class="col-xl-12 col-lg-12">
                            <div class="card alljobPortals">
                                <div class="card-header bg-primary">
                                    <h4 class="card-title" style="color: #fff;">HR List </h4>
            
                                </div>
                                <div class="card-body">
                                    <fieldset class="checkbox-group">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper">
                                <table id="example" class="table table-striped" style="min-width: 845px" role="grid"
                                    aria-describedby="example_info">
                                    <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-sort="ascending"
                                                aria-label="Name: activate to sort column descending"
                                                style="width: 90.641px;">S.No</th>

                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Position: activate to sort column ascending"
                                                style="width: 240.891px;">Company Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Office: activate to sort column ascending"
                                                style="width: 117.938px;">Hr Name</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Age: activate to sort column ascending"
                                                style="width: 47.3281px;">Contact No.</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Start date: activate to sort column ascending"
                                                style="width: 96.25px;">Email</th>
                                            <th class="sorting" tabindex="0" aria-controls="example" rowspan="1"
                                                colspan="1" aria-label="Salary: activate to sort column ascending"
                                                style="width: 200px;">Action</th>
                                              
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
                                               
                                                  <td ><a href="{{ url('gift-details', $hr->id) }}"
                                                    style="color:#fff"  ><button style="margin-left:-15px" class="btn btn-primary" style="color:#fff !important">Add Gift</a> 
                                                        &nbsp;
                                                   
                                                        {{-- <a href="{{ url('gift-details', $hr->id) }}"
                                                            class="btn btn-primary">Add Gift</a>  --}}
                                                              <a href="{{ url('show-investment', $hr->id) }}"
                                                                ><button style="margin-left:2px" class="btn btn-info" >Show Gift </button></a> 
                                                           </td>
                                               
                                           
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <th>S.No.</th>

                                            <th rowspan="1" colspan="1">Company name</th>
                                            <th rowspan="1" colspan="1">Name</th>
                                            <th rowspan="1" colspan="1">Contact No.</th>
                                            <th rowspan="1" colspan="1">Email</th>
                                            <th rowspan="1" colspan="1">Action</th>
                                        </tr>
                                    </tfoot> --}}
                                </table>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="{{ url('assets') }}/vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Datatable -->
    <script src="{{ url('assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins-init/datatables.init.js"></script>
    <script src="{{ url('assets') }}/js/custom.js"></script>
    <script src="{{ url('assets') }}/js/deznav-init.js"></script>
    <script src="{{ url('assets') }}/js/demo.js"></script>
    <script src="{{ url('assets') }}/js/styleSwitcher.js"></script>
@endsection
