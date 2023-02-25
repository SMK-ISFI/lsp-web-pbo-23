<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * Display register 
     * 
     */
    public function index()
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
            'email'     => 'required|email:users|email',
            'password'  => 'required|min:6|confirmed'
        ]);

        $validasi["password"] = Hash::make($validasi["password"]);
        User::create($validasi);

        return redirect('/');
    }
}
