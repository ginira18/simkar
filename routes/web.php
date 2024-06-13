<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeSettingController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/welcome', function () {return view('welcome');});
// Route::get('/', function () {return view('dashboard');});

Route::middleware('admin')->group(function () {
    // Dashboard
    Route::resource('dashboard', DashboardController::class);
    // Karyawan
    Route::resource('karyawan', EmployeeController::class);
    Route::post('karyawan/{id}/deactivate', [EmployeeController::class, 'deactivate'])->name('karyawan.deactivate');

    // sementara
    Route::post('karyawan/{id}/activate', [EmployeeController::class, 'activate'])->name('karyawan.activate');

    // Pengaturan Karyawan
    Route::resource('pengaturan-karyawan', EmployeeSettingController::class);
    Route::post('/pengaturan-karyawan/{id}/deactivate', [EmployeeSettingController::class, 'deactivate'])->name('pengaturan-karyawan.deactivate');
    Route::post('/pengaturan-karyawan/{id}/activate', [EmployeeSettingController::class, 'activate'])->name('pengaturan-karyawan.activate');
    // Kehadiran
    Route::get('/dashboard-kehadiran/current-time', [AttendanceController::class, 'getCurrentTime'])->name('dashboard-kehadiran.current-time');
    Route::resource('dashboard-kehadiran', AttendanceController::class);
});


// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Presensi
// Route::get('/menu_kehadiran', function () {return view('kehadiran/menu_kehadiran');});
// Route::get('/halaman_kehadiran', function () {return view('kehadiran/halaman_kehadiran');});
// Route::get('/kehadiran_izin', function () {return view('kehadiran/kehadiran_izin');});
// Route::get('/riwayat_kehadiran', function () {return view('kehadiran/riwayat_kehadiran');});

// Gaji
Route::get('/gaji', function () {
    return view('gaji/daftar_gaji');
});

//Laporan
Route::get('/laporan_gaji', function () {
    return view('laporan/laporan_gaji');
});
Route::get('/laporan_karyawan', function () {
    return view('laporan/laporan_karyawan');
});
// Route::get('/detail_laporan_karyawan', function () {return view('laporan/detail_laporan_karyawan');});

// Pengguna 
Route::get('/kehadiran', function () {
    return view('pengguna/kehadiran');
});
Route::get('/pengguna/home', function () {
    return view('pengguna/home');
});
Route::get('/pengguna/kehadiran', function () {
    return view('pengguna/kehadiran');
});  

// Login
// Route::get('/login', function () {return view('login/index');});
// Route::get('/registrasi', function () {return view('login/registrasi');});