@if($candidates->count()==0)
@include('master.404')
@else
<table class="table  no-footer" id="ListDatatableView" role="grid" aria-describedby="ListDatatableView_info">
    <thead style="overflow: auto;">
        <tr>
            <th>
                <h6>Parent</h6>
            </th>
            <th>
                <h6>Lineup By</h6>
            </th>
            <th>
                <h6>Candidate</h6>
            </th>
            <th>
                <h6>Position</h6>
            </th>
            <th>
                <h6>Current CTC</h6>
            </th>
            <th>
                <h6>Status</h6>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($candidates as $key=> $candidate)
            <tr role="row" class="odd">
                <td class="sorting_1">
                    <h6>{{ $candidate->pco->realparent->name ?? "" }}</h6>
                </td>
                <td>
                    <div class="media style-1">
                        <div class="media-body">
                            <h6>{{ $candidate->pco->name ?? "" }}</h6>
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
                        <h6 class="text-primary">{{ ucwords($candidate->position->position_name ?? "") }}</h6>
                        <span class="text-dark">({{ ucwords($candidate->position->clientname ?? "") }})</span>
                    </div>
                </td>
                <td>
                    <h6 class="text-primary">{{ inc_format($candidate->offerd_ctc ?? "0") }}</h6>
                </td>
                <td><span class="badge badge-success light">{{ ucwords($candidate->stage?? "") }}</span></td>
            </tr>
        @endforeach
    </tbody>
</table>
@endif
