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
                                <h4 class="card-title">Edit Job Description Template</h4>
                            </div>
                            <div class="col-4 offset-2">
                                <a href="{{ route('job_description.index') }}"><button class="btn btn-primary">View Template</button></a>
                            </div>
                        </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('job_description.update',$job_description->id) }}" method="post" id="job_description" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row my-1">
                                    <label class="col-  col-form-label ">Job Role </label>
                                    <div>
                                        <input type="text" class="form-control" value="{{ $job_description->role }}"
                                        name="role">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label class=" col-form-label ">Min Experience </label>
                                    </div>
                                    <div class="col-6">
                                        <label class=" col-form-label ">Max Experience</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div style="text-align: left">

                                            <select name="MinExperience" id="MinExperience"  class="form-control">
                                               <option>--Select Minimum--</option>
                                               @for ($i = 1; $i <= 20; $i++)
                                               <option {{ $i == $selectedMinExperience ? 'selected' : '' }} >{{ $i }}<br></option>
                                               @endfor
                                            </select>

                                         </div>
                                    </div>
                                    <div class="col-6">
                                        <select name="MaxExperience" id="MaxExperience"  class="form-control">
                                        <option >--Select Maximum--</option>
                                        @for ($i = 1; $i <= 20; $i++)
                                        <option {{ $i == $selectedMaxExperience ? 'selected' : '' }}>{{ $i }}<br></option>
                                        @endfor
                                     </select></div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-  col-form-label ">Job Description Allowed characters: 250 words or more * </label>
                                    <div>
                                        <textarea class="form-control" id="description" name="description">
                                        {{ $job_description->description }}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <div class="col-6 ">
                                        <button class="btn btn-primary" type="submit">Edit Job Description</button>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script>
    // Form validation //
                        $(document).ready(function ($)
 {

                            $("#job_description").validate({
                                rules: {
                                    role: 'required',
                                    description:{

                                        required:true,
                                        minlength:250,
                                    },
                                },
                                messages: {

                                    role: '*Please enter Job role',
                                    description:{

                                        required:'*Please write Job Description',
                                        minlength:'*Description should have atleast 250 characters',
                                    },
                                },
                                errorPlacement: function (error, element) {

                                    error.insertBefore(element);

                                },
                                submitHandler: function (form) {
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
