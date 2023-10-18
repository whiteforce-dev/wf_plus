@extends('master.master')
@section('title', 'Add Client')
@section('content')
<a href="{{ url('https://white-force.com/plus/tutorial/#addclientdiv') }}" target="_blank">
    <span class="a14 btn btn-primary" style="bottom:50px;">Help</span>
</a>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('client.store') }}" method="post" id="createClient" enctype="multipart/form-data">
                                @csrf
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder=" Company name"
                                            name="company_name">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" placeholder=" Enter Email Address"
                                            name="email">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Company Percentage</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <input type="number" class="form-control" placeholder="Enter Company Percentage"
                                            name="percent">
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Type</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <div class="input-group ">
                                            <select class="form-control " name="type">
                                                <option selected value="">Select</option>
                                                @foreach($industries as $industry)
                                                <option value="{{ $industry->industry_name }}">{{ $industry->industry_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Website</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <input type="text" class="form-control" placeholder="Company Website"
                                            name="company_website">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Image</label>
                                    <div class="col-sm-6">

                                        <div class="input-group ">
                                            <div class="form-file">
                                                @include('cropper.cropper')
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Aggrement</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <div class="input-group ">
                                            <div class="form-file">
                                                <input type="file" class="form-file-input form-control"
                                                 name="aggrement" accept="application/pdf" id="aggrement">
                                            </div>
                                        </div>
                                        <div id="aggrementPreview" class="mt-4">

                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4" id="editor">
                                    <label class="col-sm-3 col-form-label">About Company</label>
                                    <div class=" col-6">
                                        <textarea class="form-control" placeholder="About Company"
                                            name="about_company"></textarea>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Select Location</label>
                                    <div class="col-2">
                                        <div class="">
                                            <select class="default form-control wide" name="countries" id="country" onchange="getStateList();">
                                                <option  value="">Country</option>
                                                @foreach($countries as $country)
                                                <option  value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control" name="states" id="state"
                                            onchange="getCityList();">
                                            <option value=""> State</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control wide" name="city" id="city">
                                            <option value=""> City</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-4">

                                    <div class="col-6 offset-3">
                                        <button class="btn btn-primary col-12 offset btn-block" type="submit">Create
                                            Company</button>
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


<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script>

        $('#country').val(101);
        getStateList();

        function getStateList(){
            const countryId = $('#country').val(); // Replace with the desired country ID
            $.ajax({
                url: "{{ url('get-state') }}" +"/"+ countryId,
                type: 'GET',
                success: function(response) {
                    // Handle the response containing the state list
                    console.log(response);
                    // Handle the response containing the state list
                    const selectElement = $('#state');

                    // Clear previous options
                    selectElement.empty();

                    // Append new options
                    const option = $('<option>').val('').text('Select State');
                    selectElement.append(option);
                    $.each(response, function(id, name) {
                        const option = $('<option>').val(id).text(name);
                        selectElement.append(option);
                    });
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });

        }
        function getCityList(){
            const stateId = $('#state').val(); // Replace with the desired country ID
            $.ajax({
                url: "{{ url('get-city') }}" +"/"+ stateId,
                type: 'GET',
                success: function(response) {
                    // Handle the response containing the state list
                    console.log(response);
                    // Handle the response containing the state list
                    const selectElement = $('#city');

                    // Clear previous options
                    selectElement.empty();

                    // Append new options
                    const option = $('<option>').val('').text('Select City');
                    selectElement.append(option);
                    $.each(response, function(id, name) {
                        const option = $('<option>').val(id).text(name);
                        selectElement.append(option);
                    });
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });
        }




    // form validation //
    $(document).ready(function ($) {

        $("#createClient").validate({
            rules: {

                email: {
                    required: true,
                    email: true,
                },

                percent: {
                    required: true,
                    number: true,
                    min: 0,
                    max: 100
                },
                company_name: 'required',
                company_website: 'required',
                type: 'required',
                image: 'required',
                // aggrement: 'required',
                about_company: 'required',
                countries: 'required',
                states: 'required',
                city: 'required'
            },
            messages: {

                email: {
                    required: "*Please enter your Email",
                    email: "*Please enter valid Email",
                },

                percent: {
                    required: "*Please enter Company Percentage",
                    number: "*Please enter Company Percentage",
                    min: "*Please enter a value less than or equal to 100",
                    max:"*Please enter a value less than or equal to 100"
                },
                company_name: '*Please enter company name',
                company_website: '*Please mention company website',
                type: '*Please select company type',
                image: '*Please insert company image',
                // aggrement: '*Please insert agreement image',
                about_company: '*Please enter company about',
                countries: "* select country",
                states: "* select state",
                city: "* select city"
            },
            errorPlacement: function (error, element) {

                error.insertAfter(element);

            },
            submitHandler: function (form) {
                form.submit();
            }

        });
    });


    let aggrement=document.querySelector('#aggrement');
    let previewContainer=document.querySelector('#aggrementPreview');
    aggrement.addEventListener('change',()=>{
        var file = aggrement.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.createElement('iframe');
                    preview.src = e.target.result;
                    preview.width = '550px';
                    preview.height = '550px';
                    previewContainer.innerHTML = '';
                    previewContainer.appendChild(preview);
                }
                reader.readAsDataURL(file);
            }
    })
</script>

@endsection
