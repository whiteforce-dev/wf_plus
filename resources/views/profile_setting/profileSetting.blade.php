<div class="modal-header custom-modal-header">
    <div class="col-sm-12">
        <h3>My Profile</h3>
        <small>You can check your details</small>
    </div>
</div>
<style>
    .geeks {
        width: 100%;
        height: 100%;
        padding: 4px;
        background: #fba2a21c;
        position: relative;
    }

    .pimg {
        width: 100%;
        height: 100%;
    }

    .boxborder {
        border-top: 1px solid #dfe7eb;
        padding-bottom: 8px;
        padding-top: 8px;
    }

    .changeImg {
        position: absolute;
        background: #ffffff8f;
        display: grid;
        place-content: center;
        inset: 0;
        margin: 0;
        display: none;
    }

    .geeks:hover .changeImg {
        display: grid
    }
</style>
<div class="modal-body custom-modal-body p-5" id="modal-body">
    <div class="col-md-12 row">
        <div class="col-sm-4" align="center">
            <div class="geeks">
                <p class="changeImg"><a href="{{ url('edit-profile') }}" class="btn btn-xs btn-primary"><span
                            class="fa fa-pencil"></span></a></p>
                <img class="pimg" src="{{ auth()->user()->avtar() }}" alt="Geeks Image" />
            </div>


        </div>
        <div class="col-sm-8">
            <div class="row " style="padding-bottom: 12px;
            padding-top: 10px;">
                <div class="col-sm-3">
                    <h6 class="mb-0"> Name</h6>
                </div>
                <div class="col-sm-9 text-dark">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <div class="row boxborder">
                <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                </div>
                <div class="col-sm-9 text-dark">
                    {{ auth()->user()->email }}
                </div>
            </div>

            <div class="row boxborder">
                <div class="col-sm-3">
                    <h6 class="mb-0">Phone</h6>
                </div>
                <div class="col-sm-9 text-dark">
                    {{ auth()->user()->contact }}
                </div>
            </div>

            <div class="row boxborder">
                <div class="col-sm-3">
                    <h6 class="mb-0">Role</h6>
                </div>
                <div class="col-sm-9 text-dark">
                    {{ ucwords(auth()->user()->role) }}
                </div>
            </div>
        </div>


        <form action="{{ url('updatepassword', [$Details->id]) }}" autocomplete="off" method="post" class="mt-5">
            @csrf
            <h4>Change Password</h4>
            <br>

            {{-- <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Old Password
                    <small style="color:red">*</small></label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password"
                        required>
                </div>
                @error('old_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">New Password
                    <small style="color:red">*</small></label>
                <div class="col-sm-8">
                    <input type="text" style="-webkit-text-security: disc;
                    text-security: disc;" id="password1" minlength="8" class="form-control" name="new_password"
                        placeholder="Enter New Password" required autocomplete="off">
                </div>
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 row">
                <label class="col-sm-4 col-form-label">Confirm Password
                    <small style="color:red">*</small></label>
                <div class="col-sm-8">
                    <input type="text" style="-webkit-text-security: disc;
                    text-security: disc;" id="password2" class="form-control" name="new_password_confirmation"
                        placeholder="Confirm New Password" required autocomplete="off">
                        <small id="validate-status"></small>
                </div>
            </div>
            <button style="display: none" id="changePasswordBtn">change</button>

        </form>


    </div>

</div>
<div class="modal-footer">
    <button id="change-password" onclick="changePassword();" class="btn btn-primary w-100" type="button">Change
        Password</button>
</div>

<script>
    $("#change-password").prop("disabled", true);
    function changePassword() {
        $('#changePasswordBtn').click();
    }

    $(document).ready(function() {
        $("#password2").keyup(validate);
        $("#password1").keyup(validate);
    });

    function validate() {
        var password1 = $("#password1").val();
        var password2 = $("#password2").val();

        if (password1 == password2) {
            $("#validate-status").text("Passowrd Matched");
            $("#change-password").prop("disabled", false);
        } else {
            $("#validate-status").text("Password Mismatched");
            $("#change-password").prop("disabled", true);
        }
    }
</script>
