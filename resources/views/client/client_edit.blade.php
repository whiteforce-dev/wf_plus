@extends('master.master')
@section('title', 'Edit Client')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Edit Client Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{route('client.update',$client->id) }}" method="post" id="createClient"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" placeholder=" Company name"
                                            name="company_name" value="{{ $client->name }}">
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Email Address</label>
                                    <div class="col-sm-6">
                                        <input type="email" class="form-control" placeholder=" Enter Email Address"
                                            name="email" value="{{ $client->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-3 col-form-label">Company Percentage</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <input type="number" class="form-control" placeholder="Enter Company Percentage"
                                            name="percent" value="{{ $client->percentage ?? '' }}">
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Type</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <div class="input-group ">
                                            <select class="default-select form-control wide" name="type">
                                                <option selected value="{{ $client->type ?$client->type:''}}">
                                                    {{ $client->type }}</option>
                                                @foreach($industries as $industry)
                                                <option value="{{ $industry->industry_name }}">
                                                    {{ $industry->industry_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Website</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <input type="text" class="form-control" placeholder="Company Website"
                                            name="company_website" value="{{ $client->website }}">
                                    </div>
                                </div>

                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Company Image</label>
                                    <div class="col-sm-6">

                                        <div class="input-group ">
                                            <div class="form-file">



                                                @include('cropper.cropper', ['preview' => $client->image])


                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Aggrement</label>
                                    <div class="col-sm-6 mt-2 mt-sm-0">
                                        <div class="input-group ">
                                            <div class="" id="addClass">
                                                <input type="file" class="form-file-input form-control collapse"
                                                    name="aggrement" value="{{ $client->aggrement }}" id="aggrement"
                                                    accept="application/pdf">
                                            </div>

                                            <input class="form-control" value=" {{ substr($client->aggrement,18)  }} " disabled
                                                style="width:350px;" id="previousFile">
                                            <button type="button" class="btn btn-primary"
                                                id="change_aggrement">change</button>
                                        </div>
                                        <div class="col-6 mt-4">
                                            <iframe src="{{ $client->aggrement }}" frameborder="0" width="550px;"
                                                height="550px;" id="aggrementPreview"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">About Company</label>
                                    <div class=" col-6">
                                        <textarea class="form-control" placeholder="About Company"
                                            name="about_company">{{ $client->about }}</textarea>

                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label">Select Location</label>
                                    <div class="col-2">
                                        <div class="input-group dropend">
                                            <select class="default form-control wide" name="countries" id="country"
                                                onchange="getStateList();">
                                                <option value="">Select Country</option>
                                                @foreach($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control" name="states" id="state"
                                            onchange="getCityList()">
                                            
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <select class="form-control wide" name="city" id="city">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="row my-4">
                                    <label class="col-sm-3 col-form-label"></label>
                                    <div class="col-2">
                                        <button class="btn btn-primary col-12 offset-md-" type="submit">Edit
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

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>

<script>


        var countries = {{ Js::from( $client->country) }}
        
        $('#country option:contains("' + countries + '")').prop('selected', true);
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

                    var state = {{ Js::from($client->state) }}
                    $('#state option:contains("' + state + '")').prop('selected', true);

                    getCityList();
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

                    var city = {{ Js::from($client->location) }}
                    $('#city option:contains("' + city + '")').prop('selected', true);
                },
                error: function(xhr) {
                    // Handle any errors
                    console.log(xhr.responseText);
                }
            });
        }





    //change aggrement design function //
    const btn = document.querySelector('#change_aggrement');
    btn.addEventListener('click', () => {
        var aggrement = document.querySelector('#aggrement');
        aggrement.click();
        aggrement.classList.remove('collapse');
        var design = "form-file";
        document.querySelector('#addClass').classList.add(design);
        document.querySelector('#previousFile').classList.add('collapse');
        btn.classList.add('collapse');
    });

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
                aggrement: 'required',
                about_company: 'required',
                // country: 'required',
                // state: 'required',
                // city: 'required'
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
                    max: "*Please enter a value less than or equal to 100"
                },
                company_name: '*Please enter company name',
                company_website: '*Please mention company website',
                type: '*Please select company type',
                image: '*Please insert company image',
                aggrement: '*Please insert agreement file',
                about_company: '*Please enter company about',
                // country: "* select country",
                // state: "* select state",
                // city: "* select city"
            },
            errorPlacement: function (error, element) {

                error.insertAfter(element);

            },
            submitHandler: function (form) {
                form.submit();
            }

        });
    });

   

    let aggrement = document.querySelector('#aggrement');
    let previewContainer = document.querySelector('#aggrementPreview');
    aggrement.addEventListener('change', () => {
        var file = aggrement.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                previewContainer.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    })

</script>
@endsection
