<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->roles == 'admin') {
                return redirect()->intended('dashboard');
            } elseif ($user->roles == 'pegawai') {
                return redirect()->intended('');
            } else {
                Auth::logout();
                return redirect()->back()->with('status_error', 'Anda tidak memiliki akses')->withInput();
            }
        }

        return redirect()->back()->with('status_error', 'Email atau password salah')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
