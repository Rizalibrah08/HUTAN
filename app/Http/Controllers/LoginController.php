<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('backend.login.index'); // Pastikan nama view sesuai
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string|min:6',
        ]);

        // Coba login dengan email atau username
        $loginType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        $credentials = [
            $loginType => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();
            
            // Redirect berdasarkan role user
            if (Auth::user()->role === 'admin') {
                return redirect()->intended('dashboard');
            }
            
            return redirect()->intended('/dashboard');
        }

        // Jika gagal login
        return back()->withErrors([
            'email' => 'Kredensial tidak valid.',
        ])->onlyInput('email');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }
}