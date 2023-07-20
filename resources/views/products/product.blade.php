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
    <div class="container mt-5 mb-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="images p-3">
                                <img class="card-img-top" src="/images/{{ $data->image }}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="product p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center"><i class="fa fa-long-arrow-left"></i><a href="/products"
                                            class="btn btn-primary">Back</a></div>
                                    <i class="fa fa-shopping-cart text-muted"></i>
                                </div>
                                <div class="mt-4 mb-3">
                                    <h5 class="text-uppercase">{{ $data->title }}</h5>
                                    <div class="price d-flex flex-row align-items-center"><p
                                            class="fs-3 fw-bold">{{ $data->price }}$</p>
                                    </div>
                                </div>
                                <p class="about">{{ $data->description }}</p>

                                <div class="cart mt-4 align-items-center">
                                </div>
                                <form method="POST" action="{{ url('/product/add') }}">
                                    @csrf
                                    @foreach ($services as $service)
                                        <li class="mb-2">
                                            <input type="checkbox" name="services[]" value="{{ $service->id }}">
                                            {{ $service->name }} (+${{ $service->price }})
                                        </li>
                                    @endforeach
                                    <input type="hidden" name="product_id" value="{{ $data->id }}">
                                    <input class="form-control mb-2" type="number" name="quantity" value="1">
                                    <button class="btn btn-primary" type="submit">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>


