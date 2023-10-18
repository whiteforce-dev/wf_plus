@extends('master.master')
@section('title', 'Edit User')
@section('content')



    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    

                    <div class="card-header bg-primary">
                        <h4 class="card-title"  style="color:white">Edit User</h4>
                        <button class="btn btn-light btn-sm"><a href="{{ route('user.index') }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                        </span>Back</a></button>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            @if(@$isProfileEdit)
                            
                                <form id="" action="{{ route('user.update',[$user->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <input type="hidden" name="profile" value="{{ $isProfileEdit }}">
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control"
                                            placeholder="Enter Full Name" value="{{ $user->name }}" disabled>
                                    </div>
                                    
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Username / Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control"
                                            placeholder="Userame/Email" value="{{$user->email }}" disabled>
                                    </div>
                                </div>
                                
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Select Software Category</label>
                                    <div class="col-sm-6">
                                        <select id="software_category" class="form-control" disabled>
                                            <option value="">Select Category</option>
                                            <option value="onrole"@if($user->software_category=="onrole")selected='selected'@endif>Onrole</option>
                                            <option value="offrole"@if($user->software_category=="offrole")selected='selected'@endif>Offrole</option>
                                            <option value="franchise-onrole"@if($user->software_category=="franchise-onrole")selected='selected'@endif>Franchise Onrole</option>
                                            <option value="franchise-offrole"@if($user->software_category=="franchise-offrole")selected='selected'@endif>Franchise Offrole</option>
                                        </select>
                                    </div>
                                    

                                </div>
                               

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-6">
                                        <input type="tel" class="form-control" placeholder="contact"
                                            value="{{ $user->contact }}" disabled>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                    <div class="col-sm-6">
                                        {{-- <div class="form-file">
                                        <input type="file" name="profile_image" class="form-file-input form-control">
                                        </div> --}}
                                        @php
                                        $preview = $user->avtar();
                                        @endphp
                                        @include('cropper.cropper')
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6 my-2">
                                        <button type="submit" class="btn btn-primary  w-100">Update User</button>
                                    </div>
                                </div>
                            </form>
                            @else
                            <form id="userForm" action="{{ route('user.update',[$user->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('patch')
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Full Name" value="{{ $user->name }}">
                                    </div>
                                    @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Username / Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Userame/Email" value="{{$user->email }}">
                                    </div> @error('email')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Select Software Category</label>
                                    <div class="col-sm-6">
                                        <select name="software_category" id="software_category" class="form-control">
                                            <option value="">Select Category</option>
                                            <option value="onrole"@if($user->software_category=="onrole")selected='selected'@endif>Onrole</option>
                                            <option value="offrole"@if($user->software_category=="offrole")selected='selected'@endif>Offrole</option>
                                            <option value="franchise-onrole"@if($user->software_category=="franchise-onrole")selected='selected'@endif>Franchise Onrole</option>
                                            <option value="franchise-offrole"@if($user->software_category=="franchise-offrole")selected='selected'@endif>Franchise Offrole</option>
                                        </select>
                                    </div>
                                    @error('software_category')
                                        <span>{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Select Role</label>
                                    <div class="col-sm-6">
                                        <select name="role" onchange="getParent(this);" id="role"
                                            class="form-control">
                                            <option value="">Select Role</option>
                                            <option value="business_head"@if($user->role=="business_head")selected='selected'@endif>Business Head</option>

                                            <option value="general_manager"@if($user->role=="general_manager")selected='selected'@endif>General Manager</option>

                                            <option value="senior_manager"@if($user->role=="senior_manager")selected='selected'@endif>Senior Manager</option>

                                            <option value="manager"@if($user->role=="manager")selected='selected'@endif>Manager</option>

                                            <option value="assistant_manager"@if($user->role=="assistant_manager")selected='selected'@endif>Assistant Manager</option>

                                            <option value="talent_acquisition"@if($user->role=="talent_acquisition")selected='selected'@endif>Talent Acquisition (Recruiter)</option>

                                        </select>

                                    </div> @error('role')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Select Parent</label>
                                    <div class="col-sm-6">
                                        <select name="parent_id" id="parent" class="form-control">
                                            <option value="">Select Parent</option>
                                            @foreach ($users as $parent)
                                                <option value="{{ $parent->id }}"@if($user->parent_id==$parent->id) selected ='selected'@endif>{{ ucwords($parent->name) }}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Is Dummy</label>
                                    <div class="col-sm-6">
                                        <select name="is_dummy" id="is_dummy" class="form-control">
                                            <option value="">Select Type</option>
                                                <option value="0" {{$user->is_dummy == '0' ? 'selected' : '' }}>No</option>
                                                <option value="1" {{$user->is_dummy == '1' ? 'selected' : '' }}>Yes</option>
                                        </select>
                                        @error('is_dummy')
                                            <span>{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Contact</label>
                                    <div class="col-sm-6">
                                        <input type="tel" name="contact" class="form-control" placeholder="contact"
                                            value="{{ $user->contact }}" required>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Upload Image</label>
                                    <div class="col-sm-6">
                                        {{-- <div class="form-file">
                                        <input type="file" name="profile_image" class="form-file-input form-control">
                                        </div> --}}
                                        @php
                                        $preview = $user->avtar();
                                        @endphp
                                        @include('cropper.cropper')
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6 my-2">
                                        <button type="submit" class="btn btn-primary  w-100">Update User</button>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
    <script>
        // form validation //

        $(document).ready(function($) {

            $("#userForm").validate({
                rules: {
                    name: 'required',
                    password: 'required',
                    software_category: 'required',
                    role: 'required',
                    profile_image: 'required',
                    email: {
                        required: true,
                        email: true,
                    },
                    parent_id: 'required',
                    contact: 'required',
                    is_dummy:'required',

                },
                messages: {

                    name: '*Please Enter Your Name',
                    password: '*Please Enter Your Password',
                    software_category: '*Please Select Software Category',
                    role: '*Please Select Role',
                    profile_image: '*Please Upload Profile Image',
                    email: {
                        required: '*Please enter email',
                        email: '*Please enter valid email',
                    },
                    parent_id: '*Please Select Parent',
                    contact: '*Please Select Contact',
                    is_dummy:'*Please Select Type',
                },
                errorPlacement: function(error, element) {

                    error.insertBefore(element);

                },
                submitHandler: function(form) {
                    form.submit();
                }

            });
        });


        function getParent(dis) {
            var role = $(dis).val();
            var software_category = $('#software_category').val();
            $.get("{{ url('get-parent-user') }}", {
                role: role,
                software_category: software_category
            }, function(response) {
                $('#parent').html(response);
            })
        }
    </script>
@endsection
