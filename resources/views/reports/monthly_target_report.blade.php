@extends('master.master')
@section('title', 'Monthly Target')
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
    .table-container{
        position: relative;
       
    }
    table {
        width: 100%; 
        border-collapse: collapse;
    }
    thead {
    position: sticky;
    top: 0;
    background-color: white;
    z-index: 1;
    }

.table-scroll {
    max-height: 400px; 
    overflow-y: scroll;
    border-top: 1px solid #ccc; 
}
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Monthly Target Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <label for="">Select Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="">Select</option>
                                @foreach($allParents as $role => $users)
                                    @if(count($users))
                                    <optgroup label="{{ $role }}">
                                    @foreach($users as $id => $user)
                                        <option value="{{ $id }}">{{ $user }}</option>
                                    @endforeach
                                    </optgroup>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Get Report</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive table-scroll">
                        <table id="monthly_target_table" class="table table-bordered table-striped" style="min-width: 845px" role="grid">
                            <thead>
                                <tr role="row">
                                    <th><strong>S. No</strong></th>
                                    <th><strong>Image</strong></th>
                                    <th><strong>Name</strong></th>
                                    <th><strong>Candidate Approach</strong></th>
                                    <th><strong>Joined Candidate</strong></th>
                                    <th><strong>Backout Candidate</strong></th>
                                    <th><strong>Quarterly Join Candidate</strong></th>
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
        if($("#parent_id").val() == ''){
            return errorMsg('Please select Parent to fetch report');
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/monthly-target-report') }}",
            data:{
                _token :"{{ csrf_token() }}",
                parent_id : $("#parent_id").val()
            },
            success: function(response){
                $('#monthly_target_table tbody').empty();
                $('#monthly_target_table tfoot').empty();
                $("#monthly_target_table").append(response);
            }
        })
    }
</script>
   
@endsection
