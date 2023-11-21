@extends('master.master')
@section('title', 'Chrome Extension Report')
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

    .custom-card {
        border-radius: 16px;
        box-shadow: 0 30px 30px -25px rgba(65, 51, 183, 0.25);
        max-width: 300px;
        background: #eaeaea;
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
<style>
    #loader-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(8px);
    }

    .three-bounce {
        margin: 0;
        width: 100%;
        height: 100%;
        text-align: center;
    }

    .three-bounce .sk-child {
        position: relative;
        top: 50%;
        transform: translateY(-50%);
        width: 20px;
        height: 20px;
        background-color: var(--primary);
        border-radius: 100%;
        display: inline-block;
        -webkit-animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
        animation: sk-three-bounce 1.4s ease-in-out 0s infinite both;
    }

    .three-bounce .sk-bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .three-bounce .sk-bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }
</style>
<div id="loader-container" style="display:none;">
    <div class="three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Chrome Extension Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12 mt-3">
                        <div class="col-md-3">
                            <label for="">Select Parent</label>
                            <select name="parent" id="parent" class="form-control" onchange="getChildrens(this.value)" required>
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
                            <select name="team" id="team" class="form-control" required>
                               
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">From Date</label>
                            <input type="date" name="from_date" id="from_date" class="form-control">
                            
                        </div>
                        <div class="col-md-3">
                            <label for="">To Date</label>
                            <input type="date" name="to_date" id="to_date" class="form-control">
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Get Report</button>
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive table-scroll">
                        <table id="chrome_extension_report_table" class="table table-bordered table-striped" style="min-width: 845px" role="grid">
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
        document.querySelector('#loader-container').style.display="block";
        if($("#parent").val() == ''){
            return errorMsg('Select Parent First');
        }
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/chrome-extension-report') }}",
            data:{
                _token: "{{ csrf_token() }}",
                parent: $("#parent").val(),
                team: $("#team").val(),
                from_date: $("#from_date").val(),
                to_date: $("#to_date").val()
            },
            success: function(response){
                document.querySelector('#loader-container').style.display="none";
                $("#chrome_extension_report_table").empty();
                $("#chrome_extension_report_table").html(response);
            }
        })
    }

    function showData(source,user_id){
        var from_date = $('#from_date').val();
        var to_date = $('#to_date').val();
        console.log(source,user_id);
        $.ajax({
            type : "POST",
            url : "{{ url('reports/get-extension-data') }}",
            data : {
                from_date : from_date,
                to_date : to_date,
                source : source,
                user_id : user_id,
                '_token' : "{{ csrf_token() }}"
            },
            success : function(response){
                $('#modal-section').html(response);
                $('#rightModal').modal('show');
            }
        })
    }
</script>
   
@endsection
