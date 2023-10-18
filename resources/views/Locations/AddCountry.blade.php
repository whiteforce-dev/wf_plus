@extends('master.master')
@section('title', 'Add Country')
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
                <h4 class="card-title">Add Country</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="POST" action="{{ url('storeCountry') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <strong class="form-label ">Country Name</strong>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <input type="text" name="country_name" class="form-control" placeholder="Country">
                                @error('country_name')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror
                            </div>

                            <div class="col-4">
                                <button type="submit" class="btn btn-primary" >Submit</button>
                            </div>
                        </div>
                 </form>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
</div>






<br><br>
<h4>Countries</h4>

<form action="{{ url('addCountry') }}" >
    <div class="row">

    <div class="col-3 mb-2" >
      <input type="text" name="search" id="" class="form-control" placeholder=" Search by Country " aria-describedby="helpId">
    </div>


    <div class="col-1  mb-2" >
    <button type="submit" class="btn btn-primary">Search</button>
    </div>

    <div class="col-1  mb-2" >
    <a href="{{ url('addCountry') }}"><button class="btn btn-info">Reset</button> </a>
    </div>
</div>

 </form>
<table>

  <tr>

    <th class="text-center">Country Name</th>
    <th class="text-center">Action</th>
  </tr>
    @foreach ($countries as $country)
    <tr>

    <td class="text-center">{{ $country->name }}</td>
    <td class="text-center" ><a href=" deleteCountry/{{ $country->id }} "><button class="btn btn-danger">Delete</button></a>
         <a href=" editCountry/{{ $country->id }} "><button class="btn btn-primary">Edit Country</button></a></td>
  </tr>
  @endforeach

</table>
<br>
<div class="d-flex justify-content-center">
    {!! $countries->links() !!}
</div>

</div>

  </body>
</html>
@endsection
