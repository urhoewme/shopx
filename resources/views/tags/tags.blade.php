<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopx</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
@extends('layouts.admin')
@section('content')
    <a href="/tag/create" class="btn btn-primary mb-2">Add new tag</a>
    <div class="table-responsive">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $tag)
                <tr>
                    <td>
                        <p class="fw-bold mb-1">{{ $tag->id }}</p>
                    </td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <a class="btn btn-primary" href="/tag/edit/{{ $tag->id }}">Edit</a>
                        <form method="POST" action="/tag/delete/{{ $tag->id }}">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-block">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
</body>
</html>
