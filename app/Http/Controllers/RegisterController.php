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
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cek email di employees
        $employee = Employee::where('email', $request->email)->first();

        if (!$employee) {
            return redirect()->back()->with('status_error', 'Email belum terdaftar oleh admin')->withInput();
        }

        // Cek email sudah terdaftar di users
        if (User::where('email', $request->email)->exists()) {
            return redirect()->route('login')->with('status_error', 'Akun sudah terdaftar. Silahkan Login!')->withInput();
        }

        User::create([
            'id' => $employee->id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('status_success', 'Registrasi berhasil, Silahkan Login!');
    }
}
