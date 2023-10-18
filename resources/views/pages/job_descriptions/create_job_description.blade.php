@extends('master.master')
@section('title', 'Dashboard')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                        <div class="card-header">
                            <div class="col-8">
                                <h4 class="card-title">Add Job Description Template</h4>
                            </div>
                            <div class="col-4 offset-2">
                                <a href="{{ route('job_description.index') }}"><button class="btn btn-primary">View Template</button></a>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('job_description.store') }}" method="post" id="job_description" enctype="multipart/form-data">
                                @csrf

<br>
                                <div class="row">
                                    <div class="col-4">
                                        <label class=" col-form-label ">Job Role </label>
                                    </div>
                                    <div class="col-4">
                                        <label class=" col-form-label ">Min Experience </label>
                                    </div>
                                    <div class="col-4">
                                        <label class=" col-form-label ">Max Experience</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <input type="text" class="form-control" placeholder="" name="role" >
                                        @error('role')
                                        <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <div style="text-align: left">

                                            <select name="MinExperience"   class="form-control" >
                                               <option value="">--Select Minimum--</option>
                                               @for ($i = 1; $i <= 20; $i++)
                                               <option >{{ $i }}<br></option>
                                               @endfor
                                            </select>
                                            @error('MinExperience')
                                            <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                         </div>
                                    </div>
                                    <div class="col-4">
                                        <select name="MaxExperience"    class="form-control" >
                                        <option value="">--Select Maximum--</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                        <option >{{ $i }}<br></option>
                                        @endfor
                                     </select>
                                     @error('MaxExperience')
                                            <strong class="text-danger">{{ $message }}</strong>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class=" col-form-label ">Job Description Allowed characters: 250 words or more * </label>
                                    @error('description')
                                    <strong class="text-danger">{{ $message }}</strong>
                                    @enderror
                                    <div>
                                        <textarea class="form-control"
                                        name="description" id="description">
                                        </textarea>

                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-6 ">
                                        <button class="btn btn-primary" type="submit">Create Job Description</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script>
$(document).ready(function () {
    var form = $("#job_description");
    var submitButton = form.find("button[type='submit']");

    form.validate({
        rules: {
            role: 'required',
            MinExperience: 'required',
            MaxExperience: 'required',
            description: {
                required: true,
                minlength: 250,
            },
        },
        messages: {
            role: '*Please enter Job role',
            MinExperience: '*Minimum Experience is mandatory',
            MaxExperience: '*Maximum Experience is mandatory',
            description: {
                required: '*Please write Job Description',
                minlength: '*Description should have at least 250 characters',
            },
        },
        errorPlacement: function (error, element) {
            error.insertBefore(element);
        }
    });

    submitButton.on("click", function (e) {
        e.preventDefault();

        // Trigger the form validation manually
        form.valid();

        if (form.valid()) {
            form.submit();
        }
    });
});
</script>

<script src="https://cdn.tiny.cloud/1/API-KEY/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#description',
            height: 250, // Adjust the height as needed
            plugins: 'lists', // Add more plugins if required
            toolbar: 'undo redo | styleselect | bold italic | bullist numlist | link',
            // Add more toolbar options as needed
            menubar: false
        });
    });
    </script>

    @endsection
