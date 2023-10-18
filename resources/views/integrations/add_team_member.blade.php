@extends('master.master')
@section('title', 'Add Team')
@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="text-white">Add Member</h3>
        </div>
        <div class="card-body">
          <form action="{{ url('showcase/v2/sushma/store-member-details') }}" method="post">
            @csrf
            @method('POST')
            <input type="text" value={{ $id }} name="integration_id" hidden>
            <div class="d-flex">
              <div class="col-3 text-black">
                <label for="name">Enter Employee Name</label>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="name" name="name">
                </div>
              </div>
            </div>
            <div class="d-flex">
              <div class="col-3 text-black">
                <label for="designation">Designation</label>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="designation" name="designation">
                </div>
              </div>
            </div>
              {{-- <div class="form-group">
                <label class="form-check-label" for="image">Insert Image</label>
                <div class="input-group ">
                  <div class="form-file">
                    <input type="file" class="form-file-input form-control" name="image[]" id="image" multiple>
                  </div>
                </div> --}}
            <div class="d-flex">
              <div class="col-3 text-black">
                <label class="" for="image">Insert Image</label>
              </div>
              <div class="col-6">
                @include('cropper.cropper')
              </div>
            </div>
            <div class="d-flex">
              <div class="col-6 offset-3">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script>

</script>
@endsection
