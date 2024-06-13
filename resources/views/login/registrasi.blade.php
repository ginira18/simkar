<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar-Register')</title>
    @vite(['resources/css/app.css'])
</head>

<div class="content-wrapper d-flex justify-content-center" style="height: 100vh; width: 100vw;">
    <div class="card rounded mb-5 mr-2 p-4 col-xs-12 col-sm-8 col-md-4">
        <h2 class="text-center mb-5">Register</h2>
        <div>
            @if (session('status_error'))
                <div class="alert alert-danger">
                    {{ session('status_error') }}
                </div>
            @endif
            @if (session('status_success'))
                <div class="alert alert-success">
                    {{ session('status_success') }}
                </div>
            @endif
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mb-3" action="{{ route('register') }}" method="POST">
            @csrf
            <label class="col-12 p-0" for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control mb-3"
                placeholder="Masukkan email sesuai dengan yang sudah didaftarkan admin" required autofocus>

            <label for="username">Username</label>
            <input type="username" name="username" id="username" class="form-control mb-3"
                placeholder="Masukkan username" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control mb-5"
                placeholder="Masukkan password" required>

            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <div class="d-flex justify-content-center">
            <small>Sudah terdaftar? <a href={{route('login')}}>Masuk</a></small>
        </div>
    </div>

    @vite(['resources/js/app.js'])

    @yield('scripts')
</div>

</html>
