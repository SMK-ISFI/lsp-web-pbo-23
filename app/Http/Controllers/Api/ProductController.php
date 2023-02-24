<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'data' => Product::select('id', 'namaproduk', 'deskripsi', 'harga', 'gambar')->get()
            ], 200);
        } catch(QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validasi = Validator::make($request->all(), [
                'namaproduk'    => 'required',
                'deskripsi'     => 'required',
                'harga'         => 'required|integer',
                'gambar'        => 'required|image|mimes:jpg,png|max:4096'
            ]);
    
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            $gambar = $request->file('gambar')->store('public/gambar');
            $data = Product::create([
                'namaproduk' => $request->namaproduk,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga,
                'gambar' => $gambar,
            ]);

            return response()->json([
                'status' => 'berhasil',
                'data'  => $data
            ], 201);

        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return response()->json([
                'data' => Product::select('id', 'namaproduk', 'deskripsi', 'harga', 'gambar')
                            ->where('id', $id)->first()
            ], 200);
        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $validasi = Validator::make($request->all(), [
                'namaproduk'    => 'required',
                'deskripsi'     => 'required',
                'harga'         => 'required|integer',
            ]);
    
            if ($validasi->fails()) {
                return response()->json($validasi->errors(), 422);
            }

            Product::where('id', $id)->update([
                'namaproduk' => $request->namaproduk,
                'deskripsi' => $request->deskripsi,
                'harga' => $request->harga
            ]);

            return response()->json([
                'status' => 'update berhasil',
            ], 201);


        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product->gambar) {
                Storage::delete($product->gambar);
            }

            $product->delete();

            return response()->json([
                'status' => 'hapus berhasil',
            ], 200);

        } catch (QueryException $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
