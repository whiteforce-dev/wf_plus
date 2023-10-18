@extends('master.master')
@section('title', 'Assign Target section')
@section('content')

<style>
    .btn-danger {
        color: rgb(0, 0, 0);
        background-color: rgb(217, 18, 18);
        border-color: rgb(255, 76, 65);
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="col-xl-12 col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="card-title" style="color:aliceblue">User Target</h4>

                    <a href="{{ url('/dashboard') }}"> <button type="button" class="btn  btn-light"><span
                                class="btn-start text-info"><i class="fa fa-angle-double-left color-info"></i>
                            </span>Back</button></a>
                </div>

                <div class="card-body" style="background: #f8fcff">


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">S.No</th>
                                <th scope="col">Image</th>
                                <th scope="col">Senior Manager</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            @if($users)
                            @foreach($users as $obj=> $user)

                            <tr style="font-weight: bolder;">
                                <th style="padding:20px;font-weight: bolder;font-size:15px">{{ ++$obj }}</span></th>

                                <td><img src="{{  url($user->thumb())}}" class="imd-fluid" width="45" height="40"
                                        style="border-radius: 50%"></td>

                                <td>{{ucwords($user->name)}}</td>

                                <td>
                                    <div style="">
                                        <a class="btn btn-primary shadow btn-xs sharp me-1"
                                            href="{{url( 'manager-team-target'.'/'.$user->id) }}"><i
                                                class="fa fa-add"></i></a>
                                        <a class="btn btn-danger shadow btn-xs sharp"
                                            href="{{ url('manager-team-target-edit'.'/'.$user->id) }}"><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>
                                </td>


                            </tr>
                            @endforeach
                            @else
                            <div class="card">
                                @include('master.404')
                            </div>
                            @endif

                        </tbody>
                    </table>
                </div>























                {{-- <div class="mydiv col-sm-12" style="background: #dee8fb">


                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="color:black;
                                                    text-transform: capitalize;
                                                 ">S.no</th>
                                <th style="color:black;text-transform: capitalize; ">Image</th>
                                <th style="color:black;text-transform: capitalize;">Manager</th>
                                <th style="color:black;text-transform: capitalize;">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $obj=> $user)

                            <tr>
                                <td scope="row" style="color:black;">&nbsp;&nbsp;{{ ($users->currentpage() - 1) *
                                    $users->perpage() + $obj + 1 }}</td>
                                <td><img src="{{  url($user->avtar())}}" class="imd-fluid" width="35" height="30"
                                        style="border-radius: 50%"> </td>
                                <td style="color:black">
                                    {{ucwords($user->name)}}
                                </td>
                                <td>
                                    <div style="">
                                        <a class="btn btn-primary shadow btn-xs sharp me-1"
                                            href="{{url( 'manager-team-target'.'/'.$user->id) }}"><i
                                                class="fa fa-add"></i></a>
                                        <a class="btn btn-danger shadow btn-xs sharp"
                                            href="{{ url('manager-team-target-edit'.'/'.$user->id) }}"><i
                                                class="fas fa-pencil-alt"></i></a>
                                    </div>

                                </td>



                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                    <div style="float: right">
                        {{$users->links('pagination::bootstrap-4')}}
                    </div>

                </div>
                --}}
                {{--
            </div> --}}


        </div>

    </div>
</div>
</div>


<script src="{{ url('assets') }}/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="{{ url('assets') }}/js/plugins-init/datatables.init.js"></script>
<script src="{{ url('assets') }}/js/custom.js"></script>
<script src="{{ url('assets') }}/js/deznav-init.js"></script>
<script src="{{ url('assets') }}/js/demo.js"></script>
<script src="{{ url('assets') }}/js/styleSwitcher.js"></script>



@endsection