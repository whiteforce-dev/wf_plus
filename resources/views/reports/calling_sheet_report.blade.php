@extends('master.master')
@section('title', 'Calling Sheet')
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
                    <h4 class="card-title" style="color: #fff;">Calling Sheet Report</h4>
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
                            <label for="">Start Date</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{ $pastDate }}">
                        </div>
                        <div class="col-md-3">
                            <label for="">End Date</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{ $currentDate }}">
                        </div>
                        <div class="col-md-2">
                            <label for=""></label>
                            <button class="btn btn-info col-md-12" onclick="getReport()">Search</button>
                        </div>
                    </div>
                    <hr>
                    <div class="table-responsive">
                        <table id="calling_sheet_table" class="table table-bordered table-striped" style="min-width: 845px" role="grid">
                            <thead>
                                <tr role="row">
                                    <th><h6>Managers</h6></th>
                                    @foreach($dates as $date)
                                    <th><h6>{{ $date }}</h6></th>
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
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/calling-sheet-report') }}",
            data:{
                _token :"{{ csrf_token() }}",
                parent_id : $("#parent_id").val(),
                start_date: $("#startDate").val(),
                end_date: $("#endDate").val()
            },
            success: function(response){
                console.log(response);
                $('#calling_sheet_table').empty();
                $("#calling_sheet_table").append(response);
            }
        })
    }

    const tableContainer = document.querySelector('.calling_sheet_table');
    const thead = document.querySelector('thead');

        tableContainer.addEventListener('scroll', () => {
        if (tableContainer.scrollTop > 0) {
            thead.classList.add('sticky');
        } else {
            thead.classList.remove('sticky');
        }
        });
</script>

@endsection

