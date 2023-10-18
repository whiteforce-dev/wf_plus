
<table class="table no-footer"  id="sortable">
    <thead style="overflow: auto;">
        <tr>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(0)">S.No↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(1)">Date↑</h6>
            </th>
            <th colspan="2">
                <h6 style="cursor:pointer" onclick="sortBy(2)">Recruiter↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(3)">Position/Company↑</h6>
            </th>
            {{-- <th >
                <h6 style="cursor:pointer" onclick="sortBy(3)">Position↑</h6>
            </th> --}}
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(4)">Location↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(5)">Openings↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(6)">Total CV↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(7)">1st CV Date↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(8)">CTC↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(9)">Status↑</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($positions as $key=> $position)
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <h6>{{ ++$key }}.</h6>
                </td>
                <td class="sorting_1">
                    <h6>{{ modDate($position->created_at, 'M d, Y') }}</h6>
                </td>
                <td class="sorting_1">
                    <img style="border-radius: 50%" height="50" src="{{ $position->findUserData->thumb() }}" alt="">
                    
                </td>
                <td class="sorting_1">
                    <h6>{{ $position->findUserData->name }} <br> <small>{{ getRoleDisplay($position->findUserData->role) }}</small></h6>
                    
                </td>
                <td class="sorting_1">
                   <h6>{{ ucwords($position->position_name) }}
                    <br>
                     <small>{{ $position->clientname }}</small></h6>
                </td>
                {{-- <td class="sorting_1">
                    <h6>{{ $position->position_name }}</h6>
                </td> --}}
                <td class="sorting_1">
                    <h6>{{ $position->locations }}</h6>
                </td>
                <td class="sorting_1">
                    <span class="badge badge-success">{{ $position->openings }}</span>
                </td>
                <td class="sorting_1">
                    <span class="badge badge-primary">{{ $position->PipelineCount }}</span>

                    
                </td>
                <td class="sorting_1">
                    <h6>{{ $position->FirstPipeline }}</h6>
                </td>
                <td class="sorting_1">
                    <small>Upto </small>
                    <h6>{{ inc_format($position->max_salary) }}</h6>
                </td>
                <td class="sorting_1">
                @php
                $status = 'Active';
                $css = 'success';
                if ($position->is_close == 1){
                    $status = 'Closed';
                    $css = 'danger';
                }
                if ($position->is_hold == 1){
                    $status = 'Hold';
                    $css = 'warning';
                }
                @endphp
                <span class="badge badge-{{ $css }}">{{ $status }}</span>
                </td>

            </tr>
        @endforeach
    </tbody>
</table>

