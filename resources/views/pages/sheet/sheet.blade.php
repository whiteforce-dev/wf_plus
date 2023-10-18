@extends('master.master')
@section('title', 'Sheets')
@section('content')
<style>
    /* table {
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    } */


    .sticky-col {
        position: sticky;
        left: 0;
        z-index: 1;
    }

</style>
<link href="{{ url('assets') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
<link href="{{ url('assets') }}/css/style.css" rel="stylesheet">

<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-sm-flex d-block">
                        <div class="col-6">
                            <h4 class="card-title mb-2">Uploaded Calling Sheet :
                                <span class="text-primary">{{ $sheetName ?? "Not Found" }}</span></h4>
                        </div>
                        <div class="col-6 offset-4 collapse">
                            <button class="btn btn-dark" id="btn" onclick="selects()">Select All</button>
                            <button class="btn btn-primary " id="bulkDelete">Delete All</button>
                        </div>
                    </div>
                    @if($sheet->count()==0)
                    <div class="card">
                        @include('master.404')
                    </div>
                    @else
                    <div class="card-body">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card-body">
                                <!-- <fieldset class="checkbox-group"> -->
                                <div class="table-responsive">
                                    <!-- @if(Session::has('success'))
                                    <div class="alert alert-success alert-dismissible alert-alt fade show">
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="btn-close">
                                        </button>
                                        <strong>{{ session('success') }}</strong>
                                    </div>
                                    @endif -->
                                    <div id="example_wrapper" class="dataTables_wrapper">
                                        <table id="example" class="table table-striped" style="min-width: 845px"
                                            role="grid" aria-describedby="example_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc " tabindex="0" aria-controls="example"
                                                        rowspan="2" colspan="1" aria-sort="ascending"
                                                        aria-label="Name: activate to sort column descending"
                                                        style="width: 150.641px;">S.No</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Age: activate to sort column ascending"
                                                        style="width: 47.3281px;">Company Name</th>

                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Salary: activate to sort column ascending"
                                                        style="width: 200px;">Candidate Name</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Mobile</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Position</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Status</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Reference</th>
                                                    <th class="sorting text-center " tabindex="0"
                                                        aria-controls="example" rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">Manager Remark</th>
                                                    <th class="sorting text-center" tabindex="0" aria-controls="example"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Position: activate to sort column ascending"
                                                        style="width: 240.891px;">ACTION</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($sheet as $index=>$obj)
                                                <tr>
                                                    <td>
                                                        <h6>
                                                            <!-- <input type="checkbox" name="chk" value="{{ $obj->id }}"> -->
                                                            &nbsp;{{ ++$index }}.</h6>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <h6 class="text-center">
                                                                {{ ucwords($obj->company_name ?? '-') }}</h6>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div>
                                                            <h6 class="text-center">
                                                                {{ ucwords($obj->candidate_name ?? '-') }}</h6>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h6>{{ucwords ($obj->mobile ?? '-') }}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6>{{ ucwords($obj->position ?? '-') }}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge badge-info"
                                                            name="status">{{ ucwords($obj->status ?? '-') }}</span>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6>{{ ucwords($obj->reference ?? '-') }}</h6>
                                                    </td>
                                                    <td class="text-center">
                                                        <h6>{{ ucwords($obj->manager_remerk ?? '-') }}</h6>
                                                    </td>
                                                    @if(Auth::user()->role=="admin")
                                                    <td>
                                                        <div class="d-flex action-button">
                                                            <a href="javascript:void(0)"
                                                                class="ms-2 btn btn-xs px-2 light btn-danger">
                                                                <form
                                                                    action="{{ url('calling-sheet-delete',$obj->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <button type="submit" class="border-0">
                                                                        <svg width="20" height="20" viewBox="0 0 24 24"
                                                                            fill="none" xmlns="">
                                                                            <path d="M3 6H5H21" stroke="#fff"
                                                                                stroke-width="2" stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                            <path
                                                                                d="M8 6V4C8 3.46957 8.21071 2.96086 8.58579 2.58579C8.96086 2.21071 9.46957 2 10 2H14C14.5304 2 15.0391 2.21071 15.4142 2.58579C15.7893 2.96086 16 3.46957 16 4V6M19 6V20C19 20.5304 18.7893 21.0391 18.4142 21.4142C18.0391 21.7893 17.5304 22 17 22H7C6.46957 22 5.96086 21.7893 5.58579 21.4142C5.21071 21.0391 5 20.5304 5 20V6H19Z"
                                                                                stroke="#fff" stroke-width="2"
                                                                                stroke-linecap="round"
                                                                                stroke-linejoin="round"></path>
                                                                        </svg>
                                                                    </button>
                                                                </form>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    @elseif(Auth::user()->role!="admin" &&
                                                    Auth::user()->role!="talent_acquisition")
                                                    <td>
                                                        <span class="badge badge-primary mb-2" data-bs-toggle="modal"
                                                            data-bs-target="#basicModal" style="cursor: pointer;"
                                                            onclick="getid({{ $obj->id }})">+Add Remark</span>
                                                    </td>
                                                    @endif
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <!-- Modal -->
                                        <div class="modal fade" id="basicModal">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Remark Here</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="get" id="addRemarkForm">
                                                            <textarea class="form-control" name="remark" id="remark"
                                                                cols="60" rows="5"></textarea>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger light"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    @endif
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

    // bulk delete function //
    // deleteAll.addEventListener('click', () => {
    //     var string = arrayOfIds.toString();
    //     console.log(string);
    //     window.open('bulk_delete_sheetdata?id=' + string, "_self");
    // });

    // Add manager remark function //
    function getid(id) {
        let form = document.querySelector('#addRemarkForm');
        var url = "{{ url('add_manager_remark') }}" + "/";
        form.action = url + id;
        console.log(form);
    }

</script>
@endsection
