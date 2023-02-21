<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('pages.products.index', [
            'products' => $products
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.products.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'namaproduk' => 'required|max:255',
            'deskripsi'  => 'required',
            'harga'      => 'required|integer',
            'gambar'     => 'required|file|max:4096|mimes:png,jpg'
        ]);

        if ($request->file('gambar')) {
            $validasi['gambar'] = $request->file('gambar')->store('public/gambar');
        }

        Product::create($validasi);

        return redirect('/products')->with('success', 'Data produk berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('pages.products.edit', [
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validasi = $request->validate([
            'namaproduk' => 'required|max:255',
            'deskripsi'  => 'required',
            'harga'      => 'required|integer'
        ]);

        Product::where('id', $product->id)->update($validasi);

        return redirect('/products')->with('success', 'Data produk berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if ($product->gambar) {
            Storage::delete($product->gambar);
        }

        Product::destroy($product->id);
        return redirect('/products')->with('success', 'Data produk berhasil dihapus!');
    }
}
