<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {return view('dashboard');});

// Karyawan
Route::get('/daftar_karyawan', function () {return view('daftar_karyawan');});
Route::get('/tambah_karyawan', function () {return view('tambah_karyawan');});
Route::get('/detail_karyawan', function () {return view('detail_karyawan');});
Route::get('/pengaturan_karyawan', function () {return view('pengaturan_karyawan');});
Route::get('/pengaturan_detail_karyawan', function () {return view('pengaturan_detail_karyawan');});

// Presensi
Route::get('/menu_kehadiran', function () {return view('kehadiran/menu_kehadiran');});
Route::get('/halaman_kehadiran', function () {return view('kehadiran/halaman_kehadiran');});
Route::get('/kehadiran_izin', function () {return view('kehadiran/kehadiran_izin');});
Route::get('/riwayat_kehadiran', function () {return view('kehadiran/riwayat_kehadiran');});

// Gaji
Route::get('/gaji', function () {return view('gaji/gaji');});

//Laporan
Route::get('/laporan_gaji', function () {return view('laporan/laporan_gaji');});
Route::get('/laporan_karyawan', function () {return view('laporan/laporan_karyawan');});
// Route::get('/detail_laporan_karyawan', function () {return view('laporan/detail_laporan_karyawan');});

