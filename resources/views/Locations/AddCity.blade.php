@extends('master.master')
@section('title', 'View City')
@section('content')
<!doctype html>
<html lang="en">
    <style>
        table {
          border-collapse: collapse;
          width: 100%;
        }

        th, td {
          padding: 8px;
          text-align: left;
          border-bottom: 1px solid #DDD;
        }

        tr:hover {background-color: #D6EEEE;}


        </style>
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
  <head>
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
                <h4 class="card-title">Add City</h4>
            </div>
    <div class="card-body">
        <div class="basic-form">
            <form method="POST" action="{{ url('storecity') }}">


                @csrf
                <div class="row">
                    <div class="mb-2 col-md-3">
                        <strong class="form-label ">select Country</strong>
                    </div>
                    <div class="mb-2 col-md-3">
                        <strong class="form-label ">Select State</strong>
                    </div>
                    <div class="mb-2 col-md-3">
                        <strong class="form-label ">City Name</strong>
                    </div>
                </div>
                <div class="row">
                    @php
                        $Country = \App\Models\Country::orderBy('id', 'asc')->get();
                    @endphp
                    <div class="col-3">
                        <select id="country_id" class="default-select form-control wide" name="country_id"" onchange="findCountry();">
                            <option selected>Choose Country</option>
                            @foreach ($Country as $Country)
                            <option value="{{ $Country->id }}">{{ $Country->name }}</option>
                        @endforeach
                        </select>
                        @error('country_id')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <select class="form-control" name="state_id" id="state_id">
                            <option value="">Choose State</option>
                        </select>
                        @error('state_id')
                        <p class="text-danger">{{ $message }}rnf</p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <input type="text" name="city_name" class="form-control" placeholder="City">
                        @error('city_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary" >Submit</button>
                    </div>
                </div>
         </form>








<br><br>
<h4>Cities</h4>

<form action="{{ url('addCity') }}" >
    <div class="row">

    <div class="col-3 mb-2" >
      <input type="text" name="search" id="" class="form-control" placeholder=" Search by Country " aria-describedby="helpId">
    </div>


    <div class="col-1  mb-2" >
    <button type="submit" class="btn btn-primary">Search</button>
    </div>

    <div class="col-1  mb-2" >
    <a href="{{ url('addCity') }}"><button class="btn btn-info">Reset</button> </a>
    </div>
</div>

 </form>
<table>

  <tr>

    <th class="text-center">City Name</th>
    <th class="text-center">Action</th>
  </tr>
  <tr>
    @foreach ($City as $city)


    <td class="text-center">{{ $city->name }}</td>
    <td class="text-center" ><a href="deleteCity/{{ $city->id }} "><button class="btn btn-danger">Delete</button></a>
         <a href="editCity/{{ $city->id }} "><button class="btn btn-primary">Edit City</button></a></td>
  </tr>
  @endforeach

</table>
<br>
<div class="d-flex justify-content-center">
    {!! $City->links() !!}
</div>
</div>
</div>
</div>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <script>
        function findCountry() {
            var stateId = $('#country_id').val();
            $.get("statelist", { country_id: stateId },
             function(response) {
                $("#state_id").html(response);
                console.log($("#state_id").html());

                // $('#state_id').html(response);
            });
        }
    </script>
  </body>
</html>
@endsection
