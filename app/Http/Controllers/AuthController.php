<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Fungsi ini digunakan untuk menampilkan halaman login.
     */
    public function index()
    {
        return view('auth.login');
    }

    /**
     * Fungsi ini digunakan untuk memproses login user.
     * Jika login berhasil, maka akan redirect ke halaman dashboard.
     * Jika login gagal, maka akan redirect ke halaman login kembali dengan pesan error.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            Auth::login(Auth::user());
            return redirect('/')->with('success', 'Anda telah berhasil login');
        }
        return redirect()->back()->with('error', 'Password atau email anda salah.');
    }

    /**
     * Fungsi ini digunakan untuk logout user.
     * Jika logout berhasil, maka akan redirect ke halaman login.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout');
    }
}
