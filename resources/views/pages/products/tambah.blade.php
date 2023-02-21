@extends('pages.main')

@section('content')
<h3 class="mb-5">Tambah Produk</h3>

<div class="col-6">
  <form action="/products" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="nama-produk" class="form-label">Nama Produk</label>
      <input type="text" class="form-control" name="namaproduk" id="namaproduk" required>
      @error('namaproduk')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-3">
      <label for="nama-produk" class="form-label">Deskripsi Produk</label>
      <textarea rows="5" class="form-control" name="deskripsi" name="deskripsi" required></textarea>
      @error('deskripsi')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-3">
      <label for="harga" class="form-label">Harga Produk</label>
      <input type="number" class="form-control" name="harga" id="harga" required>
      @error('harga')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>

    <div class="mb-3">
      <label for="gambar" class="form-label">Gambar Produk</label>
      <input type="file" class="form-control" name="gambar" id="gambar" required>
      @error('gambar')
        <small class="text-danger">{{ $message }}</small>
      @enderror
    </div>
    <button type="submit" class="btn btn-custom">Simpan</button>
  </form>
</div>
@endsection