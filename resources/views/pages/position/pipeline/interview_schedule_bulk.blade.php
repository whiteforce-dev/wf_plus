<style>
    .ccscroll {
        padding: 4px;
        overflow-y: auto;
        white-space: nowrap;
        cursor: grab;
    }

     #multipleInterview::-webkit-scrollbar {
        display: block !important;
        height: 5px !important;
    }
</style>
<div class="modal-header custom-modal-header">
    <div class="col-sm-12">
        <h3>Interview Schedule Multiple</h3>
        <small>Checked Candidates will see you
            after clicking the button</small>
    </div>
</div>
<div class="modal-body custom-modal-body" id="modal-body">
    <form action="{{ url('set-interview-multiple') }}" method="post" class="p-5" id="setinterview">
        @csrf
        <div class="d-flex justify-content-between">
            <label class="col-form-label">Total Selected Candidates - </label>
            <span class="badge badge-primary">{{ count($pipelines) }}</span>
        </div>
        <div id="multipleInterview" class="ccscroll">
            @foreach($pipelines as $key => $pipeline)
            <button data-candidate="{{ $pipeline->id }}" id="usersec-{{ $pipeline->id }}" class="btn btn-primary btn-sm show-can">{{  ++$key }}. {{ $pipeline->candidate->name }} </button>
            <input type="hidden" name="pipeline[]" value="{{ $pipeline->id }}">
            @endforeach
        </div>
        <p></p>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Interview
                Date<small style="color:red">*</small></label>
            <div class="col-sm-9">
                <input type="date" class="form-control" name="interview_date"
                    value=""placeholder="Interview Date" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Time
                From<small style="color:red">*</small></label>
            <div class="col-sm-9">
                <select class="form-control" autocomplete="off" name="interview_time_from" required
                    value="">

                    <option value="">Select Time</option>
                    <option>08.00 AM</option>
                    <option>08.30 AM</option>
                    <option>09.00 AM</option>
                    <option>09.30 AM</option>
                    <option>10.00 AM</option>
                    <option>10.30 AM</option>
                    <option>11.00 AM</option>
                    <option>11.30 AM</option>
                    <option>12.00 PM</option>
                    <option>12.30 PM</option>
                    <option>01.00 PM</option>
                    <option>01.30 PM</option>
                    <option>02.00 PM</option>
                    <option>02.30 PM</option>
                    <option>03.00 PM</option>
                    <option>03.30 PM</option>
                    <option>04.00 PM</option>
                    <option>04.30 PM</option>
                    <option>05.00 PM</option>
                    <option>05.30 PM</option>
                    <option>06.00 PM</option>
                    <option>06.30 PM</option>
                    <option>07.00 PM</option>
                    <option>07.30 PM</option>
                    <option>08.00 PM</option>
                    <option>08.30 PM</option>
                    <option>09.00 PM</option>
                    <option>09.30 PM</option>
                    <option>10.00 PM</option>
                    <option>10.30 PM</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Time
                To<small style="color:red">*</small></label>
            <div class="col-sm-9">
                {{-- $interview_time_to --}}
                <select class="form-control" autocomplete="off" name="interview_time_to" required>
                    <option value="">Select Time</option>
                    <option>08.00 AM</option>
                    <option>08.30 AM</option>
                    <option>09.00 AM</option>
                    <option>09.30 AM</option>
                    <option>10.00 AM</option>
                    <option>10.30 AM</option>
                    <option>11.00 AM</option>
                    <option>11.30 AM</option>
                    <option>12.00 PM</option>
                    <option>12.30 PM</option>
                    <option>01.00 PM</option>
                    <option>01.30 PM</option>
                    <option>02.00 PM</option>
                    <option>02.30 PM</option>
                    <option>03.00 PM</option>
                    <option>03.30 PM</option>
                    <option>04.00 PM</option>
                    <option>04.30 PM</option>
                    <option>05.00 PM</option>
                    <option>05.30 PM</option>
                    <option>06.00 PM</option>
                    <option>06.30 PM</option>
                    <option>07.00 PM</option>
                    <option>07.30 PM</option>
                    <option>08.00 PM</option>
                    <option>08.30 PM</option>
                    <option>09.00 PM</option>
                    <option>09.30 PM</option>
                    <option>10.00 PM</option>
                    <option>10.30 PM</option>
                    <option>11.00 PM</option>
                    <option>11.30 PM</option>
                </select>

            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Venue
                / Place <small style="color:red">*</small></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="interview_venue" placeholder="Enter Venue/Place "
                    value="" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label"> Name </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="interviewer_name" placeholder="Enter Interviewer Name">
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">
                Email</label>
            <div class="col-sm-9">
                <input type="email" class="form-control"
                    name="interviewer_email"placeholder="Enter Interviewer Email">
            </div>
        </div>

       

    </form>
</div>

<div class="modal-footer">
    <button class="btn btn-primary w-100" onclick="scheduleInterviewBulkSubmit()">Schedule</button>
</div>


<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(function() {
        $("#setinterview").validate({
            rules: {
                interview_date: "required",
                interview_time_from: "required",
                interview_time_to: "required",
                interview_venue: "required",
            },
            messages: {
                interview_date: "Please select interview date",
                interview_time_from: "Please select interview time from",
                interview_time_to: "Please select interview time to",
                interview_venue: "Please enter interview venue",
            }
        });
    });
</script>
