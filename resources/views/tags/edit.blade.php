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
        <h1>Edit tag</h1>
        <form method="POST" action="{{ url('/tag/edit', $data->id) }}">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Tag name:</label>
                <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{ $data->name }}">
            </div>
            <button type="submit" class="btn btn-primary form-control">Submit</button>
        </form>
    </div>

@endsection
</body>
</html>
