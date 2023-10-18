@if($candidates->count()==0)
@include('master.404')
@else
<div class="d-flex my-2" style="justify-content:space-between;">
    <div>
        <h3 class="text-dark ">
            Total Candidates
        </h3>
    </div>
    <div>
        <span class="btn bgl-warning text-danger  status-btn me-3" style="width:100px"><b>{{ $candidates->count()
                }}</b></span>
    </div>
</div>

<table class="table no-footer" id="sortable">
    <thead style="overflow: auto;">
        <tr>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(0)">S.No↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(1)">Recruiter↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(2)">Team Leader↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(3)">Candidate Name↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(4)">Company↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(5)">Company Type↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(6)">Job Profile↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(7)">Location↑</h6>
            </th>
            {{-- <th>
                <h6 style="cursor:pointer" onclick="sortBy()">Count CTC↑</h6>
            </th> --}}
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(8)">Joined Date↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(9)">Recruiter's Remark↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(10)">Company's ↑%</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(11)">Flat Amount↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(12)">Offerd CTC↑</h6>
            </th>
            <th>
                <h6 style="cursor:pointer" onclick="sortBy(13)">Count CTC↑</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidates as $key=> $candidate)
        <tr role="row" class="odd" class="{{ $candidate->position->findClientGet->sub_type ?? 'na' }}">
            <td class="sorting_1">
                <h6>{{ ++$key }}.</h6>
            </td>
            <td class="sorting_1">
                <h6>{{ $candidate->pco->name ?? "" }}</h6>
            </td>
            <td>
                <div class="media style-1">
                    <div class="media-body">
                        <h6>{{ $candidate->pco->realparent->name ?? "" }}</h6>
                        <small class="text-primary">{{ $candidate->created_at->format('M,d') ?? "" }}</small>
                    </div>
                </div>
            </td>
            <td>
                <div>
                    <h6>{{ $candidate->candidate->name ?? "" }}</h6>
                    <span>{{ $candidate->candidate->email ?? "" }}</span>
                </div>
            </td>
            <td>
                <div>
                    <h6 class="text-primary">{{ ucwords($candidate->position->clientname ?? "") }}</h6>
                </div>
            </td>
            <td>
                <div>
                    <h6 class="text-primary">{{ ucwords($candidate->position->findClientGet->sub_type ?? '-') }}</h6>
                </div>
            </td>
            <td>
                <h6 class="text-primary">{{ ucwords($candidate->position->position_name ?? "") }}</h6>
            </td>
            <td><span class="text-success">{{ ucwords($candidate->position->city ?? "") }}</span></td>
            {{-- <td class="sorting_1">
                <h6>{{ inc_format($candidate->offerd_ctc ?? "0") }}</h6>
            </td> --}}
            <td>
                <div class="media style-1">
                    <div class="media-body">
                        <h6>{{ modDate($candidate->joining_date, 'd F, Y') ?? "" }}</h6>
                    </div>
                </div>
            </td>
            <td>
                <div>
                    <span class="badge badge-primary">{{ ucwords($candidate->stage ?? "") }}</span>
                </div>
            </td>
            <td>
                <div>
                    <h6 class="text-dark">{{ $candidate->position->management_fee ? $candidate->position->management_fee.' %' :  '-' }} </h6>
                </div>
            </td>
            <td>
                <div>
                    <h6 class="text-dark">{{ $candidate->position->flat_amount ?? "-" }} </h6>
                </div>
            </td>
            
            <td>
                <h6 class="text-primary">{{ inc_format($candidate->actual_ctc ?? "0") }}</h6>
            </td>
            <td>
                @php
                $fee = $candidate->position->management_fee ?? '-';
                if($fee == '-'){
                $value = 'Managment Fee Not Updated';
                }else if($fee == '0'){
                    $value = $candidate->position->flat_amount ?? 0;
                }else if($fee == '8.33'){
                    $value = $candidate->actual_ctc ?? 0;
                }else{
                    $value = round(($candidate->actual_ctc * $fee * 12)/100);
                }
                @endphp

                <div>
                    <h6 class="text-dark"> {{ $value == 'Managment Fee Not Updated' ? $value : inc_format($value) }} </h6>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endif