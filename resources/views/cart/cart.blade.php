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
@extends('layouts.main')
@section('content')
    @php
        $totalPrice = 0;
        $servicePrice = 0;
    @endphp
    <section class="h-100 rounded" style="background-color: #eee;">
        <div class="container h-100 py-5">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-10">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fw-normal mb-0 text-black">Shopping Cart</h3>
                        <form action="{{ route('cart.delete') }}" method="post">
                            @csrf
                            <button onclick="return confirm('Are you sure ?')" class="btn btn-danger" type="submit">Clear Cart</button>
                        </form>
                    </div>
                    @foreach($data['cartItems'] as $cartItem)
                        <div class="card rounded-3 mb-4">
                            <div class="card-body p-4">
                                    <form action="/cart/product/delete/{{ $cartItem['id'] }}" method="post" class="row d-flex w-100 justify-content-end">
                                        @csrf
                                        <button onclick="return confirm('Are you sure ?')" type="submit" class="btn-close" aria-label="Close"></button>
                                    </form>
                                <div class="row d-flex justify-content-between align-items-center">
                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                        <img class="card-img-top" src="/images/{{ $cartItem['product']['image'] }}">
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-3">
                                        <p class="lead fw-normal mb-2">{{ $cartItem['product']['title'] }}</p>
                                    </div>
                                    <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                        <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                            <i class="fas fa-minus"></i>
                                        </button>

                                        <p class="lead fw-normal">{{ $cartItem['quantity'] }}</p>

                                        <button class="btn btn-link px-2"
                                                onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                        <label>Product price</label>
                                        <h5 class="mb-0">${{ $cartItem['product']['price'] }}</h5>
                                    </div>
                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                        <a href="#!" class="text-danger"><i class="fas fa-trash fa-lg"></i></a>
                                    </div>
                                    @if($cartItem['services'])
                                        <div class="accordion mt-2" id="chapters{{ $cartItem['id'] }}">
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading{{ $cartItem['id'] }}">
                                                    <button class="accordion-button" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#collapse{{ $cartItem['id'] }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse{{ $cartItem['id'] }}">
                                                        Services
                                                    </button>
                                                </h2>
                                                @foreach($cartItem['services'] as $service)
                                                    <div id="collapse{{ $cartItem['id'] }}"
                                                         class="accordion-collapse collapse p-2"
                                                         aria-labelledby="heading{{ $cartItem['id'] }}"
                                                         data-bs-parent="#chapters{{ $cartItem['id'] }}">
                                                        {{ $service['name'] }} | {{ $service['price'] }}$
                                                        | {{ $service['deadline'] }} day(s)
                                                        <form action="/cart/product/{{ $cartItem['id'] }}/service/delete/{{ $service['id'] }}" method="post">
                                                            @csrf
                                                            <button onclick="return confirm('Are you sure ?')" class="btn-close"></button>
                                                        </form>
                                                    </div>
                                                    @php
                                                        $servicePrice += $service['price'] * $cartItem['quantity'];
                                                    @endphp
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @php
                            $totalPrice += $cartItem['product']['price'] * $cartItem['quantity'];
                        @endphp
                    @endforeach
                    <div class="card">
                        <div class="card-body">
                            <label>Total price:</label>
                            <p>{{ $totalPrice + $servicePrice }}$</p>
                            <form action="{{ route('cart.checkout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning btn-block btn-lg">Proceed to Checkout
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
</body>
</html>
