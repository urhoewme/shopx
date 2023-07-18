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
@extends(Auth::check() ? (Auth::user()->usertype == \App\Models\User::ROLE_ADMIN ? 'layouts.admin' : 'layouts.main' ) : 'layouts.main')
@section('content')
    @if(Auth::check())
        @if(Auth::user()->usertype == \App\Models\User::ROLE_ADMIN)
            <a href="/product/create" class="btn btn-primary mb-2">Add new product</a>
            <div class="table-responsive">
                <table class="table align-middle mb-0 bg-white">
                    <thead class="bg-light">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $product)
                        <tr>
                            <td><img
                                    style="width: 45px; height: 45px"
                                    class="rounded-circle" src="/images/{{ $product->image }}"></td>
                            <td>
                                <p class="fw-bold mb-1">{{ $product->title }}</p>
                            </td>
                            <td>{{ $product->price }}</td>
                            <td>
                                <a href="/product/edit/{{ $product->id }}" class="btn btn-primary btn-block">
                                    Edit
                                </a>
                                <a href="/product/delete{{ $product->id }}" class="btn btn-danger btn-block">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="mt-4">
                <ul class="pagination">
                    {{ $data->links() }}
                </ul>
            </nav>
        @endif
    @elseif(Auth::check() || !Auth::check())
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
    @endif
@endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>
