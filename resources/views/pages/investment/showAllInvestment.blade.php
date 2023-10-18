@extends('master.master')
@section('title', 'Show gift details')
@section('content')
<style>
    .thead-dark{
        background:#7e7d7c;
        color:white;
    }
   
   th{
    text-transform: capitalize !important;
   }
</style>
    <link href="{{ url('assets') }}/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
    <!-- Custom Stylesheet -->
    <link href="{{ url('assets') }}/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="{{ url('assets') }}/css/style.css" rel="stylesheet">
    <div class="content-body">
        <div class="container-fluid">
            {{-- <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><i class="fa fa-gift"></i>&nbsp; Show Gift Items</h4>
                        <a href="{{ url('investment') }}" class="btn btn-primary">Back</a>
                    </div>


                    <div class="card-body"> --}}
                        {{-- <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Contextual Table</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table header-border" style="min-width: 500px;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Column heading</th>
                                                <th>Column heading</th>
                                                <th>Column heading</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-active">
                                                <td>1</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                            <tr class="table-primary">
                                                <td>1</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                            <tr class="table-success">
                                                <td>2</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                            <tr class="table-info">
                                                <td>3</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                            <tr class="table-warning">
                                                <td>4</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                            <tr class="table-danger">
                                                <td>5</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                                <td>Column content</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> --}}
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h4 class="card-title" style="color:rgb(255, 255, 255)">Show Gift Details</h4>
                                <button class="btn btn-light btn-sm"><a href="{{ url('investment') }}"><span class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                                </span>Back</a></button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-responsive-md table-striped">
                                        <thead>
                                            <tr>
                                                <th style="width:80px;"><strong>S.No</strong></th>
                                                <th><strong>Date</strong></th>
                                                <th><strong>Gift</strong></th>
                                                <th><strong>Price</strong></th>
                                                <th><strong>Remark</strong></th>
                                                <th><strong>Action</strong></th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($hrinvestments))
                                            @foreach ($hrinvestments as $key => $item)
                                            {{-- @dd($item) --}}
                                            <tr>
                                                <td><strong>&nbsp;&nbsp;{{ $key+1 }}</strong></td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at ?? '')->format('d F Y') ?? '-' }}</td>
                                                @php 
                                                $gift=App\Models\Gift::where('id',$item->giftId)->first();
                                                // dd($gift);

                                                @endphp
                                                @if($gift->name=='Diary')
                                                <td><span class="badge light badge-primary">{{ $gift->name }}</span></td>
                                                @elseif($gift->name=='Calender')
                                                <td><span class="badge light badge-success">{{ $gift->name }}</span></td>
                                                @elseif($gift->name=='Cake')
                                                <td><span class="badge light badge-info">{{ $gift->name }}</span></td>
                                                @else
                                                <td><span class="badge light badge-warning">{{ucwords ($gift->name) }}</span></td>
                                                @endif
                                                <td><span class="badge light badge-info">₹ {{ ucwords($item->price) }}</span></td>
                                                
                                                <td>{{ ucwords($item->remark) }}</td>
                                               
                                                <td>
													
														
														<div  style="">
															<a  class="btn btn-primary shadow btn-xs sharp me-1" href="{{url( 'edit-investment',$item->id) }}"><i class="fas fa-pencil-alt"></i></a>
															<a class="btn btn-danger shadow btn-xs sharp" href="{{ url('delete-investment',$item->id) }}"><i class="fa fa-trash"></i></a>
														</div>
													
												</td>
                                            </tr>
                                            
                                       

                                            @endforeach
                                            <tr style="background: #cdf0f5;">
                                              
                                                <td></td>
                                                 <td></td>
                                                <td> <b class="badge badge-danger">Total Price</b></td>
                                                @if (isset($hrpricesum))
                                                    <td style="color:white;"> <b class="badge badge-danger">₹ {{ $hrpricesum }}</b></td>
                                                @else
                                                    <td colspan="6" align="left"> <b>null</b></td>
                                                @endif
                                                <td></td>
                                                <td></td>
                                             
                                                
                                            </tr>
                                            @endif
											
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       


                </div>

            </div>
        </div>
    </div>
    </div>
    <script src="{{ url('assets') }}/vendor/global/global.min.js"></script>
    <script src="vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Datatable -->
    <script src="{{ url('assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="{{ url('assets') }}/js/plugins-init/datatables.init.js"></script>
    <script src="{{ url('assets') }}/js/custom.js"></script>
    <script src="{{ url('assets') }}/js/deznav-init.js"></script>
    <script src="{{ url('assets') }}/js/demo.js"></script>
    <script src="{{ url('assets') }}/js/styleSwitcher.js"></script>
@endsection
