<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display dashboard
     * 
     */
    public function index()
    {
        $jumlah = Product::count();
        return view('pages.dashboard', [
            'jumlah' => $jumlah
        ]);
    }
}
