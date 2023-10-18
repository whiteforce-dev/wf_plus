@extends('master.master')
@section('title', 'Month Wise Report')
@section('content')
<style>
    th {
        text-align: center;
        padding: 10px;
        font-size:15px !important;
        color: black;
    }

    td{
        text-align: center;
        font-weight: 500 !important;
        font-size:14px !important;
        color: black;
    }
    table.table tr{
        border-top: 1px solid #cfcfcf !important;
        border-bottom: 1px solid #cfcfcf !important;
    }

    table.table tr>td,
    table.table tr>th{
        border: 1px solid #cfcfcf !important;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Month Wise Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <label for="">Select Parent</label>
                            <select name="parent" id="parent" class="form-control">
                                <option value="">Select</option>
                                @foreach($allParents as $role => $users)
                                    @if(count($users))
                                    <optgroup label="{{ $role }}">
                                    @foreach($users as $id => $user)
                                        <option value="{{ $id }}">{{ ($user) }}</option>
                                    @endforeach
                                    </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Select Year</label>
                            <select name="year" id="year" class="form-control">
                                @for($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ ($i == date('Y')) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for=""></label>
                            <button class="btn btn-primary col-md-12" onclick="getReport()">Get Report</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="month_wise_report_table" class="table table-bordered table-striped" style="min-width: 845px" role="grid">
                            <thead>
                                <tr role="row">
                                    <th><strong>S. No</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Details</strong></th>
                                    @foreach(monthsArray() as $month)
                                    <th><strong>{{ $month }}</strong></th>
                                    @endforeach
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getReport(){
        if($("#parent").val() == '' || $("#year").val() == ''){
            return errorMsg('Please select Parent and Year');
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/month-wise-report') }}",
            data:{
                _token: "{{ csrf_token() }}",
                parent: $("#parent").val(),
               year: $("#year").val()
            },
            success: function(response){
                $('#month_wise_report_table tbody').empty();
                $('#month_wise_report_table tfoot').empty();
                $("#month_wise_report_table").append(response);
            }
        })
    }
</script>
   
@endsection
