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
                    <div class="table-responsive card table-scroll" id="daily_lineup_table">
                        @include('master.404')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal right fade right-Modal" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                    <div class="position_Information d-flex flex-wrap align-items-center">
                        <input type="text" id="searchQuery"
                            placeholder="Serach Position By Name, Client Name or Number Of Position"
                            class="form-control" onkeyup="getC()">
                        <div class="m-2 d-flex between">
                            <small>Checked Position will see you
                                after clicking the button</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-body custom-modal-body">
                <div class="custom-tab-1">
                    <div class="tab-content custom-tab-content">
                        <div id="details-tab" class="tab-pane fade active show" role="tabpanel">
                            <div id="can_search_sec">
                                <ul class="grid">

                                </ul>

                                <div class="a14" >
                                    <span style="font-size:80px; color: coral"
                                        class="mdi mdi-checkbox-marked-circle"></span>
                                </div>
                            </div>
                        </div>
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
               console.log(response);
                $('#daily_lineup_table').empty();
                $("#daily_lineup_table").html(response);
            }
        })
    }
</script>

@endsection

