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
    <section class="vh-100 bg-image">
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Change user permissions</h2>
                                <form method="POST" action="{{ url('/user/edit', $data->id) }}">
                                    @csrf
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example3cg">User name</label>
                                        <p class="fw-bold fs-4">{{ $data->name }}</p>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">User email</label>
                                        <p class="fw-bold fs-4">{{ $data->email }}</p>
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="form3Example4cg">User type</label>
                                        <select class="form-select" name="usertype">
                                            <option value="0" {{ ($data->usertype === '0') ? 'Selected' : '' }}>
                                                User
                                            </option>
                                            <option value="1" {{ ($data->usertype === '1') ? 'Selected' : '' }}>
                                                Admin
                                            </option>
                                        </select>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="submit" name="submit"
                                                class="btn btn-primary btn-block btn-lg gradient-custom-4 text-white">
                                            Submit
                                        </button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
</body>
</html>
