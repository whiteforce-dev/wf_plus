@extends('master.master')
@section('title', 'Edit Gift Remark')
@section('content')
    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card alljobPortals">
                    <div class="card-header bg-primary">
                        @php
                        $hr=\App\Models\investment::find($hrId);
                        // dd($hr->hrId)
                        @endphp
                        <h4 class="card-title" style="color:white"><i class="fa fa-gift"></i>&nbsp;Edit Gift Remark  </h4>
                        <button class="btn btn-light btn-sm"><a href="{{ url('show-investment',[$hr->hrId]) }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                        </span>Back</a></button>

                    </div>
                    {{-- <div class="card-body"> --}}
                        {{-- <div class="basic-form">
                            <form action="{{ url('save-investment/' . $hrId) }}" method="POST" id="hrgiftForm"
                                name="hrgiftForm">
                                @csrf
                                <div class="row" style="margin-top:19px;">
                                 <div class="col-md-6">
                                    <label style="font-size:18px;color:rgb(59, 54, 54)">Gift</label>

                                    <select class="form-control" name="giftId">
                                        @foreach ($Hrgift as $hr)
                                        {{-- @dd($hr); --}}
                                            {{-- <option value="{{ $hr->id }}"> {{ $hr->name }}</option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-md-6">
                                    <label style="font-size:18px;color:rgb(59, 54, 54)">Price</label> --}}
                                    {{-- <span class="input-group-text">Price</span> --}}
                                    {{-- <input type="text" class="form-control" placeholder="Price" name="price"
                                        value="">
                                </div>
                           
                               

                                <div class="col-md-12" style="margin-top:29px;">
                                    <label style="font-size:18px;color:rgb(59, 54, 54)">Remark</label>
                                    <textarea class="form-control" name="remark" value=""></textarea>
                                </div> --}}
                            {{-- </div>


                                <center><button type="submit" class="btn btn-primary"
                                        style="margin-top:20px;">Submit</button></center>
                            </form> --}}
                        {{-- </div> --}} 
                        <div class="card-body">
                            <div class="basic-form">
                                <form action="{{ url('update-investment/' . $hrId) }}" 
                                method="POST" id="hrgiftForm"
                                name="hrgiftForm">
                                @csrf
                                {{-- @dd($id) --}}
                                    
                                    {{--     
                                    <div class="mb-3 row mb-4 mt-5">
                                        <div class="col-sm-12">
                                            <h5></h5>
                                        </div>
                                    </div> --}}
                                    <div class="mb-3 row">
                                        <div class="col-sm-1">Gift*</div>
                                        <div class="col-sm-9">

                                            <input type="text" disabled class="as_colorpicker form-control asColorPicker-input"
                                            value="{{ $Hrgift }}" name="price" placeholder="Enter Gift Price">
                                            
                                            {{-- @error('giftId')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <div class="col-sm-1">Price*</div>
                                        <div class="col-sm-9">
                                            <input type="text" disabled class="as_colorpicker form-control asColorPicker-input"
                                                value="{{ $hrinvestments->price }}" name="price" placeholder="Enter Gift Price">
                                            @error('price')
                                                <span style="color:red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
    
                                  
                                    <div class="mb-3 row">
                                        <div class="col-sm-1">Remark*</div>
                                        <div class="col-sm-9">
                                            <textarea placeholder="Enter Remark" name="remark" class="form-control" id="textarea"
                                                rows="4" cols="50">{{ $hrinvestments->remark }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-9">
                                    <center><button type="submit" class="btn btn-sm btn-primary"
                                        style="margin-top:20px;">Update</button></center>
                                    </div>
                                </form>
                            </div>
    
                        </div>



                   



                </div>

            </div>
        </div>
    </div>
    </div>

@endsection
