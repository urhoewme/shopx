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
@extends(Auth::user()->usertype == \App\Models\User::ROLE_ADMIN ? 'layouts.admin' : 'layouts.main')
@section('content')
    <h1>Dashboard</h1>
    @auth
        <h2>Welcome, {{ auth()->user()->name }} !</h2>
    @endauth
    @if(Auth::user()->usertype == \App\Models\User::ROLE_ADMIN)
        <div class="table-responsive">
            <form action="/export" method="post">
                @csrf
                <button type="submit" class="btn btn-primary mb-2">Export product prices</button>
            </form>
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
            <tr>
                <th>Name</th>
                <th>Usertype</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $user)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="ms-3">
                                <p class="fw-bold mb-1">{{ $user->name }}</p>
                                <p class="text-muted mb-0">{{ $user->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->usertype }}</td>
                    <td>
                        <a href="/user/edit/{{ $user->id }}" class="btn btn-primary btn-rounded">
                            Edit
                        </a>
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
@endsection
</body>
</html>
