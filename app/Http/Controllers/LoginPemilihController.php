<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginPemilihController extends Controller
{
    public function index()
    {
        return view('login.loginpemilih.index', [
            'title' => 'Login Pemilih'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('pemilih')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal!')->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('pemilih')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/loginPemilih');
    }
}
