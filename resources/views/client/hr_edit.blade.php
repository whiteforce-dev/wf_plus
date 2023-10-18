@extends('master.master')
@section('title', 'Edit HR')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .c {
        color: black;
    }

</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Edit HR</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('hr.update',$hr->id) }}" id="addHr" enctype="multipart/form-data"
                                method="post">
                                @csrf
                                @method('PUT')
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label  c ">Client Name</label>
                                    <div class="col-sm-6">
                                        <select class="default-select form-control wide" name="client_name"
                                            placeholder="">

                                            <option value="">Select Client</option>
                                            @foreach($clients as $client)
                                            <option value="{{ $client->id }}"
                                                {{ $hr->clientname && $hr->clientname->id == $client->id ? ' selected' : '' }}>
                                                {{ $client->name }}
                                            </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-sm-2 col-form-label  c ">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Hr Name" name="hr_name"
                                            value="{{ $hr->name }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0  c ">Email</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Hr Email" name="hr_email"
                                            value="{{ $hr->email }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0 c ">Birthday</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" placeholder="Hr Birthday"
                                            name="birthday" value="{{ $hr->dob }}">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0 c ">Mobile</label>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" placeholder="Hr Mobile" name="hr_mobile"
                                            value="{{ $hr->mobile }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0 c ">Location</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Hr Location"
                                            name="hr_location" value="{{ $hr->location }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0 c ">Designation</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder="Hr Designation"
                                            name="hr_designation" value="{{ $hr->designation }}">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label class="col-form-label col-sm-2 pt-0 c "></label>
                                    <div class="col-sm-6">
                                        <button class="btn btn-primary col-12 offset-md-" type="submit">Edit HR</button>
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
    $(document).ready(function ($) {

        $("#addHr").validate({
            rules: {
                client_name: 'required',
                hr_name: 'required',
                birthday: 'required',
                hr_mobile: 'required',
                hr_location: 'required',
                hr_email: {
                    required: true,
                    email: true,
                },
                hr_designation: 'required',

            },
            messages: {

                client_name: '*Please enter client name',
                hr_name: '*Please enter HR name',
                birthday: '*Please enter birthday',
                hr_mobile: '*Please enter mobile number',
                hr_location: '*Please enter location',
                hr_email: {
                    required: '*Please enter email',
                    email: '*Please enter valid email',
                },
                hr_designation: '*Please select designation',
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
@endsection
