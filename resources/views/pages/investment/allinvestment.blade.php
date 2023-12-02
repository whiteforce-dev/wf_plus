@extends('master.master') @section('title', 'Add Gift') @section('content')
<style>
    .col-sm-1 {
        color: #000000e8;
        font-weight: 500;
    }
</style>
<style>
    .client_logoDiv {
    width: 65px;
    height: 65px;
    background: #f1f1f1;
    border-radius: 10px;
    margin: 0;
    text-align: center;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 1px dashed #00000049;
    padding: 4px;
}

.client_logoDiv img {
    max-width: 100%;
    max-height: 100%;
    border-radius: 10px;
}
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: white">
                        <i class="fa fa-gift"></i>&nbsp;Add Gift To : {{ ucwords($hrs->name)?? ''}} - {{ $hrs->clientName->name ?? ''}}
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
                                action="{{ url('save-investment/'.$hrId) }}"
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
                                            value=""
                                            name="gift"
                                            placeholder="Enter Gift"
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
                                            value=""
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
                                        ></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Docket Number*</div>
                                    <div class="col-sm-9">
                                        <input
                                            type="number"
                                            class="as_colorpicker form-control asColorPicker-input"
                                            value=""
                                            name="docket"
                                            placeholder="Enter Docket Number"
                                        />
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Delivery Status*</div>
                                    <div class="col-sm-9">
                                        <select name="delivery" id="" class="form-control">
                                            <option value="Delivered">Delivered</option>
                                            <option value="Not Delivered">Not Delivered</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-2 text-black">Insert Image*</div>
                                    <div class="col-sm-9">
                                        @include('cropper.cropper')
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
            <div class="card alljobPortals">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color: white">
                       Gift Investment List
                    </h4>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-hover table-bordered ">
                        <thead class="bgl bgl-dark">
                            <tr>
                                <th scope="col"><h6>S.No</h6></th>
                                <th scope="col"><h6>Date</h6></th>
                                <th scope="col"><h6>Gift</h6></th>
                                <th scope="col"><h6>Price</h6></th>
                                <th scope="col"><h6>Docket Number</h6></th>
                                <th scope="col"><h6>Status</h6></th>
                                <th scope="col"><h6>Image</h6></th>
                                <th scope="col"><h6>Action</h6></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($giftInvestment->count() != 0)
                            @foreach($giftInvestment as $key =>$invest)
                            <tr class="" role="row">
                                <td class="text-black">{{ ++$key }} .</td>

                                <td class="text-danger"><h6>{{ substr($invest->created_at, 0, 11)
                                }}</h6></td>
                                <td class="text-black">{{ ucwords($invest->gift ?? '') }}</td>
                                <td class="text-black">{{ $invest->price ?? '' }}</td>
                                <td ><h6 class="text-primary">{{ $invest->docketnumber ?? '' }}</h6></td>
                                <td ><h6 class="text-dark">{{ $invest->delivery ?? '' }}</h6></td>
                                <td >
                                    <div class="client_logoDiv mx-2 mt-1" id="client_logoDiv" >
                                        <a href="{{  Storage::disk('s3')->temporaryUrl('gift_images/'.$invest->image, now()->addMinutes(5)) }}" target="_blank">
                                        <img class="" id="client_logo_img" src="{{  Storage::disk('s3')->temporaryUrl('gift_images/'.$invest->image, now()->addMinutes(5)) }}"
                                            alt="no image"/>
                                        </a>
                                    </div></td>
                                <td>
                                    <a href="{{ url('edit-investment/'.$invest->id) }}"><span 
                                        class="btn px-3 py-1 btn-info btn-xs">Edit</span></a>
                                        &nbsp;
                                    <a href="{{ url('delete-investment/'.$invest->id) }}"><span 
                                            class="btn px-3 py-1 btn-danger btn-xs">Delete</span></a>
                                </td>
                            </tr>
                           @endforeach
                           @else
                           <tr><td colspan="7">
                            <h6 class="text-danger text-center">No Data Found</h6></td></tr>
                           @endif
                        </tbody>
                    </table>
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
