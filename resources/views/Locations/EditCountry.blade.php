@extends('master.master')
@section('title', 'Edit Country')
@section('content')
<!doctype html>
<html lang="en">
  <head>
  <style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
  </head>
  <body>
    <br><br><br><br>

    <div class="col-xl-10 col-lg-12 offset-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit Country</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="put" action="{{ url('updateCountry',$Country->id) }}">
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <strong class="form-label ">Country Name</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input type="text" name="country_name" class="form-control" value="{{ $Country->name }}">
                                @error('country_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" >Update</button>
                            </div>
                        </div>
                 </form>
                </div>

            </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</div>
@endsection
