<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
     * Display register 
     * 
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Process register
     * 
     */
    public function register_proses(Request $request)
    {
        $validasi = $request->validate([
            'name'      => 'required|max:255',
            'email'     => 'required|email:users|email:dns',
            'password'  => 'required|min:6|confirmed'
        ]);

        $validasi["password"] = Hash::make($validasi["password"]);
        User::create($validasi);

        return redirect('/');
    }   

    /**
     * Process login
     * 
     */
    public function login_proses(Request $request)
    {
        $validasi = $request->validate([
            'email'     => 'required|email:dns',
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
