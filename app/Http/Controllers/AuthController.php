<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //menampilkan login
    public function index()
    {
        return view('login');
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
            return redirect()->route('laundry');
        } else {
            // return 'gagal'
            return redirect('/')->withErrors('username dan password tidak valid');
        }
    }
    // logout
    public function logout(Request $request)
    {
        Auth::logout(); // logout user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerasi token CSRF

        return redirect('/')->with('success', 'Anda telah logout');
    }
}
