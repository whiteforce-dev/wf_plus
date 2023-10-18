@extends('master.master')
@section('title', 'Edit State')
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
                <h4 class="card-title">Edit State</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form method="Put" action="{{ url('updateState', $State->id) }}">
@method('put')                        <div class="row">

                            <div class="mb-2 col-md-4">
                                <strong class="form-label ">State Name</strong>
                            </div>
                        </div>

                                <div class="row">
                                <div class="col-6">
                                <input type="text" name="state_name" class="form-control" value="{{ $State->name }}">
                                @error('state_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary" >Update</button>
                            </div>
                        </div>
                        <br><br><br><br>

                 </form>
                </div>
            </div>
            </div>
            </div>
            </div>
            @endsection
