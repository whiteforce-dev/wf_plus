@extends('master.master')
@section('title', 'Add Popup Details')
@section('content')
<div class="content-body">
    <div class="container-fluid">
        <div class="form-head mb-sm-5 mb-3 d-flex flex-wrap align-items-center">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Client Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ url('update-popup-description') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                
                                <div class="row my-4" id="editor">
                                    <label class="col-sm-3 col-form-label">Popup Description</label>
                                    <div class=" col-6">
                                        <textarea
                                        placeholder="&nbsp;&nbsp;&nbsp;&nbsp;Enter Description for Updates"
                                        name="description" class="form-control tinymce-editor" id="textarea"
                                        rows="4" cols="50">{{ $popup->description ?? '' }}</textarea>
                                    </div>
                                </div>
                                
                                <div class="row my-4">

                                    <div class="col-6 offset-3">
                                        <button class="btn btn-primary col-12 offset btn-block" type="submit">Add Popup</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ url('assets') }}/vendor/jquery-validation/jquery.validate.min.js"></script>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    tinymce.init({
                selector: 'textarea.tinymce-editor',
                height: 500,
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
