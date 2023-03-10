<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display login page
     * 
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Process login
     * 
     */
    public function login_proses(Request $request)
    {
        $validasi = $request->validate([
            'email'     => 'required|email',
            'password'  => 'required|'
        ]);

        if (Auth::attempt($validasi)) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        }

        return back()->with('loginError', 'Gagal Login');
    }

    /**
     * Process logout
     * 
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
