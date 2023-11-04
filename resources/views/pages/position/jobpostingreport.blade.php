<style>
    .disabled {
        opacity: 0.3;
    }

    .redBorder {
        border: 2px solid #e23c3c;
    }
</style>
<div class="modal-header custom-modal-header">

    <div class="col-sm-12">
        <h3>Job Posting Report</h3>
        <small>All history about Job Posting</small>
    </div>


</div>
<div class="modal-body custom-modal-body p-3" id="modal-body">

    <table class="table">
        <thead>
            <tr>
                <th>S.No.</th>
                <th>Portal</th>
                <th>Status</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody> @php

           
        @endphp <tr>
                <td>1</td>
                <td style="width: 30% !important;"> <img class="" src="{{ url('job-posting-assets/happiest.png') }}"
                        alt="happiest" srcset="" style="height:30px; width:auto;"></td>
                <td> <span class="badge">Posted</span> </td>
                <td>Job Posted Successfully in Happiest Resume </td>
                <td><span class="badge">-</span> </td>
            </tr>
            <tr>
                <td>2</td>
                <td style="width: 30% !important;"> <img class="" src="{{ url('job-posting-assets/wf.png') }}"
                        alt="happiest" srcset="" style="height:30px; width:auto;"></td>
                <td> <span class="badge">Posted</span> </td>
                <td>Job Posted Successfully in White Force</td>
                <td><span class="badge">-</span> </td>
            </tr> @php $count = 2;

             @endphp @foreach ($portals as $key => $item)
             @php
                $src = logos($item->portal);
             @endphp
                <tr>
                    <td>{{ ++$count }}</td>
                    <td style="width: 30% !important;"> <img class="{{ $item->is_success == 1 ? '' : 'disabled' }}"
                        src="{{ $src ?? '' }}"
                        alt="{{ $item->portal }}" srcset=""
                            style="height:30px; width:auto;"></td>
                    <td> <span
                            class="badge {{ $item->is_success == 1 ? '-' : 'badge-danger' }}">{{ $item->is_success == 1 ? 'Posted' : 'Not Posted' }}</span>
                    </td>
                    @if (strlen($item->response) > 50)
                        <td style="width: 30% !important;">{{ substr($item->response, 0, 50) }} <a
                                style="color:blue; cursor: pointer;" data-toggle="tooltip" data-placement="top"
                                title="{{ $item->response }}"> View more</a></td>
                    @else
                        <td style="width: 30% !important;">{{ $item->response }} </td>
                    @endif
                    <td><span
                            class="badge">{{ \Carbon\carbon::parse($item->created_at)->format('M, d Y h:i A') }}</span>
                    </td>
                </tr>
                @endforeach <tr>
                    <td colspan="5" align="center"><b>Not Seleted Portals</b></td>
                </tr>
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Portal</th>
                        <th>Status</th>
                        <th colspan="2">Message</th>
                    </tr>
                </thead>
                @foreach ($notSelectedPortals as $key => $item)
                @php
                $src = logos($item);
                @endphp
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td style="width: 30% !important;"> <img src="{{ $src ?? '' }}"
                                alt="{{ $item }}" srcset="" style="height:30px; width:auto;"></td>
                        <td> <span class="badge badge-danger">Not Selected</span> </td>
                        <td style="width: 30% !important;" colspan="2">{{ ucfirst($item) }} Portal Not selected.
                        </td>
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
</div>
