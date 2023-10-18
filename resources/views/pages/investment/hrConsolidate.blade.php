@extends('master.master')
@section('title', 'Gift Consolidated Report')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">

               

                <div class="card">
                    <div class="card-header bg-primary">
                        <h4 class="card-title"  style="color:white">Gift Consolidated List</h4>
                        <button class="btn btn-light btn-sm"><a href="{{ url('investment') }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                        </span>Back</a></button>
                    </div>
                    @if(count($hrinvestments))
                    <div class="card-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper">
                            <table  id="example" class="table table-striped table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">S.No</th>
                                        <th scope="col">HR Name</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Gift</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Remark</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($hrinvestments as $key => $hrinvestment)   
                                    {{-- @php ++$key ; @endphp --}}
                                    @php
                                    $clientname = App\Models\client::where('id',$hrinvestment->HrWithClient->client_id)->first();
                                    $gift = App\Models\gift::where('id',$hrinvestment->giftId)->first();
                                    @endphp 
                                     <tr>
                                        <th style="padding:20px;">{{ $key+1 }}.</th>
                                        <td>{{ ucwords($hrinvestment->HrWithClient->name) }}</td>
                                        <td>{{ ucwords($clientname->name) }}</td>
                                        <td><span class="badge badge-success light">{{ \Carbon\Carbon::parse($hrinvestment->HrWithClient->created_at ?? '00-00-00')->format('j F, Y') }}</span></td>
                                        
                                        <td><span class="badge badge-info light"><i
                                                class="fa fa-gift"></i> {{ ucwords($gift->name) }}</span></td>
                                        
                                        <td><span class="badge badge-danger light">₹ {{ $hrinvestment->price }}</span>
                                        </td>
                                        <td class="color-primary">{{ ucwords($hrinvestment->remark) }}</td>
                                    </tr>
                                   @endforeach
                                </tbody>
                            </table>
                        </div>
                      </div>
                    </div>
                    @else
                    <div class="card">
                        @include('master.404')
                    </div>
                    @endif
                </div>
@endsection
