
@if($details)
<table class="table no-footer"  id="sortable">
    <thead style="overflow: auto;">
        <tr>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(0)">S.No↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(1)">Manager↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(2)">Recruiter↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(3)">Total Calls↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(4)">Total Lineup↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(5)">Interview↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(6)">Joined↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(7)">Joined CTC↑</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($details as $key=> $detail)
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <h6>{{ ++$key }}.</h6>
                </td>
                <td class="sorting_1">
                    <h6>{{ $detail["parent"]["name"] ?? "-" }}</h6>
                </td>
                <td>
                    <div class="media style-1">
                        <div class="media-body">
                            <h6>{{ $detail["user"]["name"] ?? "-" }}</h6>
                              <!-- <small class="text-primary">sdf</small> -->
                        </div>
                    </div>
                </td>
                <td>
                    <div>
                        <h6>{{ $detail["sheet"] ?? "-" }}</h6>
                    </div>
                </td>
                <td>
                    <div>
                        <h6 class="text-primary">{{ $detail["pipeline"] ?? "-" }}</h6>
                    </div>
                </td>
                <td>
                    <h6 class="text-primary">{{ $detail["interview"] ?? "-" }}</h6>
                </td>
                <td><h6><span class="text-success">{{ $detail["joining"] ?? "-" }}</span></h6></td>
                <td class="sorting_1">
                    <h6>{{ inc_format($detail["joining_ctc"] ?? "-") }}</h6>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif


