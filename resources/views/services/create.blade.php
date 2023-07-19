<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Shopx</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
@extends('layouts.admin')
@section('content')
    <div class="mx-auto col-10 col-md-8 col-lg-6">
        <h1>Add new service</h1>
        <form method="POST" action="/service/create">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Service name:</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Service price:</label>
                <input class="form-control" type="text">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Service deadline:</label>
                <input name="price" type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <button type="submit" class="btn btn-primary form-control">Add</button>
        </form>
    </div>

@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
