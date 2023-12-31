<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf_token" content="{{ csrf_token() }}">
    <title>Shopix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
@extends('layouts.main')
@section('content')
    <div class="mx-auto col-10 col-md-8 col-lg-6">
        <h1>Add new product</h1>
        <form method="POST" action="/product/create" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Product name:</label>
                <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">Product description:</label>
                <textarea name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Choose product image:</label>
                <input name="image" class="form-control" type="file" id="formFile">
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Product price:</label>
                <input name="price" type="text" class="form-control w-50" id="exampleFormControlInput1">
            </div>
            @foreach ($data as $tag)
                <li class="mb-2">
                    <input type="checkbox" name="tags[]" value="{{ $tag->id }}">
                    {{ $tag->name }}
                </li>
            @endforeach
            <button type="submit" class="btn btn-primary form-control">Add</button>
        </form>
    </div>

@endsection
</body>
</html>
