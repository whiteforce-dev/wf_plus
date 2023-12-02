@extends('master.master')
@section('title', 'Client List')
@section('content')
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
    .pagination {
        margin-bottom: 0.25rem;
        display: flex;
        flex-wrap: nowrap;
        justify-content: center;
    }

    .pagination-gutter {
        background-color: white;
        width: auto;
        padding: 4px;
        border-radius: 5px;
        margin: auto;
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="row">
                        <div class="card col-10 offset-1">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div class="col-2">
                                    <h4>Client List View</h4>
                                    <!-- <span>Onrole Clients</span> -->
                                </div>
                                <div class="col-3">
                                        <div class="input-group ">
                                            <select class="default-select form-control wide" name="created_by" id="created_by" onchange="createdByClient();">
                                                <option selected value="0">All</option>
                                                @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $selectedUser == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="col-1">
                                    <span class="btn bgl-warning text-danger  status-btn me-3" style="width:100px"><b>{{ $clients->count()}}</b></span>
                                </div>
                                <div class="input-group search-area right d-lg-inline-flex d-none col-2">
                                    <input type="search" class="form-control" placeholder="Search Clients here..." id="search" client="{{ $serch }}">
                                    <span class="input-group-text"><i class="flaticon-381-search-2" id="serchIcon" style="cursor: pointer;"></i></span>
                                </div>
                            </div>
                        </div>
                </div>
                    @if(count($clients))
                    @foreach($clients as $client)
                    <div class="col-xl-10 col-xxl-10 col-sm-10 offset-1" >
                        <div class="card me-auto" id="list">
                            <div class="project-info my-2">
                                <div class="col-4">
                                    <div class="d-flex align-items-center">
                                        <div class="client_logoDiv mx-2 mt-1" id="client_logoDiv" >
                                            <img class="" id="client_logo_img" src="{{  Storage::disk('s3')->temporaryUrl('company/images/'.$client->image, now()->addMinutes(5)) }}"
                                                alt="no image"/>
                                        </div>
                                        <div>
                                            <h5 class="mb-1 text-black name">{{ ucwords($client?->name) }}</h5>
                                            <div class="text-dark"><i class="far fa-calendar me-2" aria-hidden="true"></i>Updated At : {{ $client?->updated_at->format('M d, Y') }}</div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-around">
                                        <a href="{{ url('hr?client=' . $client->id) }}"><span class="btn bgl-success text-dark status-btn me-3 "><b>HR : {{ count($client?->hrs) }}</b></span></a>

                                        <a href="{{ url('position?id=' . $client->id) }}">
                                            <span class="btn bgl-secondary text-secondary  status-btn me-3"><b>Total Positions : {{ count($client?->position->where('is_active', 1)) }}</b></span>
                                        </a>
                                    </div>
                                </div>
                                @php
                                $allAllotedUsers = getClientAllotedToNames($client->id,$childUsers);
                                @endphp
                                <div class="col-3">
                                    @if(!empty($client->owner))
                                    <h5 class="title font-w600 mb-2"><a href="" class="text-black">Added By : {{ $client->owner?->name }}</a></h5>
                                    @else
                                    <h6 class="title font-w600 mb-2"><a href="" class="text-black">Alloted By : {{ $client->alloted_by }}</a></h5>
                                    <h6 class="title font-w600 mb-2"><a href="" class="text-black">Alloted To : {{ implode(',',$allAllotedUsers) }}</a></h5>
                                    @endif

                                </div>
                                <div class="col-1 text-center">
                                    <div class="d-flex project-status align-items-center">
                                        <div class="dropdown">
                                            <a href="javascript:void(0);" data-bs-toggle="dropdown" aria-expanded="false">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 13C12.5523 13 13 12.5523 13 12C13 11.4477 12.5523 11 12 11C11.4477 11 11 11.4477 11 12C11 12.5523 11.4477 13 12 13Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12 6C12.5523 6 13 5.55228 13 5C13 4.44772 12.5523 4 12 4C11.4477 4 11 4.44772 11 5C11 5.55228 11.4477 6 12 6Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    <path d="M12 20C12.5523 20 13 19.5523 13 19C13 18.4477 12.5523 18 12 18C11.4477 18 11 18.4477 11 19C11 19.5523 11.4477 20 12 20Z" stroke="#575757" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </svg>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" onclick="hrList({{ $client?->id }})">Hr list</a>
                                                <hr>

                                                <a class="dropdown-item" href="{{ route('client.edit',$client->id) }}" id="edit">Edit</a>


                                                @if($currentUser=='admin')
                                                <form action="{{ route('client.destroy',$client?->id) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="submit" value="Delete" class="dropdown-item">
                                                </form>
                                                <!-- <a class="dropdown-item" data-toggle="modal" data-target="#selectUser">
                                                Allot</a> -->
                                                <a class="dropdown-item" data-toggle="modal" onclick="selectuserModal({{ $client->id }})">
                                                Allot</a>
                                                @else
                                                <a class="dropdown-item" href="javascript:void(0);" id="">Only admin can delete Clients</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col pagination-gutter offset-1">
                        {{ $clients->links() }}
                    </div>
                    @else
                    <div class="col-xl-10 col-xxl-10 col-sm-10 offset-1">
                        <div class="card">
                            @include('master.404')
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="selectUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
  <form action="{{ url('allotOldClients') }}" method="POST">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Allot Client To Other User</h5>
      </div>
      <div class="modal-body">

            @csrf
            <input type="hidden" name="client_id" id="client_id">
            <label for="allot_user">Select User To Allot Client</label>
            <select name="allot_user" id="allot_user" class="form-control">
            @foreach ($manager_and_sm_list as $role => $users)
            <optgroup label="{{ $role }}">
                @foreach ($users as $id => $user)
                <option value={{$id}}>{{$user}}</option>';
                @endforeach
            </optgroup>;
            @endforeach
            </select>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Allot</button>
      </div>
    </div>
  </form>
  </div>
</div>
<script>

    function selectuserModal(client_id){
        $('#client_id').val(client_id);
        $('#selectUser').modal('toggle');
    }

    // serch in table //
    var serch=document.querySelector('#search');
    var serchIcon=document.querySelector('#serchIcon');
    serch.addEventListener('keypress', function(event) {
        if (event.key === 'Enter') {
        event.preventDefault(); // Prevent form submission or page reload
        var client=serch.value;
            var url="{{ url('client') }}?serch="+client;
            window.open(url,"_self");
        }
    });

    serchIcon.addEventListener('click',()=>{
            var client=serch.value;
            var url="{{ url('client') }}?serch="+client;
            window.open(url,"_self");
        });


    // choose by manager function //

    function createdByClient(){

        var user = $('#created_by').val();
        var url = "{{ url('client') }}?user="+user;
        window.open(url, "_self");
    }
    // client edit alert //
    var edit=document.querySelector('#edit');
    edit.addEventListener('click',()=>{
        confirm('Are you sure to modify the Client ?');
    });

    // client delete alert  //
    var del = document.querySelector('#delete');
    del.addEventListener('click',()=>{
        confirm('Are you sure to delete the Client ?');
    });

    // to see client according hr list //
    function hrList(e){
        var url = "{{ url('hr') }}?client="+e;
       window.open(url,"_self");
    }



</script>
@endsection
