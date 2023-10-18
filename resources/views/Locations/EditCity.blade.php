@extends('master.master')
@section('title', 'Edit City')
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
                <h4 class="card-title">Edit City</h4>
            </div>
    <div class="card-body">
        <div class="basic-form">
            <form method="Put" action="{{ url('updateCity', $City->id) }}">
@method('put')
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <strong class="form-label ">City Name</strong>
                    </div>
                </div>
                <div class="row">

                    <div class="col-6">
                        <input type="text" name="city_name" class="form-control" value="{{ $City->name }}">
                        @error('city_name')
                        <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-3">
                        <button type="submit" class="btn btn-primary" >Update</button>
                    </div>
                </div>
         </form>
        </div>
    </div>
    </div>
    </div>
    </div>
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
                     @endsection
