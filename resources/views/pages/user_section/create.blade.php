@extends('master.master')
@section('title', 'Create User')
@section('content')



    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    {{-- <div class="card-header">
                        <h4 class="card-title">Create User</h4>
                    </div> --}}
                    <div class="card-header bg-primary">
                        <h4 class="card-title"  style="color:white">Create User</h4>
                        <button class="btn btn-light btn-sm"><a href="{{ url('home') }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                        </span>Back</a></button>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form id="userForm" action="{{ route('user.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" name="name" class="form-control"
                                            placeholder="Enter Full Name">
                                    </div>
                                    @error('name')
                                        <span style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Enter Username / Email</label>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" class="form-control"
                                            placeholder="Userame/Email">
                                    </div> @error('email')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Create Password</label>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>
                                    @error('password')
                                        <span>{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Select Software Category</label>
                                    <div class="col-sm-6">
                                        <select name="software_category" id="software_category" class="form-control">
                                            <option value="">Select Category</option>
                                            @foreach (CATEGORIES() as $category)
                                                <option value="{{ $category }}"
                                                    {{ Auth::user()->software_category == $category ? 'selected' : '' }}>
                                                    {{ ucwords($category) }}
                                                </option>
                                            @endforeach
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
                                            <option value="business_head">Business Head</option>
                                            <option value="general_manager">General Manager</option>
                                            <option value="senior_manager">Senior Manager</option>
                                            <option value="manager">Manager</option>
                                            <option value="assistant_manager">Assistant Manager</option>
                                            <option value="talent_acquisition">Talent Acquisition (Recruiter)</option>
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
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}">{{ ucwords($user->name) }}</option>
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
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                        </select>
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
                                        @include('cropper.cropper')
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-sm-6 my-2">
                                        <button type="submit" class="btn btn-primary  w-100">Create User</button>
                                    </div>
                                </div>
                            </form>
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
