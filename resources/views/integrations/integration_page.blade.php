@extends('master.master')
@section('title', 'Add Details')
@section('content')
<div class="content-body">
  <div class="container-fluid">
    <div class="">
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="text-white">Add Details</h3>
        </div>
        <div class="card-body">
          <form action="{{ url('showcase/v2/sushma/add-integration-details') }}" method="post">
            @csrf
            @method('POST')
            <div class="row">
              <div class="col-3 text-black">
                <label for="company_name">Enter Company Name</label>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" class="form-control" id="company_name" name="company_name">
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-3 text-black">
                <label for="video">Select Type</label>
              </div>
              <div class="col-6">
               <select  id="type" class="form-control" onchange="getType(this.value)">
                <option value="" disabled selected>Select Type</option>
                <option value="video">Video</option>
                <option value="image">Image</option>
               </select>
              </div>
            </div>
            <div class="row collapse" id="video">
              <div class="col-3 text-black">
                <label for="video">Video Link</label>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <input type="text" class=" form-control" name="video" id="video">
                </div>
              </div>
            </div>

            <div class="row collapse" id="image">
              <div class="col-3 text-black">
                <label class="" for="image">Insert Image</label>
              </div>
              <div class="col-6">
                @include('cropper.cropper')
              </div>
            </div>

            <div class="row">
              <div class="col-3 text-black">
              <label class="" for="about">Company About</label>
              </div>
              <div class="col-6">
                <div class="form-group ">
                  <textarea name="about" id="about" cols="30" rows="10" class="form-control tinymce-editor"></textarea>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script>
  function getType(e){
    var video=document.querySelector("#video");
    var image=document.querySelector("#image");
    if(e=="video"){
      video.classList.remove('collapse');
      image.classList.add('collapse');
    }else{
      image.classList.remove('collapse');
      video.classList.add('collapse');
    }

  }
  tinymce.init({
                selector: 'textarea.tinymce-editor',
                height: 300,
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount', 'image'
                ],
                toolbar: 'undo redo | formatselect | ' +
                    'bold italic backcolor | alignleft aligncenter ' +
                    'alignright alignjustify | bullist numlist outdent indent | ' +
                    'removeformat | help',
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });

</script>
@endsection
