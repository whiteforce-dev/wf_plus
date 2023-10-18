<form action="{{ url('interview-form/' . Auth::user()->id . '/' . $positionId) }}" method="POST" id="interviewForm"
    name="interviewForm">
    @csrf
    <div class="modal fade" id="exampleModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Interview Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="recipient-name" class="col-form-label">Date:</label>
                            <input type="date" class="form-control" autocomplete="off" name="interviewDate"
                                placeholder="Interview Date" required>
                            <input type="hidden" value="{{ $stage->id }}" name="stageId">
                        </div>
                        <div class="col-sm-4">
                            <label for="message-text" class="col-form-label">Time From:</label>
                            <select class="form-control" autocomplete="off" name="interviewTimeFrom">
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
                        <div class="col-sm-4">
                            <label for="recipient-name" class="col-form-label">Time To:</label>
                            <select class="form-control" autocomplete="off" name="interviewTimeTo">

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
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="message-text" class="col-form-label">Interview Venue:</label>
                            <input type="text" class="form-control" autocomplete="off" name="interviewVenue"
                                placeholder="Interview Venue" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="message-text" class="col-form-label">Interview Stage:</label>
                            <select name="interviewStage" id="interviewStage" class="form-control">
                                @foreach ($stages as $item)
                                    <option value="{{ ucwords($item->stageName) }}">
                                        {{ ucwords($item->stageName) }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="message-text" class="col-form-label">Interviewer Name:</label>
                            <input type="text" class="form-control" autocomplete="off" name="interviewerName"
                                placeholder="Interviewer Name">
                        </div>
                        <div class="col-sm-6">
                            <label for="message-text" class="col-form-label">Interviewer Mail
                                Id:</label>
                            <input type="email" class="form-control" autocomplete="off" name="interviewerEmail"
                                placeholder="Interviewer Mail Id">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="interviewForm" autocomplete="off">Schedule
                        Interview</button>

                </div>
            </div>
        </div>
    </div>

</form>
