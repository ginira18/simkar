<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar')</title>
    @vite(['resources/css/app.css'])
</head>

<div class="content-wrapper d-flex justify-content-center" style="height: 100vh; width: 100vw;">
    <div class="card rounded mb-5 mr-2 p-4 col-md-4">
        <h2 class="text-center mb-5">Login</h2>
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
        <form class="mb-3 mt-5" action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control mb-3" placeholder="Masukkan email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control mb-5" placeholder="Masukkan password"
                required>
            <button type="submit" class="btn btn-primary btn-block">Masuk</button>
        </form>
        <div class="d-flex justify-content-center">
            <small>Tidak terdaftar? <a href={{route('register')}}>Daftar sekarang!</a></small>
        </div>
    </div>


    @vite(['resources/js/app.js'])

    @yield('scripts')
</div>

</html>
