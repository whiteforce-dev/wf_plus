
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
                    <a href="javascript:void(0)"><span
                            class="badge badge-primary">{{ $count }}</span></a>
                </h6>
            </td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>


<script>
    function showChild(id) {
        $('#parent_id').val(id);
        getReport();
    }

    

</script>
