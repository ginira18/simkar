<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('login.registrasi');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:employees,email',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            if ($validator->errors()->has('email')) {
                return redirect()->back()->with('status_error', 'Email belum terdaftar oleh admin')->withInput();
            }
        }

        // Temukan karyawan berdasarkan email
        $employee = Employee::where('email', $request->email)->first();
        $user = User::where('username', $request->username)->first();

        if ($user && $employee) {
            return redirect()->back()->with('status_error', 'Username atau email sudah terdaftar')->withInput();
        }

        // Periksa apakah akun sudah terdaftar
        $user = User::where('id', $employee->id)->first();
        if ($user && $user->username && $user->password) {
            return redirect()->back()->with('status_error', 'Akun sudah terdaftar');
        }

        // Buat user baru
        $user = User::create([
            'id' => $employee->id,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status_success', 'Registration successful');
    }
}
