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
@extends(Auth::check() ? (Auth::user()->usertype == \App\Models\User::ROLE_ADMIN ? 'layouts.admin' : 'layouts.main' ) : 'layouts.main')
@section('content')
    @if(session()->has('message'))
        <div class="alert alert-success">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            {{ session()->get('message') }}
        </div>
    @endif
    @if(Auth::check())
        @if(Auth::user()->usertype == \App\Models\User::ROLE_ADMIN)
            <a href="/product/create" class="btn btn-primary mb-2">Add new product</a>
            <form class="d-flex mb-2" role="search">
                @csrf
                <input
                    type="search"
                    class="form-control me-2"
                    name="search"
                    value="{{ $query }}"
                >
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
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
                                <form method="POST" action="/product/delete/{{ $product->id }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-block">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav class="mt-4">
                <ul class="pagination">
                    {{ $data->appends(['search' => $query])->links() }}
                </ul>
            </nav>
        @else
            <h1 class="fw-bold">Products</h1>
            <form class="d-flex mb-4" role="search">
                @csrf
                <input
                    type="search"
                    class="form-control me-2"
                    name="search"
                    value="{{ $query }}"
                >
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <form class="mb-4">
                @csrf
                <label class="mb-2">Sort by:</label>
                <select name="sorting" class="form-select mb-2" aria-label="Default select example">
                    <option value="default" selected>Default sorting</option>
                    <option value="title">Title: from A-Z</option>
                    <option value="title-desc">Title: from Z-A</option>
                    <option value="price">Price: from low to high</option>
                    <option value="price-desc">Price: from high to low</option>
                </select>
                <button class="form-control btn btn-primary">Apply</button>
            </form>
            <form class="mb-4" action="">
                @csrf
                <select name="tags[]" class="form-select mb-2" multiple aria-label="multiple select example">
                    @foreach(\App\Models\Tag::all() as $tag)
                        <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                <button class="form-control btn btn-primary">Apply</button>
            </form>
            <section style="background-color: #eee;">
                <div class="container py-5">
                    <div class="row">
                        @foreach($data as $product)
                            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                                <div class="card mb-4">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            @if($product->tags->count() > 0)
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" aria-expanded="false">
                                                        Tags
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        @foreach($product->tags as $tag)
                                                            <li>{{ $tag->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
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
            <nav class="mt-4">
                <ul class="pagination">
                    {{ $data->appends(['search' => $query, 'sorting' => $sorting])->links() }}
                </ul>
            </nav>
        @endif
    @else
        <h1 class="fw-bold">Products</h1>
        <form class="mb-2">
            @csrf
            <select name="sorting" class="form-select mb-2" aria-label="Default select example">
                <option value="default" selected>Default sorting</option>
                <option value="title">Title: from A-Z</option>
                <option value="title-desc">Title: from Z-A</option>
                <option value="price">Price: from low to high</option>
                <option value="price-desc">Price: from high to low</option>
            </select>
            <button class="form-control btn btn-primary">Apply</button>
        </form>
        <form class="d-flex mb-2" role="search">
            @csrf
            <input
                type="search"
                class="form-control me-2"
                name="search"
                value="{{ $query }}"
            >
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        <section style="background-color: #eee;">
            <div class="container py-5">
                <div class="row">
                    @foreach($data as $product)
                        <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        @if($product->tags->count() > 0)
                                            <div class="dropdown">
                                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    Tags
                                                </button>
                                                <ul class="dropdown-menu">
                                                    @foreach($product->tags as $tag)
                                                        <li>{{ $tag->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
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
        <nav class="mt-4">
            <ul class="pagination">
                {{ $data->appends(['search' => $query, 'sorting' => $sorting])->links() }}
            </ul>
        </nav>
    @endif

@endsection
</body>
</html>
