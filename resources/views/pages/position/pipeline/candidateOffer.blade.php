<div class="modal-header custom-modal-header">

    <div class="col-sm-12">
        <h3>Enter Offerd Details</h3>
        <small>Enter CTC and Joining Date.</small>
    </div>


</div>
<div class="modal-body custom-modal-body" id="modal-body">
    <form action="{{ url('set-offer-detail') }}" id="offerForm" method="post" class="p-5">
        @csrf
        <input type="hidden" name="pipeline" value="{{ $pipeline }}">
        <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Joining
                Date <small style="color:red">*</small></label>
            <div class="col-sm-9">


                <input type="date" class="form-control" value="{{ $pipelineData->joining_date }}" name="joining_date"
                    id="date_picker" placeholder="Enter Joining Date" min="{{ date("Y-m-d") }}">
            </div>
        </div>

        @if (in_array(Auth::user()->software_category, ONROLE_CATEGORY()))
            <div class="mb-3 row">
                <label class="col-sm-3 col-form-label">Offered
                    CTC <small style="color:red">*</small></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control numberOnly" value="{{ $pipelineData->offerd_ctc }}"
                        onkeyup="inWords(this)" id="number" name="offerd_ctc" placeholder=" Enter Offerd CTC">
                    <span id="words" style="text-transform: capitalize;"></span>
                </div>
                @error('offerd_ctc')
                    {{ $message }}
                @enderror
            </div>
        @else
            <div class="mb-3 row" style="display: none;">
                <label class="col-sm-3 col-form-label">Offered
                    CTC <small style="color:red">*</small></label>
                <div class="col-sm-9">
                    <input type="text" class="form-control numberOnly" value="1" onkeyup="inWords(this)"
                        id="number" name="offerd_ctc" placeholder=" Enter Offerd CTC">
                    <span id="words" style="text-transform: capitalize;"></span>
                </div>
                @error('offerd_ctc')
                    {{ $message }}
                @enderror
            </div>
        @endif

        <button style="display: none" id="scheduleInterviewBtn" type="submit"></button>

    </form>
</div>

<div class="modal-footer">
    <button class="btn btn-primary w-100" onclick="offerDetailsSubmit()">Save Offerd Details</button>
</div>

<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(function() {
        $("#offerForm").validate({
            rules: {
                joining_date: "required",
                offerd_ctc: "required",
            },
            messages: {
                joining_date: "Please Select Joining Date",
                offerd_ctc: "Please Enter Offer Amount "
            }
        });
    });




    var a = ['', 'one ', 'two ', 'three ', 'four ', 'five ', 'six ', 'seven ', 'eight ', 'nine ', 'ten ', 'eleven ',
        'twelve ', 'thirteen ', 'fourteen ', 'fifteen ', 'sixteen ', 'seventeen ', 'eighteen ', 'nineteen '
    ];
    var b = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function inWords(dis) {
        var num = dis.value;
        if ((num = num.toString()).length > 9) return 'overflow';
        n = ('000000000' + num).substr(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{1})(\d{2})$/);
        if (!n) return;
        var str = '';
        str += (n[1] != 0) ? (a[Number(n[1])] || b[n[1][0]] + ' ' + a[n[1][1]]) + 'crore ' : '';
        str += (n[2] != 0) ? (a[Number(n[2])] || b[n[2][0]] + ' ' + a[n[2][1]]) + 'lac ' : '';
        str += (n[3] != 0) ? (a[Number(n[3])] || b[n[3][0]] + ' ' + a[n[3][1]]) + 'thousand ' : '';
        str += (n[4] != 0) ? (a[Number(n[4])] || b[n[4][0]] + ' ' + a[n[4][1]]) + 'hundred ' : '';
        str += (n[5] != 0) ? ((str != '') ? 'and ' : '') + (a[Number(n[5])] || b[n[5][0]] + ' ' + a[n[5][1]]) +
            'only ' : '';
        $('#words').html(str);
    }

    $(".numberOnly").on("input", function(evt) {
        var self = $(this);
        self.val(self.val().replace(/\D/g, ""));
        if ((evt.which < 48 || evt.which > 57)) {
            evt.preventDefault();
        }
    });
</script>
