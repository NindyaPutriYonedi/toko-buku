@extends('layouts.admin')

@section('content')
<h2>Tambah Buku</h2>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    {{-- Judul --}}
    <div class="mb-3">
        <label for="title" class="form-label">Judul</label>
        <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
    </div>

    {{-- Penulis --}}
    <div class="mb-3">
        <label for="author" class="form-label">Penulis</label>
        <input type="text" class="form-control" name="author" id="author" value="{{ old('author') }}" required>
    </div>

    {{-- Harga --}}
    <div class="mb-3">
        <label for="price" class="form-label">Harga</label>
        <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" required>
    </div>

    {{-- Stok --}}
    <div class="mb-3">
        <label for="stock" class="form-label">Stok</label>
        <input type="number" class="form-control" name="stock" id="stock" value="{{ old('stock') }}" required>
    </div>

    {{-- Kategori --}}
    <div class="mb-3">
        <label for="category_id" class="form-label">Kategori</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Deskripsi --}}
    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
    </div>

    {{-- Cover --}}
    <div class="mb-3">
        <label for="cover_image" class="form-label">Cover Buku (opsional)</label>
        <input type="file" class="form-control" name="cover_image" id="cover_image" accept="image/*">
    </div>

    <button type="submit" class="btn btn-primary">Simpan</button>
</form>
@endsection
