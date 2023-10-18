@if(count($companies))
<table class="table no-footer"  id="sortable">
    <thead style="overflow: auto;">
        <tr>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(0)">S.No↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(1)">Client Type↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(2)">Client Name↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(3)">Alloted By↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(4)">Client %↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(5)">Aggrement</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(6)">Last Requirement↑</h6>
            </th>
            <th >
                <h6 style="cursor:pointer" onclick="sortBy(6)">Status↑</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($companies as $key=> $company)
        
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <h6>{{ ++$key }}.</h6>
                </td>
                <td class="sorting_1">
                    <h6>{{ ucwords($company->type) }}</h6>
                 </td>
                <td class="sorting_1">
                   <h6>{{ ucwords($company->name) }}</h6>
                </td>
                <td class="sorting_1">
                    <h6>{{ ucwords($company->alloted_by ?? "-") }}</h6>
                 </td>
                <td class="sorting_1">
                    <h6>{{ str_replace("%","",$company->percentage ?? '-')}} </h6>
                 </td>
                
                 <td class="sorting_1">
                    @php
                    $path = base64_encode('company/agreements/' . $company->aggrement);
                    @endphp
                    @if($company->aggrement)
                    <a href="{{ url('download').'/'.$path }}" target="_blank" ><span class="badge badge-primary"><span class="fa fa-download"></span> &nbsp;&nbsp; Download</span></a>
                    @else
                    <small><a href="javascript:void(0)">  No Aggrement</a></small>
                    @endif
                 </td>
                 <td class="sorting_1">
                    <h6>{{ $company->lastPosition() }}</h6>
                 </td>
                @if($status=='hot')
                <td class="sorting_1">
                    <h6><span class="badge badge-success">{{ ucwords($status) }}</span></h6>
                </td>
                @elseif($status=='cold')
                <td class="sorting_1">
                    <h6><span class="badge badge-info">{{ ucwords($status) }}</span></h6>
                </td>
                @else
                <td class="sorting_1">
                    <h6><span class="badge badge-danger">{{ ucwords($status) }}</span></h6>
                </td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
@else
@include('master.404')
@endif

