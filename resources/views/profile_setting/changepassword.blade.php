<div class="modal-dialog modal-lg ">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header mh1">

            <h4 class="modal-title"><i class="mdi  mdi-multiplication-box text-white"></i>  Change Password</h4>
            {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
        </div>
        <form action="{{url('updatepassword',[$Details->id])}}" method="post" >
            @csrf
            <div class="modal-body">

                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif


              
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Old Password
                            <small style="color:red">*</small></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password" required>
                        </div>
                        @error('old_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                   
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">New Password
                            <small style="color:red">*</small></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_password" placeholder="Enter New Password" required>
                        </div>
                        @error('new_password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                    </div>
                   
                    <div class="mb-3 row">
                        <label class="col-sm-3 col-form-label">Confirm Password
                            <small style="color:red">*</small></label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="new_password_confirmation" placeholder="Confirm New Password" required>
                        </div>
                    </div>
                   
                    
                 
                   




                </div>


               

                









                <br>













            <div class="modal-footer">
                {{-- <button type="submit" class="btn btn-success" >Update Password</button>
                <button style="display: none" id="updatepasswordBtn" type="submit"></button> --}}
                <button class="btn btn-primary w-100" type="submit" >Update Password</button> 
                {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
            </div>
        </form>
    </div>

</div>
