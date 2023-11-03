@extends('master.master')
@section('title', 'Interview Pannel Report')
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
                    <h4 class="card-title" style="color: #fff;">Interview Pannel Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <label for="from_date">Select From Date</label>
                            <input type="date" name="from_date" id="from_date" value="{{ $from_date }}" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label for="to_date">Select To Date</label>
                            <input type="date" name="to_date" id="to_date" value="{{ $to_date }}" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="parent">Select Parent</label>
                            <select name="parent" id="parent" class="form-control" onchange="getChildrens(this.value)">
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
                        <div class="col-md-3">
                            <label for="">Select User</label>
                            <select name="team" id="team" class="form-control">
                               
                            </select>
                        </div>
                        <div class="col-md-3" style="padding-top:15px">
                            <label for="">Select Stage</label>
                            <select name="stage" id="stage" class="form-control">
                              <option value="">All</option>
                              @foreach(stagesArr() as $stage)
                              <option value="{{ $stage }}">{{ ucwords(strtolower($stage)) }}</option>
                              @endforeach
                            </select>
                        </div>
                        <div class="col-md-3" style="padding-top:15px">
                            <label for="">Client Name <small>(optional)</small></label>
                            <input type="text" class="form-control" id="client">
                        </div>
                        <div class="col-md-4" style="padding-top:15px">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Get Report</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive table-scroll">
                        <table id="interview_pannel_report_table" class="table table-bordered table-hover" style="min-width: 845px" role="grid">
                            <thead>
                                <tr role="row">
                                    <th><strong>S. No</strong></th>
                                    <th><strong>Client</strong></th>
                                    <th><strong>Position</strong></th>
                                    <th><strong>Candidate Name</strong></th>
                                    <th><strong>Interview Date</strong></th>
                                    <th><strong>Current Stage</strong></th>
                                    <!-- <th><strong>Interview Count</strong></th> -->
                                    <th><strong>Position Created By</strong></th>
                                    <th><strong>Candiate Sourced By</strong></th>
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
    function getChildrens(id){
        $.ajax({
            url : "{{ url('getChildrenRollWiseWithParent') }}" + '/' + id,
            success: function(reponse){
                $('#team').html(reponse);
            }
        })
    }
    function getReport(){
        if($("#from_date").val() == '' || $("#to_date").val() == ''){
            return errorMsg('Please select date range to display report');
        }
        if($("#parent").val() == ''){
            return errorMsg('Please select Parent to display report');
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/interview-pannel-report') }}",
            data:{
                _token: "{{ csrf_token() }}",
                parent: $("#parent").val(),
                team: $("#team").val(),
                from_date: $("#from_date").val(),
                to_date: $("#to_date").val(),
                stage: $("#stage").val(),
                client:$("#client").val()
            },
            success: function(response){
                $('#interview_pannel_report_table tbody').empty();
                $('#interview_pannel_report_table tfoot').empty();
                $("#interview_pannel_report_table").append(response);
            }
        })
    }
</script>
   
@endsection
