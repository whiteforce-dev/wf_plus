<div class="modal-header custom-modal-header">

    <div class="col-sm-12">
        <h3>Manager List</h3>
        <small>You can share your position by choosing <b>Single/ Multiple </b> managers</small>
    </div>


</div>
<div class="modal-body custom-modal-body p-3" id="modal-body">
    <style>
         .checkbox {
        -webkit-appearance: none;
        -moz-appearance: none;
        cursor: pointer;
        background: #e2ebf6;
        border-radius: 50%;
        height: 2em;
        margin: 0;
        margin-left: auto;
        flex: none;
        outline: none;
        position: relative;
        transition: all 0.2s;
        width: 2em;
    }

    .checkbox:after {
        border: 2px solid #fff;
        border-top: 0;
        border-left: 0;
        content: "";
        display: block;
        height: 1em;
        left: 0.625em;
        position: absolute;
        top: 0.25em;
        transform: rotate(45deg);
        width: 0.5em;
    }

    .checkbox:focus {
        box-shadow: 0 0 0 2px rgba(100, 193, 117, 0.6);
    }

    .checkbox:checked {
        background: #64c175;
        border-color: #64c175;
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    .checkbox-control__target {
        bottom: 0;
        cursor: pointer;
        left: 0;
        opacity: 0;
        position: absolute;
        right: 0;
        top: 0;
    }

    </style>
<form action={{ url('sharedmanager') }} method="post">
    @csrf
    <input type="hidden" name="position" value="{{ $positionId }}">
    <table class="table table-striped">
        <thead class="thead-dark">
          <tr>
            <th scope="col"><b>S.No</b></th>
            <th scope="col"style="padding-left: 40px !important;"><b>Image</b></th>
            
            <th scope="col" style="padding-left: 35px !important;
            width: 205px;"><b>Manager Name</b> </th>
            <th scope="col"><b>Select Manager</b></th>
          </tr>
        </thead>
        <tbody>
        @foreach($managerlist as $key => $manager)
        @if($manager->id !=  Auth::user()->id) 
         <tr>
            <td scope="row" style="padding-left: 25px !important;"><b>{{ $key+1 }}</b></td>
            <td style="padding-left: 40px !important;">
            <img src="{{url($manager->thumb()) }}" height="70px;" style="border-radius: 50%;">

            </td>
            <td style="padding-left: 40px;"><b>{{ $manager->name }}</b> <small>{{ $manager->role }}</small></td>
         <td style="padding-left: 40px !important;">
            
            {{-- <input type="checkbox" id="manager" name="manager[]" value={{ $manager->id }}> --}}
            <div class="form-check form-switch form-switch-sm">
                <input class="form-check-input" name="manager[]" type="checkbox" id="manager" value="{{ $manager->id }}" {{ in_array($manager->id, $alreadyShared) ? 'checked' : '' }}>
            </div>
         </td>
          </tr>
          @endif
         @endforeach
        </tbody>
      </table>
      <button style="display:none;" id="assign_id" type="submit">Submit</button>
            <div class="a14" onclick="clickSubmit();">
                <span style="font-size:80px; color: coral" class="mdi mdi-checkbox-marked-circle"></span>
            </div>
      {{-- <button class="btn btn-primary"type="submit">Submit</button> --}}
    </form>
</div>
<script>
    function clickSubmit(){
        $('#assign_id').click();

    }
</script>