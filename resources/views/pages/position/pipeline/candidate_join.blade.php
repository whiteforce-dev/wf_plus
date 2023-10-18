<div class="modal-header custom-modal-header">

    <div class="col-sm-12">
        <h3>Enter Candidate Information</h3>
        <small>Enter Passbook, Aadhar and Pan Information</small>
    </div>


</div>
<div class="modal-body custom-modal-body" id="modal-body">
    <form action="{{ url('set-joining-details') }}" id="joiningdetailsform" method="post" class="p-5">
        @csrf
        <input type="hidden" name="pipeline" value="{{ $pipeline }}">
        {{-- <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Aadhar Card </label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="aadharcard" id="aadharcard">
            </div>
        </div>
        <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Pan Card </label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="pancard" id="pancard">
            </div>
        </div>
        <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Passbook </label>
            <div class="col-sm-9">


                <input type="file" class="form-control" name="passbook" id="passbook">
            </div>
        </div> --}}
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Management Fees</label>
            <div class="col-sm-9">
                <select class="form-control" name='management_fee' required id="management_fee" onchange="change(this.value)">
                    <option value="" disabled selected>Select Percentage</option>
                    <option value="0" {{ $position->position->management_fee == '0' ? 'selected' : '' }}>Flat Amount</option>
                    <option value="2" {{ $position->position->management_fee == '2' ? 'selected' : '' }}>2%</option>
                    <option value="3" {{ $position->position->management_fee == '3' ? 'selected' : '' }}>3%</option>
                    <option value="4" {{ $position->position->management_fee == '4' ? 'selected' : '' }}>4%</option>
                    <option value="5" {{ $position->position->management_fee == '5' ? 'selected' : '' }}>5%</option>
                    <option value="6" {{ $position->position->management_fee == '6' ? 'selected' : '' }}>6%</option>
                    <option value="6.5" {{ $position->position->management_fee == '6.5' ? 'selected' : '' }}>6.5%</option>
                    <option value="7" {{ $position->position->management_fee == '7' ? 'selected' : '' }}>7%</option>
                    <option value="7.5" {{ $position->position->management_fee == '7.5' ? 'selected' : '' }}>7.5%</option>
                    <option value="8" {{ $position->position->management_fee == '8' ? 'selected' : '' }}>8%</option>
                    <option value="8.33" {{ $position->position->management_fee == '8.33' ? 'selected' : '' }}>8.33%</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row" id="flat">
            <label class="col-sm-3 col-form-label">Flat Amount </label>
            <div class="col-sm-9">
                <input type="number" class="form-control" name="flat_amount" id="flat_amount" value="{{ $position->position->flat_amount ??'0' }}" >
            </div>
        </div>
        <div class="mb-3 row">
            <label class="col-sm-3 col-form-label">Offer Letter </label>
            <div class="col-sm-9">
                <input type="file" class="form-control" name="offerLetter" id="offerLetter" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,">
            </div>
        </div>
        {{-- <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">UAN/ESIC No</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" placeholder="Enter UAN / ESIC Number" name="uan_esic"
                    id="uan_esic">
            </div>
        </div> --}}
        {{-- <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Payroll</label>
            <div class="col-sm-9">
                <select name="is_payroll" id="is_payroll" class="form-control">
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
        </div>
        <div class="mb-3 row">

            <label class="col-sm-3 col-form-label">Company Type</label>
            <div class="col-sm-9">
                <select name="company_type" id="company_type" class="form-control">
                    <option value="temp">Temp</option>
                    <option value="it">IT</option>
                    <option value="onetime">One Time</option>
                </select>
            </div>
        </div> --}}
    </form>
</div>

<div class="modal-footer">
    <button class="btn btn-primary w-100" onclick="saveJoinedDetails()">Save Offerd Details</button>
</div>

<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script>
    $(document).ready(function() {
        $("#joiningdetailsform").validate({
            rules: {
                management_fee: "required",
                offerLetter: "required",
                flat_amount:"required",
            },
            messages: {
                management_fee: "Please Select Management Fee.",
                offerLetter: "Please Update Offer Letter.",
                flat_amount:"Please Enter Flat Amount.",
            }
        });

    });

    var management_fee=document.querySelector('#management_fee');
    var flat_amount=document.querySelector('#flat_amount');
    var flat=document.querySelector('#flat');
    function enable(){
        if(management_fee.value!=0){
            flat.classList.add('collapse');
        }
    }
    enable();

    function change(e){
        if(e==0){
            flat.classList.remove('collapse');
        }
        else{
            flat_amount.value=0;
            flat.classList.add('collapse');

        }
    }
</script>
