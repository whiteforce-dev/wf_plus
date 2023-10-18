@extends('master.master')
@section('title', 'Quarter Wise Report')
@section('content')
<style>
    td,th {
        text-align: center;
        padding: 10px;
        font-size:15px !important;
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

    table.table thead tr th[rowspan="2"]:first-child,
    table.table thead tr th[rowspan="2"]:nth-child(2),
    table.table tbody tr td:first-child,
    table.table tbody tr td:nth-child(2),
    table.table tfoot tr td[colspan="2"]:first-child{
        position:sticky;
        left:var(--left);
        background: white !important;
    }

    table.table thead tr th[rowspan="2"]:first-child,
    table.table tbody tr td:first-child,
    table.table tfoot tr td[colspan="2"]:first-child{
    --left:0;
    }

    table.table thead tr th[rowspan="2"]:nth-child(2),
    table.table tbody tr td:nth-child(2){
        --left: 45px;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Quarter Wise Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-3">
                            <label for="">Select Parent</label>
                            <select name="parent" id="parent" class="form-control" onchange="getChildrens(this.value)">
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
                            <label for="">Select User</label>
                            <select name="team" id="team" class="form-control">
                               
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Select Quarter</label>
                            <select name="quarter" id="quarter" class="form-control">
                                <option value="1">Quarter 1 (Jan - Mar)</option>
                                <option value="2">Quarter 2 (Apr - Jun)</option>
                                <option value="3">Quarter 3 (Jul - Sep)</option>
                                <option value="4">Quarter 4 (Oct - Dec)</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Select Year</label>
                            <select name="year" id="year" class="form-control">
                                @for($i = 2023; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ ($i == date('Y')) ? 'selected' : '' }}>{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Get Report</button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">
                        <table id="quarter_wise_report_table" class="table table-bordered table-striped" style="min-width: 845px" role="grid">
                        
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
        if($("#parent").val() == ''){
            return errorMsg('Select Parent First');
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/quarter-wise-report') }}",
            data:{
                _token: "{{ csrf_token() }}",
                parent: $("#parent").val(),
                team: $("#team").val(),
                quarter: $("#quarter").val(),
                year: $("#year").val()
            },
            success: function(response){
                $("#quarter_wise_report_table").html(response);
            }
        })
    }
</script>
   
@endsection
