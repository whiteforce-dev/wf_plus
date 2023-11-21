@extends('master.master')
@section('title', 'Send Joining Form')
@section('content')


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    .c{
        color:black;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">

                    <div class="card">
                        <div class="card-header bg-primary">
                            <h4 class="card-title" style="color:white">Send Joining Form</h4> <a href={{ url('receiver-list') }}><button class="btn btn-light"><b> Email List -</b> &nbsp; <span  class="badge badge-danger">{{ $email_count }}</span> </button> </a>
                        </div>
                        <div class="card-body">
                            <div class="basic-form">
                                <form action={{ url('sendjoiningform') }} method="post" >
                                    @csrf
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label  c ">Email <span style="color:red">*</span><small>(Add multiple Email Id by pressing enter )</small></label>
                                        <div class="col-sm-6">
                                            <select class="form-control js-example-tokenizer"  id="js-example-basic-multiple" type="email"name="email[]" multiple="multiple" > 
                                            </select>
                                        </div>
                                        @error('email')
                                        <span style="color:red;margin-left:215px;">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3 row">
                                        <label class="col-sm-2 col-form-label  c ">Company Name<span style="color:red">*</span></label>
                                        <div class="col-sm-6">
                                            <select class="single-select" name='company' required>
                                            {{-- <select class='form-control'name='company'> --}}
                                                <option>-Select Company-</option>
                                                @foreach($clients as $client)
                                                @if($client->client_name == 'OCTOPOLIS TECHNOLOGIES PRIVATE LIMITED')
                                                <option value="{{$client->client_id  }}">Apna Club</option>
                                                @else
                                                <option value="{{ $client->client_id }}">{{ $client->client_name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                        <div class="mb-3 row">
                                            <label class="col-form-label col-sm-2 pt-0  c ">Job Location <span style="color:red">*</span></label>
                                            <div class="col-sm-6">
                                                <input type='text'class='form-control'name='joblocation' required>
                                            </div>
                                        </div>

                                       

                                   
                                    
                                   
                                    <div class="mb-3 row">
                                        <label class="col-form-label col-sm-2 pt-0 c "></label>
                                        <div class="col-sm-6">
                                            <button class="btn btn-primary col-12 btn-block" type="submit">Send</button>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
{{-- <script>
  $(document).ready(function() {
      $('#js-example-basic-multiple').select2({
          tags:true
      });
  });
</script> --}}

<script>
  $(".js-example-tokenizer").select2({
tags: true,
tokenSeparators: [',', ' ']
})
</script>

{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
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

                                    error.insertAfter(element);

                                },
                                submitHandler: function (form) {
                                    form.submit();
                                }

                            });
                    });

</script> --}}
@endsection
