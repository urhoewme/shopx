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
@extends('layouts.main')
@section('content')
    <h1 class="fw-bold">Products</h1>
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    @foreach($data as $product)
                        <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                                        <p class="fs-3 fw-bold">{{ $product->price }}$</p>
                                    </div>
                                    <div class="d-flex justify-content-between mb-3">
                                        <h5 class="mb-0">{{ $product->title }}</h5>
                                    </div>
                                    <a href="/product/{{ $product->id }}">
                                    <img class="card-img-top" src="/images/{{ $product->image }}">
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
    </section>
{{--    @else--}}
{{--        <p class="fs-1 fw-normal">No products available</p>--}}
{{--    @endif--}}
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
