@extends('master.master')
@section('title', 'Gift Consolidated Report')
@section('content')

    <div class="content-body">
        <div class="container-fluid">
            <div class="col-xl-12 col-lg-12">
                <div class="card alljobPortals">
                    <div class="card-header bg-primary">
                        <h4 class="card-title" style="color: white">
                           Gift Consolidated List
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-hover table-bordered">
                            @foreach($company as $key => $invest)
                            <thead >
                                <!-- First Header Row -->
                                <tr class="bgl bgl-light">
                                    <th colspan="6" class="text-center"><h5 style="display:inline;">Company Name : {{ $key ?? "Not Found" }}</h5></th>
                                    
                                </tr>
                                <!-- Second Header Row -->
                                
                            </thead>
                            <tbody>
                               @foreach($invest as $name => $info)
                               <tr>
                                <th colspan="6"><h6>HR Name : {{ucwords( $name ?? 'NOT FOUND') }}</h6></th>
                                
                               </tr>
                               <tr class="bgl bgl-danger">
                                <th><h6>S No.</h6></th>
                                <th><h6>Date</h6></th>
                                <th><h6>Gift</h6></th>
                                <th><h6>Docket Number</h6></th>
                                <th><h6>Status</h6></th>
                                <th><h6>Price</h6></th>
                                </tr>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($info as $count =>$item)
                               <tr class="">
                                <td><h6>{{ ++$count }}.</h6></td>
                                <td><h6>{{ substr($item['created_at'],0,11) ?? '' }}</h6></td>
                                <td><h6>{{ ucwords($item['gift'] ?? '') }}</h6></td>
                                <td><h6>{{ $item['docketnumber'] ?? '' }}</h6></td>
                                <td><h6>{{ $item['delivery'] ?? ''}}</h6></td>
                                <td><h6>{{ $item['price'] ?? '' }}</h6></td>
                               </tr>
                               @php
                                    $total += $item['price'];
                               @endphp
                               @endforeach
                               <tr class="bgl bgl-success">
                                <td colspan="5" class="text-center "><h6>Total Investment :-</h6></td>
                                <td class=""><h6>{{  $total ?? 0 }}</h6></td>
                               </tr>
                               @endforeach
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    
                  
                    <!-- <div class="card">
                        @include('master.404')
                    </div> -->
                  
                </div>
            </div>
        </div>
    </div>
@endsection
