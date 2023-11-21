
<table class="table table-bordered table-striped" style="min-width: 845px" role="grid">
    <thead style="overflow: auto;">
        <tr>
            <th>
                <h6>Parent</h6>
            </th>
            @foreach($dates as $date)
            <th>
                <h6>{{ $date }}</h6>
            </th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($combine as $key => $data)
        <tr>
            <td>
                <h6>{{ $data["name"] }} @if($key > 0) <br> <small style="font-size: 10px; color:blue; cursor: pointer;"
                        onclick='showChild("{{ $data["id"] }}")'>Show Data</small>@endif </h6>
            </td>
            @foreach($data["counts"] as $ckey => $count)
            @php
            $date = $dates[$ckey].' '.date('Y');
            $date = \Carbon\Carbon::parse($date)->format('Y-m-d');
            @endphp
            <td>
                <h6>
                    <a >
                    <span class="badge badge-primary" style="cursor:pointer;" onclick = 'show({{$data["score"][$ckey]  }});' >{{ $count }}</span>
                    </a>       
                </h6>
            </td>
            @endforeach
        </tr>
        
        @endforeach
    </tbody>
</table>
<div class="modal right fade right-Modal" id="candidates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                    <div class="position_Information d-flex flex-wrap align-items-center">
                        <h4>Matching Percentage List</h4>
                    </div>
                </div>
            </div>
            <div class="modal-body custom-modal-body">
                <div class="custom-tab-1">
                    <div class="tab-content custom-tab-content">
                        <div id="details-tab" class="tab-pane fade active show" role="tabpanel">
                            <div id="can_search_sec">
                                <ul class="grid">
                                    <div class="alert  fade show" style="height: 120px;" id='percentage'>   
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<script>
    function showChild(id) {
        $('#parent_id').val(id);
        getReport();
    }

   function show(e){
   console.log(typeof e);
   let data = "Resume Matching Data";
        for (a in e) {
            console.log(a);
            data += `<div class="alert alert-info alert-dismissible alert-alt fade show" style="display: flex; margin-top:10px;">
                <div class="d-flex justify-content-between" style="width:78%; justify-content:center; align-items:center; margin-top:10px;">
                    <p style="color: #43474b; font-size:0.8rem; font-weight:500; width:60%;">Percentage Matching: <br> <span style="color: rgb(255,76,65);font-size:35px;">` + e[a].score + `%</span></p>
                    <p style="color: #404249; font-size:0.8rem; font-weight:500; width:40%;"> Created At: <br> <span style="color: rgb(255,76,65);">` + e[a].created_at.substring(0,10) + `</span></p>
                </div>
            </div>`;
        }


    $('#candidates').modal('show');
    $('#percentage').empty();
    $('#percentage').html(data);
   }

</script>
