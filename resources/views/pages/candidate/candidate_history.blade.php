 @if($history->count()==0)
<div align="center">
    <lottie-player src="https://assets2.lottiefiles.com/packages/lf20_NlLnID.json" background="transparent" speed="1"
        style="width: 600px; height: 450px;" autoplay></lottie-player>
    <h3 class="text-danger">No Data Found</h3>
</div>
@endif

@foreach($history as $detail)
 @if($detail->type=="sourcing")
 <div class="alert alert-warning alert-dismissible alert-alt fade show" style="height: 120px;">
    <div style="width: 100%;display:flex; margin-top:-10px; border-bottom:1px solid rgb(233, 214, 206); height: 30px;">
        <p class="view" style="color: rgb(73, 74, 78);font-weight:600; width:55%; margin:0 auto; text-align:left;">
            <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 10px"></i> Staged On -{{ $detail->created_at->format('M d, Y') }}</p>
        <p
            style="color: #4a4b4e; font-size:0.8rem; font-weight:500; width:45%; display:flex; justify-content:end; margin-right:2px;">
            Created By : <span style="color: rgb(255,76,65);"> {{
                ucwords($detail->createBy->name ?? "N/A") }}</span>
        </p>
    </div>
    <div style="display: flex; margin-top:10px;">
        <div class="d-flex justify-content-between"
            style="width:78%; justify-content:center; align-items:center; margin-top:10px;">
            <p style="color: #43474b; font-size:0.8rem; font-weight:500; width:60%;">Position: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->position->position_name ?? "N/A") }}</span></p>
            <p style="color: #404249; font-size:0.8rem; font-weight:500; width:40%;"> Changed By: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->changeBy->name ?? "N/A") }}</span></p>
        </div>

        <div class="d-flex justify-content-around"
            style=" flex-direction:column !important; width:22%; justify-content:end; align-items:center;">
            <div style="display: flex; flex-direction:column; width:100%; align-item:center; justify-content:end;">
                <p class="view"
                    style="background-color: white; color:rgb(75, 77, 82); border:1px solid rgb(247, 222, 210); font-weight:600;width: 100%; height:27px; border-radius:3px; margin:0 0; text-align:center; padding-top:1px;">
                    {{ ucwords($detail->stage ?? "N/A") }}</p>
                <p class="bg-warning"
                    style="width: 100%;  color:white; text-align:center; padding-top:2px; height:27px; border-radius:3px; margin:5px 0;">
                    {{ ucwords($detail->type ?? "N/A") }}!</p>
            </div>
        </div>
    </div>
</div>
@elseif($detail->type=="stage updated")
<div class="alert alert-success alert-dismissible alert-alt fade show" style="height: 120px;">
    <div style="width: 100%;display:flex; margin-top:-10px; border-bottom:1px solid rgb(233, 214, 206); height: 30px;">
        <p class="view" style="color: rgb(73, 74, 78);font-weight:600; width:55%; margin:0 auto; text-align:left;">
            <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 10px"></i> Staged On -{{ $detail->created_at->format('M d, Y') }}</p>
        <p
            style="color: #4a4b4e; font-size:0.8rem; font-weight:500; width:45%; display:flex; justify-content:end; margin-right:2px;">
            Created By : <span style="color: rgb(255,76,65);"> {{
                ucwords($detail->createBy->name ?? "N/A") }}</span>
        </p>
    </div>
    <div style="display: flex; margin-top:10px;">
        <div class="d-flex justify-content-between"
            style="width:78%; justify-content:center; align-items:center; margin-top:10px;">
            <p style="color: #43474b; font-size:0.8rem; font-weight:500; width:60%;">Position: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->position->position_name ?? "N/A") }}</span></p>
            <p style="color: #404249; font-size:0.8rem; font-weight:500; width:40%;"> Changed By: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->changeBy->name ?? "N/A") }}</span></p>
        </div>

        <div class="d-flex justify-content-around"
            style=" flex-direction:column !important; width:22%; justify-content:end; align-items:center;">
            <div style="display: flex; flex-direction:column; width:100%; align-item:center; justify-content:end;">
                <p class="view"
                    style="background-color: white; color:rgb(75, 77, 82); border:1px solid rgb(247, 222, 210); font-weight:600;width: 100%; height:27px; border-radius:3px; margin:0 0; text-align:center; padding-top:1px;">
                    @if($detail->stage == 'offered')
                    <marquee>{{ ucwords($detail->stage ?? "N/A") }}, ₹ {{ inc_format($detail->offerd_ctc ?? 0) }}</marquee>
                    @else
                    {{ ucwords($detail->stage ?? "N/A") }}
                    @endif
                
                </p>
                <p class="bg-success"
                    style="width: 100%;  color:white; text-align:center; padding-top:2px; height:27px; border-radius:3px; margin:5px 0;">
                    {{ ucwords($detail->type ?? "N/A") }}!</p>
            </div>
        </div>
    </div>
</div>
@elseif($detail->type=="interview")
<div class="alert alert-info alert-dismissible alert-alt fade show" style="height: 120px;">
    <div style="width: 100%;display:flex; margin-top:-10px; border-bottom:1px solid rgb(233, 214, 206); height: 30px;">
        <p class="view" style="color: rgb(73, 74, 78);font-weight:600; width:55%; margin:0 auto; text-align:left;">
            <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 10px"></i> Staged On -{{ $detail->created_at->format('M d, Y') }}</p>
        <p
            style="color: #4a4b4e; font-size:0.8rem; font-weight:500; width:45%; display:flex; justify-content:end; margin-right:2px;">
            Created By : <span style="color: rgb(255,76,65);"> {{
                ucwords($detail->createBy->name ?? "N/A") }}</span>
        </p>
    </div>
    <div style="display: flex; margin-top:10px;">
        <div class="d-flex justify-content-between"
            style="width:78%; justify-content:center; align-items:center; margin-top:10px;">
            <p style="color: #43474b; font-size:0.8rem; font-weight:500; width:60%;">Position: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->position->position_name ?? "N/A") }}</span></p>
            <p style="color: #404249; font-size:0.8rem; font-weight:500; width:40%;"> Changed By: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->changeBy->name ?? "N/A") }}</span></p>
        </div>

        <div class="d-flex justify-content-around"
            style=" flex-direction:column !important; width:22%; justify-content:end; align-items:center;">
            <div style="display: flex; flex-direction:column; width:100%; align-item:center; justify-content:end;">
                <p class="view"
                    style="background-color: white; color:rgb(75, 77, 82); border:1px solid rgb(247, 222, 210); font-weight:600;width: 100%; height:27px; border-radius:3px; margin:0 0; text-align:center; padding-top:1px;">
                    <marquee>
                    {{ ucwords($detail->stage ?? "N/A") }}, {{ modDate($detail->interview_date, 'd F, Y') }}
                    </marquee>
                </p>
                <p class="bg-info"
                    style="width: 100%; color:white; text-align:center; padding-top:2px; height:27px; border-radius:3px; margin:5px 0;">
                    {{ ucwords($detail->type ?? "N/A") }}!</p>
            </div>
        </div>
    </div>
</div>
@else
<div class="alert alert-danger alert-dismissible alert-alt fade show" style="height: 120px;">
    <div style="width: 100%;display:flex; margin-top:-10px; border-bottom:1px solid rgb(233, 214, 206); height: 30px;">
        <p class="view" style="color: rgb(73, 74, 78);font-weight:600; width:55%; margin:0 auto; text-align:left;">
            <i class="fa fa-clock-o" aria-hidden="true" style="margin-right: 10px"></i> Staged On -{{ $detail->created_at->format('M d, Y') }}</p>
        <p
            style="color: #4a4b4e; font-size:0.8rem; font-weight:500; width:45%; display:flex; justify-content:end; margin-right:2px;">
            Created By : <span style="color: rgb(255,76,65);"> {{
                ucwords($detail->createBy->name ?? "N/A") }}</span>
        </p>
    </div>
    <div style="display: flex; margin-top:10px;">
        <div class="d-flex justify-content-between"
            style="width:78%; justify-content:center; align-items:center; margin-top:10px;">
            <p style="color: #43474b; font-size:0.8rem; font-weight:500; width:60%;">Position: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->position->position_name ?? "N/A") }}</span></p>
            <p style="color: #404249; font-size:0.8rem; font-weight:500; width:40%;"> Changed By: <br> <span
                    style="color: rgb(255,76,65);">{{
                        ucwords($detail->changeBy->name ?? "N/A") }}</span></p>
        </div>

        <div class="d-flex justify-content-around"
            style=" flex-direction:column !important; width:22%; justify-content:end; align-items:center;">
            <div style="display: flex; flex-direction:column; width:100%; align-item:center; justify-content:end;">
                <p class="view"
                    style="background-color: white; color:rgb(75, 77, 82); border:1px solid rgb(247, 222, 210); font-weight:600;width: 100%; height:27px; border-radius:3px; margin:0 0; text-align:center; padding-top:1px;">
                    <marquee>Stage : {{ ucwords($detail->stage ?? "N/A") }}, Joining Date : {{ modDate($detail->joining_date, 'd F, Y') }}</marquee>
                    {{-- <marquee>{{ ucwords($detail->stage ?? "N/A") }}, {{ modDate($detail->joining_date, 'd F, Y') }}</marquee> --}}
                    </p>
                <p class="bg-danger"
                    style="width: 100%; color:white; text-align:center; padding-top:2px; height:27px; border-radius:3px; margin:5px 0;">
                    {{ ucwords($detail->type ?? "N/A") }}!</p>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach


