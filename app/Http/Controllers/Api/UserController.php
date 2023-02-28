<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            Log::info("user sedang menampilkan semua data user");
            return response()->json([
                'data' => User::select('id', 'name', 'email', 'created_at', 'updated_at')->get()
            ], 200);
        } catch(QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    public function hitung_user()
    {
        try {
            Log::info("user sedang menampilkan total data user");
            return response()->json([
                'total_user' => User::count()
            ], 200);
        } catch(QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
