@extends('master.master') @section('title', 'Edit Gift Remark')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: white">
                        <i class="fa fa-gift"></i>&nbsp;Edit Gift Investment 
                    </h4>
                    <button class="btn btn-light btn-sm">
                        <a href="{{ url('investment') }}"
                            ><span class="btn-start text-info"
                                ><i
                                    class="fa fa-angle-double-left color-info"
                                ></i> </span
                            >Back</a
                        >
                    </button>
                </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form
                                action="{{ url('update-investment/'.$Investment->id) }}"
                                method="POST"
                                id="hrgiftForm"
                                name="hrgiftForm">
                                @csrf
                                {{-- @dd($hrs); --}}
                                {{-- @php 
                                $client=App/Models/client::where('id',$hrs)
                                @endphp --}}

                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Gift*</div>
                                    <div class="col-sm-9">
                                        <input
                                        type="text"
                                        class="as_colorpicker form-control asColorPicker-input"
                                        value="{{ $Investment->gift ?? 'Not Found' }}"
                                        name="gift"
                                        placeholder="Enter Gift "
                                    />

                                        @error('giftId')
                                        <span style="color: red">{{
                                            $message
                                        }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Price*</div>
                                    <div class="col-sm-9">
                                        <input
                                            type="number"
                                            class="as_colorpicker form-control asColorPicker-input"
                                            value="{{ $Investment->price ?? 0 }}"
                                            name="price"
                                            placeholder="Enter Gift Price"
                                        />
                                        @error('price')
                                        <span style="color: red">{{
                                            $message
                                        }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Remark*</div>
                                    <div class="col-sm-9">
                                        <textarea
                                            placeholder="Enter Remark"
                                            name="remark"
                                            class="form-control"
                                            id="textarea"
                                            rows="4"
                                            cols="50"
                                        >{{ $Investment->remark ?? 'Not Found' }}</textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Docket Number*</div>
                                    <div class="col-sm-9">
                                        <input
                                            type="number"
                                            class="as_colorpicker form-control asColorPicker-input"
                                            value="{{ $Investment->docketnumber ?? 0 }}"
                                            name="docket"
                                            placeholder="Enter Docket Number"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Delivery Status*</div>
                                    <div class="col-sm-9">
                                        <select name="delivery"  class="form-control">
                                            <option value="Delivered" {{ $Investment->delivery == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option value="Not Delivered"{{ $Investment->delivery == 'Not Delivered' ? 'selected' : '' }}>Not Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Insert Image*</div>
                                    <div class="col-sm-9">
                                        @include('cropper.cropper', ['preview' => $Investment->image])
                                    </div>
                                </div>
                                <div class=" offset-2 col-sm-9">
                                    <center>
                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-primary btn-block"
                                            style="margin-top: 20px"
                                        >
                                            Submit
                                        </button>
                                    </center>
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
    $(document).ready(function ($) {

        $("#hrgiftForm").validate({
            rules: {

                gift:'required',    
                price: "required",
                docket: 'required',
              
            },
            messages: {

                gift:"*Please Select Gift Item",
                price: "*Please enter Price",
                docket: '*Please enter docket Number',
               
            },
            errorPlacement: function (error, element) {

                error.insertAfter(element);

            },
            submitHandler: function (form) {
                form.submit();
            }

        });
    });
</script>

@endsection
