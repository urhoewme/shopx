<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shopix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
@extends('layouts.admin')
@section('content')
    <a href="/service/create" class="btn btn-primary mb-2">Add new service</a>
    <div class="table-responsive">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>Service</th>
                <th>Price</th>
                <th>Deadline</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $service)
                <tr>
                    <td>
                        <p class="fw-bold mb-1">{{ $service->name }}</p>
                    </td>
                    <td>{{ $service->price }}</td>
                    <td>
                        {{ $service->deadline }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
