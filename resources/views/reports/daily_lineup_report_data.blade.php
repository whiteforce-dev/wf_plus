
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
                    <a href="javascript:void(0)" data-toggle="modal" data-target="#candidates"
                        onclick='showByDate("{{ $data["id"] }}",  "{{ $date }}")'><span
                            class="badge badge-primary">{{ $count }}</span></a>
                </h6>
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>
{{-- <div class="modal right fade right-Modal" id="candidates" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header custom-modal-header">
                <div class="d-flex flex-wrap align-items-center w-100 justify-content-between">
                    <div class="position_Information d-flex flex-wrap align-items-center">
                        <!-- <input type="text" id="searchQuery"
                            placeholder="Serach Position By Name, Client Name or Number Of Position"
                            class="form-control" onkeyup="getC()">
                        <div class="m-2 d-flex between">
                            <small>Checked Position will see you
                                after clicking the button</small>
                        </div> -->
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<script>
    function showChild(id) {
        $('#parent_id').val(id);
        getReport();
    }

    function showByDate(id, date) {
        console.log(id, date)
        $.ajax({
            type: 'POST',
            url: "{{ url('reports/get-lineup-report') }}",
            data: {
                _token: "{{ csrf_token() }}",
                user_id: id,
                date: date,

            },
            success: function (response) {
                // $('.grid').empty();
                // $('.grid').html(response);

                $('#modal-section').html(response);
                $('#rightModal').modal('show');
            }
        })
    }

</script>
