@extends('master.master')
@section('title', 'Calling Sheet')
@section('content')


    <style>
        .deznav .metismenu {
            padding-top: 25px;
            padding-bottom: 15px;
        }
    </style>
    <div class="content-body">
        <div class="container-fluid">
            <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
                <div class="card col-12">
                    <div class="card-header d-sm-flex d-block">
                        <div class="col-3">
                            <h4 class="card-title mb-2">Calling Sheet Upload:</h4>

                        </div>

                        <div class="col-6 ">
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-file">
                                        <form action="{{ url('importExcel') }}" style="display:inline;" method="post"
                                            enctype="multipart/form-data" id="excelForm">
                                            @csrf
                                            <input type="file" class="form-file-input form-control" name="file"
                                                id="sheet" required>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-info">+ Import Sheet</button>
                                </div>
                                </form>
                            </div>
                        </div>

                        <a href="{!! url('assets/Sample_sheet.xlsx') !!}" class="btn btn-success me-3" download><i
                                class="las la-download scale3 me-2"></i>Download Sample Sheet</a>

                    </div>
                </div>
                <div class="card col-12">
                    <div class="card-header">
                        <div class="col-6">
                            <h4 class="card-title">Calling Sheets</h4>
                        </div>
                        <div class="col-6 d-flex justify-content-end ">
                            <div class="badge badge-secondary" style="font-size: 15px;padding-right: 20px;padding-left: 20px;padding-top: 9px;margin-right:1px;padding-bottom:9px;">{{ count($excelSheet) }}</div>
                                @if ($currentUser == 'admin')
                                <button class="btn btn-dark" id="btn" onclick="selects()">Select All</button>
                                &nbsp;
                                <button class="btn btn-primary " id="bulkDelete">Delete All</button>
                                @endif
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card-body">
                                <!-- <fieldset class="checkbox-group"> -->
                                <div class="table-responsive">
                                    <!-- @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible alert-alt fade show">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="btn-close">
                                            </button>
                                            <strong>{{ session('success') }}</strong>
                                        </div>
                                    @endif -->
                                    <div id="example_wrapper" class="dataTables_wrapper">
                                        @if(count($excelSheet))
                                        <table class="table table-striped" style="min-width: 845px" role="grid"
                                            aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc " tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 20.641px;">S.No</th>

                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Excel Name</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Office: activate to sort column ascending"
                                                        style="width: 117.938px;">Uploaded By</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 47.3281px;">Date</th>

                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 200px;">Action</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($excelSheet as $index => $obj)
                                                    <tr>
                                                        <td>
                                                            <h6>
                                                                <input type="checkbox" name="chk"
                                                                    value="{{ $obj->id }}">
                                                                &nbsp;{{ ++$index }}.
                                                            </h6>
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="{{ $obj->file_path }}">
                                                                <h6 class="text-primary">
                                                                    {{ ucwords($obj->name) }} </h6>
                                                            </a>
                                                        </td>
                                                        <td class="text-center">
                                                            <div>
                                                                <h6>{{ $obj->GetUser->name }}</h6>

                                                            </div>
                                                        </td>
                                                        <td class="text-center">
                                                            <div>
                                                                <h6 class="text-center">
                                                                    {{ $obj->created_at->format('d/m/Y') ?? '-' }}
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-center">
                                                                <a href="{{ url('sheet', $obj->id) }}">
                                                                    <button class="badge badge-secondary">View</button></a>
                                                                @if ($currentUser == 'admin')
                                                                    <form action="{{ url('delete_excel', $obj->id) }}"
                                                                        method="post" style="display:inline">
                                                                        @csrf
                                                                        @method('POST')
                                                                        <button type="submit" class="badge badge-danger">
                                                                            Delete
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                        @else

                                            @include('master.404')

                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    {{ $excelSheet ->links() }}
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
    <script>
        let count = 1;
        var arrayOfIds = new Array();
        let deleteAll = document.querySelector('#bulkDelete');
        //select all function using check box //
        function selects() {
            var ele = document.getElementsByName('chk');
            var btn = document.querySelector('#btn');
            if (count == 1) {
                document.querySelector('#btn').innerHTML = "Deselect All";
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = true;
                    arrayOfIds.push(ele[i].value);

                }
                console.log(arrayOfIds);
                count = 0;
            } else if (count == 0) {
                document.querySelector('#btn').innerHTML = "Select All";
                for (var i = 0; i < ele.length; i++) {
                    if (ele[i].type == 'checkbox')
                        ele[i].checked = false;

                }
                arrayOfIds = [];
                count = 1;
                console.log(arrayOfIds);
            }
        }

        deleteAll.addEventListener('click', () => {
            var string = arrayOfIds.toString();
            console.log(string);
            window.open('bulk_delete?id=' + string, "_self");
        });
    </script>
@endsection
