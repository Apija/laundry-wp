<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //menampilkan login
    public function login()
    {
        return view('login');
    }
    public function dashboard()
    {
        return view('dashboard');
    }
    public function petugasdashboard()
    {
        return view('petugas.dashboard');
    }
    //verifikasi use and password
    public function autheticate(Request $request)
    {
        Session::flash('email', $request->email);

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email wajib disini',
            'password.required' => 'password wajib disini',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($infologin)) {

            // Ambil user yang sedang login
            $user = Auth::user();

            // Arahkan sesuai role
            if ($user->role === 'admin') {
                return redirect()->route('dashboard'); // admin dashboard
            }

            if ($user->role === 'petugas') {
                return redirect()->route('petugas.dashboard'); // petugas dashboard
            }

            // Jika role tidak dikenali
            Auth::logout();
            return redirect('/login')->withErrors('Role tidak dikenal.');
        }

        return redirect('/login')->withErrors('username dan password tidak valid');
    }

    // logout
    public function logout(Request $request)
    {
        Auth::logout(); // logout user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerasi token CSRF

        return redirect('/login')->with('success', 'Anda telah logout');
    }
}
