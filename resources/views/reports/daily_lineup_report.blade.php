@extends('master.master')
@section('title', 'Daily Lineup')
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
    font-weight: 700 !important;
    font-size:16px !important;
}

td{
    text-align: center;
    font-weight: 600 !important;
    font-size:15px !important;
}
thead {
  position: sticky;
  top: 0;
  background-color: #f2f2f2;
}


tfoot {
  position: sticky;
  bottom: 0;
  background-color: #f2f2f2;
}
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: #fff;">Daily Lineup Report</h4>
                </div>
                <div class="card-body">
                    <div class="row col-md-12">
                        <div class="col-md-4">
                            <label for="">Select Parent</label>
                            <select name="parent_id" id="parent_id" class="form-control" >
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
                        <!-- <div class="col-md-4">
                            <label for="">Select Team</label>
                            <select name="team[]" id="team" class="form-control" multiple>

                            </select>
                        </div> -->
                        <div class="col-md-3">
                            <label for="">From Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{ $pastDate }}">
                        </div>
                        <div class="col-md-3">
                            <label for="">To Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{ $currentDate }}">
                        </div>
                        <div class="col-md-2">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive card" id="daily_lineup_table">
                        @include('master.404')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    function getReport(){
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/daily-lineup-report') }}",
            data:{
                _token :"{{ csrf_token() }}",
                parent_id : $("#parent_id").val(),
                start_date: $("#startDate").val(),
                end_date: $("#endDate").val()
            },
            success: function(response){
               
                $('#daily_lineup_table').empty();
                $("#daily_lineup_table").html(response);
            }
        })
    }
</script>

@endsection

