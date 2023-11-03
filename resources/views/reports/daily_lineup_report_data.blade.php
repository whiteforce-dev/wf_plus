
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
            <th>
                <h6>Total Count</h6>
            </th>
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
            <td class="text-black font-w600">
                {{ $data["total"] }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
 

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
