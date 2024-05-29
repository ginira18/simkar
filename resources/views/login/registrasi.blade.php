<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Simkar')</title>
    @vite(['resources/css/app.css'])
</head>

<div class="content-wrapper d-flex justify-content-center" style="height: 100vh; width: 100vw;">
    <div class="card rounded mb-5 mr-2 p-4 col-xs-12 col-sm-8 col-md-4">
        <h2 class="text-center mb-5">Register</h2>
        <form class="mb-3" action="login">
            <label class="col-12 p-0" for="username">Email</label>
            {{-- <small class="text-danger">
                NB: Sesuaikan dengan yang sudah didaftarkan oleh admin!
            </small> --}}
            <input type="email" name="username" id="username" class="form-control mb-3" placeholder="Masukkan email sesuai dengan yang sudah didaftarkan oleh admin" required autofocus>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control mb-5" placeholder="Masukkan password"
                required>
            <button type="submit" class="btn btn-primary btn-block">Daftar</button>
        </form>
        <div class="d-flex justify-content-center">
            <small>Sudah terdaftar? <a href="/login">Masuk</a></small>
        </div>
    </div>

    @vite(['resources/js/app.js'])

    @yield('scripts')
</div>

</html>
